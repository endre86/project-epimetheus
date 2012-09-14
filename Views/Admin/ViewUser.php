<?php if(isset($error)): ?>
	<div id="warning" class="error"><p>Noe gikk gale og handlingen din ble ikke korrekt utført.</p></div>
<?php endif; ?>

<section id="personalia" class="vcard">
<h2 id="navn">
	<span class="given-name" id="firstName"><?= $firstname ?><span> 
	<span class="family-name" id="lastName"><?= $lastname ?></span>
</h2>
	
<p class="org">
	<?= $HTMLHelper->createLocalLink('Admin/EditUser/' . $email, 'Rediger bruker') ?>
	|
	<?= $HTMLHelper->createLocalLink('Admin/DeleteUser/' . $email, 'Slett bruker') ?>
</p>	

<h3>Epost</h3>
<p class="org"><?= $email ?></p>

<h3>Telefon</h3>
<p class="org"><?= $phone ?></p>

<h3>Aksesslevel: <?= $accessLevel ?></h3>
<lu>
    <?php foreach(User::$accesslvls as $key => $value):?>
	<?php if($value <= $accessLevel):?>
	    <li><?= $key ?></li>
	<?php endif; ?>
    <?php endforeach; ?>
</lu>

</section> <!-- Slutt på #resultat -->
