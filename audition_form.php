<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once('_inc/ipt_1.php');
$title = "{$currentShow->getTitle()} Audition Form";
require_once('_inc/ipt_2.php');

// $formSubmitted = apiGet('formSubmitted');

$likelySpam = false;
if(apiPost('submit') && (apiPost('questions') || apiPost('referral') || apiPost('website') !== 'http://')) {	//	if any of these bot-trap (hidden) fields are filled, this is almost certainly spam
	$likelySpam = true;
}

if(apiPost('submit') && !$likelySpam) {
	$sqlQueries = array();
	$newPerson = false;	//	assume false until proven true
	$newAudition = false;	//	assume false until proven true

	$whenAudition = apiPost('whenAudition') . (apiPost('whenAudition') === 'Other' ? ': ' . apiPost('whenAudition_OtherText') : '');
	$showId = $currentShow->getId();
	$type = 'cast';
	$firstName = trim(apiPost('firstName'));
	$lastName = trim(apiPost('lastName'));
	$gender = apiPost('gender');
	$height = (intval(apiPost('ht_ft')) * 12) + intval(apiPost('ht_in'));	//	height is stored only in inches
	$dateOfBirth = apiPost('dateOfBirth');
	$phone = trim(apiPost('phone'));
	$email = trim(apiPost('email'));
	$address = apiPost('address') ? trim(apiPost('address')) : null;
	$city = apiPost('city') ? trim(apiPost('city')) : null;
	$state = apiPost('state') ? apiPost('state') : null;
	$zip = apiPost('zip') ? trim(apiPost('zip')) : null;
	$carpool = apiPost('carpool') ? apiPost('carpool') : 'N';
	$parentName = apiPost('parentName') ? trim(apiPost('parentName')) : null;
		$parentFirstName = $parentName ? substr($parentName, 0, strrpos($parentName, ' ')) : null;
		$parentLastName = $parentName ? substr($parentName, strrpos($parentName, ' ') + 1) : null;
	$parentPhone = apiPost('parentPhone') ? trim(apiPost('parentPhone')) : null;
	$parentEmail = apiPost('parentEmail') ? trim(apiPost('parentEmail')) : null;
	$experience = apiPost('experience') ? apiPost('experience') : null;
	$dance = apiPost('dance') ? apiPost('dance') : null;
	$conflicts = apiPost('conflicts') ? apiPost('conflicts') : null;
	$roles = apiPost('role1') ? apiPost('role1') . (apiPost('role2') ? ', ' . apiPost('role2') . (apiPost('role3') ? ', ' . apiPost('role3') : '') : '') : null;
	$acceptEnsemble = apiPost('acceptEnsemble');
	$tech = isset($_POST['tech']) && count($_POST['tech']) ? implode(', ', $_POST['tech']) : null;	//	NOTE: cannot use apiPost() on an array!
	$signature = trim(apiPost('signature'));
	$parentSignature = apiPost('parentSignature') ? trim(apiPost('parentSignature')) : null;
	$comments = apiPost('comments') ? apiPost('comments') : null;
	$date = date('Y-m-d');
	$ip = $_SERVER['REMOTE_ADDR'];

	//	check if this auditionee is already in the system...
	$sql = "
		SELECT id
		FROM ip_people
		WHERE firstName = :firstName
		AND lastName = :lastName
		LIMIT 1";
	$sth = $dbh->prepare($sql);
	$sth->bindParam(':firstName', $firstName, PDO::PARAM_STR);
	$sth->bindParam(':lastName', $lastName, PDO::PARAM_STR);
	$sth->execute();
	$personId = $sth->fetchObject()->id;
	$sqlQueries[] = '//	check if this auditionee is already in the system...' . $sql;
	$testOnly = (strtolower($firstName) === 'test' && strtolower($lastName) === 'test');	//	use the name 'Test Test' to avoid inserting into the database

	if($personId) {	//	this person already has an ID in our system, update their information
		//	first make a back-up copy of the old person data so we don't lose something important...
		$sql = "
			INSERT INTO bak_ip_people
			SELECT p.*, CURRENT_TIMESTAMP()
			FROM ip_people p
			WHERE id = :personId;";
		$sth = $dbh->prepare($sql);
		$sth->bindParam(':personId', $personId, PDO::PARAM_INT);
		$sth->execute();
		$sqlQueries[] = "//	first make a back-up copy of the old person data so we don't lose something important..." . $sql;

		//	now overwrite their old person info with this new info...
		$sql = "
			UPDATE ip_people
			SET
				type = :type,
				firstName = :firstName,
				lastName = :lastName,
				gender = :gender,
				dateOfBirth = :dateOfBirth,
				height = :height,
				email = :email,
				phone = :phone,
				address = :address,
				city = :city,
				state = :state,
				zip = :zip,
				parentFirstName = :parentFirstName,
				parentLastName = :parentLastName,
				parentPhone = :parentPhone,
				parentEmail = :parentEmail,
				ip = :ip
			WHERE id = :personId
			LIMIT 1";
		$sth = $dbh->prepare($sql);
		$sth->bindParam(':type', $type, PDO::PARAM_STR);
		$sth->bindParam(':firstName', $firstName, PDO::PARAM_STR);
		$sth->bindParam(':lastName', $lastName, PDO::PARAM_STR);
		$sth->bindParam(':gender', $gender, PDO::PARAM_STR);
		$sth->bindParam(':dateOfBirth', $dateOfBirth, PDO::PARAM_STR);
		$sth->bindParam(':height', $height, PDO::PARAM_INT);
		$sth->bindParam(':email', $email, PDO::PARAM_STR);
		$sth->bindParam(':phone', $phone, PDO::PARAM_STR);
		$sth->bindParam(':address', $address, PDO::PARAM_STR);
		$sth->bindParam(':city', $city, PDO::PARAM_STR);
		$sth->bindParam(':state', $state, PDO::PARAM_STR);
		$sth->bindParam(':zip', $zip, PDO::PARAM_STR);
		$sth->bindParam(':parentFirstName', $parentFirstName, PDO::PARAM_STR);
		$sth->bindParam(':parentLastName', $parentLastName, PDO::PARAM_STR);
		$sth->bindParam(':parentPhone', $parentPhone, PDO::PARAM_STR);
		$sth->bindParam(':parentEmail', $parentEmail, PDO::PARAM_STR);
		$sth->bindParam(':ip', $ip, PDO::PARAM_STR);
		$sth->bindParam(':personId', $personId, PDO::PARAM_INT);
		$sth->execute();
		$sqlQueries[] = "//	now overwrite their old person info with this new info..." . $sql;

		//	check if their audition is already in the system...
		$sql = "
			SELECT id
			FROM ip_auditions
			WHERE personId = :personId
			AND showId = :showId
			LIMIT 1";
		$sth = $dbh->prepare($sql);
		$sth->bindParam(':personId', $personId, PDO::PARAM_INT);
		$sth->bindParam(':showId', $showId, PDO::PARAM_INT);
		$sth->execute();
		$auditionId = $sth->fetchObject()->id;
		$sqlQueries[] = "//	check if their audition is already in the system..." . $sql;

		if($auditionId) {	//	they've already filled out the form before, update their previous one
			//	first make a back-up copy of the old audition data so we don't lose something important...
			$sql = "
				INSERT INTO bak_ip_auditions
				SELECT a.*, CURRENT_TIMESTAMP()
				FROM ip_auditions a
				WHERE id = :auditionId;";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':auditionId', $auditionId, PDO::PARAM_INT);
			$sth->execute();
			$sqlQueries[] = "//	first make a back-up copy of the old audition data so we don't lose something important..." . $sql;

			//	now overwrite their old audition data with this new info...
			$sql = "
				UPDATE ip_auditions
				SET
					showId = :showId,
					personId = :personId,
					whenAudition = :whenAudition,
					height = :height,
					experience = :experience,
					dance = :dance,
					conflicts = :conflicts,
					roles = :roles,
					acceptEnsemble = :acceptEnsemble,
					tech = :tech,
					carpool = :carpool,
					signature = :signature,
					parentSignature = :parentSignature,
					comments = :comments,
					date = :date,
					ip = :ip
				WHERE id = :auditionId
				LIMIT 1";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':showId', $showId, PDO::PARAM_INT);
			$sth->bindParam(':personId', $personId, PDO::PARAM_INT);
			$sth->bindParam(':whenAudition', $whenAudition, PDO::PARAM_STR);
			$sth->bindParam(':height', $height, PDO::PARAM_INT);
			$sth->bindParam(':experience', $experience, PDO::PARAM_STR);
			$sth->bindParam(':dance', $dance, PDO::PARAM_STR);
			$sth->bindParam(':conflicts', $conflicts, PDO::PARAM_STR);
			$sth->bindParam(':roles', $roles, PDO::PARAM_STR);
			$sth->bindParam(':acceptEnsemble', $acceptEnsemble, PDO::PARAM_STR);
			$sth->bindParam(':tech', $tech, PDO::PARAM_STR);
			$sth->bindParam(':carpool', $carpool, PDO::PARAM_STR);
			$sth->bindParam(':signature', $signature, PDO::PARAM_STR);
			$sth->bindParam(':parentSignature', $parentSignature, PDO::PARAM_STR);
			$sth->bindParam(':comments', $comments, PDO::PARAM_STR);
			$sth->bindParam(':date', $date, PDO::PARAM_STR);
			$sth->bindParam(':ip', $ip, PDO::PARAM_STR);
			$sth->bindParam(':auditionId', $auditionId, PDO::PARAM_INT);
			$sth->execute();
			$sqlQueries[] = "//	now overwrite their old audition data with this new info..." . $sql;
		} else {	//	this is the first time they've filled out the audition form for this show
			$newAudition = true;
		}
	} else {	//	they are a new person
		$newPerson = true;
		$newAudition = true;
	}

	if($newPerson) {
		//	insert this new person into database and retrieve their personId (for the audition)...
		$sql = "
			INSERT INTO ip_people (
				type,
				firstName,
				lastName,
				gender,
				dateOfBirth,
				height,
				email,
				phone,
				address,
				city,
				state,
				zip,
				parentFirstName,
				parentLastName,
				parentPhone,
				parentEmail,
				dateCreated,
				ip
			) VALUES (
				:type,
				:firstName,
				:lastName,
				:gender,
				:dateOfBirth,
				:height,
				:email,
				:phone,
				:address,
				:city,
				:state,
				:zip,
				:parentFirstName,
				:parentLastName,
				:parentPhone,
				:parentEmail,
				:date,
				:ip
			);";
		$sth = $dbh->prepare($sql);
		$sth->bindParam(':type', $type, PDO::PARAM_STR);
		$sth->bindParam(':firstName', $firstName, PDO::PARAM_STR);
		$sth->bindParam(':lastName', $lastName, PDO::PARAM_STR);
		$sth->bindParam(':gender', $gender, PDO::PARAM_STR);
		$sth->bindParam(':dateOfBirth', $dateOfBirth, PDO::PARAM_STR);
		$sth->bindParam(':height', $height, PDO::PARAM_INT);
		$sth->bindParam(':email', $email, PDO::PARAM_STR);
		$sth->bindParam(':phone', $phone, PDO::PARAM_STR);
		$sth->bindParam(':address', $address, PDO::PARAM_STR);
		$sth->bindParam(':city', $city, PDO::PARAM_STR);
		$sth->bindParam(':state', $state, PDO::PARAM_STR);
		$sth->bindParam(':zip', $zip, PDO::PARAM_STR);
		$sth->bindParam(':parentFirstName', $parentFirstName, PDO::PARAM_STR);
		$sth->bindParam(':parentLastName', $parentLastName, PDO::PARAM_STR);
		$sth->bindParam(':parentPhone', $parentPhone, PDO::PARAM_STR);
		$sth->bindParam(':parentEmail', $parentEmail, PDO::PARAM_STR);
		$sth->bindParam(':date', $date, PDO::PARAM_STR);
		$sth->bindParam(':ip', $ip, PDO::PARAM_STR);

		if (!$testOnly) {
			$sth->execute();
			$personId = $dbh->lastInsertId();
		}
		$sqlQueries[] = "//	insert this new person into database and retrieve their personId (for the audition)..." . $sql;
	}

	if($newAudition) {
		//	insert this new audition into database using the known personId...
		$sql = "
			INSERT INTO ip_auditions (
				showId,
				personId,
				whenAudition,
				height,
				experience,
				dance,
				conflicts,
				roles,
				acceptEnsemble,
				tech,
				carpool,
				signature,
				parentSignature,
				comments,
				date,
				ip
			) VALUES (
				:showId,
				:personId,
				:whenAudition,
				:height,
				:experience,
				:dance,
				:conflicts,
				:roles,
				:acceptEnsemble,
				:tech,
				:carpool,
				:signature,
				:parentSignature,
				:comments,
				:date,
				:ip
			);";
		$sth = $dbh->prepare($sql);
		$sth->bindParam(':showId', $showId, PDO::PARAM_INT);
		$sth->bindParam(':personId', $personId, PDO::PARAM_INT);
		$sth->bindParam(':whenAudition', $whenAudition, PDO::PARAM_STR);
		$sth->bindParam(':height', $height, PDO::PARAM_INT);
		$sth->bindParam(':experience', $experience, PDO::PARAM_STR);
		$sth->bindParam(':dance', $dance, PDO::PARAM_STR);
		$sth->bindParam(':conflicts', $conflicts, PDO::PARAM_STR);
		$sth->bindParam(':roles', $roles, PDO::PARAM_STR);
		$sth->bindParam(':acceptEnsemble', $acceptEnsemble, PDO::PARAM_STR);
		$sth->bindParam(':tech', $tech, PDO::PARAM_STR);
		$sth->bindParam(':carpool', $carpool, PDO::PARAM_STR);
		$sth->bindParam(':signature', $signature, PDO::PARAM_STR);
		$sth->bindParam(':parentSignature', $parentSignature, PDO::PARAM_STR);
		$sth->bindParam(':comments', $comments, PDO::PARAM_STR);
		$sth->bindParam(':date', $date, PDO::PARAM_STR);
		$sth->bindParam(':ip', $ip, PDO::PARAM_STR);
		if (!$testOnly) {
			$sth->execute();
		}
		$sqlQueries[] = "//	insert this new audition into database using the known personId..." . $sql;
	}

	//	Send an email to myself...
	$to = $config['my_email'];
	$message = "<b>name:</b> $firstName $lastName<br>\n"
		. "<b>dateOfBirth:</b> $dateOfBirth (age: " . getAge($dateOfBirth) . ")<br>\n"
		. "<b>whenAudition:</b> $whenAudition<br>\n"
		. "<b>roles:</b> $roles<br>\n"
		. "<b>acceptEnsemble:</b> $acceptEnsemble<br>\n"
		. "<b>tech:</b> $tech<br>\n"
		. "<b>carpool:</b> $carpool<br>\n"
		. "<b>experience:</b> " . nl2br($experience) . "<br>\n"
		. "<b>dance:</b> " . nl2br($dance) . "<br>\n"
		. "<b>conflicts:</b> " . nl2br($conflicts) . "<br>\n"
		. "<b>comments:</b> " . nl2br($comments) . "<br>\n"
		. "<b>gender:</b> $gender<br>\n"
		. "<b>height:</b> " . floor($height / 12) . "'" . ($height % 12) . '"' . "<br>\n"
		. "<b>phone:</b> $phone<br>\n"
		. "<b>email:</b> $email<br>\n"
		. "<b>address:</b> $address<br>\n"
		. "<b>city:</b> $city<br>\n"
		. "<b>state:</b> $state<br>\n"
		. "<b>zip:</b> $zip<br>\n"
		. "<b>parentName:</b> $parentName<br>\n"
		. "<b>parentPhone:</b> $parentPhone<br>\n"
		. "<b>parentEmail:</b> $parentEmail<br>\n"
		. "<b>newPerson:</b> $newPerson<br>\n"
		. "<b>newAudition:</b> $newAudition<br>\n"
		. "<b>date:</b> $date<br>\n"
		. "<b>browser:</b> " . $_SERVER['HTTP_USER_AGENT'] . "<br>\n"
		. "<b>ip:</b> $ip<br>\n";
	$subject = ($whenAudition !== 'General' ? "ALTERNATE " : "") . "{$currentShow->getAbbr()} Audition: $firstName $lastName";
	$headers = "From: IPTheater <{$config['info_email']}>\n"
		. "Reply-To: $firstName $lastName <$email>\n"
		. "MIME-Version: 1.0\n"
		. "Content-type: text/html; charset=iso-8859-1\n"
		. "bcc: {$config['bcc_email']}";
	$message = preg_replace("#(?<!\r)\n#si", "\r\n", $message);	// Fix any bare linefeeds in the message to make it RFC821 Compliant
	$headers = preg_replace("#(?<!\r)\n#si", "\r\n", $headers); // Make sure there are no bare linefeeds in the headers
	mail($to,$subject,$message,$headers);

	//	Send an email to auditionee...
	$to = $email;
	switch($whenAudition) {
		case 'General':
			$whenAuditionMessage = "Please mark your calendar for Saturday, November 1st (9:00am - 12:30pm) for your {$currentShow->getTitle()} audition!  The location is:<br><br>\n"
				. "New City Church<br>\n"
				. "7456 Nieman Rd<br>\n"
				. "Shawnee, KS 66203<br><br>\n"
				. "NOTE: Callbacks are on November 8th and are by invitation only.<br><br>\n"
				. "You don't have to bring any paperwork with you, but please make note of the following list:<br><br>\n"
				. "<b>WHAT TO PREPARE</b><br>\n"
				. "<ul>\n"
					. "<li>Prepare a solo audition song (approx. 30-45 seconds) with background music on CD, smartphone, or mp3 player.</li>\n"
					. "<li>Please bring comfortable shoes and clothes to dance in.  (NOTE: tap shoes are optional for those who wish to participate in the tap audition.)</li>\n"
					. "<li>For those who are unfamiliar with the roles, we encourage you to read the character descriptions by clicking the following link:<br>\n"
						. "<a href='http://iptheater.com/downloads/{$currentShow->getAbbr()}%20Character%20Descriptions.pdf'>http://iptheater.com/downloads/{$currentShow->getAbbr()}%20Character%20Descriptions.pdf</a></li>\n"
					. "<li>Optionally, download the {$currentShow->getTitle()} callback package to prepare for callbacks (NOTE: Approximately 30-40% of auditionees will be asked to return for callbacks.  Receiving a callback does not guarantee you will be cast in the show, and not receiving a callback does not necessarily mean you are not being considered for a role.).  The optional callback package may be downloaded at: <a href='http://iptheater.com/downloads/{$currentShow->getAbbr()}%20Callback%20Package.zip'>http://iptheater.com/downloads/{$currentShow->getAbbr()}%20Callback%20Package.zip</a></li>\n"
				. "</ul>\n";
			break;
		case 'YouTube':
			$whenAuditionMessage = "You opted to audition over YouTube.  Please record yourself singing 30-45 seconds of one or two audition songs of your choice.  Optionally, you're welcome to use a video of a previous performance as long as you're featured singing a solo.<br><br>\n"
				. "If you would like to show us any form of dancing, you're welcome to do that also, but it is not required.  Simply include a link to a video of yourself performing a dance solo or dancing in a group (be sure to point out who you are in a group video if it's not obvious).<br><br>\n"
				. "In addition, you may optionally wish to include any scenes or songs from the {$currentShow->getTitle()} callback package which may be downloaded at <a href='http://iptheater.com/downloads/{$currentShow->getAbbr()}%20Callback%20Package.zip'>http://iptheater.com/downloads/{$currentShow->getAbbr()}%20Callback%20Package.zip</a>.<br><br>\n"
				. "After you have recorded yourself, upload the video(s) to YouTube (you may wish use the \"invite-only\" setting), and send us the link(s) using the contact page on our website or replying to this email.  We will keep your video confidential, and after we have watched it, you are certainly welcome to take it down.  Feel free to contact us if you have any questions about this process.<br><br>\n";
			break;
		case 'Email':
			$whenAuditionMessage = "You opted to audition over Email.  Please record yourself singing 30-45 seconds of one or two audition songs of your choice, and use WeTransfer.com (or another large file sending service) to send the file to {$config['info_email']}.  You may optionally wish to include any scenes or songs from the {$currentShow->getTitle()} callback package which may be downloaded at <a href='http://iptheater.com/downloads/{$currentShow->getAbbr()}%20Callback%20Package.zip'>http://iptheater.com/downloads/{$currentShow->getAbbr()}%20Callback%20Package.zip</a>.<br><br>\n"
				. "We will keep your video confidential.  Feel free to contact us if you have any questions about this process.<br><br>\n";
			break;
		case 'Skype':
			$whenAuditionMessage = "You opted to audition over Skype.  Please prepare a solo audition song (approx. 30-45 seconds) with background music on CD, smartphone, or mp3 player.  You may optionally wish to prepare any scenes or songs from the {$currentShow->getTitle()} callback package which may be downloaded at <a href='http://iptheater.com/downloads/{$currentShow->getAbbr()}%20Callback%20Package.zip'>http://iptheater.com/downloads/{$currentShow->getAbbr()}%20Callback%20Package.zip</a>.<br><br>\n"
				. "You may expect to receive an email from us within a few days to schedule your Skype audition.  Feel free to contact us if you have any questions about this process.<br><br>\n";
			break;
		default:
			$whenAuditionMessage = "You may expect to receive an email from us within a few days to work out the details of your audition.<br><br>\n";
	}
	$message = "<p>Hi $firstName!<br><br>\n"
		. "Thank you for your interest in Immeasurable Productions!<br><br>\n"
		. $whenAuditionMessage
		. "Thank you again for your interest in {$currentShow->getTitle()}!  We are excited to see your audition!<br><br>\n"
		. "Jeremy Moritz<br>\n"
		. "Immeasurable Productions<br>\n"
		. "<a href='www.IPTheater.com'>www.IPTheater.com</a><br>\n";
	$subject = "We look forward to your {$currentShow->getTitle()} Audition!";
	$headers = "From: Immeasurable Productions <{$config['info_email']}>\n"
		. "MIME-Version: 1.0\n"
		. "Content-type: text/html; charset=iso-8859-1\n"
		. "bcc: {$config['bcc_email']}";
	$message = preg_replace("#(?<!\r)\n#si", "\r\n", $message);	// Fix any bare linefeeds in the message to make it RFC821 Compliant
	$headers = preg_replace("#(?<!\r)\n#si", "\r\n", $headers); // Make sure there are no bare linefeeds in the headers
	mail($to,$subject,$message,$headers);
	if ($parentEmail && $parentEmail !== $email) {
		mail($parentEmail,$subject,$message,$headers);	//	send the same email to parent
	}

	foreach($sqlQueries as $sql) {
		file_put_contents('_inc/log.txt', $sql . "\n", FILE_APPEND);
	}

	//	Redirect to thank you page
	header('Location: ' . $_SERVER['PHP_SELF'] . '?formSubmitted=true' . ($whenAudition === 'General' ? '&wa=general' : ''));
}

