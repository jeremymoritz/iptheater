<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once('_inc/ipt_1.php');
$title = "Test PHP Page";
require_once('_inc/ipt_2.php');

?>
<?=$header;?>
<body id='<?=pathinfo($_SERVER['PHP_SELF'])['filename'];?>'>
	<?=$topper;?>
		<?=$navbar;?>
		<section class='main'>
			<p>
			<?php
			$email = 'abc.com';
			if (preg_match("/^[^@]+@[^@]+$/", $email)) {
				echo "yes";
			} else {
				echo "no";
			}
			?>
			</p>
		</section>
	<?=$footer;?>
</body>
</html>

