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
			<h3>Facebook Cover Photos!</h3>
			<p>Right-click on either of these images to save the high resolution version to your local computer.  Then upload it as your Facebook Cover photo (it's already sized perfectly to fit).  This is a fun way to promote the show to your Facebook friends!</p>
			<div class='fb_photos'>
				<div>
					<a href='downloads/<?=$currentShow->getAbbr();?>-Facebook-Cover-Photo.jpg'>
						<img src='downloads/<?=$currentShow->getAbbr();?>-Facebook-Cover-Photo.jpg' alt='' title='Right-Click to save this image to your computer!'>
					</a>
				</div>
			</div>
			<h2>Cast in shirts</h2>
			<p>(Right-click on your photo, save the image to your computer, then upload it to Facebook as a profile pic)</p>
			<section class='photos'>
				<ul>
					<?php
					
						foreach(scandir("_img/shirts") as $img) {
							echo strpos($img, "shirt") ? "<li><div class='pic_spacer'><img src='_img/shirts/$img' alt='' class='enlarge'></div></li>\n" : "";
						}
					
					?>
				</ul>
			</section>
			<ul>
				<li><a href='cast_info.php'>Click here for the cast resources page</a>.</li>
			</ul>
		</section>
	<?=$footer;?>
</body>
</html>
