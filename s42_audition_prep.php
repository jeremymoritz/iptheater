<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once '_inc/ipt_1.php';
$title = $currentShow->getTitle() . ' Audition Preparation';
require_once '_inc/ipt_2.php';
?>
<?=$header;?>
	<section class='main'>
		<div class='row'>
			<div class='col-xs-12'>
				<h2>
					<img src='_img/<?=$currentShow->getAbbr();?>-logo_250.png' alt='<?=$currentShow->getTitle();?>' class='img-responsive inline-block top-buffer'>
					<br>Audition Preparation
				</h2>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-10 col-sm-offset-1'>
				<p>Director/Choreographer Mindy Moritz demonstrates the original Broadway choreography to the opening number from <?=$currentShow->getTitle();?>.  The first four moves of this dance will also be used at auditions (only for auditionees who want to tap).  If you wish to be considered for a tap role, we would strongly recommend you take a little time to dowload the written choreography, watch the videos, and work on it before auditions on November 1st.</p>
				<h2><a href='downloads/s42_tap_audition_choreography.pdf' class='btn btn-success' target='_blank'><i class='fa fa-file-text-o'></i> Download the Choreography Outline</a></h2>
				<h2><a href='downloads/s42_tap_audition_music.mp3' class='btn btn-info' target='_blank'><i class='fa fa-music'></i> Download the Music Track</a></h2>
				<p>This first video is Mindy saying the steps from start to finish, then running the dance with music:</p>
				<iframe width="560" height="315" src="//www.youtube.com/embed/uQkJCSrqIjc?rel=0" frameborder="0" allowfullscreen></iframe>
				<p>In these next two videos, the steps are slower and broken down just a little bit more.</p>
				<iframe width="560" height="315" src="//www.youtube.com/embed/_MRJg2OCJKE?rel=0" frameborder="0" allowfullscreen></iframe>
				<br>
				<iframe width="560" height="315" src="//www.youtube.com/embed/ZscFPvu2dP8?rel=0" frameborder="0" allowfullscreen></iframe>
				<p>Mindy is also available to teach private tap lessons.  If you are interested in further information about this, please <a href='contact' class='btn btn-primary'>Contact Us</a> and mention tap lessons in the comments field.</p>
				<p>Happy tapping!  We can't wait to see you at auditions this fall!</p>
			</div>
		</div>
	</section>
<?=$footer;?>
