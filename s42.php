<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once '_inc/ipt_1.php';

$currentShow = new Show(34, '42nd Street', 's42');

$title = $currentShow->getTitle() . ' Information Page';
$body_class .= ' show_info';

$js_content = "
	<script>
		$('#showHideSynopsis').click(function() {
			$('.synopsis').slideToggle();
			$(this).find('span').html(function() {
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

				<!--
				<p>We are pleased to announce the cast list for <?=$currentShow->getTitle();?>!</p>-->
				<!--<p>Thank you so much to all of our auditionees!  If you did not make the list this time, please consider auditioning for us again in the future.  Every show has different demands, and everyone who has been involved in theater for any length of time has felt the disappointment of not being cast or missing out on a favorite role.  Don't give up!</p>
				<p>If you were cast, congratulations!  We are excited to get to know each and every one of you and work together on this great show!  Please make special note of our first cast meeting.  Further details should be in your email.</p>--><!--
				<h3>AUDITIONS &amp; CALLBACKS...</h3>
				--><!-- <p>Auditions will be sometime around early November, 2014.  Check back later for more information.</p> --><!--
				<p>Please fill out the <a class='btn btn-success' href='audition_form.php' title='Fill out the Audition Form!'><i class='fa fa-lg fa-pencil-square-o'></i> <?=$currentShow->getTitle();?> Audition Form</a> online in advance.</p>
				<p><strong>WHEN:</strong> </p>
				<ul>
					<li>AUDITIONS: Saturday, November 1st, 2014 9:00am - 12:30pm</li>
					<li>CALLBACKS: Saturday, November 8th, 2014 9:00am - 12:30pm (by invitation only)</li>
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
					<li>Bring comfortable shoes and clothes to dance in.</li>
					--><!-- <li>For those who are unfamiliar with the roles, we encourage you to <a href='downloads/<?=$currentShow->getAbbr();?>%20Character%20Descriptions.pdf' target='_blank'>read the character descriptions</a>.</li> --><!--
					<li><strong>OPTIONAL:</strong> Download the <a class='btn btn-success' href='downloads/<?=$currentShow->getAbbr();?>%20Callback%20Package.zip' title='Download the <?=$currentShow->getTitle();?> Callback Package!' target='_blank'><i class='fa fa-lg fa-arrow-circle-o-down'></i> <?=$currentShow->getTitle();?> Callback Package</a> to prepare for callbacks.</li>
					<li><strong>OPTIONAL:</strong> Bring tap shoes if you wish to be considered for tap dancing roles.</li>
					<li><strong>OPTIONAL:</strong> All who are interested in the optional tap dance portion of the audition are encouraged to <a href='s42_audition_prep' class='btn btn-info'><i class='fa fa-video-camera'></i> watch the instructional video</a> to learn the tap steps in advance.</li>
				</ul><br>-->
				<h3>PERFORMANCES...</h3>
				<p><strong>WHEN:</strong></p>
				<div class='row'>
					<div class='col-sm-8 col-md-6 col-lg-4'>
						<?=$performancesHTML;?>
					</div>
				</div>
				<p><strong>WHERE:</strong> The Goppert Theatre at Avila University (11901 Wornall Rd, Kansas City, MO 64145)</p>
				<p><strong>TICKETS:</strong>  All tickets are $10 (reserved seating) in advance or <!-- Reserved Seating Tickets will be available on our website or--> at the door<!--(check back here after November 20th)-->.</p>
				<h4><a href='tickets.php' class='btn btn-success'><i class='fa fa-ticket fa-lg'></i> Order Your Tickets Now</a></h4>
				<!-- <hr> -->
				<!--<h2>...Cast Info...</h2>
				<h3>CAST MEETING...</h3>
				<p><strong>WHEN:</strong> Saturday, November 23rd, 2014 from 10:00am to 11:30am<br>
					<strong>WHERE:</strong>
					New City Church<br>
					7456 Nieman Rd<br>
					Shawnee, KS 66203<br>
					<span>(same location as auditions)</span></p>
				<h3>REHEARSALS...</h3>
				<p><strong>WHEN:</strong> December 26 - 31, 2014 from 9am to 6pm daily <span>(some selected leads or specialty dance groups will stay till 9pm)</span></p>
				<p><strong>WHERE:</strong> The Goppert Theatre at Avila University <span>(11901 Wornall Rd, Kansas City, MO 64145)</span></p>-->
				<!-- <h4><a class='btn btn-primary' href='<?=$currentShow->getAbbr();?>_cast.php' title='<?=$currentShow->getTitle();?> Cast List'><i class='fa fa-lg fa-briefcase'></i> Resources for the Cast</a></h4> -->
				<h3>CAST...</h3>
				<p><a class='btn btn-danger' href='cast_list.php' title='<?=$currentShow->getTitle();?> Cast List'><i class='fa fa-lg fa-pencil-square-o'></i> <?=$currentShow->getTitle();?> Cast List</a></p>
				<!--<p>There is a production fee of $140 per cast member (or $240 per family).  There is no tech requirement, ticket sales quota, or fund-raising.</p>
				<p>NOTE: If you would like to work on a tech crew during this week (building sets, sewing costumes, working with lights and sound, etc.), <a href='contact.php'>let us know</a>, and we will do our best to get you plugged in!</p>-->
				<h3>ABOUT THE SHOW...</h3>
				<p>Here's a blurb about <em><?=$currentShow->getTitle();?></em>... <span>(excerpted from the licensing company's official website.)</span></p>
				<blockquote class='text-left'><?=$currentShow->getTitle();?> is a celebration of Broadway and the people involved in shows. It focuses on aspiring chorus girl Peggy Sawyer, and takes us along her journey. Musical hits include You're Getting to Be a Habit with Me, Dames, We're In the Money, Lullaby of Broadway, Shuffle Off to Buffalo and Forty-Second Street. Based on the 1933 film that saved Warner Brothers studio, 42nd Street became an extravaganza not seen on Broadway in decades. This is a big, bold musical that celebrates the stuff that dreams are made of!</blockquote>
				<h4><button class='btn btn-primary' id='showHideSynopsis'><i class='fa fa-file-text-o'></i> <span>Show</span> Detailed Plot Synopsis</button></h4>
				<blockquote class='synopsis'>
					<h4>SYNOPSIS OF <?=strtoupper($currentShow->getTitle());?></h4>
					<h5><i class='fa fa-exclamation-triangle'></i> WARNING: SPOILERS AHEAD <i class='fa fa-exclamation-triangle'></i></h5>
					<p>The curtain rises on Andy Lee, the dance director who is auditioning kids for the chorus of 'Pretty Lady'-Audition. The show's writers, Bert and Maggie, are pleased with what they see on stage, but they warn the dancers that at $4.40 per seat, the audience will demand some spectacular dancing. While she has gathered up her courage for an hour at the stage door, young Peggy Sawyer has missed the audition. Billy, the romantic lead, tries to help her see the producer-Young and Healthy.
					<p>The producer, Julian Marsh, has no patience for latecomers and Peggy rushes off the stage. Meanwhile, Bert and Maggie try to encourage Julian about the show's prospects of success. He is worried about some of the cast, especially Dorothy Brock, the leading lady. Her last hit was ten years earlier, but her sugar daddy, Abner Dillon, is backing the show.</p>
					<p>Just then Dorothy and Abner arrive. Dorothy gushes to Julian that she has "dreamed of the day when I might work with the King of Broadway." Nevertheless, the "king" will not be pushed around, and Julian suggests that Dorothy audition. Abner defends Dorothy and reminds Julian that Dorothy does not have to try out for anyone-Shadow Waltz.</p>
					<p>Realizing that she has forgotten her purse, Peggy returns to the stage. Maggie invites her to lunch with three of the girls. The five dance off stage. As they settle in at the Gypsy Tea Kettle, the girls are amused by Peggy's naïvete. They follow with an amusing account of the Broadway facts of life, and dance back to the theater-Go into Your Dance. This number evolves into an audition for Peggy. When Julian walks in he is angry to see Peggy disrupting things again, but he is struck by her remarkable talent. He orders everyone back to work and tells Andy to hire Peggy for the chorus.</p>
					<p>Dorothy and Billy begin their rehearsals. The love scene they are rushing through comes under the scrutiny of Abner. He objects to it and handshakes are substituted for kisses-You're Getting to be a Habit With Me.</p>
					<p>Peggy, weak and overcome by an exciting day, faints on stage. She is carried to Dorothy's dressing room where Pat Denning, Dorothy's real boyfriend, is waiting. Dorothy walks in, and misreading what she sees, thinks that Pat is two-timing her. Julian suggests that Pat leave town.</p>
					<p>Word arrives that the Atlantic City run of the show has been cancelled and that Philadelphia has been substituted. The company packs up for the Arch Street Theatre-Getting Out of Town.</p>
					<p>Dress rehearsals begin in Philadelphia-Dames. Julian congratulates the kids on a number well done and sends the cast off to relax.</p>
					<p>The cast is throwing a party and Peggy asks Julian if he is coming. Captivated by her charm, Julian decides to go. Dorothy, who misses Pat, has drunk a bit too much, and tells Abner to take his money and leave. Abner is ready to close the show, but the kids are able to talk him out of it.</p>
					<p>'Pretty Lady' opens spectacularly with We're In the Money. Then Dorothy rushes onstage to lead the Act I finale. She is accidentally knocked down by Peggy and can't get up. A furious Julian fires Peggy and cancels the rest of the performance.</p>
					<p>Act II opens with a doctor telling Julian that Dorothy's ankle is broken. Fear and panic spread through the cast. Julian says he will close 'Pretty Lady' for good, but the cast won't give up-Sunny Side to Every Situation. The cast thinks that Peggy can save the day. Julian finally agrees that Peggy might be able to take over for Dorothy. Peggy has already left for the train station and Julian rushes after her. Julian convinces Peggy to return-Lullabye of Broadway.</p>
					<p>Peggy has exactly 36 hours to learn 25 pages, 6 songs and 10 dance numbers. As Julian says, by the next evening, he'll have either a live leading lady or a dead chorus girl!</p>
					<p>At long last the Broadway curtain opens on 'Pretty Lady'-Shuffle Off to Buffalo. The show is a fabulous hit and Peggy Sawyer is a sudden sensation. Julian reprises the glory of "42ND STREET."</p>
				</blockquote>
				<p><em><?=$currentShow->getTitle();?></em> opened on Broadway in 1980, won the Tony Award for Best Musical, and played for 3,486 performances. It was later revived on Broadway in 2001 winning the Tony Award for Best Revival and ran for another 1524 performances over the next 4 years.  It is a well-loved, energetic musical that is highly entertaining for audiences and cast members alike.</p>
				<p>We are excited to make this another unforgettable show!  <a href='contact.php'>Contact us</a> if you wish to be added to the email list to receive the latest updates regarding <!--auditions, rehearsals and -->performances<!--.  We look forward to working with you to put together this marvelous production of <em><?=$currentShow->getTitle();?></em>-->!</p>
				<img src='_img/<?=$currentShow->getAbbr();?>-stage-photo.png' alt='' class='img-responsive'>
				<div class='cutout hidden-xs'>
					<img src='_img/maggie-christian.png' alt=''>
				</div>
			</div>
		</div>
	</section>
<?=$footer;?>