?>
<?=$header;?>
	<section class='main'>
		<h1>Immeasurable Productions</h1>
		<h2><img src='_img/ip-logo-long_400_trans.png' alt='Immeasurable Productions'><br>
			<img src='_img/<?=$currentShow->getAbbrLower();?>-logo_250.png' alt='<?=$currentShow->getTitle();?>' id='<?=$currentShow->getAbbrLower();?>_logo'>
		</h2>

<?php
	if(apiGet('formSubmitted')) {
		echo "<h3>Thank you for filling out the audition form!</h3>";

		if(apiGet('wa') === 'general') {
			echo  "
				<p>Now would be a great time to mark your calendar!</p>
				<p>Auditions: Saturday, Nov. 1st, 9:00am - 12:30pm<br>
				(Callbacks: Saturday, Nov. 8th, 9:00am - 12:30pm)<br>
				at New City Church<br>
				7456 Nieman Rd<br>
				Shawnee, KS 66203</p>";
		}

		echo "
			<p>More information about how to prepare for your audition is on our <a href='{$currentShow->getAbbrLower()}' class='btn btn-primary'><i class='fa fa-lg fa-info-circle'></i> {$currentShow->getTitle()} Information Page</a>.</p>
			<p>Optionally, you may wish to download the <a class='btn btn-success' href='downloads/{$currentShow->getAbbr()}%20Callback%20Package.zip' title='Download the {$currentShow->getTitle()} Callback Package!' target='_blank'><i class='fa fa-lg fa-arrow-circle-o-down'></i> {$currentShow->getTitle()} Callback Package</a> if you would like to prepare for callbacks.</p>
			<h3>We look forward to your audition!</h3>";
	} else {
?>
		<h3>Audition Form for <?=$currentShow->getTitle();?></h3>
		<p>Please completely fill out and submit this form in advance of your audition.</p>
		<hr>
		<form action='<?=$_SERVER['PHP_SELF'];?>' method='post' role='form' class='bs-condensed form-inline'>
			<div class='row'>
				<section class='col-xs-12'>
					<p>When are you auditioning (select one)?</p>
				</section>
			</div>
			<div class='row'>
				<section class='col-sm-9'>
					<ul class="jm list-group">
						<li class="list-group-item"><input type='radio' name='whenAudition' value='General' id='whenAudition_General' class='form-control' required>
							<label for='whenAudition_General'><strong>General Audition<br>
							AUDITIONS: Saturday, November 1st, 9:00am - 12:30pm<br>
							(Callbacks: Saturday, November 8th, 9:00am - 12:30pm)</strong></label>
						</li>
						<li class="list-group-item"><input type='radio' name='whenAudition' value='YouTube' id='whenAudition_YouTube' class='form-control' required><label for='whenAudition_YouTube'>Absentee Audition: YouTube</label></li>
						<!-- <li class="list-group-item"><input type='radio' name='whenAudition' value='Skype' id='whenAudition_Skype' class='form-control' required><label for='whenAudition_Skype'>Absentee Audition: Skype</label></li> -->
						<!-- <li class="list-group-item"><input type='radio' name='whenAudition' value='Email' id='whenAudition_Email' class='form-control' required><label for='whenAudition_Email'>Email</label></li> -->
						<li class="list-group-item"><input type='radio' name='whenAudition' value='Other' id='whenAudition_Other' class='form-control' required><label for='whenAudition_Other'>Absentee Audition: Other:</label><input type='text' name='whenAudition_OtherText' maxlength='100' class='form-control'></li>
					</ul>
				</section>
				<section class='col-sm-3' id="headshot">
				</section>
			</div>
			<div class='row'>
				<section class='col-sm-12'>
					<strong>Name:</strong>
					<input type='text' name='firstName' id='firstName' placeholder='First Name' class='form-control' required>
					<input type='text' name='lastName' id='lastName' placeholder='Last Name' class='form-control' required>
					&nbsp; &nbsp;
					<strong>M/F:</strong>
					<select name='gender' class='form-control' required><option value=''>&hellip;</option><option value='M'>M</option><option value='F'>F</option></select>
					&nbsp; &nbsp;
					<strong>Height:</strong>
					<input type='number' name='ht_ft' min='3' max='6' class='form-control' required>ft.
					<input type='number' name='ht_in' min='0' max='11' class='form-control' required>in.
					&nbsp; &nbsp;
					<strong>Date of Birth:</strong>
					<input
						type='number' name='dobMM' data-bind='value: dobMM' placeholder='MM' min='1' max='12' class='form-control' required>/<input
						type='number' name='dobDD' data-bind='value: dobDD' placeholder='DD' min='1' max='31' class='form-control' required>/<input
						type='number' name='dobYYYY' data-bind='value: dobYYYY, valueUpdate: "afterkeydown"' placeholder='YYYY' min='<?=date('Y', strtotime('-80 years'));?>' max='<?=date('Y', strtotime('-4 years'));?>' class='form-control' required>
						<span class='weak' data-bind="text: auditioneeAge() < 100 ? 'age ' + auditioneeAge() : ''"></span>
					<input type='hidden' name='dateOfBirth' data-bind='value: dateOfBirth'>
				</section>
			</div>
			<div class='row'>
				<section class='col-sm-12'>
					<strong>Phone:</strong><input type='text' name='phone' class='formatter format-phone form-control' required>
					<strong>Email:</strong><input type='text' name='email' class='form-control' required>
				</section>
			</div>
			<div class='row'>
				<section class='col-sm-12'>
					<strong>Address:</strong><input type='text' name='address' class='form-control'>
					<strong>Zip:</strong><input type='text' name='zip' maxlength='10' class='formatter format-zip form-control' id='zip'>
					<strong>City:</strong><input type='text' name='city' id='city' class='form-control'>
					<strong>State:</strong><select name='state' id='state' class='form-control'><?=$stateOptions;?></select>
				</section>
			</div>
			<div class='row'>
				<section class='col-sm-12'>
					<input type='checkbox' name='carpool' value='Y' id='carpoolY' class='form-control'><label for='carpoolY'> &nbsp;<i class="fa fa-arrow-left"></i> Check this box if you're interested in carpooling.</label>
				</section>
			</div>
			<div class='row' data-bind='visible: auditioneeAge() < grownUpAge()'>
				<section class='col-sm-12'>
					<strong>Parent/Guardian:</strong><input type='text' name='parentName' data-bind="attr: {'required': auditioneeAge() < adultAge()}" class='form-control'>
					<strong>Phone:</strong><input type='text' name='parentPhone' class='formatter format-phone form-control' data-bind="attr: {'required': auditioneeAge() < adultAge()}">
					<strong>Email:</strong><input type='text' name='parentEmail' data-bind="attr: {'required': auditioneeAge() < adultAge()}" class='form-control'>
				</section>
			</div>
			<div class='row'>
				<section class='col-sm-12'>
					Prior Theatre Experience (type a few highlights or paste from a resume): <textarea name='experience' class='form-control'></textarea>
				</section>
			</div>
			<div class='row'>
				<section class='col-sm-12'>
					Formal Dance Training:<textarea name='dance' class='form-control'></textarea>
				</section>
			</div>
			<div class='row'>
				<section class='col-sm-12'>
					Please list any conflicts with the 6-day rehearsal schedule and 6 performances.  Rehearsals are Dec 26 - 31, 2013, 9am - 6pm daily (2pm - 6pm on Sunday).  Some selected leads will need to stay as late as 9pm on some rehearsal days. Performances are Dec. 31, <?= date('Y'); ?> at 6pm, Jan. 1 at 2pm &amp; 7pm, Jan. 2 at 2pm &amp; 7pm, and Jan. 3, <?= date('Y', strtotime('+1 year')); ?> at 2pm. Three or more hours of absences may prohibit casting in the show:<textarea name='conflicts' class='form-control'></textarea>
				</section>
			</div>
			<div class='row'>
				<section class='col-sm-12'>
					What role(s) do you see yourself as? (<a href='downloads/<?=$currentShow->getAbbr();?>%20Character%20Descriptions.pdf' target='_blank'>Character Descriptions</a>)<br>
					<ol id='roles'>
						<li>1.) <input type='text' name='role1' class='form-control'></li>
						<li>2.) <input type='text' name='role2' class='form-control'></li>
						<li>3.) <input type='text' name='role3' class='form-control'></li>
					</ol>
				</section>
			</div>
			<div class='row'>
				<section class='col-sm-12'>
					Would you consider another role (including ensemble)? <select name='acceptEnsemble' class='form-control'><option value='Y'>Yes</option><option value='N'>No</option></select>
				</section>
			</div>
			<div class='row' data-bind='visible: auditioneeAge() < grownUpAge()'>
				<section class='col-sm-12'>
					<strong>Parents:</strong> Would you or another adult consider volunteering in one of the following areas? (Note: if you have a strong preference or skill in a particular area, please mention this in the comments section)
				</section>
				<section class='col-sm-12'>
					<ul id='techAreas'>
						<li><label><input type='checkbox' name='tech[]' value='costumes' class='form-control'>Costumes</label></li>
						<li><label><input type='checkbox' name='tech[]' value='sets' class='form-control'>Sets</label></li>
						<li><label><input type='checkbox' name='tech[]' value='props' class='form-control'>Props</label></li>
						<li><label><input type='checkbox' name='tech[]' value='backstage' class='form-control'>Backstage</label></li>
						<li><label><input type='checkbox' name='tech[]' value='makeup' class='form-control'>Make-Up</label></li>
						<li><label><input type='checkbox' name='tech[]' value='green room' class='form-control'>Green Room</label></li>
						<li><label><input type='checkbox' name='tech[]' value='ticketing/ushering/refreshments' class='form-control'>Ticketing/Ushering/Refreshments</label></li>
					</ul>
				</section>
			</div>
			<div class='row'>
				<section class='col-sm-12'>
					<p>I understand that each cast member is responsible to pay a $140 production fee (or $240 per family) which includes all production costs.</p>
					Type-In Signature:<input type='text' name='signature' class='form-control' required> <span data-bind='visible: auditioneeAge() < adultAge()'>Type-In Signature of Parent/Guardian:<input type='text' name='parentSignature' data-bind="attr: {'required': auditioneeAge() < adultAge()}" class='form-control'> </span>Date: <?= date('n/j/Y'); ?>
				</section>
			</div>
			<div class='row'>
				<section class='col-sm-12'>
					<strong>Comments:</strong><textarea name='comments' class='form-control'></textarea>
				</section>
			</div>
			<div class='row bot-trap'>
				<section class='col-xs-12'>
					<!-- BOT-TRAP: THIS PART IS MEANT TO STOP SPAM SUBMISSIONS FROM ROBOTS (if you see this section, don't change these fields) -->
						<p class='bot-trap'><label>Robot Questions</label><textarea name='questions' rows='6' cols='40' class='form-control'></textarea></p>
						<p class='bot-trap'><label>Robot Referral</label><input type='text' name='referral' value='' class='form-control'></p>
						<p class='bot-trap'><label>Robot Website</label><input type='text' name='website' value='http://' class='form-control'></p>
					<!-- /BOT-TRAP -->
				</section>
			</div>
			<div class='row'>
				<section class='col-sm-12 text-center top-buffer'>
					<input type='submit' name='submit' value='Submit Audition Form' onclick='return confirm("Is the form complete and accurate?")' class='btn btn-primary'>
				</section>
			</div>
		</form>
<?php
	}
?>
	</section>
<?=$footer;?>
