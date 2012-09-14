<?php $HTMLHelper->addJS('libs/jquery.tablesorter.min.js'); ?>

<secion>
<h1>Alle brukere:</h1>

<?php if(isset($error)): ?>

<div class="warning">Kunne ikke finne noen brukere.</div>

<?php else: ?>
<table id="allUsers"><!-- TODO: Legg til tablesorter -->
	<thead>
		<tr>
			<th style="text-align: left;"><u>Epost</u> <img src="gfx/sort_icon.gif" /></th>
			<th style="text-align: left;"><u>Fornavn</u> <img src="gfx/sort_icon.gif" /></th>
			<th style="text-align: left;"><u>Etternavn</u> <img src="gfx/sort_icon.gif" /></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$count = 1;
		foreach($data as $user):
			$count++;
	?>
	
	<tr class="id<?= $count % 2 ?>">
		<td><?= $HTMLHelper->createLocalLink('Admin/ViewUser/' . $user['email'], $user['email']) ?></td>
		<td><?= $user['firstname'] ?></td>
		<td><?= $user['lastname'] ?></td>
		<td>
			<?= $HTMLHelper->createLocalLink('Admin/EditUser/' . $user['email'], 'Rediger') ?> 
			|
			<?= $HTMLHelper->createLocalLink('Admin/DeleteUser/' . $user['email'], 'Slett') ?>
		</td>
	</tr>

<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>
</secion>

<script tyle="text/javascript">
	$(function(){
		$('#allUsers').tablesorter({
			sortList: [[2,0], [1,0], [0,0]]
		});
	});
</script>