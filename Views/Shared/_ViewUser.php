<section id="personalia" class="vcard">
<h2 id="navn">
	<span class="given-name" id="firstName"><?= $firstname ?><span> 
	<span class="family-name" id="lastName"><?= $lastname ?></span>
</h2>
	
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
