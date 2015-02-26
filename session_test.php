<?php
session_start();
$_SESSION['views'] = isset($_SESSION['views']) ? $_SESSION['views'] + 1 : 1;

echo "views = ". $_SESSION['views'];
echo '<p><a href="' . $_SERVER['PHP_SELF'] . '">Refresh</a></p>';

echo (new DateTime('NOW'))->format('c');
echo "<p>Ten minutes ago was " . date('Y-m-d H:i:s', strtotime('-10 minutes')) . "</p>";
$k = $p = 12;
echo "<p>K and P = $k and $p</p>";
echo "browser: " . $_SERVER['HTTP_USER_AGENT'] . "<br>\n";

// $browser = get_browser(null, true);
echo get_browser();
// echo "browser (simplified): " . $browser['browser'] . " " . $browser['version'];
?>
