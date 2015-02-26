<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once '_inc/ipt_1.php';
$title = $currentShow->getTitle() . ' Cast Information Page';
require_once '_inc/ipt_2.php';
?>
<?=$header;?>
	<section class='main'>
		<div class='row'>
			<section class='col-sm-10 col-sm-offset-1'>
				<h2><img src='_img/<?=$currentShow->getAbbrLower();?>-logo_250.png' alt='<?=$currentShow->getTitle();?>' class='img-responsive inline-block top-buffer'></h2>
				<h2>Cast Information</h2>
				<p><?=$currentShow->getTitle();?> cast, check back here occasionally for the latest info about rehearsals, costume notes, scheduling and more!</p>
			</section>
		</div>
		<!-- <div class='row'>
			<section class='col-sm-10 col-sm-offset-1'>
				<h3>CAST MEETING</h3>
				<ul>
					<li>There is a mandatory cast meeting on <b>Saturday, November 22nd from 10:30am to 12:00pm</b>.</li>
					<li>The location for this meeting will be at JOURNEY CHURCH OF LENEXA, 8865 Bourgade Ave., Lenexa, KS 66219 (this is a new location, so please note the address).</li>
					<li>We will distribute scripts, music &amp; detailed rehearsal schedules, and inform you of everything you will NEED TO KNOW for this production.</li>
					<li>The first HALF of your production fee is due at this meeting.  The full production fee is $140/person or $240/family, so plan to pay at least half of this amount at the cast meeting.  Payment may be made by check, credit card, cash, or Paypal.  This production fee payment must be made in order to remain in the cast in December.  (Note: the second half payment is due at our first rehearsal on December 26th).</li>
					<li>You will also have the opportunity to pre-order pictures and buy a <?=$currentShow->getTitle();?> cast T-shirt or Sweatshirt if you wish.</li>
					<li>If you are unable to attend the cast meeting, please send a parent or friend or parent-of-a-friend to represent you, take notes, pick up your materials, and make your payment.</li>
					<li>If you have any questions or concerns regarding the cast meeting or your availability for it, please contact our Production Coordinator, Kasey Lynch (<?=disguiseMail("<a href='mailto:kasey@iptheater.com'>kasey@iptheater.com</a>");?>).</li>
				</ul>
			</section>
		</div> -->
		<div class='row'>
			<section class='col-sm-10 col-sm-offset-1'>
				<h3>BEFORE THE FIRST REHEARSAL</h3>
				<p>Every cast member should do these before the first rehearsal:</p>
				<ul>
					<li>Fill out the <a href='bio_form.php' class='btn btn-primary'><i class='fa fa-align-left'></i> Bio Form</a> online.</li>
					<li>Download the <a href='downloads/<?=$currentShow->getAbbrLower();?>%20Vocal%20Book.pdf' class='btn btn-primary'><i class='fa fa-music'></i> <?=$currentShow->getTitle();?> Vocal Book</a>.</li>
					<li>Download the <a href='downloads/<?=$currentShow->getAbbrLower();?>%20Costume%20Requirements.pdf' class='btn btn-primary'><i class='fa fa-user'></i> Costume Requirements</a> here (NOTE: Every cast member is required to provide their own base costumes and bring them to the first rehearsal for approval).</li>
					<li>If you missed the meeting, be sure to download the <a href='downloads/<?=$currentShow->getAbbrLower();?>%20Cast%20Meeting%20Notes%20Handout.pdf' class='btn btn-primary'><i class='fa fa-file-text-o'></i> Notes Handout</a>.</li>
					<li>Though not required, we encourage each cast member to briefly review these great <a href='downloads/<?=$currentShow->getAbbrLower();?>%20Hair%20and%20Makeup%20Tips.pdf' class='btn btn-primary'><i class='fa fa-scissors'></i> Hair and Makeup Tips</a>.</li>
				</ul>
			</section>
		</div>
		<div class='row'>
			<section class='col-sm-10 col-sm-offset-1'>
				<h3>REHEARSAL SCHEDULE</h3>
				<h4><a href='downloads/<?=$currentShow->getAbbrLower();?>%20Rehearsal%20Schedule.pdf' target='_blank'>
					<button class='btn btn-primary'><i class='fa fa-calendar'></i> Download the Rehearsal Schedule</button><br><br>
					<img src='_img/<?=$currentShow->getAbbrLower();?>-rehearsal-schedule.png' alt class='img-responsive center'>
				</a></h4>
			</section>
		</div>
		<div class='row'>
			<section class='col-sm-10 col-sm-offset-1'>
				<h3>TICKETS</h3>
				<p>Click here to <a href='tickets.php' class='btn btn-success'><i class='fa fa-ticket'></i> Order Your Tickets</a>!</p>
			</section>
		</div>
		<div class='row'>
			<section class='col-sm-10 col-sm-offset-1'>
				<h3>CAST LIST</h3>
				<p>Check out the award-winning <a class='btn btn-danger' href='cast_list.php' title='<?=$currentShow->getTitle();?> Cast List'><i class='fa fa-lg fa-pencil-square-o'></i> <?=$currentShow->getTitle();?> Cast List</a>!!</p>
			</section>
		</div>
		<div class='row'>
			<section class='col-sm-10 col-sm-offset-1'>
				<h3>Facebook</h3>
				<p><strong>Facebook Event</strong> - Invite all your Facebook friends with this <a href='https://www.facebook.com/events/1725169184374159/' target='_blank'>Facebook Event link</a>!</p>
				<p><strong>Facebook Cover Photo</strong> - Right-click on this image to save the high resolution version to your local computer.  Then upload it as your Facebook Cover photo (it's already sized perfectly to fit).  This is another fun way to promote the show to your Facebook friends!</p>
				<div class='fb_photos'>
					<div>
						<a href='downloads/<?=$currentShow->getAbbr();?>-Facebook-Cover-Photo.jpg'>
							<img src='downloads/<?=$currentShow->getAbbr();?>-Facebook-Cover-Photo.jpg' alt='' title='Right-Click to save this image to your computer!'>
						</a>
					</div>
				</div>
				<h3>Download the <?=$currentShow->getTitle();?> Poster to email to friends and family!</h3>
				<h4><a class='btn btn-danger' href='downloads/<?=$currentShow->getAbbr();?>%20Poster.jpg' title='<?=$currentShow->getTitle();?> Poster'><i class='fa fa-lg fa-bullhorn'></i> <?=$currentShow->getTitle();?> Poster (normal)</a> <a class='btn btn-danger' href='downloads/<?=$currentShow->getAbbr();?>%20Poster_large.jpg' title='<?=$currentShow->getTitle();?> Poster'><i class='fa fa-lg fa-bullhorn'></i> <?=$currentShow->getTitle();?> Poster (extra large)</a></h4>
				<p>For reference, here is a <a href='downloads/<?=$currentShow->getAbbrLower();?>%20Glossary.pdf' class='btn btn-primary'><i class='fa fa-list'></i> Glossary of Terms</a> used in <?=$currentShow->getTitle();?>.</p>
			</section>
		</div>
		<div class='row'>
			<section class='col-sm-10 col-sm-offset-1'>
				<!-- <h4><a class='btn btn-danger' href='shirts' title='<?=$currentShow->getTitle();?> Cast in Shirts'><i class='fa fa-lg fa-camera'></i> Pics of <?=$currentShow->getTitle();?> Cast in Shirts</a></h4> -->
				<!-- <h4><a class='btn btn-primary' href='downloads/<?=$currentShow->getAbbr();?>%20Costumes.pdf' title='<?=$currentShow->getTitle();?> Costumes'><i class='fa fa-lg fa-tags'></i> Download Costume Ideas</a></h4> -->
				<!-- <h4><a class='btn btn-success' href='downloads/<?=$currentShow->getAbbr();?>%20Rehearsal%20Schedule.pdf' title='<?=$currentShow->getTitle();?> Rehearsal Schedule'><i class='fa fa-lg fa-calendar'></i> Download Rehearsal Schedule</a></h4> -->
				<!-- <h2><img src='_img/<?=$currentShow->getAbbrLower();?>_rehearsal_schedule.png' alt='<?=$currentShow->getTitle();?> Rehearsal Schedule' class='rehearsalSchedule'></h2> -->
				<h3>Here are accompaniment tracks to help you study your music!</h3>
				<ul class='ul'>
					<?php
						$accompanimentTracks = scandir('downloads/accompaniment');
						natsort($accompanimentTracks);	//	sort 1, 2, 3, 10, 11 (instead of 1, 10, 11, 2, 3)
						foreach($accompanimentTracks as $filename) {
							if(strpos($filename, '.mp3')) {
								$thisFile = pathinfo($filename);
								$thisFile = $thisFile['filename'];
								echo "
									<li>
										<a href='downloads/accompaniment/" . rawurlencode($filename) . "' title='Download \"$filename\"!' target='_blank'>" . $thisFile . "</a>
									</li>";
							}
						}
					?>
				</ul>
				<h4><a class='btn btn-info' href='downloads/accompaniment/<?=$currentShow->getAbbr();?>%20Accompaniment.zip' title='<?=$currentShow->getTitle();?> Accompaniment'><i class='fa fa-lg fa-headphones'></i> Download All Accompaniment Tracks</a></h4>
			</section>
		</div>
		<div class='row'>
			<section class='col-sm-10 col-sm-offset-1'>
				<h3>OPENING TAP DANCE CHOREOGRAPHY</h3>
				<p>Director/Choreographer Mindy Moritz demonstrates the choreography to our opening number (NOTE: this is the original broadway choreography!).  Every cast member who learns this dance may be in this number in the performance!  If you would like to be in the opening tap dance, we strongly recommend you take a little time to dowload the written choreography, watch the videos, and work on it before rehearsals begin on December 26th.</p>
				<h2><a href='downloads/<?=$currentShow->getAbbrLower();?>_tap_audition_choreography.pdf' class='btn btn-primary' target='_blank'><i class='fa fa-file-text-o'></i> Download the Choreography Outline</a></h2>
				<h2><a href='downloads/<?=$currentShow->getAbbrLower();?>_tap_audition_music.mp3' class='btn btn-info' target='_blank'><i class='fa fa-volume-up'></i> Download the Music Track</a></h2>
				<p>This first video is Mindy saying the steps from start to finish, then running the dance with music:</p>
				<iframe width="560" height="315" src="//www.youtube.com/embed/uQkJCSrqIjc?rel=0" frameborder="0" allowfullscreen></iframe>
				<p>In these next two videos, the steps are slower and broken down just a little bit more.</p>
				<iframe width="560" height="315" src="//www.youtube.com/embed/_MRJg2OCJKE?rel=0" frameborder="0" allowfullscreen></iframe>
				<br>
				<iframe width="560" height="315" src="//www.youtube.com/embed/ZscFPvu2dP8?rel=0" frameborder="0" allowfullscreen></iframe>
				<p>Mindy is also available to teach private tap lessons.  If you are interested in further information about this, please <a href='contact' class='btn btn-warning'><i class='fa fa-comment-o'></i> Contact Us</a> and mention tap lessons in the comments field.</p>
				<p>Happy tapping!  We can't wait to see you at rehearsals!</p>
			</section>
		</div>
	</section>
<?=$footer;?>
