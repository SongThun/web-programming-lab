<?php
$total_pages = ceil($total / $limit);
?>
<div id="pagination-bar" class="flex center">
    <button class="btn-active">1</button>
    <?php if ($total_pages <= 6): ?>
        <?php for ($i = 2; $i <= $total_pages; $i++): ?>
            <button data-page="<?= $i ?>"><?= $i ?></button>
        <?php endfor; ?>
        <?php if ($total_pages > 0): ?>
            <button id="next">&gt;</button>
        <?php endif; ?>
    <?php else: ?>
        <button data-page="2">2</button>
        <button data-page="3">3</button>
        <button>...</button>
        <button data-page="<?= $total_pages - 2 ?>"><?= $total_pages - 2 ?></button>
        <button data-page="<?= $total_pages - 1 ?>"><?= $total_pages - 1 ?></button>
        <button data-page="<?= $total_pages ?>"><?= $total_pages ?></button>
        <button id="next"><i class="bx bx-chevron-right"></i></button>
    <?php endif; ?>
</div>