<?php
require_once('_inc/ipt_1.php');
$title = 'Immeasurable Productions Show Survey Results';
require_once('_inc/ipt_2.php');

$sql = "
	SELECT
		id,
		title
	FROM ip_shows
	WHERE flag = 1";
$sth = $dbh->prepare($sql);
$sth->execute();
$shows_unsorted = sthFetchObjects($sth);	//	array of objects

$shows = array();
foreach($shows_unsorted as $su) {
	$shows[$su->id] = new SurveyShow($su->id, $su->title);
}

$sql = "
	SELECT
		name,
		age,
		choice_1,
		choice_2,
		choice_3,
		choice_4,
		comment,
		date,
		ip
	FROM ip_show_survey
	WHERE date > '" . date('Y') . "'
	ORDER BY date DESC";
$sth = $dbh->prepare($sql);
$sth->execute();
$submissions = sthFetchObjects($sth);

function getShow($id) {
	global $shows;

	foreach($shows as $show) {
		if ($id === $show->get_id()) {
			return $show;
			//break;
		}
	}
}

$points = array(5,4,3,2);	//	1st choice, 2nd, 3rd, 4th
$ipList = array();
$ipListDoubled = array();
$submissionCount = count($submissions);
$filteredCount = 0;
$filtered = apiGet('filtered', 1);	//	by default, results are filtered, use the "unfiltered" flag to turn filtering off
$detailsTable = array();

foreach($submissions as $sub) {
	if($filtered) {
		if(in_array($sub->ip, $ipList)) {
			if(in_array($sub->ip, $ipListDoubled)) {
				continue;
			}
			$ipListDoubled[] = $sub->ip;
		} else {
			$ipList[] = $sub->ip;
		}
	}

	if(isset($shows[$sub->choice_1])) {
		$shows[$sub->choice_1]->set_score($shows[$sub->choice_1]->get_score() + $points[0]);
	}
	if(isset($shows[$sub->choice_2])) {
		$shows[$sub->choice_2]->set_score($shows[$sub->choice_2]->get_score() + $points[1]);
	}
	if(isset($shows[$sub->choice_3])) {
		$shows[$sub->choice_3]->set_score($shows[$sub->choice_3]->get_score() + $points[2]);
	}
	if(isset($shows[$sub->choice_4])) {
		$shows[$sub->choice_4]->set_score($shows[$sub->choice_4]->get_score() + $points[3]);
	}
	$filteredCount++;

	if(!($sub->choice_1 && $sub->choice_2 && $sub->choice_3 && $sub->choice_4)) {
		continue;
	}

	//	details table
	$detailsTable[] = "
		<tr>
			<td>" . date('n/j', strtotime($sub->date)) . "</td>
			<td>{$sub->name}</td>
			<td>{$sub->age}</td>
			<td>" . getShow($sub->choice_1)->get_title() . "</td>
			<td>" . getShow($sub->choice_2)->get_title() . "</td>
			<td>" . getShow($sub->choice_3)->get_title() . "</td>
			<td>" . getShow($sub->choice_4)->get_title() . "</td>
			<td>{$sub->comment}</td>
		</tr>";
}

function sortByScore($a, $b) {
	return intval($a->get_score()) < intval($b->get_score());
}
usort($shows, "sortByScore");

$highScore = 0;
$graphRows = "";
foreach($shows as $show) {
	$highScore = $show->get_score() > $highScore ? $show->get_score() : $highScore;
	$percent = ($show->get_score() / $highScore) * 100;	//	between 0 and 100

	$graphRows .= "<tr><th>" . $show->get_title() . "</th><td><bar style='width: " . $percent . "%' /></td></tr>\n";
}
$resultsGraph = "
	<table>
		<tbody>
			$graphRows
		</tbody>
	</table>";

?>
<?=$header;?>
	<section class='main'>
		<div class='row'>
			<div class='col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2'>
				<h2><img src='_img/ip-logo-long_400_trans.png' alt='Immeasurable Productions' class='img-responsive inline-block'></h2>
				<section id="results_section">
					<h3>Results of the Show Survey</h3>
					<h4>(<?=$filtered ? 'Filtered by I.P. Address' : 'Unfiltered';?>)</h4>
					<aside>
						<button class='btn btn-primary' onclick='changeFiltering(<?=$filtered ? "0" : "1";?>)'><i class='fa fa-align-left'></i> Change to <?=$filtered ? "un" : "";?>filtered results</button>
					</aside>
					<ul>
						<li>Total Submissions: <?=$submissionCount;?></li>
						<li>Filtered Submissions: <?=$filteredCount;?></li>
					</ul>
					<?=$resultsGraph;?>
				</section>
				<h3><button class='btn btn-info' onclick='$("#details_section").show();$(this).hide()'><i class='fa fa-list'></i> Show Detailed Results</button></h3>
				<section id='details_section' style='display:none'>
					<h3>Detailed Results</h3>
					<table class='table table-striped'>
						<thead>
							<tr>
								<th>Date</th>
								<th>Name</th>
								<th>Age</th>
								<th>1st</th>
								<th>2nd</th>
								<th>3rd</th>
								<th>4th</th>
								<th>Comment</th>
							</tr>
						</thead>
						<tbody>
							<?=join("\n", $detailsTable);?>
						</tbody>
					</table>
				</section>
			</div>
		</div>
	</section>
<?=$footer;?>

