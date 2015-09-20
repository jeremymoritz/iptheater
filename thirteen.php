<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once '_inc/ipt_1.php';
$title = '13 Information Page';
$body_class .= ' show_info';
require_once '_inc/ipt_2.php';

$currentShow = new Show(61, '13', 'thirteen');
// $sql = "
// 	SELECT
// 		id,
// 		dateTime
// 	FROM ip_performances
// 	WHERE showId = {$currentShow->getId()};";
// $sth = $dbh->prepare($sql);
// $sth->execute();
// $performances = sthFetchObjects($sth);	//	fetch all of the performances
// foreach($performances as $p) {
// 	$currentShow->addPerformance(new Performance($p->id, $p->dateTime));
// }

// $performancesHTML = "
// 	<ul class='jm list-group'>";
// foreach($currentShow->getPerformances() as $p) {
// 	$performancesHTML .= "
// 		<li class='list-group-item'>{$p->getDateTimeFormatted()}</li>";
// }
// $performancesHTML .= "
// 	</ul>";

?>
<?=$header;?>
	<section class='main'>
		<div class='row'>
			<div class='col-xs-12'>
				<h2>
					<img src='/_img/ip-logo-long_400_trans.png' alt='Immeasurable Productions' class='img-responsive inline-block'>
					<br>We are offering our first-ever Musical Summer Camp!
					<br>This summer, we will produce Jason Robert Brown's hit musical 13<br>
					<img src='_img/<?=$currentShow->getAbbr();?>-logo_400.png' alt='<?=$currentShow->getTitle();?>' class='img-responsive inline-block top-buffer'>
				</h2>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-10 col-sm-offset-1'>
				<h2><a class='btn btn-lg btn-success' href='http://www.13tickets.weebly.com/'><i class='fa fa-ticket'></i> Reserve Tickets for 13</a></h2>
				<h2><a class='btn btn-lg btn-purple' href='cast_list_thirteen.php'><i class='fa fa-list-alt'></i> 13 Cast List</a></h2>
				<h2>13 Materials for Campers:</h2>
				<h2>
					<a class='btn btn-warning' href='downloads/<?=rawurlencode("13 Costumes Hair and Makeup.pdf");?>'>
						<i class='fa fa-book'></i> 13 Costume, Hair and Makeup Booklet
					</a> &nbsp; &nbsp; &nbsp;
					<a class='btn btn-danger' href='downloads/<?=rawurlencode("13 Rehearsal Schedule.pdf");?>'>
						<i class='fa fa-calendar'></i> 13 Rehearsal Schedule
					</a>
				</h2>
				<hr>
				<!-- <h2><i class='fa fa-smile-o'></i><strong> ANNOUNCING!</strong> A SECOND "13" CAMP! <i class='fa fa-smile-o'></i><br>
					Keep reading to find out more!</h2> -->
				<!-- <h2>
					<i class='fa fa-frown-o'></i> Camp is closed for GIRLS <i class='fa fa-frown-o'></i><br>
					<small>If you are a girl, click this link to </small><a href='wait_list' class='btn btn-warning'><i class='fa fa-list-alt'></i> join the waiting list</a><br>
					<small>If you are a boy, please read on and fill out the camp registration form</small>
				</h2> -->
				<!-- <h2>
					<i class='fa fa-frown-o'></i> Camp is closed for BOYS <i class='fa fa-frown-o'></i><br>
					<small>All positions for boys have been filled.  If you are a boy, click this link to </small><a href='wait_list' class='btn btn-warning'><i class='fa fa-list-alt'></i> join the waiting list</a><br>
					<small>If you are a girl, please read on and fill out the camp registration form</small>
				</h2> -->
				<!-- <p class='text-center'>
					<a href='http://iptheater.com/downloads/13%20Audition%20Form.pdf' target='_blank' class='btn btn-purple'><i class='fa fa-file-text'></i> Download the Audition Form</a> and bring it with you to auditions!
				</p> -->
