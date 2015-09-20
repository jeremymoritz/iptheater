<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once('_inc/ipt_1.php');
$title = "Audition Workshop Registration Form";
$body_class .= ' form_page';
require_once('_inc/ipt_2.php');

// $formSubmitted = apiGet('formSubmitted');

$likelySpam = false;
//	if any of these bot-trap (hidden) fields are filled, this is almost certainly spam
if(apiPost('submit') && (apiPost('questions') || apiPost('referral') || apiPost('website') !== 'http://')) {
	$likelySpam = true;
}

if(apiPost('submit') && !$likelySpam) {
	$firstName = trim(apiPost('firstName'));
	$lastName = trim(apiPost('lastName'));
	$gender = apiPost('gender');
	$dateOfBirth = apiPost('dateOfBirth');
	$phone = trim(apiPost('phone'));
	$email = trim(apiPost('email'));
	$parentName = apiPost('parentName') ? trim(apiPost('parentName')) : null;
		$parentFirstName = $parentName ? substr($parentName, 0, strrpos($parentName, ' ')) : null;
		$parentLastName = $parentName ? substr($parentName, strrpos($parentName, ' ') + 1) : null;
	$parentPhone = apiPost('parentPhone') ? trim(apiPost('parentPhone')) : null;
	$parentEmail = apiPost('parentEmail') ? trim(apiPost('parentEmail')) : null;
	$signature = trim(apiPost('signature'));
	$parentSignature = apiPost('parentSignature') ? trim(apiPost('parentSignature')) : null;
	$comments = apiPost('comments') ? apiPost('comments') : null;
	$date = date('Y-m-d');
	$ip = $_SERVER['REMOTE_ADDR'];

	phpConsoleLog(apiPost('dateOfBirth'));

	//	Send an email to myself...
	$to = $config['info_email'];
	$message = "<b>name:</b> $firstName $lastName<br>\n"
		. "<b>dateOfBirth:</b> $dateOfBirth (age: " . getAge($dateOfBirth) . ")<br>\n"
		. "<b>gender:</b> $gender<br>\n"
		. "<b>phone:</b> $phone<br>\n"
		. "<b>email:</b> $email<br>\n"
		. "<b>comments:</b> " . nl2br($comments) . "<br>\n"
		. "<b>parentName:</b> $parentName<br>\n"
		. "<b>parentPhone:</b> $parentPhone<br>\n"
		. "<b>parentEmail:</b> $parentEmail<br>\n"
		. "<b>date:</b> $date<br>\n"
		. "<b>browser:</b> " . $_SERVER['HTTP_USER_AGENT'] . "<br>\n"
		. "<b>ip:</b> $ip<br>\n";
	$subject = "Audition Workshop Registration: $firstName $lastName";
	$headers = "From: IPTheater <{$config['info_email']}>\n"
		. "Reply-To: $firstName $lastName <$email>\n"
		. "MIME-Version: 1.0\n"
		. "Content-type: text/html; charset=iso-8859-1\n"
		. "cc: {$config['my_email']}\n"
		. "bcc: {$config['bcc_email']}";
	$message = preg_replace("#(?<!\r)\n#si", "\r\n", $message);	// Fix any bare linefeeds in the message to make it RFC821 Compliant
	$headers = preg_replace("#(?<!\r)\n#si", "\r\n", $headers); // Make sure there are no bare linefeeds in the headers
	mail($to,$subject,$message,$headers);

	//	Send an email to registrant...
	$to = $email;
	$message = "<p>Hi $firstName!<br><br>\n"
		. "Thank you for registering for Immeasurable Productions' Audition Workshop!<br><br>\n"
		. "If you have paid your $50 registration fee then you are guaranteed a spot in the class.  Please mark your calendar now and make note of these details so that you can be prepared to get the most out of this fun day!<br><br>\n"
		. "<b>WHEN:</b> Saturday, August 22nd, 10am - 3pm<br>\n"
		. "<b>WHERE:</b> New City Church, 7456 Nieman Rd, Shawnee, KS 66203<br>\n"
		. "<b>WHAT TO WEAR:</b> Comfortable clothes and tennis shoes (if you have a pair of comfortable dance shoes, bring those too!)<br>\n"
		. "<b>HOW TO PREPARE:</b> Bring the background music (on a CD or on your phone) for a 30- to 60-second song that you would consider using (or have used in the past) for an audition.  Also bring a large, sturdy water bottle.<br><br>\n"
		. "Lunch will provided from Jimmy Johns (sub sandwiches, chips and cookies), or you're welcome to bring your own lunch if you prefer.<br><br>\n"
		. "If you have any questions, feel free to reply to this email.<br><br>\n"
		. "We are excited to see you at the workshop!<br><br>\n"
		. "Jeremy Moritz and Mindy Moritz<br>\n"
		. "Immeasurable Productions<br>\n"
		. "<a href='www.IPTheater.com'>www.IPTheater.com</a><br>\n";
	$subject = "You are registered for the Audition Workshop!";
	$headers = "From: Jeremy Moritz <jeremy@iptheater.com>\n"
		. "MIME-Version: 1.0\n"
		. "Content-type: text/html; charset=iso-8859-1\n"
		. "bcc: {$config['bcc_email']}";
	$message = preg_replace("#(?<!\r)\n#si", "\r\n", $message);	// Fix any bare linefeeds in the message to make it RFC821 Compliant
	$headers = preg_replace("#(?<!\r)\n#si", "\r\n", $headers); // Make sure there are no bare linefeeds in the headers
	mail($to, $subject, $message, $headers);
	if ($parentEmail && $parentEmail !== $email) {
		mail($parentEmail, $subject, $message, $headers);	//	send the same email to parent
	}

	//	Redirect to payment page
	header("Location: pay.php?amount=50&name={$parentName}&email=" . ($parentEmail ? $parentEmail : $email) . "&phone={$parentPhone}&comments=Audition%20Workshop%20Registration%20Fee:%20{$firstName}%20{$lastName}");
}

