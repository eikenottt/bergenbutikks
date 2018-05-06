<!DOCTYPE html>
<html>
<head>
	<title>Testsøk</title>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript">
		function searchq(){
			var searchTxt = $("input[name='søk']").val();

			$.post("søk.php", {searchVal: searchTxt}, function (output) {
					$('#output').html(output);
			});
		}
	</script>
</head>
<body>
<form action="testsøk.php" method="post">
	<input type="text" name="søk" placeholder="Søk da vel..." onkeydown="searchq();">
</form>

<div id="output"></div>

</body>
</html>