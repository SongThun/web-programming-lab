<?php
$total_pages = ceil($total / $limit);
?>
<div id="pagination-bar">
    <button class="btn-active">1</button>
    <?php
    if ($total_pages <= 6) {
        for ($i = 2; $i <= $total_pages; $i += 1) {
            echo "<button data-page=$i>$i</button>";
        }
        if ($total_pages > 0) {
            echo '<button id="next">&gt;</button>';
        }
    } else {
        echo "<button data-page=2>2</button>";
        echo "<button data-page=3>3</button>";
        echo "<button>...</button>";
        echo "<button data-page=" . $total_pages - 2 .">" . $total_pages - 2 . "</button>";
        echo "<button data-page=" . $total_pages - 1 .">" . $total_pages - 1 . "</button>";
        echo "<button data-page=$total_pages>$total_pages</button>";
        echo '<button id="next">&gt;</button>';
    }
    ?>
</div>
