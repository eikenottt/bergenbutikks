<?php
// Her e ein kommentar
include('./connect.php');
session_start();

function strposa($haystack, $needle, $offset=0) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $query) {
        if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
    }
    return false;
}

function changeURI($senter){
	$senter = str_replace(" ", "+", $senter);
	$uri = "http://localhost:8888/bergen.php?finn=".$senter."&submit=S%C3%B8k#";
	header("Location: ".$uri);
}

if(!empty($_GET['finn'])){
	$hmReplace = array("hm", "h m", "h/m");
	$byReplace = array("b young", "b. young");
	$oasen = array("oasen", "oasen storsenter");
	if(strposa($_GET['finn'], $hmReplace)){
		$finn = str_replace($hmReplace, "h&m", $_GET['finn']);
	}
	else if(strposa($_GET['finn'], $byReplace)){
		$finn = str_replace($byReplace, "b.young", $_GET['finn']);
	}
	else if(strposa($_GET['finn'], $oasen)){
		changeURI('Oasen Senter');
	}
	else if(strposa($_GET['finn'], "galleriet")){
		changeURI('Galleriet');
	}
	else {
		$finn = $_GET['finn'];
	}
}
else {
    $finn = "";
}


function filter($input){
	if(isset($_GET[$input])){
		if(!empty($_GET[$input])){
			return $_GET[$input];
		}
	}
	else{
		return "";
	}
}

$filterArray = array("omraade", "storsenter", "kategori", "kjede");
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>bergenbutikker.no</title>

    <!-- <meta name="robots" content="noindex,nofollow"> -->
    <link href="CSS/reset.css" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="CSS/omraade.css">
    <link href="CSS/index.css" rel='stylesheet' type='text/css'>
    <link href="CSS/fremside.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Raleway:200" rel="stylesheet">
    <script type="text/javascript" src="js/sidebar.js"></script>


    <!--[if lte IE 7]>
    <link href="CSS/ie.css" rel="stylesheet" type="text/css"/><![endif]-->
</head>

<body>
<header>
		<a href="bergen.php">
			<h1>BERGENBUTIKKER.NO</h1>
		</a>
		<h3>DIN BUTIKKOVERSIKT PÅ NETT</h3>
	</header>
<section id="wrap">
	<section id="main">
		<section id="search">
		    <form method="GET" action="">
		        <label for=""></label>
		        <input type="text" name="finn" placeholder="Søk etter butikker, områder, storsentre mm" value="<?php if(!isset($_GET['finn'])) {
		        	echo "";
		        }
		        else {
		        	echo trim($_GET['finn']);
		        }

		        ?>">
