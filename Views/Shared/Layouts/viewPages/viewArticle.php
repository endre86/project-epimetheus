<script type="text/javascript" src="js/viewArticle.js"></script>
<script type="text/javascript" src="../js/jquery.autocomplete-min.js"></script>
<section id="article" class="vcard">
<span class="h" id="editLinks"></span>
<h2 id="title"></h2>
<p><span id="addedBy"></span> | <span id="dateAdded"></span> | <span id="url"></span></p>
<h3>Kategorier</h3>
	<p id="category" class="tags"></p>
	<nav id="addInterviewCategory" class="tags" placeholder="Kategori">
	<input type="text" id="newCategory" size="21" placeholder="Kategori" />
	<button type="button" id="addNewCategoryButton"><span class="pluss">Legg til!</span></button>
	</nav>
</section>

<section id="resultat">
<h3>Intervjuobjekter som er knyttet til denne artikkelen:</h3>
<table id="interviewObjectTable">
<thead>
	<tr class="tablehead">
		<th class="tittel">Navn</th>
		<th width="50">Poeng</th>
		<th>Kommentar</th>
	</tr>
	</thead>
	<tbody id="interviewObjectTableBody">
	
	</tbody>
</table>
<p>
<h3>Legg til nytt intervjuobjekt</h3>
	<input type="text" id="query" placeholder="Navn" />
	<input id="score" class="athird" type="range" min="1" max="6" value="3" placeholder="1-6" step="1" onchange="showValue(this.value)" />
					<span id="range"><strong>3</strong></span>
					<script type="text/javascript">
					function showValue(newValue)
					{
						document.getElementById("range").innerHTML=newValue;
					}
					</script>
	<input type="text" id="comment" class="athird" placeholder="Kommentar" />
	<input type="hidden" id="resultBox" />
	<button type="button" id="addInterviewObjectButton"><span class="pluss">Legg til!</span></button></p>
</section> <!-- Slutt på #resultat -->
