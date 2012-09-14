<script type="text/javascript" src="js/viewUser.js"></script>
<section id="personalia" class="vcard">
<span class="h" id="editLinks"></span>
<h2 id="navn">
	<span class="given-name" id="firstName"><span> 
	<span class="family-name" id="lastName"></span>
</h2>
	<p id="name">
		
	</p> 

<h3 id="organizationHeader">Organisasjon</h3>
	<p class="org" id="organization"></p>
	
<h3 id="organizationHeader">Brukernavn</h3>
	<p class="org" id="username"></p>

<h3 id="contact">Kontakt</h3>
	<p id="phone">
		
	</p><br />
	<p id="mail">
	</p>
	<nav id="addPersonEmail" class="tags" placeholder="Telefon / Epost">
	<label><input type="radio" name="phone_or_email" value="Phone" checked> Telefon</label>
	<label><input type="radio" name="phone_or_email" value="Email"> Epost</label><br />
	<input type="text" id="newContactSpecification" size="21" placeholder="Beskrivelse" />
	<input type="text" id="newContact" size="21" placeholder="Nummer / Epost" />
	<label><button type="button" id="addNewPersonEmailButton"><span class="pluss">Legg til</span></button></label>
	</navn>
	</fieldset>

<h3>Adresse</h3>
	<p class="adr" id="address">
		<span class="street-address" id="streetAddress"></span>, 
		<span class="postal-code" id="postNumber"></span>
		<span class="locality" id="city"></span> 
	</p>
</section> <!-- Slutt på #personalia -->

<section id="resultat">
<h3 id="interviewWith"></h3>
<table id="interviewTable">
<thead>
<tr class="tablehead" id="interviews">
	<th class="tittel">Tittel</th>
	<th>Dato</th>
	<th>Lenke</th>
</tr>
</thead>
<tbody id="interviewTableBody">
</tbody>
</table>
</section> <!-- Slutt på #resultat -->
