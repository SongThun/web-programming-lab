<div class="flex space-between" id="product-utils">
    <input id="filter-search" type="text" placeholder="Search...">
    <select name="sort" id="sort-select">
        <option selected value="createdDate-DESC">Newest</option>
        <option value="createdDate-ASC">Oldest</option>
        <option value="price-DESC">Highest price</option>
        <option value="price-ASC">Lowest price</option>
        <option value="salesAmount-DESC">Best selling</option>
    </select>
    <div id="pagination">
        <!-- <?php if ($total_pages > 1):?>
            <button id="prev">&lt;</button>
        <?php endif; ?> -->
        1/<?= $total_pages ?>
        <?php if ($total_pages > 1):?>
            <button id="next">&gt;</button>
        <?php endif; ?>
    </div>
</div>