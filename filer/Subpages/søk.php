<?php
	include("../connect.php");

	$output = '';
	if(isset($_POST['searchVal'])) {
		$søkq = $_POST['searchVal'];
		$søkq = preg_replace("#[^0-9a-z]#i", "", $søkq);

		$query = $con->query("SELECT * FROM butikker WHERE butikknavn LIKE '%$søkq%' OR omraade LIKE '%$søkq%'") or die();
		$count = mysqli_num_rows($query);
		if ($count == 0) {
			$output = "Va noko feil";
		}
		else {
			while ($row = $query->fetch_array()) {
				$butikknavn = $row['butikknavn'];
				$omraade = $row['omraade'];

				$output .= '<div> ' . $butikknavn . ' ' . $omraade . '</div>';
			}
		}
	}
echo $output;
?>