<!--
				<p class='text-center'>In order to make the audition process easier for everyone, we have created a sign up! Click the link to sign up for your spot!</p>
				<p class='text-center'><a href='http://www.SignUpGenius.com/go/10C054EA5A629AB9-13musical' target='_blank' class='btn btn-danger'><i class='fa fa-file-text-o'></i> 13 Audition Sign Up</a></p>
 -->
				<!-- <h2>
					Registration Open!
				</h2>
				<p>Immeasurable Productions's first-ever summer camp musical!</p>
				<p>Ages 12 - 16</p>
				<p>Camp Tuition: $195</p>
				<p>Includes a camp T-shirt, pizza party, and the opportunity to be in this awesome, high-energy show!</p> -->
				<!-- <h2><a class='btn btn-success' href='registration_form_camp.php' title='Fill out the Registration Form!'><i class='fa fa-lg fa-pencil-square-o'></i> <?=$currentShow->getTitle();?> Camp Registration Form (Boys only) </a></h2> -->
				<!-- <ul class='jm list-group top-buffer'>
					<li class='list-group-item'>
						WEEK 1: July 13-19 (CLOSED for BOYS)
						<a href='wait_list' class='btn btn-warning'>
							<i class='fa fa-list-alt'></i> Waiting List
						</a>
						<a class='btn btn-success' href='registration_form_camp.php' title='Fill out the Registration Form!'>
							<i class='fa fa-lg fa-pencil-square-o'></i> <?=$currentShow->getTitle();?> Registration Form (Girls only)
						</a>
					</li>
					<li class='list-group-item'>
						WEEK 2: July 20-26 (CLOSED)
						<a href='wait_list' class='btn btn-warning'>
							<i class='fa fa-list-alt'></i> Waiting List
						</a>
					</li>
				</ul> -->
				<p>13 is a really fun, modern type musical set in a Junior High. It follows Evan Goldman. A Jewish boy from New York City who just moved to Appleton, Indiana right before his 13th birthday. A modern score that follows the life of kids going through a crazy transition in their life as they enter their teenage years.</p>
				<h3>REHEARSALS...</h3>
				<p><strong>WHEN:</strong><br>
					WEEK 1: July 13-17<br>
					WEEK 2: July 20-23<br>
					Rehearsals will be from 9am-5pm daily. <span>(Some selected leads will be asked to stay until 6pm)</span></p>
				<h3>PERFORMANCES...</h3>
				<p><strong>WHEN:</strong></p>
				<p>WEEK 1:</p>
				<div class='row'>
					<div class='col-sm-8 col-md-6 col-lg-4'>
						<ul class='jm list-group'>
							<li class='list-group-item'>5pm on Fri, July 17th</li>
							<li class='list-group-item'>8pm on Fri, July 17th</li>
							<li class='list-group-item'>2pm on Sat, July 18th</li>
							<li class='list-group-item'>7pm on Sat, July 18th</li>
							<li class='list-group-item'>1pm on Sun, July 19th</li>
						</ul>
					</div>
				</div>
				<p>WEEK 2:</p>
				<div class='row'>
					<div class='col-sm-8 col-md-6 col-lg-4'>
						<ul class='jm list-group'>
							<li class='list-group-item'>5pm on Fri, July 24th</li>
							<li class='list-group-item'>8pm on Fri, July 24th</li>
							<li class='list-group-item'>2pm on Sat, July 25th</li>
							<li class='list-group-item'>7pm on Sat, July 25th</li>
							<li class='list-group-item'>2pm on Sun, July 26th</li>
						</ul>
					</div>
				</div>
				<p><strong>WHERE:</strong> All rehearsals and performances take place at Olathe Civic Theatre Association (OCTA) - <span>500 E. Loula Rd., Olathe, KS. 66061</span></p>
				<p>There will be a cast party after the Sunday performance, so please plan to stay for that if possible.</p>
				<!-- <p>There are only 45 spots available for each camp. A $50 deposit is required to hold your place. This goes towards your campers tuition. The rest of the tuition will be due at auditions on May 29th.</p> -->
				<!-- <h3>AUDITIONS/CALLBACKS...</h3>
				<p><strong>WHEN:</strong> Friday, May 29th, 2:30pm - 6pm (Callbacks 6pm - 9:30pm).</p>

				<p class='text-center'>In order to make the audition process easier for everyone, we have created a sign up! Click the link to sign up for your spot!</p>
				<p class='text-center'><a href='http://www.SignUpGenius.com/go/10C054EA5A629AB9-13musical' target='_blank' class='btn btn-purple'><i class='fa fa-file-text'></i> 13 Audition Sign Up</a></p>
				<p class='text-center'>We will do our best to stay on schedule. Please arrive 10-15 min before your audition time slot. We thank you in advance for your patience and flexibility.</p>

				<p><strong>WHERE:</strong> Cross Points Church (6824 Lackman Rd, Shawnee, KS 66217)</p>
				<p>Auditions will be held on a first come, first served basis. The earlier you can arrive, the better. If you cannot attend the audition day, please upload an audition video and email us the link by May 28th.</p>
				<p><strong>VOCAL AUDITION:</strong> Please prepare a song somewhere between 30-45 seconds in length. All songs should have a background or karaoke track behind them. Sheet music is discouraged as no accompanist will be there. Music can be on a phone, mp3 player or CD.</p>
				<p><strong>DANCE AUDITION:</strong> Following the vocal audition, campers will be asked to learn a short dance combination. Jazz shoes are encouraged. They will work on it for a while with an audition helper, then come in and perform it for the directing team. It will be very short and fairly easy.</p>
				<p><strong>CALLBACKS:</strong> Following the dance audition, we will announce who has been invited to stay for callbacks. Callbacks will be later that evening. (6pm-9:30pm). If you have time, you are welcome to leave and come back. Also feel free to pack a dinner, or parents are certainly welcome to get dinner and bring it back. Callbacks are only for those we are considering for a lead role. The good news is, if you have signed up, you have already made the show! If you would like to prepare your possible callback ahead of time, feel free to download the <a href='downloads/13%20Callback%20Package.zip' class='btn btn-purple' rel='external'><i class='fa fa-file-text'></i> Callback Package</a> to do so! There is no guarantee you will receive a callback, but you are certainly welcome to prepare with the materials we have provided. *Note: All callback materials are subject to change at the Artistic Team's discretion.</p>
				<p>On May 29th, we ask that you please be as flexible as possible. Allow a lot of time for the audition/callback if you are able to. We have a lot of people to get through, and two shows to cast in one evening, so we ask for your patience as we go through the process. If you have any time constraints on that evening, please let us know ahead of time, and we will try our best to work around your schedule. If you are worried about making it to another event in time, feel free to just submit a video audition.</p>
				<p><strong>VIDEO AUDITIONS:</strong> If you are not available for auditions on May 29th, please send a video using a YouTube link (suggestion: mark the video "unlisted" -- not "private") to <?=disguiseMailLink('mindy@iptheater.com');?> by May 28th.</p> -->
				<h3 class='top-buffer'>A LITTLE MORE INFO ABOUT THE <?=$currentShow->getTitle();?> CAMP...</h3>
				<!-- <p>There are only 45 spots available for each session. Week 1 is closed, although you can still click here to <a href='wait_list' class='btn btn-warning'><i class='fa fa-list-alt'></i> join the waiting list</a>. We still have limited availability for Week 2, and are currently accepting registrations on a first come, first served basis until all of the spots are full.</p>
				<p>If you are currently enrolled in Week 1, but would like to switch to Week 2, please send an email to <?=disguiseMailLink('mindy@iptheater.com');?>. Switching from Week 1 to Week 2 is encouraged, so if you are able to switch camp sessions, please let us know as soon as you can!</p>
				<p>To officially be registered for the camp, you need to fill out the <a class='btn btn-success' href='registration_form.php' title='Fill out the Registration Form!'><i class='fa fa-lg fa-pencil-square-o'></i> <?=$currentShow->getTitle();?> Camp Registration Form</a> online, and pay the $50 holding fee to reserve your spot. A confirmation email with more information will be sent out upon receiving your deposit.</p>
				<p>The remaining funds, ($145), will be due at the auditions on May 29th. Or you are welcome to click here to <a href='pay.php' class='btn btn-info'><i class='fa fa-money'></i> pay the remaining balance</a>. Just be sure to mention your camper's name in the comments section.</p> -->
				<p><?=$currentShow->getTitle();?> Staff:<br>
					Director/Choreographer: Mindy Moritz<br>
					Music/Tech Director: Nick Perry<br>
					Assistant Director: Jenn Harvey<br>
					Assistant Choreographer: Elizabeth Brooks</p>
				<h3>ABOUT THE SHOW...</h3>
				<p>Here's a blurb about <em><?=$currentShow->getTitle();?></em>... <span>(excerpted from the licensing company's official website.)</span></p>
				<blockquote class='text-left'>
					<p><?=$currentShow->getTitle();?> is a hilarious, coming-of-age musical about discovering that "cool" is sometimes where we least expect it.</p>
					<p>Geek. Poser. Jock. Beauty Queen. Wannabe. These are the labels that can last a lifetime. With an unforgettable rock score from TONY Award-winning composer Jason Robert Brown, (Parade, The Last Five Years, Bridges Of Madison County) 13 is a musical about fitting in – and standing out!</p>
					<p>Evan Goldman is plucked from his fast paced, preteen New York City life and plopped into a sleepy Indiana town following his parents divorce. Surrounded by an array of simpleminded middle school students, he needs to establish his place in the popularity pecking order. Can he situate himself on a comfortable link of the food chain or will he dangle at the end with the outcasts?!</p>
				</blockquote>
				<h4><button class='btn btn-primary' id='showHideSynopsis'><i class='fa fa-file-text-o'></i> <span>Show</span> Detailed Plot Synopsis</button></h4>
				<blockquote class='synopsis'>
					<h4>SYNOPSIS OF <?=strtoupper($currentShow->getTitle());?></h4>
					<h5><i class='fa fa-exclamation-triangle'></i> WARNING: SPOILERS AHEAD <i class='fa fa-exclamation-triangle'></i></h5>
					<p>12-year old New Yorker Evan Goldman is surrounded by rabbis. After chanting, one of them explains that when a boy has his Bar Mitzvah, he becomes an adult. Evan breaks from the scene and expresses his anguish to the audience. The mounting pressure of puberty, coupled with his parent's ugly divorce, has created unneeded stress in his life ("Thirteen/Becoming A Man"). Just as Evan begins to feel hopeful, his mother calls to tell him they're moving to Indiana. Once there, however, Evan finds a friend in his neighbor, Patrice. Evan is disappointed that there aren't any cool places in Indiana to have his Bar Mitzvah; Patrice attempts to encourage him ("The Lamest Place In The World").</p>
					<p>Next we join Evan for the start of the school year. Brett, the most popular kid in school, has summoned up the courage to ask Kendra, the prettiest girl in school, to a scary movie Friday night so he can kiss her ("Hey Kendra"). Despite her best friend Lucy's attempts to dissuade her, Kendra consents. Inviting Kendra to a scary movie was Evan's idea, so Brett decides that Evan is cool and refers to him as the "Brain." As the new kid, Evan is thrilled. Patrice, however, is not amused. As the popular kids begin considering Evan's invite to his Bar Mitzvah, however, he becomes pressured to renege his invitation to Patrice - no one will attend if she is there. Seeing the group is not bluffing, he hastily rips up her invitation. Patrice is devastated.</p>
					<p>Later that day we meet Archie, a high school student who suffers from a degenerative illness. He has run into Evan in the school and expresses anger at Evan for humiliating Patrice, his best and only friend. In an attempt to capitalize on the incident, Archie promises to help mend things between him and Patrice only if Evan can get him a date with Kendra ("Get Me What I Need"). At cheerleading practice, Kendra teaches a new cheer while Lucy resolves to make Brett her boyfriend ("Opportunity").</p>
					<p>Elsewhere, Archie tries to talk Patrice into giving Evan a second chance, especially since she has a crush on him. Patrice feels betrayed by Evan and finds it difficult to forgive him ("What It Means To Be A Friend").</p>
					<p>In class, Brett tells Evan he should get his mom to buy them all tickets to the new thriller 'The Bloodmaster.' Evan protests that his mother won't buy them tickets to an R-rated movie, but Brett reminds him that if she doesn't, nobody will go to his Bar Mitzvah. Evan cycles through possible plans, eventually settling on having Archie use his illness to guilt his mother into relenting ("All Hail The Brain/Terminal Illness"). To try and make things better with Patrice, Evan eventually asks her to go to the movie with him as his date. He doesn't realize until later on that he has set up Archie's date with Kendra on the same day and movie as Brett's date! Realizing his mistake, Evan makes Archie promise not to do anything more than sit next to Kendra during the movie, or else he will screw up Brett's date. Archie agrees and everyone prepares for Friday night ("Getting Ready").</p>
					<p>At the movie, Patrice is upset that Evan isn't even sitting next to her. Throughout the bloody scenes, we see into Brett and Kendra's thoughts - as they prepare for the impending kiss ("Any Minute"). Just as they're about to lock lips, Archie ruins it. Brett swears revenge on Evan and Archie. Lucy, seeing her chance, kisses Brett. Patrice tells off Evan when she sees all he cares about is Brett being angry at him ("Good Enough"). With no one to turn to, Evan realizes he's danger of forever being a lonely geek ("Being A Geek").</p>
					<p>As Lucy and Brett begin dating, she forces him to spend more and more time with her. Brett's friends recognize that Lucy isn't good for Brett or for them at all ("Bad Bad News"). Evan promises to try and bring Brett and Kendra back together, so he can get on everyone's good side. Archie, fearing that this is an impossible mission, begs Patrice to help Evan. She shows up just in time to tell Brett to talk to Kendra, and she and Evan suggest things to say - while resolving their own issues ("Tell Her").</p>
					<p>Brett takes their advice and mends his relationship with Kendra. Lucy, however, won't stand for this. She spreads a rumor that Kendra is cheating on Brett with Evan, and then gets Evan and Kendra in the same place so Brett can catch them ("It Can't Be True"). As Kendra runs after Brett, Evan realizes that he didn't really want to be friends with Brett anyway, and that Archie and Patrice are his true friends. He wants to call off the Bar Mitzvah because it would only be the three of them, but Archie and Patrice insist it won't be that bad ("If That's What It Is"). Finally, Evan has his Bar Mitzvah and it turns out to be a success. Reflecting on the lessons of becoming a man, he begins to accept what growing up is all about ("A Little More Homework"). The show ends with the cast in celebration ("Brand New You").</p>
				</blockquote>
				<div class='row text-center'>
					<div class='col-sm-6'>
						<img src='_img/<?=$currentShow->getAbbr();?>-stage-photo.jpg' alt='' class='img-responsive' style='max-height: 263px'>
					</div>
					<div class='col-sm-6'>
						<img src='_img/<?=$currentShow->getAbbr();?>-stage-photo2.jpg' alt='' class='img-responsive'>
					</div>
				</div>
				<div class='cutout hidden-xs'>
					<img src='_img/maggie-christian.png' alt=''>
				</div>
			</div>
		</div>
	</section>
<?=$footer;?>
