<section id="addperson">
<h2>Legg til ny bruker</h2>
		<fieldset>
			<label>
				<span>Epost / Brukernavn:</span>
				<input type="text" name="username" id="username"/>
				<small id="usernameComment"></small>
			</label>
			<label>
				<span>Passord:</span>
				<input type="password" name="password" id="password"/>
				<small id="passwordComment"></small>
			</label>
			<label>
				<span>Tilgangsnivå:</span>
				<select id="accessLevelSelector">
						<option value="1">Lesetilgang</option>
						<option value="2">Lese + skrivetilgang</option>
						<option value="3">Administrator</option>
						<option value="4">Super-administrator</option>
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
				<span>Organisasjon:</span>
				<select id="organizationSelector">
						
				</select>
			</label>
			<label>
				<span>Adresse (gate):</span>
				<input type="text" name="street" id="street"/>
			</label>
			<label>
				<span>Postnummer:</span>
				<input type="text" name="postnumber" id="postnumber"/>
			</label>
			<label>
				<span>Poststed:</span>
				<input type="text" name="city" id="city"/>
			</label>
			<label>
				<button type="button" id="submitButton" value="submit" class="addUser"><span>Legg til bruker</span></button>
			</label>
		</fieldset>
	
</section> <!-- Slutt på #addperson -->
