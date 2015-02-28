<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once '_inc/ipt_1.php';
$title = '13 Information Page';
$body_class .= ' show_info';
require_once '_inc/ipt_2.php';

$currentShow = new Show(61, '13', 'thirteen');
$sql = "
	SELECT
		id,
		dateTime
	FROM ip_performances
	WHERE showId = {$currentShow->getId()};";
$sth = $dbh->prepare($sql);
$sth->execute();
$performances = sthFetchObjects($sth);	//	fetch all of the performances
foreach($performances as $p) {
	$currentShow->addPerformance(new Performance($p->id, $p->dateTime));
}

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
					<br>We are offering our first-ever Musical Summer Camp!
					<br>This summer, we will produce Jason Robert Brown's hit musical 13<br>
					<img src='_img/<?=$currentShow->getAbbr();?>-logo_400.png' alt='<?=$currentShow->getTitle();?>' class='img-responsive inline-block top-buffer'>
				</h2>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-10 col-sm-offset-1'>
				<h2>
					<i class='fa fa-frown-o'></i> Camp is closed for GIRLS <i class='fa fa-frown-o'></i><br>
					<small>If you are a girl, click this link to </small><a href='wait_list' class='btn btn-warning'><i class='fa fa-list-alt'></i> join the waiting list</a><br>
					<small>If you are a boy, please read on and fill out the camp registration form</small>
				</h2>
				<p>Ages 12 - 16</p>
				<p>Camp Tuition: $195</p>
				<p>Includes a camp T-shirt, pizza party, and the opportunity to be in this awesome, high-energy show!</p>
				<h2><a class='btn btn-success' href='registration_form.php' title='Fill out the Registration Form!'><i class='fa fa-lg fa-pencil-square-o'></i> <?=$currentShow->getTitle();?> Camp Registration Form (Boys only)</a></h2>
				<p>13 is a really fun, modern type musical set in a Junior High. It follows Evan Goldman. A Jewish boy from New York City who just moved to Appleton, Indiana right before his 13th birthday. A modern score that follows the life of kids going through a crazy transition in their life as they enter their teenage years.</p>
				<p>The camp will be July 13-19th</p>
				<h3>REHEARSALS...</h3>
				<p><strong>WHEN:</strong> July 13 - 17, <?=date('Y');?> from 9am to 5pm daily <span>(some selected leads or specialty dance groups will stay till 6pm)</span></p>
				<h3>PERFORMANCES...</h3>
				<p><strong>WHEN:</strong></p>
				<div class='row'>
					<div class='col-sm-8 col-md-6 col-lg-4'>
						<?=$performancesHTML;?>
					</div>
				</div>
				<p><strong>WHERE:</strong> All rehearsals and performances take place at Olathe Civic Theatre Association (OCTA) - <span>500 E. Loula Rd., Olathe, KS. 66061</span></p>
				<p>There will be a cast party after the Sunday performance, so please plan to stay for that if possible.</p>
				<p>There are only 45 spots available for this show, so sign up right away if interested. A $50 deposit is required to hold your campers spot in the camp. This goes towards your campers tuition. The rest of the tuition will be due at auditions on May 30th.</p>
				<h3>AUDITIONS...</h3>
				<p>Auditions will be held on Friday, May 29th  from 3pm - 5:30pm. And Callbacks from 6pm - 9pm. (Location to be determined)</p>
				<p>If you cannot attend the audition day, please upload an audition video and email us the link by May 29th.</p>
				<p>Please fill out the <a class='btn btn-success' href='registration_form.php' title='Fill out the Registration Form!'><i class='fa fa-lg fa-pencil-square-o'></i> <?=$currentShow->getTitle();?> Camp Registration Form (Boys only)</a> online and pay the $50 holding fee to reserve your spot.</p>
				<p>A confirmation email with more information will be sent out within one week of receiving your deposit.</p>
				<p>There are only 45 spots available and this camp WILL fill up so don’t delay!</p>
				<p><?=$currentShow->getTitle();?> Staff:<br>
					Director/Choreographer: Mindy Moritz<br>
					Music/Tech Director: Nick Perry<br>
					Assistant Director: Jenn Harvey</p>
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
				<div class='cutout hide-xs'>
					<img src='_img/maggie-christian.png' alt=''>
				</div>
			</div>
		</div>
	</section>
<?=$footer;?>
