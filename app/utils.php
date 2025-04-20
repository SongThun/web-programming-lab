<?php
    function slugify($string) {
        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
        $string = preg_replace('/[\s-]+/', '-', $string);
        return trim($string, '-');
    }
    function getDiscount($item) {
        $price = $item['price'];
        $discount = round($price * (1 - $item['discount']), 2);
        if ($item['discount'] > 0) {
            echo "<span class='flex'>
                <h3 class='old-text' style='margin-right: 3px;'>$$price</h2>
                <h3 class='new-text'>$$discount</h2>
            </span>";
        } else {
            echo "<h3>$$price</h2>";
        }
    }
    function e($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
    
?>
