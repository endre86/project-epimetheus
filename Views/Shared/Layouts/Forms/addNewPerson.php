<section id="addperson">
<h2>Legg til nytt intervjuobjekt</h2>
		<fieldset>
			<label>
				<span>Fornavn:</span>
				<input type="text" name="firstname" id="firstname"/>
				<input type="hidden" name="personId" id="personId"/>
			</label>
			<label>
				<span>Etternavn:</span>
				<input type="text" name="lastname" id="lastname"/>
			</label> 
			<label>
				<span>Vil ikke kontaktes:</span>
				<input type="checkbox" id="isContactable"/>
			</label>
			<label>
				<span>Stilling:</span>
				<input type="text" name="position" id="postition"/>
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
				<span>Tilleggsinformasjon:</span>
				<textarea type="text" id="data" /></textarea>
			</label>
			<label>
				<button type="button" id="submitButton" value="submit" class="addUser"><span>Legg til intervju objekt</span></button>
			</label>
		</fieldset>
	
</section> <!-- Slutt på #addperson -->
