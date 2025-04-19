<div class="flex center align-center mb-2" id="sort-bar">
    <button class="me-2" id="filter-btn" style="display: none;"><i class='bx bx-filter'></i></button>
    <label class="me-2" for="sort">Sort by</label>
    <select name="sort" id="sort-select">
        <option selected value="createdDate-DESC">Newest</option>
        <option value="createdDate-ASC">Oldest</option>
        <option value="price-DESC">Highest price</option>
        <option value="price-ASC">Lowest price</option>
        <option value="salesAmount-DESC">Best selling</option>
    </select>
</div>

<script>
    const filterBtn = document.querySelector("#filter-btn");
    const filterDiv = document.querySelector("#filter");

    function changeSort() {
        if (window.matchMedia("(max-width: 768px)").matches) {
            filterBtn.style.display = 'block';
        } else {
            filterBtn.style.display = "none";
        }
    }

    window.addEventListener('resize', changeSort);
    window.addEventListener('load', changeSort);

    filterBtn.addEventListener('click', () => {
        filterDiv.classList.toggle('filter-collapsed');
    })
    document.addEventListener('click', function(e) {
        const isClickInside = filterDiv.contains(event.target) || filterBtn.contains(event.target);

        if (!isClickInside && filterDiv.classList.contains('filter-collapsed')) {
            filterDiv.classList.remove('filter-collapsed');
        }
    });
</script>