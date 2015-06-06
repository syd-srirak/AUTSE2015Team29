<div class="search">
	<form method="get" class="search-form" id="search-form" action="<?php bloginfo( 'home' ); ?>/">
		<div>Search Field:
			<select name="search-field">
				<option value="paper_name">Paper Name</option>
				<option value="paper_id">Extreme Programming</option>
				<option value="Kanban">KANBAN</option>
				<option value="Pair">Pair Programming</option>
				<option value="Scrum">SCRUM</option>
				<option value="Test">Test-driven Development</option>
				<option value="Waterfall">Waterfall Model</option>
		</select></div>
		<div>Search Query:
			<select name="search-query">
				<option value="LIKE">LIKE</option>
				<option value="=">EQUAL TO</option>
				<option value="!=">NOT EQUAL TO</option>
				<option value="<">LESS THAN</option>
				<option value="<=">LESS THAN OR EQUAL TO</option>
				<option value=">">MORE THAN</option>
				<option value=">=">MORE THAN OR EQUAL TO</option>
				<option value="BETWEEN">BETWEEN (X-Y)</option>
		</select></div>
		<div>Search Value:
		<input class="search-text" type="text" name="s" id="search-text" value="Search..." /></div>
		<div>Save Query?:
			<select name="save-query">
				<option value="yes">YES</option>
				<option value="no">NO</option>
		</select></div>
	</form>
</div>