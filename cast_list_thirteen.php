<?php	//	Immeasurable Productions Musicals (IPTheater.com)
require_once '_inc/ipt_1.php';

$currentShow = new Show(61, '13', 'thirteen');
// if(!apiGet('nr')) {	//	'nr' = "NO REDIRECT"
// 	header('Location: http://' . $_SERVER['HTTP_HOST'] . '/' . $currentShow->getAbbr());
// }

$title = '13 Cast List';
$body_class .= ' show_info';
require_once '_inc/ipt_2.php';
?>
<?=$header;?>
	<section class='main'>
		<div class='row'>
			<div class='col-xs-12'>
				<h2>
					<img src='/_img/ip-logo-long_400_trans.png' alt='Immeasurable Productions' class='img-responsive inline-block'>
					<br><img src='_img/<?=$currentShow->getAbbr();?>-logo_400.png' alt='<?=$currentShow->getTitle();?>' class='img-responsive inline-block top-buffer'>
				</h2>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-10 col-sm-offset-1'>
				<h2>13 CAST LIST</h2>
				<p>Let me tell you that this was EXTREMELY difficult to cast! There were so many wonderful auditions! This show is really going to be amazing! I know cast lists come with joy and sadness, but I promise you that this will be one amazingly fun and memorable week!</p>
				<p>I will be sending another email soon with the script as well as more information about 13. Please keep an eye out for my emails and make sure they aren't going to your spam folder! Please save my email address, <?=disguiseMailLink('mindy@iptheater.com');?>, to your contacts list as this is how I will do all communication for camp.</p>
				<p>I can't wait to get started on the journey of 13! Congratulations to everyone!  This will be a show to which you will want to invite everyone!</p>
				<p>~Mindy, Jenn, Nick, &amp; Elizabeth</p>
				<!-- <ul>
					<li>Mindy Moritz (Director/Choreographer) </li>
					<li>Jenn Harvey (Assistant Director)</li>
					<li>Nick Perry (Vocal/Tech Director)</li>
					<li>Elizabeth Brooks (Assistant Choreographer)</li>
				</ul> -->
				<table class='table'>
					<thead>
						<tr><th>Role</th><th>Week 1</th><th>Week 2</th></tr>
					</thead>
					<tbody>
						<tr class='boy'><th>Evan</th><td>Fisher Stewart</td><td>Caleb Ellis</td></tr>
						<tr><th>Patrice</th><td>McKenna Shaw</td><td>Madelyn Padget</td></tr>
						<tr class='boy'><th>Archie</th><td>Reece Melber</td><td>Josh Holloway</td></tr>
						<tr><th>Kendra</th><td>Lauren Chandler</td><td>Ava Hauser</td></tr>
						<tr class='boy'><th>Brett</th><td>A.J. Nauman</td><td>Jared Berlin</td></tr>
						<tr><th>Lucy</th><td>McKenna Harvey</td><td>Lucy Blake</td></tr>
						<tr class='boy'><th>Eddie</th><td>Jackson Tomlin</td><td>Sheridan Mirador</td></tr>
						<tr><th>Molly</th><td>Mia McManamy</td><td>Anna Synek</td></tr>
						<tr class='boy'><th>Malcolm</th><td>Max Pinson</td><td>Micah Davis</td></tr>
						<tr><th>Cassie</th><td>Laura Ascher</td><td>Quinn Cole</td></tr>
						<tr class='boy'><th>Richie</th><td>Dalton Petersohn</td><td>Jack Reeves</td></tr>
						<tr><th>Charlotte</th><td>Megan Secrest</td><td>McKenna Shaw</td></tr>
						<tr class='boy'><th>Simon</th><td>Cooper Schram</td><td>Connor Ampleman</td></tr>
						<tr class='boy'><th>Aiden</th><td>Tucker Brown</td><td>Calvin Beechner</td></tr>
						<tr class='boy'><th>Ethan</th><td>Gus Sippel</td><td>Jackson Tomlin</td></tr>
						<tr class='boy'><th>Frankie</th><td>Sam Wise</td><td>Weston Curnow</td></tr>
						<tr class='boy'><th>Johnny</th><td>Michael Moore</td><td>William Chapman</td></tr>
						<tr class='boy'><th>Justin</th><td>Nicolas Cross</td><td>Brandon Rider</td></tr>
						<tr class='boy'><th>Liam</th><td>Brandon Barksdale</td><td>Jacob Moyer</td></tr>
						<tr class='boy'><th>Lucas</th><td>Evan McNeley Phelps</td><td>Miguel Hunt</td></tr>
						<tr class='boy'><th>Mason</th><td>Philip Licata</td><td>Andrew Moritz</td></tr>
						<tr class='boy'><th>Noah</th><td>Gavin Hoedl</td><td>Tony Mauna</td></tr>
						<tr><th>Amy</th><td>Erin McNeley Phelps</td><td>Anna Schneider</td></tr>
						<tr><th>Audrey</th><td>Emma Smith </td><td>Shayleigh Lawson</td></tr>
						<tr><th>Brianna</th><td>Emerson Pereira</td><td>Alyssa Gaul</td></tr>
						<tr><th>Brittany</th><td>Elizabeth Ericson</td><td>Katie Kaminski</td></tr>
						<tr><th>Cara</th><td>Samantha Kopecky</td><td>Claire Severance</td></tr>
						<tr><th>Hope </th><td>Teresa Payne</td><td>Emma Johnson</td></tr>
						<tr><th>Isabelle</th><td>Olivia Tolleson</td><td>Hannah Strompoly</td></tr>
						<tr><th>Jade</th><td>Melinda Johns</td><td>Allison Myers</td></tr>
						<tr><th>Jasmine</th><td>Zoe London</td><td>Jamie Todd</td></tr>
						<tr><th>Katrina</th><td>Lisa Earlenbaugh</td><td>Alexa Morgan</td></tr>
						<tr><th>Kaylee</th><td>Keirstyn Mascereno</td><td>Margaret Ahearn</td></tr>
						<tr><th>Kelly</th><td>Megan McConnell</td><td>Halle Hedenskog</td></tr>
						<tr><th>Lacey</th><td>Merritt Parsons</td><td>Maren O'Hara</td></tr>
						<tr><th>Layla</th><td>Jenna Hultgren</td><td>Emma Mathieson</td></tr>
						<tr><th>Lizzie</th><td>Amanda Thomas</td><td>Carlee Cline</td></tr>
						<tr><th>Margot</th><td>Kyler Peterson</td><td>Faith Hart</td></tr>
						<tr><th>Millie</th><td>Amelia Benjamin</td><td>Lillie Large</td></tr>
						<tr><th>Natalie</th><td>Maddy Terrill</td><td>Elisa Gelapo</td></tr>
						<tr><th>Piper</th><td>Janie Carr</td><td>McKenzie Parks</td></tr>
						<tr><th>Regina</th><td>Shantha Burt</td><td>Maddie Munsey</td></tr>
						<tr><th>Riley</th><td>Laurie Hoedl</td><td>Grace LaSala</td></tr>
						<tr><th>Sarah </th><td>Maureen Pollock</td><td>Carlina Bogdon</td></tr>
						<tr><th>Scarlett</th><td>Chandler Steger</td><td>Kate Rivera</td></tr>
						<tr><th>Stacey</th><td>Lillie Large</td><td>Alyssa Bloom</td></tr>
						<tr><th>Stella</th><td>Margaret Jordahl</td><td>Parker Baughman</td></tr>
						<tr><th>Sydney</th><td>Gabbi Lumma</td><td>Rachel Adair</td></tr>
						<tr><th>Tanya</th><td>Abby Kiesling</td><td>Jenna Lee McCarty</td></tr>
						<tr><th>Violet</th><td>Mackenzie Werner</td><td>Paige Talken</td></tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>
<?=$footer;?>
