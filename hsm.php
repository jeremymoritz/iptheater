<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once '_inc/ipt_1.php';
$title = $currentShow->getTitle() . ' Information Page';
$body_class .= ' show_info';

$js_content = "
	<script>
		$('#showHideSynopsis').click(function showHideSynopsis() {
			$('.synopsis').slideToggle();
			$(this).find('span').html(function changeButtonText() {
				return $(this).html() === 'Show' ? 'Hide' : 'Show';
			});
			return false;
		});
	</script>";
require_once '_inc/ipt_2.php';

$performancesHTML = "
	<ul class='jm list-group'>";
foreach($currentShow->getPerformances() as $p) {
	$performancesHTML .= "
		<li class='list-group-item'>{$p->getDateTimeFormatted()}</li>";
}
$performancesHTML .= "
	</ul>";

?>
<?=$header;?>
	<section class='main'>
		<div class='row'>
			<div class='col-xs-12'>
				<h2>
					<img src='/_img/ip-logo-long_400_trans.png' alt='Immeasurable Productions' class='img-responsive inline-block'>
					<br>Presents...<br>
					<img src='_img/<?=$currentShow->getAbbr();?>-logo_400.png' alt='<?=$currentShow->getTitle();?>' class='img-responsive inline-block top-buffer'>
				</h2>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-10 col-sm-offset-1'>
				<!-- <h4 id='<?=$currentShow->getAbbr();?>Link'><img src='/downloads/<?=$currentShow->getAbbr();?>%20Poster.jpg' alt='<?=$currentShow->getTitle();?>' id='<?=$currentShow->getAbbr();?>_logo'></h4> -->
				<!-- <p>We are pleased to announce the cast list for <?=$currentShow->getTitle();?>!</p> -->
				<!-- <p>Thank you so much to all of our auditionees!  If you did not make the list this time, please consider auditioning for us again in the future.  Every show has different demands, and everyone who has been involved in theater for any length of time has felt the disappointment of not being cast or missing out on a favorite role.  Don't give up!</p>
				<p>If you were cast, congratulations!  We are excited to get to know each and every one of you and work together on this great show!  Please make special note of our first cast meeting.  Further details should be in your email.</p> -->
				<h3>AUDITIONS &amp; CALLBACKS...</h3>
				<p>Auditions will be sometime around early November, <?=date('Y');?>.  Check back later for more information.</p>
				<!-- <p>Please fill out the <a class='btn btn-success' href='audition_form.php' title='Fill out the Audition Form!'><i class='fa fa-lg fa-pencil-square-o'></i> <?=$currentShow->getTitle();?> Audition Form</a> online in advance.</p>
				<p><strong>WHEN:</strong></p>
				<ul>
					<li>AUDITIONS: Saturday, November 1st, <?=date('Y');?> 9:00am - 12:30pm</li>
					<li>CALLBACKS: Saturday, November 8th, <?=date('Y');?> 9:00am - 12:30pm (by invitation only)</li>
					<li>OR...<a href='contact'>Contact us</a> if you wish to arrange an alternate audition over Skype or YouTube.</li>
				</ul>
				<p><strong>WHERE:</strong><br>
					New City Church<br>
					7456 Nieman Rd<br>
					Shawnee, KS 66203</p>
				<p><strong>WHO:</strong> Anyone age 10 or older may audition, but we're especially looking for teenagers and young adults.</p>
				<p><strong>WHAT TO PREPARE:</strong></p>
				<ul>
					<li>Prepare a solo audition song (approx. 30-45 seconds) with background music on CD or mp3 player.</li>
					<li>Bring comfortable shoes and clothes to dance in.</li> -->
					<!-- <li>For those who are unfamiliar with the roles, we encourage you to <a href='downloads/<?=$currentShow->getAbbr();?>%20Character%20Descriptions.pdf' target='_blank'>read the character descriptions</a>.</li> -->
					<!-- <li><strong>OPTIONAL:</strong> Download the <a class='btn btn-success' href='downloads/<?=$currentShow->getAbbr();?>%20Callback%20Package.zip' title='Download the <?=$currentShow->getTitle();?> Callback Package!' target='_blank'><i class='fa fa-lg fa-arrow-circle-o-down'></i> <?=$currentShow->getTitle();?> Callback Package</a> to prepare for callbacks.</li>
					<li><strong>OPTIONAL:</strong> Bring tap shoes if you wish to be considered for tap dancing roles.</li>
					<li><strong>OPTIONAL:</strong> All who are interested in the optional tap dance portion of the audition are encouraged to <a href='s42_audition_prep' class='btn btn-info'><i class='fa fa-video-camera'></i> watch the instructional video</a> to learn the tap steps in advance.</li>
				</ul><br> -->
				<h3>PERFORMANCES...</h3>
				<p><strong>WHEN:</strong></p>
				<div class='row'>
					<div class='col-sm-8 col-md-6 col-lg-4'>
						<?=$performancesHTML;?>
					</div>
				</div>
				<p><strong>WHERE:</strong> The Goppert Theatre at Avila University (11901 Wornall Rd, Kansas City, MO 64145)</p>
				<!-- <p><strong>TICKETS:</strong> All tickets are $12 (reserved seating) in advance or at the door.</p> -->
				<!-- <h4><a href='tickets.php' class='btn btn-success'><i class='fa fa-ticket fa-lg'></i> Order Your Tickets Now</a></h4> -->
				<!-- <hr> -->
				<!--<h2>...Cast Info...</h2>
				<h3>CAST MEETING...</h3>
				<p><strong>WHEN:</strong> Saturday, November 23rd, <?=date('Y');?> from 10:00am to 11:30am<br>
					<strong>WHERE:</strong>
					New City Church<br>
					7456 Nieman Rd<br>
					Shawnee, KS 66203<br>
					<span>(same location as auditions)</span></p> -->
				<h3>REHEARSALS...</h3>
				<p><strong>WHEN:</strong> December 26 - 31, <?=date('Y');?> from 9am to 6pm daily <span>(some selected leads or specialty dance groups will stay till 9pm)</span></p>
				<p><strong>WHERE:</strong> The Goppert Theatre at Avila University</p>
				<!-- <h4><a class='btn btn-primary' href='<?=$currentShow->getAbbr();?>_cast.php' title='<?=$currentShow->getTitle();?> Cast List'><i class='fa fa-lg fa-briefcase'></i> Resources for the Cast</a></h4> -->
				<!-- <h3>CAST...</h3>
				<p><a class='btn btn-danger' href='cast_list.php' title='<?=$currentShow->getTitle();?> Cast List'><i class='fa fa-lg fa-pencil-square-o'></i> <?=$currentShow->getTitle();?> Cast List</a></p> -->
				<!--<p>There is a production fee of $150 per cast member (or $250 per family).  There is no tech requirement, ticket sales quota, or fund-raising.</p>
				<p>NOTE: If you would like to work on a tech crew during this week (building sets, sewing costumes, working with lights and sound, etc.), <a href='contact.php'>let us know</a>, and we will do our best to get you plugged in!</p>-->
				<h3>NEW THIS YEAR...</h3>
				<p>We will be implementing some exciting new changes this year:</p>
				<ol>
					<li><strong>SMALLER CAST SIZE AND ENSEMBLE TRACKS:</strong> By limiting our cast size to 50 people (ages 13+), we'll have individual tracks set for the entrances, exits, costume changes, and dances for each member of the ensemble!</li>
					<li><strong>WILDCAT CREW (PRESHOW PERFORMANCE):</strong> This year, we're excited to showcase a separate cast of performers (ages 8-13) before the start of each show!  The Wildcat Crew will have a 15-minute high-energy pre-show performance featuring the best musical numbers from High School Musical 2 and High School Musical 3!  Featured solo singers and fun dances will start our performances off with a rush of adrenaline!  All of these dances will be entertaining and challenging and choreographed by our very own Mindy Moritz!</li>
				</ol>
				<h3>ABOUT THE SHOW...</h3>
				<p>Here's a blurb about <em><?=$currentShow->getTitle();?></em>... <span>(excerpted from the licensing company's official website.)</span></p>
				<blockquote class='text-left'>Disney Channel's smash hit movie musical comes to life on your stage! Troy, Gabriella, and the students of East High must deal with issues of first love, friends, and family while balancing their classes and extra curricular activities.<br>It's the first day after winter break at East High. The Jocks, Brainiacs, Thespians and Skater Dudes find their cliques, recount their vacations, and look forward to the new year. Basketball team captain and resident jock Troy discovers that the brainy Gabriella, a girl he met singing karaoke on his ski trip, has just enrolled at East High. They cause an upheaval when they decide to audition for the high school musical. Although many students resent the threat posed to the "status quo," Troy and Gabriella's alliance might just open the door for others to shine as well.<br>With many terrific roles and upbeat dance numbers, Disney's High School Musical is nonstop fun for the whole family!</blockquote>
				<h4><button class='btn btn-primary' id='showHideSynopsis'><i class='fa fa-file-text-o'></i> <span>Show</span> Detailed Plot Synopsis</button></h4>
				<blockquote class='synopsis'>
					<h4>SYNOPSIS OF <?=strtoupper($currentShow->getTitle());?></h4>
					<h5><i class='fa fa-exclamation-triangle'></i> WARNING: SPOILERS AHEAD <i class='fa fa-exclamation-triangle'></i></h5>
					<h4>Act I</h4>
					<p>At East High School (in Albuquerque, New Mexico) <strong>("Wildcat Cheer")</strong>, Troy Bolton tells his Jock friends, Chad Danforth and Zeke Baylor, about meeting Gabriella Montez on New Year's Eve during winter vacation on a ski trip. Gabriella, who has just moved to Albuquerque, also tells her newfound Brainiac friends Taylor McKessie, Kelsi Nielsen and Martha Cox of her vacation. We meet Sharpay and Ryan Evans, the two drama stars of the school. Sharpay is selfish, and Ryan follows her orders but tries to be friends with everyone. Troy and Gabriella have a flashback to New Year's Eve when they met. <strong>("Start of Something New")</strong>. One-half of the song is during the flashback, then we return to East High where Chad, Taylor, Kelsi, Ryan, Sharpay, Zeke and other students sing of their New Year's Resolutions.</p>
					<p>In homeroom, Mrs. Darbus tells her class of the upcoming winter musical, "Juliet and Romeo", a new version of Shakespeare's "Romeo and Juliet", written by Kelsi Nielsen, a shy East High student. When Ryan, Sharpay, Troy, and Gabriella start using their cell phones, Mrs. Darbus gives them all detention. Chad interferes, telling Mrs. Darbus that Troy cannot go because they have basketball practice after school and that they have an upcoming championship game. Mrs. Darbus then gives Chad a 30 minute detention, and gives Taylor detention when she remarks that Chad can't even count that high. At Gabriella's locker, Troy runs into her and they show their amazement of how they found each other again. Sharpay walks by and tries to flirt with Troy, but he shows no interest in her. Sharpay observes that he is interested in Gabriella and she is interested in him. Later, the Jocks have basketball practice <strong>("Get'cha Head in the Game")</strong>.</p>
					<p>In a Science class, Gabriella shows her smarts by pointing out a flaw in the teacher's equation. Taylor is impressed and asks, on behalf of her Science Club, if Gabriella could join their team to win the upcoming Scholastic Decathlon, although Gabriella refuses. Sharpay overhears and has Ryan investigate by Googling her.</p>
					<p>Discovering that Gabriella was a very intelligent Brainiac at her old school, Sharpay prints her newfound information and puts it in Taylor's locker. The students later head to the Mrs. Darbus's room for detention, and act like animals. Taylor then asks Gabriella again to join the Scholastic Decathlon team based on the printouts Sharpay planted in her locker, and Gabriella agrees. Everyone does the 'ball of noise,' and Coach Bolton comes to get Troy and Chad for practice and then talks to Mrs. Darbus about it.</p>
					<p>The next day, thespians audition for the play <strong>("Auditions")</strong>. Sharpay and Ryan audition as well <strong>("What I've Been Looking For")</strong>. After the auditions have been declared closed, Gabriella and Troy sing the song as Kelsi intended it - much slower <strong>("What I've Been Looking For (Reprise)")</strong>. Although Troy and Gabriella did not intend it to be an audition they are called back for a second audition. When their friends hear the news they spread it via cell phones <strong>("Cellular Fusion")</strong>.</p>
					<p>Sharpay is furious, believing Troy and Gabriella have stolen the lead roles and broken the 'rules' of East High. Though most of the school agrees, lyrical chaos erupts during a lunch break when students begin telling their secret obsessions outside of their cliques <strong>("Stick to the Status Quo")</strong>. The scene culminates with Sharpay getting 'caked' by Zeke (who secretly likes her), after Gabriella spins into him. Act I ends with Sharpay angrily shouting "Someone is going to pay for this!"</p>
					<h4>Act II</h4>
					<p>Jack Scott recaps events before Troy and Gabriella dance on the rooftop garden <strong>("I Can't Take My Eyes Off of You")</strong>. Zeke comes to Sharpay's locker and tries to flirt with her. Meanwhile, the Jocks and Brainiacs plot against the infuriated duo during study hall. Sharpay and Ryan see the Jocks and the Brainiacs mingling together and imagine they are trying to help Troy and Gabriella. So Sharpay lies to Mrs. Darbus saying that Troy and his dad are trying to ruin the auditions because she gave Troy detention. Later at practice, <strong>("Wildcat Cheer (Reprise)")</strong>, Mrs. Darbus talks to Troy's dad and then he talks to Troy. Gabriella comes to practice to see Troy while Martha comes and takes her to the lab. Troy's dad thinks Gabriella is the reason why Troy got detention. He tells Troy that he is a playmaker and not a singer. This infuriates Troy who angrily asks his father if he ever wondered if he could be both and storms off in a rage, leaving his father stunned.</p>
					<p>The Jocks and Brainiacs put their plan to work, pushing at Troy and Gabriella to 'split up'. Eventually, Troy, furious with his friends for telling him the same things his dad did, gives in and pretends that he doesn't like Gabriella, completely oblivious to the phone in Zeke's hand, transmitting Troy's words directly to Gabriella <strong>("Counting on You")</strong>. Gabriella hears and becomes very upset. Troy and Gabriella, lonely and upset, sing <strong>("When There Was Me and You")</strong>. The Jocks and Brainiacs then realize that they have gone too far and feel guilty for ruining Troy and Gabriella's relationship.</p>
					<p>The next day, Sharpay and Ryan are rehearsing for their callback while Sharpay talks to Ryan about her role in the school. Then Troy comes in looking for Gabriella and Ryan tells him that she is in the theatre. Troy goes to the theatre and tells Gabriella that they were set up and he didn't mean what he said and sings to remind her of New Year's <strong>("Start of Something New (reprise)")</strong>.</p>
					<p>Hearing that the callback date has been moved up by request of Sharpay to the same time as the big game and the Scholastic Decathlon, Troy and Gabriella announce to the Jocks and Brainiacs that they are going to not do the callback, but instead help their respective teams for their events. The Jocks and Brainiacs say they should do the callbacks. Troy and Gabriella refuse, but the teams decide to lend a helping hand anyway <strong>("We're All In This Together")</strong>.</p>
					<p>On the day of the big game/Decathlon/callbacks, the students are excited for the festivities. Sharpay and Ryan perform their callback song <strong>("Bop to the Top")</strong>, which at the same time happens with the basketball championship and the science decathlon, during which Taylor engineers an electronic meltdown in the decathlon and light malfunctions in the game, which forces all the students to move to the theater. Chad and Taylor explain to Troy and Gabriella that this is their only chance. Mrs. Darbus, hesitant to allow Troy and Gabriella an audition due to their lateness, has no choice but to let them audition as the auditorium fills with students <strong>("Breaking Free")</strong>. Mrs. Darbus gives Troy and Gabriella the parts on the spot with everyone watching.</p>
					<p>The end of Act II brings us to the gym where all the main characters wrap up their plots (Chad asks Taylor to an after-party, Zeke gets Sharpay to be nice to him, Jack Scott and Kelsi flirt, and Sharpay makes up with Gabriella and Troy). The Wildcats win the big game and the Decathlon. The students celebrate <strong>("We're All in This Together (Reprise)")</strong> followed by a recap of all the major songs in the show <strong>("Megamix")</strong> during the curtain call.</p>
				</blockquote>
				<p>Since the Disney channel movie <em><?=$currentShow->getTitle();?></em> was adapted for the stage in 2007, it has been performed by over 5,000 theaters throughout the world.  We are excited to make this another unforgettable show!  <a href='contact.php'>Contact us</a> if you wish to be added to the email list to receive the latest updates regarding auditions, rehearsals and performances.  We look forward to working with you to create an outstanding production of <em><?=$currentShow->getTitle();?></em>!</p>
				<img src='_img/<?=$currentShow->getAbbr();?>-stage-photo.jpg' alt='' class='img-responsive center'>
				<div class='cutout hide-xs'>
					<img src='_img/maggie-christian.png' alt=''>
				</div>
			</div>
		</div>
	</section>
<?=$footer;?>
