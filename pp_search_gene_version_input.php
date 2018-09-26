<?php
	 // Connecting to database and retrival of all Versions.
	 include_once 'pp_database_data.php';
	$dbconn = pg_connect($connectionString)
	or die('Could not connect: ' . pg_last_error());
	$query='select distinct genome_version from "public"."gene" order by genome_version asc;';
	$versions_res=pg_query($query) or die('Cannot access list of genome versions: ' . pg_last_error());
?>

<input type="checkbox" id="chkGeneSearch">Search for a specific gene version</input>
<!-- Script to activate and deactivate combo box if checkbox is checked or unchecked. This code block includes the jquery file contained in js - this is a bit dirty because it may be included multiple times if other php files are doing the same. It's also possible to write this function in to a seperate javascript file - this would be less dirty but it's not possible to seperate this part of a form in a seperate php file in this case. -->
<script src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
$('#chkGeneSearch').change(function(){
	if($(this).is(":checked"))
		$('#selGeneVersion').prop('disabled',false);
	else
		$('#selGeneVersion').prop('disabled',true);
	});
</script>

<select id="selGeneVersion" disabled="true">
	<?php
		$versions=pg_fetch_all_columns($versions_res) or die("Invalid result after version-request:".pg_last_error());
		foreach($versions as $version)
		{
			echo "<option>" . $version . "</option>";
		}
	?>
	</select
	<?php
	// Closing connection
pg_close($dbconn);
?>