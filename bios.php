<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once('_inc/ipt_1.php');
$title = "{$currentShow->getTitle()} Cast Bios";
require_once('_inc/ipt_2.php');

//	FETCH ALL CAST MEMBERS, INCLUDING BIOS
$selections = "
	p.id,
	p.firstName,
	p.lastName,
	p.dateOfBirth,
	p.gender,
	b.bio,
	c.role,
	c.group1,
	c.group2,
	c.group3,
	a.auditionNumber
	";

$sql = "
	SELECT $selections
	FROM ip_people p
	INNER JOIN ip_cast c ON p.id = c.personId
	INNER JOIN ip_auditions a ON p.id = a.personId
	LEFT JOIN ip_cast_bios b ON b.castId = c.id
	WHERE c.showId = {$currentShow->getId()}
	AND a.showId = {$currentShow->getId()}
	AND (
		b.approved = 1
		OR b.approved IS NULL
	)
	ORDER BY p.lastName, p.firstName";

$sth = $dbh->prepare($sql);
$sth->execute();
$cast = sthFetchObjects($sth);

$castBios = "";

$firstName = '';
$pronoun = '';
$possessivePronoun = '';

$funnyBios = array(
	"<firstName> is very proud of <possessivePronoun> organized stamp collection! Now on display at the Nelson Art Gallery!",
	"<firstName> can sing the alphabet in Swahili.",
	"<firstName> loves to scrapbook <possessivePronoun> friends' baby photos.",
	"<firstName> currently holds the Midwest high school record for sending 14,621 instagrams!",
	"<firstName> is Vice-President of the Save the Orangutans Foundation.",
	"<firstName> is perfecting <possessivePronoun> impersonation of Ross Lynch.",
	"<firstName> has an extensive glass unicorn collection.",
	"<firstName> is training for a hot dog eating competition.",
	"<firstName> is very skilled in building toothpick and marshmallow scale-model skyscrapers.",
	"<firstName> is a stark-raving Justin Bieber fan. #belieber",
	"<firstName> is an Olympic-level dumpster diver.",
	"<firstName> just recently emerged after a year of solitude. <pronoun> is also very fond of easy-cheese and crackers.",
	"<firstName> has never kissed a chipmunk or painted daisies on a big red rubber ball.",
	"<firstName> would like you to know that <pronoun> love cats.  <pronoun> loves every kind of cat. <pronoun> just wants to hug all them... But <pronoun> can't.",
	"<firstName> enjoys candle-light dinners and getting caught in the rain.",
	"<firstName> likes to belly dance and eat jolly ranchers…but not at always the same time.",
	"<firstName> is going pro with national Cupid shuffle dance competitions.",
	"<firstName> just saved a bunch of money on <possessivePronoun> car insurance by switching to Geico. ",
	"<firstName> would like to boast that <possessivePronoun> bedroom is currently decorated with 9,227 Christmas lights.",
	"A liger is pretty much <firstName>'s favorite animal.",
	"<firstName> is all about that bass.",
	"<firstName> was the number one contributor to Gangnam style's 2 billion views."
);
shuffle($funnyBios);

foreach($cast as $c) {
	$groups = $c->group1 === "Leads" ? "" : $c->group1 . ($c->group2 ? ", $c->group2" . ($c->group3 ? ", $c->group3" : "") : "");

	$imgPrefix = "_img/auditions/";
	$showPrefix = "{$currentShow->getAbbrLower()}/{$currentShow->getAbbrLower()}";
	$imgSrc = "{$imgPrefix}{$showPrefix}_{$c->auditionNumber}.jpg";
	if(!file_exists($imgSrc)) {	//	if we don't have a pic with this audition number
		$imgSrc = "{$imgPrefix}{$showPrefix}_0{$c->auditionNumber}.jpg";	//	try zero-padding the audition number

		if(!file_exists($imgSrc)) {	//	if it still doesn't exist
			$imgSrc = "{$imgPrefix}nophoto_" . strtolower($c->gender) . ".jpg";	//	use a nophoto pic
		}
	}

	if (!$c->bio) {
		$firstName = $c->firstName;
		$pronoun = ($c->gender === 'M' ? 'he' : 'she');
		$possessivePronoun = ($c->gender === 'M' ? 'his' : 'her');
		$c->bio = str_replace(array('<firstName>','<pronoun>','<possessivePronoun>'), array($firstName, $pronoun, $possessivePronoun), array_pop($funnyBios));
	}

	$castBios .= "
		<section class='cast-bio col-sm-6 col-md-4'>
			<div>
				<img src='$imgSrc' alt='$c->firstName $c->lastName'>
				<h5><strong>$c->firstName $c->lastName</strong> (" . getAge($c->dateOfBirth) . ")<br>
				<em>" . ($c->role ? "<b>{$c->role}</b>" . ($groups ? ", $groups" : "") : $groups) . "</em></h5>"
				. ($c->bio ? "<hr><p>{$c->bio}</p>" : "") . "
				<div class='clearfix'></div>
			</div>
		</section>";
}

?>
<?=$header;?>
	<section class='main'>
		<h1>Immeasurable Productions</h1>
		<h2><img src='_img/ip-logo-long_400_trans.png' alt='Immeasurable Productions'><br>
			<img src='_img/<?=$currentShow->getAbbrLower();?>-logo_250.png' alt='<?=$currentShow->getTitle();?>' id='<?=$currentShow->getAbbrLower();?>_logo'>
		</h2>
		<h3>Cast Bios</h3>
		<ul class='no-bullet'>
			<li>* Denotes a role that will be performed on Dec 31st Evening, Jan 2nd Evening, and Jan 3rd Matinee.</li>
			<li>** Denotes a role that will be performed on Jan 1st Matinee, Jan 1st Evening, and Jan 3rd Evening.</li>
		</ul>
		<div class='row'>
			<?=$castBios;?>
		</div>
		<ul class='no-bullet'>
			<li>* Denotes a role that will be performed on Dec 31st Evening, Jan 2nd Evening, and Jan 3rd Matinee.</li>
			<li>** Denotes a role that will be performed on Jan 1st Matinee, Jan 1st Evening, and Jan 3rd Evening.</li>
		</ul>
	</section>
<?=$footer;?>
