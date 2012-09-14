<section id="addinterview">	
<h2 id="addInterviewHeading">Legg til ny artikkel</h2>	
	<form action="#" method="post" id="addInterviewForm">
		<fieldset>
			<input type="hidden" name="articleId"/>
			<input type="hidden" name="user" value="<?php echo $_SESSION['personId']; ?>" />
			<label>
				<span>Tittel</span>
				<input type="text" name="title"/>
			</label>
			<label>
				<span>Media:</span>
				<select id="media">
				   <option value="multimedia">Multimedia</option>
				   <option value="tekst">Tekst</option>
				   <option value="video">Video</option>
				   <option value="lyd">Lyd</option>
				</select>
			</label>
			<label>
				<span>Kategori:</span>
				<input type="text" name="category"/>
				<small>(Separer flere med komma)</small>
			</label>
			<label>
				<span>Lenke:</span>
				<input type="text" name="url"/>
			</label>
			<label>
				<span>Dato (ÅÅÅÅ-MM-DD):</span> 
				<input type="date" name="date"/>
			</label>

			<label>
				<button type="button" id="submitButton" value="submit" class="submitBtn"><span>Legg til artikkel</span></button>
			</label>
		<fieldset>
	</form>
</section>
