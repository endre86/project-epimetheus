<section id="login">
<h3>Logg inn</h3>
		<?php if(isset($error)): ?>
			<div id="warning" class="error"><p>Brukernavn / passord kombinasjonen passer ikke overens.</p></div>
		<?php endif; ?>
	<form id="loginForm" action="<?php echo $GLOBALS['PAGE']['root_dir'] //TODO: Refactor out of view.. htaccess? ?>Home/Login" method="post">
		<fieldset>
			<label>
				<span>Brukernavn:</span>
				<input id="email" type="text" name="email" autofocus/>
			</label> 
			<label>
				<span>Passord:</span>
				<input id="password" type="password" name="password"/>
			</label>
			<label>
				<input id="submit" type="submit" value="Logg inn"/>
			</label>
			<label>
				<input type="checkbox" id="rememberme" name="rememberme" /> 
				Husk meg | <?php $HTMLHelper->createLocalLink('User/ForgottenPassword', 'Glemt passord?'); ?>
			</label>
		</fieldset>
	</form>
</section>

<label>
	TODO: Get this look:<br />
<input type="checkbox" id="rememberme_" name="rememberme_" /> 
				Husk meg | <?php $HTMLHelper->createLocalLink('User/ForgottenPassword', 'Glemt passord?'); ?>
</label>

<?php $HTMLHelper->addJS('libs/jquery.validate.min.js'); ?>
<script type="text/javascript">
	$(function(){
		$('#loginForm').validate({
			errorClass: 'invalid',
			rules: {
				'email': {
					required: true,
					email: true
				},
				'password': {
					required: true,
					minlength: 8
				}
			}				
		})
	})
</script>