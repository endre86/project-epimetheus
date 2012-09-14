<?php
	require_once 'Helpers/HTMLHelper.php';
	$HTMLHelper = new HTMLHelper();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Project Epimetheus</title>
		
		<script type="text/javascript" src="libs/jquery-1.7.2.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="styles/default_layout.css" />
		<link rel="stylesheet" type="text/css" href="styles/default_additional.css" />
		<link rel="profile" href="http://microformats.org/profile/hcard" />
		<link rel="shortcut icon" href="/favicon.ico" />
	</head>
	<body>
		<header>
			<figure>
				<a href="/"><img src="gfx/logo.png"/></a>
			</figure>
			<hgroup>
				<h1><span>Project</span>Epimetheus</h1>
				<h5>- Husker alt</h5>
			</hgroup>
			<nav>
				<ul>
					<li><?= $HTMLHelper->createLocalLink('Home', 'Fremsiden'); ?></li> | 
					
					<?php if(User::hasAccessTo('edit')): ?>
					<li><?= $HTMLHelper->createLocalLink('Article/Add', 'Registrer ny artikkel'); ?></li> | 
					<li><?= $HTMLHelper->createLocalLink('InterviewObject/Add', 'Registrer nytt intervjuobjekt'); ?></li> | 
					<?php endif;
					if(User::hasAccessTo('view')): ?>
					<li><?= $HTMLHelper->createLocalLink('InterviewObject/List', 'Alle intervjuobjekter'); ?></li> | 
					<li><?= $HTMLHelper->createLocalLink('InterviewObject/List/Outdated', 'Alle utdaterte intervjuobjekt'); ?></li> |
					<?php endif; ?>
					
					<li><?= $HTMLHelper->createLocalLink('About', 'Om'); ?></li>
					
                                        <?php if(User::hasAccessTo('admin')): ?>
					| <li><?= $HTMLHelper->createLocalLink('Admin', 'Admin') ?></li>
                                        <?php endif; ?>
				</ul>
			</nav>
			
			<section id="meta">
				<?php 
					if(isset($_SESSION['USER'])): ?>
					<p>
						Innlogget som: <?= $HTMLHelper->createLocalLink('User/View/' . $_SESSION['USER']->email, $_SESSION['USER']->getName()) ?>
						| <?= $HTMLHelper->createLocalLink('Home/Logout', 'Logg ut') ?>
				<?php endif;?>
			</section>
		</header>
		
		
		<section id="wrapper">
			<?php
				include $view;
			?>
		</section>
		
		<footer id="footer">
			<section class="footerboks">
				<h5>Nyttige tips</h5>
				<?= isset($page_hints) ? $page_hints : 'Lurer du på noe så kan du alltid sjekke ut Om siden.'; ?>
			</section>
			<section class="footerboks">
				<h5>Om skaperene</h5>
				<p>Project Epithemeus er laga av Odd-Arild Kristensen, Endre VestbÃ¸, Preben Madsen og Andreas H. Opsvik.</p>
			</section>
			<section class="footerboks">
				<h5>Om Project Epithemeus</h5>	
				<p>Project Epithemeus er eit ressursdatabase for medier som vil ha en lettere oversikt over
				intervjuobjekter. Det skal gjere det lettare Ã¥ halde oversikten og Ã¥ finne relevante intervjuobjekter.</p>
				<p>Project Epithemeus er no i versjon 1.0.</p>
			</section>
		</footer> <!-- End #footer -->

<?php $HTMLHelper->includeJS(); ?>
</body>
</html>