const display = document.querySelector("#product-display");
const pagination = document.querySelector("#pagination-bar");
const categories = document.querySelector("#filter-categories");
const priceMin = document.querySelector("#price-min");
const priceMax = document.querySelector("#price-max");
const search = document.querySelector("#filter-search input");
const sort_select = document.querySelector("#sort-select");

let current = 1;
let sort = {
  by: "createdDate",
  order: "DESC",
};
let filter = {
  title: "",
  categories: [],
  price_range: [priceMin.value, priceMax.value],
};

// Debounce helper
function debounce(fn, delay = 500) {
  let timeout;
  return (...args) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => fn.apply(this, args), delay);
  };
}

// Init categories
filter.categories = Array.from(categories.querySelectorAll("button")).map(
  (btn) => btn.value
);

// Debounced category update
const updateCategories = debounce(() => {
  const activeButtons = categories.querySelectorAll("button.btn-active");
  filter.categories = Array.from(activeButtons).map((btn) => btn.value);
  load_products(1, sort, filter);
}, 500);

// Category buttons
categories.addEventListener("click", (e) => {
  if (e.target.tagName === "BUTTON") {
    e.target.classList.toggle("btn-active");
    updateCategories();
  }
});

// Debounced filter updates
const updatePriceRange = debounce(() => {
  filter.price_range[0] = parseFloat(priceMin.value) || 0;
  filter.price_range[1] = parseFloat(priceMax.value) || 5;
  load_products(1, sort, filter);
}, 500);

const updateSearch = debounce(() => {
  filter.title = search.value.trim();
  load_products(1, sort, filter);
}, 500);

priceMin.addEventListener("input", updatePriceRange);
priceMax.addEventListener("input", updatePriceRange);
search.addEventListener("input", updateSearch);

sort_select.addEventListener("change", function () {
  const selected_value = sort_select.value;
  const [sortBy, sortOrder] = selected_value.split("-");

  const sort = {
    by: sortBy,
    order: sortOrder,
  };

  load_products(1, sort, filter);
});

// Pagination buttons
function attachPaginationEvents() {
  const prevbtn = document.querySelector("#pagination-bar #prev");
  const nextbtn = document.querySelector("#pagination-bar #next");

  if (prevbtn) {
    prevbtn.addEventListener("click", () => {
      load_products(current - 1, sort, filter);
    });
  }

  if (nextbtn) {
    nextbtn.addEventListener("click", () => {
      load_products(current + 1, sort, filter);
    });
  }

  document
    .querySelectorAll("#pagination-bar button[data-page]")
    .forEach((btn) => {
      const page = btn.getAttribute("data-page");
      if (page) {
        btn.addEventListener("click", () => {
          load_products(parseInt(page), sort, filter);
        });
      }
    });
}
attachPaginationEvents();

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
        console.log(total_pages);
        current = update_pagination(page_num, total_pages);
        let products_html = "";

        res["data"].forEach((prod) => {
          products_html += `
                    <a href="/product/${prod["title"]})-${prod["id"]}">
                        <img src="public/images/${prod["imageLink"]}" alt="${prod["title"]}">
                        <span>${prod["catName"]}</span>
                        <h1>${prod["title"]}</h1>
                        <div>
                            <span>${prod["price"]}</span>
                            <span>${prod["salesAmount"]}</span>
                        </div>
                    </a>`;
        });

        display.innerHTML = products_html;
        attachPaginationEvents(); // re-attach listeners after pagination redraw
      }
    })
    .catch((err) => console.log(err));
}

function update_pagination(current, total) {
  if (total === 0) {
    display.innerHTML = "";
    pagination.innerHTML = "";
    return 0;
  }
  const delta = 2;
  const range = [];

  if (current >= 1) range.push(1);
  if (current - delta > 2) range.push("...");
  for (let i = current - delta; i <= current + delta; ++i) {
    if (i > 1 && i < total) range.push(i);
  }
  if (current + delta < total - 1) range.push("...");
  if (current <= total && total != 1) range.push(total);

  let html = "";
  if (total > 1 && current > 1) html += `<button id="prev">&lt;</button>`;

  range.forEach((page) => {
    if (page === "...") {
      html += `<button disabled>...</button>`;
    } else if (page === current) {
      html += `<button class="btn-active" data-page="${page}">${page}</button>`;
    } else {
      html += `<button data-page="${page}">${page}</button>`;
    }
  });

  if (total > 1 && current < total) html += `<button id="next">&gt;</button>`;
  pagination.innerHTML = html;
  return current;
}
