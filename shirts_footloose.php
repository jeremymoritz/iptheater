<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once('_inc/ipt_1.php');
require_once('_inc/ipt_2.php');
     
?>
<?=$header;?>
<body id='<?=$thisPageBaseName;?>'>
	<?=$topper;?>
		<?=$navbar;?>
		<section class='main'>
			<h1>Immeasurable Productions</h1>
			<!--<h2><img src='_img/footloose-logo_600.png' alt='Footloose' id='fl_logo'></h2>-->
			<h2>Facebook Cover Photo</h2>
			<p>(Right-click to save the image to your computer, then upload it to Facebook as a cover photo)</p>
			<img src='_img/Footloose-Facebook-Cover.jpg' alt='Footloose Facebook Cover'>
			<h2>Cast in shirts</h2>
			<p>(Right-click on your photo, save the image to your computer, then upload it to Facebook as a profile pic)</p>
			<section class='photos'>
				<?php
				
					foreach(scandir("_img/shirts") as $img) {
						echo strpos($img, "shirt") ? "<img src='_img/shirts/$img' alt='' class='enlarge'>\n" : "";
					}
				
				?>
			</section>
			<ul>
				<li><a href='bbb_cast'>Click here for the cast resources page</a>.</li>
				<li><a href='downloads/Footloose%20costume%20ideas.pdf'>Click here for costume ideas</a>.</li>
			</ul>
			<br>
			<h2>Rehearsal Schedule</h2>
			<img src='_img/footloose_rehearsal_schedule.jpg' alt=''>
		</section>
	<?=$footer;?>
</body>
</html>