<input type="submit" name="submit" value="Søk" />
		<div class="box">
			<label class="heading">Områder</label>
			<select multiple name="omraade">
				<?php 
				$filterQuery = "SELECT * FROM butikker GROUP BY omraade;";
				$result = $con->query($filterQuery);
					while ($row = $result->fetch_assoc()) {
					echo '<option value="'.$row['omraade'].'">'.$row[$filterArray[0]].'</option>';
				} ?>
			</select>
		</div>
		<div class="box">
			<label class="heading">Storsenter</label>
			<select multiple name="storsenter">
				<?php 
				$filterQuery = "SELECT * FROM butikker GROUP BY storsenter;";
				$result = $con->query($filterQuery);
					while ($row = $result->fetch_assoc()) {
					echo '<option value="'.$row['storsenter'].'">'.$row[$filterArray[1]].'</option>';
				} ?>
			</select>
		</div>
		<div class="box">
			<label class="heading">Kategori</label>
			<select multiple name="kategori">
				<?php 
				$filterQuery = "SELECT * FROM kategori GROUP BY kategori;";
				$result = $con->query($filterQuery);
					while ($row = $result->fetch_assoc()) {
					echo '<option value="'.$row['kategori'].'">'.$row[$filterArray[2]].'</option>';
				} ?>
			</select>
		</div>
		<div class="box">
			<label class="heading">Kjede</label>
			<select multiple name="kjede">
				<?php 
				$filterQuery = "SELECT * FROM butikker GROUP BY kjede;";
				$result = $con->query($filterQuery);
					while ($row = $result->fetch_assoc()) {
					echo '<option value="'.$row['kjede'].'">'.$row[$filterArray[3]].'</option>';
				} ?>
			</select>
		</div>
		    </form>		    
		</section>
		
		<section id="mellom">
			<?php
				if(strpos($_SERVER['REQUEST_URI'], "finn=Galleriet")){
					echo '<img src="/img/Storsenter/m_logo.png">';
					$sql = "SELECT * FROM butikker WHERE storsenter = 'Galleriet' Group by storsenter;";
					$result = $con->query($sql);
					while ($row = $result->fetch_assoc()) { ?>
					<ul>
						  <p><?php echo $row['aapningstider']; ?></p>
						  <p><?php echo $row['adresse']; ?></p>
						<?php } ?>
					</ul>
					<?php
				}
				else if (strpos($_SERVER['REQUEST_URI'], "finn=Oasen+Senter")){
					echo '<img src="/img/Storsenter/oasen-storsenter-logo-white.png">';
					$sql = "SELECT * FROM butikker WHERE storsenter LIKE 'Oasen%' Group by storsenter;";
					$result = $con->query($sql);
					while ($row = $result->fetch_assoc()) { ?>
					<ul>
						  <p><?php echo $row['aapningstider']; ?></p>
						  <p><?php echo $row['adresse']; ?></p>
						<?php } ?>
					</ul>
					<?php
				}
				?>
		</section>
		<!--<?php
		if(isset($_GET['submit'])){
		if(!empty($_GET['storsenter'])) {
		echo "<span>You have selected :</span><br/>";
		// As output of $_POST['Color'] is an array we have to use Foreach Loop to display individual value
		foreach ($_GET['storsenter'] as $select)
		{
		echo "<span><b>".$select."</b></span><br/>";
		}
		}
		else { echo "<span>Please Select Atleast One Value.</span><br/>";}
		}
		?>-->

		<section id="butikkCollection">
        <?php

        $omr = filter('omraade');
        $sto = filter('storsenter');
        $kat = filter('kategori');
        $kje = filter('kjede');

			$sql = "SELECT * FROM butikker b, kategori k 
			WHERE b.kategoriID = k.id AND (b.butikknavn LIKE '%$finn%' 
			OR b.omraade LIKE '%$finn%'
			OR b.storsenter LIKE '%$finn%'
			OR b.kjede LIKE '%$finn%'
			OR b.telefonnr LIKE '%$finn%'
			OR b.adresse LIKE '%$finn%'
			OR k.kategori LIKE '%$finn%')
			ORDER BY b.butikknavn ASC";
			$result = $con->query($sql);
        if(!$result){
            echo "NEI";
        }
        else {
            while ($row = $result->fetch_assoc()) {
                if ($result->num_rows > 0) {
                    $erstatt = array(" ", "æ", "ø", "å");
                    $kjedesub = strtolower(str_replace($erstatt, '', $row['kjede']));
                    ?>
                    <section id="butikkContainer" class="card">
                        <!-- index.php?page=kategorier -->
                        <div class="noko">

                        <span class="logo">
                            <img src="../img/logo/<?php echo $kjedesub ?>.png">
                        </span>
                            <section id="butikknavn" class="bnavn">
                                <?php echo $row["butikknavn"]; ?>
                            </section>
                            <!-- Lukker butikknavn og kjede -->
                            <section id="storsenter" class="bnavn">
                                <?php echo $row["storsenter"]; ?>
                            </section>
                            <!-- Lukker storsenter -->
                            <section id="telefonnr" class="bnavn">
                                <?php echo $row["telefonnr"]; ?>
                            </section>
                            <!-- Lukker storsenter -->
                            <section id="adresse" class="bnavn">
                                <?php echo $row["adresse"]; ?>
                            </section>
                            <!-- Lukker storsenter -->

                        </div>
                    </section> <!-- Lukker butikkContainer -->


                <?php
                } else {
                    echo "0 results";
                }
            }
        }
        ?>
    </section> <!-- Lukker butikkCollection -->

	</section>
	<section id="sidebar">
	<?php 
		$sql = "SELECT * FROM butikker Group by storsenter;";
		$result = $con->query($sql);
		while ($row = $result->fetch_assoc()) { ?>
		<ul>
			<button class="sidebar"><?php echo $row['storsenter']; ?></button>
			<div class="panel">
			  <p><?php echo $row['aapningstider']; ?></p>
			  <p><?php echo $row['adresse']; ?></p>
			  <a href="/bergen.php?finn=<?php
			  $noSpace = str_replace(' ', '+', $row['storsenter']);
			   echo $noSpace; ?>&submit=Søk#">Vis butikkene</a>
			</div>
			<?php } ?>
		</ul>
	</section>
</section>
	<footer>
		<section>
			<h2>Kontakt Oss:</h2>
			<a href="mailto:brukerstøtte@bergenbutikker.no">brukerstøtte@bergenbutikker.no</a>
		</section>
	</footer>
	<script type="text/javascript">
		var acc = document.getElementsByClassName("sidebar");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
  }
}
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="http://arrow.scrolltotop.com/arrow57.js"></script>
<noscript>Not seeing a <a href="http://www.scrolltotop.com/">Scroll to Top Button</a>? Go to our FAQ page for more info.</noscript>

</body>
</html>