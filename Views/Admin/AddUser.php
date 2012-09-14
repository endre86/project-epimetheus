
<section id="addperson">
<?php if(isset($error)): ?>
    <div class="warning">Noe gikk galt og brukeren ble ikke lagt til.</div><br/>
<?php endif; ?>
<h2>Legg til ny bruker</h2>
<form id="addUser" method="post" action="<?php echo $GLOBALS['PAGE']['root_dir'] //TODO: Refactor out of view.. htaccess? ?>Admin/AddUser">
    <fieldset>
	    <label>
		    <span>Epost / Brukernavn:</span>
		    <input type="text" name="email" id="email"/>
		    <small id="usernameComment"></small>
	    </label>
	    <label>
		    <span>Passord:</span>
		    <input type="password" name="password" id="password"/>
		    <small id="passwordComment"></small>
	    </label>
	    <label>
		    <span>Tilgangsnivå*:</span>
		    <select id="accessLevel" name="accessLevel">
			<?php foreach(User::$accesslvls AS $key => $value): ?>
			<option name="accessLevel" id="accessLevel" value="<?= $value ?>"><?= $key . ' (' . $value . ')' ?></option>
			<?php endforeach; ?>
		    </select>
	    </label>
	    <label>
		    <span>Fornavn:</span>
		    <input type="text" name="firstname" id="firstname"/>
	    </label>
	    <label>
		    <span>Etternavn:</span>
		    <input type="text" name="lastname" id="lastname"/>
	    </label>
	    <label>
		    <span>Telefon:</span>
		    <input type="text" name="phone" id="phone"/>
	    </label>
	    <label>
		    <input type="submit" id="submitButton" value="submit" class="addUser"><span>Legg til bruker</span></button>
	    </label>
    </fieldset>
</form>
   
    <br />
    <p>
	* Tilgangsnivået som står inne i parantes er gjeldende. 
	<br />Alle tilganger er hierarkiske, mao får en tilgang til alle level 1 og 2 funksjoner hvis en har level 2 tilgang.
    </p>
	
</section> <!-- Slutt på #addperson -->

<?php $HTMLHelper->addJS('libs/jquery.validate.min.js'); ?>
<script type="text/javascript">
	$(function(){
		$('#addUser').validate({
			errorClass: 'invalid',
			rules: {
				'email': {
					required: true,
					email: true
				},
				'password': {
					required: true,
					minlength: 8
				},
				'firstname': {
					required: true
				},
				'lastname': {
					required: true
				},
				'phone': {
					required: true,
					minlength: 8
				}
			}				
		})
	})
</script>