const display = document.querySelector("#product-display");
const pagination = document.querySelector("#pagination");
const categories = document.querySelectorAll("#filter-categories button");
const all_cats = Array.from(categories)
  .slice(1)
  .map((btn) => btn.value);
const search = document.querySelector("#filter-search");
const sort_select = document.querySelector("#sort-select");

let current = 1;
let filter = {
  categories: all_cats,
  price_range: [],
  title: "",
};
let sort = {
  by: "createdDate",
  order: "DESC",
};

function debounce(fn, delay = 500) {
  let timeout;
  return (...args) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => fn.apply(this, args), delay);
  };
}

function update_categories() {
  active_btn = document.querySelector("#filter-categories .btn-active");
  if (active_btn.value === "all") {
    filter.categories = all_cats;
  } else {
    filter.categories = [active_btn.value];
  }
  load_products(1, sort, filter);
}

categories.forEach((btn) => {
  btn.addEventListener("click", () => {
    categories.forEach((b) => b.classList.remove("btn-active"));
    btn.classList.add("btn-active");
    update_categories();
  });
});

const update_search = debounce(() => {
  filter.title = search.value.trim();
  load_products(1, sort, filter);
}, 500);

function attachPaginationEvents() {
  const prevbtn = document.querySelector("#pagination #prev");
  const nextbtn = document.querySelector("#pagination #next");

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
}
attachPaginationEvents();

sort_select.addEventListener("change", function () {
  const selected_value = sort_select.value;
  const [sortBy, sortOrder] = selected_value.split("-");

  const sort = {
    by: sortBy,
    order: sortOrder,
  };

  load_products(1, sort, filter);
});

search.addEventListener("input", update_search);

function load_products(page_num, sort, filter) {
  fetch("api.php?page=product", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ sort, filter, page_num }),
  })
    .then((response) => response.json())
    .then((res) => {
      if (res["status"] === "success") {
        let total_pages = res["total_pages"];
        current = update_pagination(page_num, total_pages);

        let html = "";
        res["data"].forEach((prod) => {
          html += `<tr>
                        <td>${prod["id"]}</td>
                        <td><div>
                            <span>${prod["catName"]}</span>
                            <span>${prod["title"]}</span>
                        </div></td>
                        <td>${prod["price"]}</td>
                        <td>${prod["salesAmount"]}</td>
                        <td>${prod["inStock"]}</td>
                        <td>${prod["discount"]}</td>
                        <td><img src="public/images/${prod["imageLink"]}" alt=""></td>
                    </tr>`;
        });
        display.innerHTML = html;
        attachPaginationEvents(page_num);
      }
    });
}

function update_pagination(current, total) {
  html = "";
  if (total > 1 && current > 1) {
    html += '<button id="prev">&lt;</button>';
  }
  if (total > 0 && current <= total) {
    html += current + "/" + total;
  }
  if (total > 1 && current < total) {
    html += '<button id="next">&gt;</button>';
  }
  pagination.innerHTML = html;
  return current;
}
