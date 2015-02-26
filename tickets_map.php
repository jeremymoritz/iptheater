<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once('_inc/ipt_1.php');

$title = "Order {$currentShow->getTitle()} Tickets Online!";

$js_content = "<script src='zOld/ipt_seat-map.js'></script>";

require_once('_inc/ipt_2.php');

$pageContent = "
	<section class='ko'>
		<h4>Step 2: Choose Your Seats...</h4>
		<h2>Goppert Theatre Seating Chart</h2>
		<section class='chart'>
			<img src='_img/goppert_900.png' alt='Goppert Theatre Seating Chart' id='goppert'>
		</section>
	</section>";
?>
<?=$header;?>
	<section class='main'>
		<div class='row'>
			<div class='col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2'>
				<h2><img src='_img/ip-logo-long_400_trans.png' alt='Immeasurable Productions' class='img-responsive inline-block'></h2>
				<h2><img src='_img/<?=$currentShow->getAbbrLower();?>-logo_250.png' alt='<?=$currentShow->getTitle();?>' id='<?=$currentShow->getAbbrLower();?>_logo'></h2>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-10 col-sm-offset-1'>
				<?=$pageContent;?>
			</div>
		</div>
		<?=isset($ticketBoothLink) ? "<p><a href='" . addToQueryString($thisPage, 'ticketbooth') . "'><i class='fa fa-sm fa-ticket'></i></a></p>" : "";?>
	</section>
<?=$footer;?>

