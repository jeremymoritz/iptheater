<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once('_inc/ipt_1.php');

$title = "{$currentShow->getTitle()} Cast Faces";
require_once('_inc/ipt_2.php');

$more = filter_input(INPUT_GET, 'more');

//	FETCH ALL AUDITIONEES
$selections = "
	p.id,
	p.firstName,
	p.lastName,
	p.dateOfBirth,
	p.gender,
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
	WHERE c.showId = {$currentShow->getId()}
	AND a.showId = {$currentShow->getId()}
	ORDER BY p.lastName, p.firstName";

$sth = $dbh->prepare($sql);
$sth->execute();
$cast = sthFetchObjects($sth);

shuffle($cast);

$castTableHeaders = "
	<th>Name</th>
	<th>Role(s)</th>";

$count = 0;
foreach($cast as $c) {
	$count++;

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

	$castTableRows .= "
		<tr>
			<td><label><input type='checkbox' id='check_$count'><img src='$imgSrc' alt='$c->firstName $c->lastName' class='img-circle'> $c->firstName $c->lastName</label></td>
			<td><label for='check_$count'>" . ($c->role ? "<b>{$c->role}</b>" . ($groups ? ", $groups" : "") : $groups) . "</label></td>
		</tr>";
}

?>
<?=$header;?>
<body id='<?=$thisPageBaseName;?>'>
	<?=$topper;?>
		<?=$navbar;?>
		<section class='main'>
			<h1>Immeasurable Productions</h1>
			<h2><img src='_img/ip-logo-long_400_trans.png' alt='Immeasurable Productions'><br>
				<img src='_img/<?=$currentShow->getAbbrLower();?>-logo_250.png' alt='<?=$currentShow->getTitle();?>' id='<?=$currentShow->getAbbrLower();?>_logo'></h2>
			<p>Learn these faces!  Click anywhere on a row to hide that row.</p>
			<button class='btn btn-success refresh'><i class='fa fa-refresh fa-lg'></i> Show All Rows</button>
			<a href='<?=$_SERVER['PHP_SELF'];?>?<?=$_SERVER['QUERY_STRING'];?>' class='btn btn-primary'><i class='fa fa-random fa-lg'></i> Shuffle</a>
			<button class='btn btn-danger reveal'><i class='fa fa-eye fa-lg'></i> Reveal All Names</button>
			<?php
				$otherShowAbbr = ($currentShow->getAbbrLower() === 'bbb') ? 's42' : 'bbb';
				$otherShowTitle = ($currentShow->getAbbrLower() === 'bbb') ? '42nd Street' : 'Bye Bye Birdie';

				echo "<a href='{$_SERVER['PHP_SELF']}?dev&amp;show=$otherShowAbbr' class='btn btn-warning'><i class='fa fa-music fa-lg'></i> View $otherShowTitle Cast</a>";
			?>
			<h3><?=$currentShow->getTitle();?> Cast List</h3>
			<table class='table table-bordered table-striped table-hover table-condensed tablesorter'>
				<thead>
					<tr>
						<?=$castTableHeaders;?>
					</tr>
				</thead>
				<tbody>
					<?=$castTableRows;?>
				</tbody>
			</table>
			<!--<p>Cast Size: <?=$count;?></p>-->
		</section>
	<?=$footer;?>
	<script>
		$(document).on('click', 'input[type="checkbox"], tr', function() {$(":checked").closest('tr').hide();});
		$(document).on('click', 'button.refresh', function() {
			$("tr").show();
			$("input[type='checkbox']").prop('checked', false);
		});
		$(document).on('click', 'button.reveal', function() {
			$("#cast_faces table tr").css({color: '#c00'});
		});
	</script>
</body>
</html>