?>
<?=$header;?>
	<section class='main'>
		<h1>Immeasurable Productions</h1>
		<h2><img src='_img/ip-logo-long_400_trans.png' alt='Immeasurable Productions' class='img-responsive inline-block'>
			<br>
			Audition Workshop
		</h2>
		<h3>Registration Form (Ages 11-18)</h3>
		<p>Please completely fill out and submit this form to register for the Audition Workshop.</p>
		<hr>
		<div class='row'>
			<div class='col-sm-8 col-md-6 col-lg-4 col-sm-offset-2 col-md-offset-3 col-lg-offset-4'>
				<form action='<?=$_SERVER['PHP_SELF'];?>' method='post' role='form' class='bs-condensed'>
					<div class='row'>
						<section class='col-xs-12 text-center' id="headshot">
						</section>
					</div>
					<div class='row top-buffer'>
						<section class='col-xs-12'>
							<label class='sr-only'>Name:</label>
							<input type='text' name='firstName' id='firstName' placeholder='First Name' class='form-control' required>
							<input type='text' name='lastName' id='lastName' placeholder='Last Name' class='form-control top-buffer' required>
						</section>
					</div>
					<div class='row top-buffer'>
						<section class='col-xs-6'>
							<label class='control-label'>M/F:</label>
						</section>
						<section class='col-xs-6'>
							<select name='gender' class='form-control' required><option value=''>&hellip;</option><option value='M'>M</option><option value='F'>F</option></select>
						</section>
					</div>
					<div class='row top-buffer'>
						<section class='col-xs-6'>
							<label class='control-label'>Date of Birth:</label>
						</section>
						<section class='col-xs-6'>
							<input type='date' class='form-control' name='dateOfBirth'>
						</section>
					</div>
					<div class='row top-buffer'>
						<section class='col-sm-12'>
							<label class='sr-only'>Phone:</label>
							<input type='text' name='phone' placeholder='Phone' class='formatter format-phone form-control' required>
						</section>
					</div>
					<div class='row top-buffer'>
						<section class='col-xs-12'>
							<label class='sr-only'>Email:</label>
							<input type='text' name='email' placeholder='Email' class='form-control' required>
						</section>
					</div>
					<div class='row top-buffer'>
						<section class='col-sm-12'>
							<label class='sr-only'>Parent/Guardian:</label>
							<input type='text' name='parentName' placeholder='Parent Name' class='form-control' required>
						</section>
					</div>
					<div class='row top-buffer'>
						<section class='col-sm-12'>
							<label class='sr-only'>Phone:</label>
							<input type='text' name='parentPhone' placeholder='Parent Phone' class='formatter format-phone form-control' required>
						</section>
					</div>
					<div class='row top-buffer'>
						<section class='col-sm-12'>
							<label class='sr-only'>Email:</label>
							<input type='text' name='parentEmail' placeholder='Parent Email' class='form-control' required>
						</section>
					</div>
					<div class='row top-buffer'>
						<section class='col-sm-12'>
							<label class='sr-only'>Comments:</label>
							<textarea name='comments' placeholder='Comments' class='form-control'></textarea>
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
					<div class='row top-buffer'>
						<section class='col-sm-12 text-center top-buffer'>
							<input type='submit' name='submit' value='Submit Form And Pay $50 Registration Fee' onclick='return confirm("Is the form complete and accurate?")' class='btn btn-primary'>
						</section>
					</div>
				</form>
			</section>
		</div>
	</section>
<?=$footer;?>
