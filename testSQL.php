<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once('_inc/ipt_1.php');
$title = "Test SQL Page";
require_once('_inc/ipt_2.php');

$sqlQueries = array();

			
			//	now overwrite their old audition data with this new info...
			$sql = "
				UPDATE ip_auditions
				SET 
					showId = :showId,
					personId = :personId,
					whenAudition = :whenAudition,
					song = :song,
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
					date = :date
				WHERE id = :auditionId
				LIMIT 1";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':showId', $showId, PDO::PARAM_INT);
			$sth->bindParam(':personId', $personId, PDO::PARAM_INT);
			$sth->bindParam(':whenAudition', $whenAudition, PDO::PARAM_STR);
			$sth->bindParam(':song', $song, PDO::PARAM_STR);
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
			$sth->bindParam(':auditionId', $auditionId, PDO::PARAM_INT);
			$sth->execute();
			$sqlQueries[] = "//	now overwrite their old audition data with this new info..." . $sql;
	
	file_put_contents('_inc/log.txt', "\n\n\nSQL QUERIES...\n\n", FILE_APPEND);
	foreach($sqlQueries as $sql) {
		file_put_contents('_inc/log.txt', $sql . "\n", FILE_APPEND);
	}
}

?>
<?=$header;?>
<body id='audition_form'>
	<?=$topper;?>
		<?=$navbar;?>
		<section class='main'>
			Test SQL Page
		</section>
	<?=$footer;?>
</body>
</html>

