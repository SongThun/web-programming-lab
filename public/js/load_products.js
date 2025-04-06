const display = document.querySelector("#product-display");
const pagination = document.querySelector("#pagination-bar");
const categories = document.querySelector("#categories-list");
const priceMin = document.querySelector("#price-min");
const priceMax = document.querySelector("#price-max");
const search = document.querySelector("#filter-search input");
const sort_select = document.querySelector("#sort-select");

const all_cats = Array.from(categories.querySelectorAll("button")).map(btn => btn.value);

let current = 1;
let sort = { by: "createdDate", order: "DESC" };
let filter = {
  title: "",
  categories: all_cats,
  price_range: [priceMin.value, priceMax.value],
};

function debounce(fn, delay = 500) {
  let timeout;
  return (...args) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => fn.apply(this, args), delay);
  };
}

document.querySelector("#select-all").addEventListener("click", () => {
  filter.categories = all_cats;
  categories.querySelectorAll("button").forEach((ele) => {
    ele.classList.add("btn-active");
  });
  debounce(() => load_products(1, sort, filter), 500);
});

document.querySelector("#remove-all").addEventListener("click", () => {
  filter.categories = [];
  categories.querySelectorAll("button").forEach((ele) => {
    ele.classList.remove("btn-active");
  });
  debounce(() => load_products(1, sort, filter), 500);
});

// Update categories filter
const updateCategories = debounce(() => {
  const activeButtons = categories.querySelectorAll("button.btn-active");
  filter.categories = Array.from(activeButtons).map(btn => btn.value);
  load_products(1, sort, filter);
}, 500);

// Update price range filter
const updatePriceRange = debounce(() => {
  filter.price_range[0] = parseFloat(priceMin.value) || 0;
  filter.price_range[1] = parseFloat(priceMax.value) || 5;
  load_products(1, sort, filter);
}, 500);

// Update search filter
const updateSearch = debounce(() => {
  filter.title = search.value.trim();
  load_products(1, sort, filter);
}, 500);

categories.addEventListener("click", (e) => {
  if (e.target.tagName === "BUTTON") {
    e.target.classList.toggle("btn-active");
    updateCategories();
  }
});
priceMin.addEventListener("input", updatePriceRange);
priceMax.addEventListener("input", updatePriceRange);
search.addEventListener("input", updateSearch);

sort_select.addEventListener("change", function () {
  const [sortBy, sortOrder] = sort_select.value.split("-");
  sort = { by: sortBy, order: sortOrder };
  load_products(1, sort, filter);
});

// Attach pagination events
function attachPaginationEvents() {
  const prevbtn = document.querySelector("#pagination-bar #prev");
  const nextbtn = document.querySelector("#pagination-bar #next");

  if (prevbtn) prevbtn.addEventListener("click", () => load_products(current - 1, sort, filter));
  if (nextbtn) nextbtn.addEventListener("click", () => load_products(current + 1, sort, filter));

  document.querySelectorAll("#pagination-bar button[data-page]").forEach((btn) => {
    const page = btn.getAttribute("data-page");
    if (page) {
      btn.addEventListener("click", () => {
        load_products(parseInt(page), sort, filter);
      });
    }
  });
}
attachPaginationEvents();

function bindAddToCart() {
  const buttons = document.querySelectorAll(".add-cart-btn");
  buttons.forEach(btn => {
    btn.onclick = (e) => {
      const id = btn.dataset.id;
      const title = btn.dataset.title;
      addItem(id, title, e);
    };
  });
}

// Function to load products
function load_products(page_num, sort, filter) {
  fetch("api.php?page=product", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ sort, filter, page_num }),
  })
    .then((response) => response.json())
    .then((res) => {
      if (res["status"] === "success") {
        let total_pages = res["total_pages"];
        current = update_pagination(page_num, total_pages);
        let products_html = "";

        res["data"].forEach((prod) => {
          const url = `?page=product&item=${encodeURIComponent(prod.title.toLowerCase() + '-' + prod.id)}`;
          const img = `public/images/${prod.imageLink}`;
          products_html += `
            <a class="card container space-between" href="${url}">
              <div class="img-div" style="background-image: url('${img}')">
                <div class="flex space-between">
                  <button class="tag tag-left">${prod.catName}</button>
                  <button class="tag tag-right flex">${prod.salesAmount}<i class='bx bxs-heart'></i></button>
                </div>
              </div>
              <div class="img-info">
                <span>
                  <h1>${prod.title}</h1>
                  <span>$${prod.price}</span>
                </span>
                <button
                  class="add-cart-btn"
                  data-id="${prod.id}"
                  data-title="${prod.title.replace(/"/g, '&quot;')}">
                  <i class='bx bx-cart-add'></i>
                </button>
              </div>
            </a>`;
        });

        display.innerHTML = products_html;
        attachPaginationEvents();
        bindAddToCart(); // Re-bind after reload
      }
    })
    .catch((err) => console.error(err));
}

// Function to update pagination
function update_pagination(current, total) {
  if (total === 0) {
    display.innerHTML = "";
    pagination.innerHTML = "";
    return 0;
  }

  const delta = 1;
  const range = [];

  if (current >= 1) range.push(1);
  if (current - delta > 2) range.push("...");
  for (let i = current - delta; i <= current + delta; ++i) {
    if (i > 1 && i < total) range.push(i);
  }
  if (current + delta < total - 1) range.push("...");
  if (current <= total && total !== 1) range.push(total);

  let html = "";
  if (total > 1 && current > 1) html += `<button id="prev"><i class='bx bx-chevron-left'></i></button>`;
  range.forEach((page) => {
    if (page === "...") {
      html += `<button disabled>...</button>`;
    } else if (page === current) {
      html += `<button class="btn-active" data-page="${page}">${page}</button>`;
    } else {
      html += `<button data-page="${page}">${page}</button>`;
    }
  });
  if (total > 1 && current < total) html += `<button id="next"><i class='bx bx-chevron-right'></i></button>`;
  pagination.innerHTML = html;
  return current;
}
