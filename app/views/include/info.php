<?php 
if (isset($_SESSION['user_id'])) {
    
echo '<button>favorite</button>';
echo "<span>" . $_SESSION["username"] . "</span>";
echo '<a href="?page=logout">Log out</a>';
}
else{
echo '<a id="logout-btn" href="?page=login">Login</a>';
}
?>

