<section id="sokeboks">
		<div id="searchForm" method="post" action="">
			<fieldset>
				<nav><label><input type="radio" name="searchOption" value="searchGeneral" checked/> Generelt</label> |
				<label><input type="radio" name="searchOption" value="searchObjectExpertise"/> Ekspertiser 
					<select id="expertiseSpecificationSelector">
						<option value="null">Uspesifisert</option>
					</select>
				</label> |
				<label><input type="radio" name="searchOption" value="searchPersonName"/> Navn</label> |
				<label><input type="radio" name="searchOption" value="searchObjectOcupation"/> Jobb</label> |
				<label><input type="radio" name="searchOption" value="searchInterview"/> Intervjuer</label></nav>
				
				<input type="text" placeholder="Skriv inn navn, fagfelt eller organisasjon her..." id="sok" name="search"/>
				<button type="button" id="searchButton">SÃ¸k<span></span></button>
			</fieldset>
		</div>
</section>