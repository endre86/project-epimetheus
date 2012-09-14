<form action="" method="post">
		<fieldset>
			<h4>Søk spesifikt i feltene</h4>
			<label>
				<span>Fornavn:</span>
				<input type="text" name="firstname"/>
			</label> 
			<label>
				<span>Etternavn:</span>
				<input type="text" name="lastname"/>
			</label> 
			<label>
				<span>Fagfelt:</span>
				<input type="text" name="specialization"/>
			</label>
			<label>
				<span>Stilling:</span>
				<input type="text" name="position"/>
			</label>
			<label>
				<span>Organisasjon:</span>
				<input type="text" name="organization"/>
			</label>
			<h4>Spesifiseringer</h4>
			<label>
				<span>Alle disse ordene:</span>
				<input type="text" name="allthewords"/>
			</label> 
			<label>
				<span>Et eller flere av disse ordene:</span>
				<input class="athird" type="text" name="orword"/>
				<input class="athird" type="text" name="orword"/>
				<input class="athird" type="text" name="orword"/>
			</label>
			<h4>Utelat dette ordet fra søkene</h4>
			<label>
				<span>Stoppord:</span>
				<input type="text" name="stopword"/>
			</label> 
			
			<label>
				<input type="submit" value="Søk"/>
			</label>
		</fieldset>
	</form>