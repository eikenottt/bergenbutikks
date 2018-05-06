<?php
include('./connect.php');
session_start();

if(!empty($_GET['finn'])){
			    $finn = $_GET['finn'];
			}
			else {
			    $finn = "";
			}

$filterArray = array("omraade", "storsenter", "kategori", "kjede");

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>bergenbutikker.no</title>

    <link href="CSS/reset.css" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="CSS/omraade.css">
    <link href="CSS/index.css" rel='stylesheet' type='text/css'>
    <link href="CSS/fremside.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Raleway:200" rel="stylesheet">
    <script type="text/javascript" src="js/sidebar.js"></script>

</head>

<body>
<header>
		<a href="bergen-1.php">
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
		        	}?>">
<input type="submit" name="submit" value="Søk" />
		<div class="box">
			<label class="heading">Områder</label>
			<select multiple name="omraade[]">
				<?php 
				$filterQuery = "SELECT * FROM butikker GROUP BY omraade;";
				$result = $con->query($filterQuery);
					while ($row = $result->fetch_assoc()) {
					echo '<option value="'.$row[$filter].'">'.$row[$filterArray[0]].'</option>';
				} ?>
			</select>
		</div>
		<div class="box">
			<label class="heading">Storsenter</label>
			<select multiple name="storsenter[]">
				<?php 
				$filterQuery = "SELECT * FROM butikker GROUP BY storsenter;";
				$result = $con->query($filterQuery);
					while ($row = $result->fetch_assoc()) {
					echo '<option value="'.$row[$filter].'">'.$row[$filterArray[1]].'</option>';
				} ?>
			</select>
		</div>
		<div class="box">
			<label class="heading">Kategori</label>
			<select multiple name="kategori[]">
				<?php 
				$filterQuery = "SELECT * FROM kategori GROUP BY kategori;";
				$result = $con->query($filterQuery);
					while ($row = $result->fetch_assoc()) {
					echo '<option value="'.$row[$filter].'">'.$row[$filterArray[2]].'</option>';
				} ?>
			</select>
		</div>
		<div class="box">
			<label class="heading">Kjede</label>
			<select multiple name="kjede[]">
				<?php 
				$filterQuery = "SELECT * FROM butikker GROUP BY kjede;";
				$result = $con->query($filterQuery);
					while ($row = $result->fetch_assoc()) {
					echo '<option value="'.$row[$filter].'">'.$row[$filterArray[3]].'</option>';
				} ?>
			</select>
		</div>
		    </form>		    
		</section>
		
		<section id="mellom">
			<?php
				if($_SERVER['REQUEST_URI']->contains("Galleri") !== False){
					echo '<img src="/img/Storsenter/m_logo.png">';
					$sql = "SELECT * FROM butikker WHERE storsenter = 'Galleriet' Group by storsenter;";
					$result = $con->query($sql);
					while ($row = $result->fetch_assoc()) { ?>
					<ul>
						  <p><?php echo $row['aapningstider']; ?></p>
						  <p><?php echo $row['adresse']; ?></p>
						  <a href="/bergen.php?finn=<?php echo $row['storsenter'] ?>&submit=Search#">Vis butikkene</a>
						<?php } ?>
					</ul>
					<?php
				}
				else if ($_SERVER['REQUEST_URI']->contains("Oasen") !== False){
					echo '<img src="/img/Storsenter/oasen-storsenter-logo-white.png">';
					$sql = "SELECT * FROM butikker WHERE storsenter LIKE 'Oasen%' Group by storsenter;";
					$result = $con->query($sql);
					while ($row = $result->fetch_assoc()) { ?>
					<ul>
						  <p><?php echo $row['aapningstider']; ?></p>
						  <p><?php echo $row['adresse']; ?></p>
						  <a href="/bergen.php?finn=<?php echo $row['storsenter'] ?>&submit=Search#">Vis butikkene</a>
						<?php } ?>
					</ul>
					<?php
				}
				?>
		</section>

		<section id="butikkCollection">
        <?php

			$sql = "SELECT * FROM butikker b 
			WHERE b.butikknavn LIKE '%$finn%' 
			OR b.omraade LIKE '%$finn%'
			OR b.storsenter LIKE '%$finn%'
			OR b.kjede LIKE '%$finn%'
			OR b.telefonnr LIKE '%$finn%'
			OR b.adresse LIKE '%$finn%'
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
                            <!-- Lukker telefonnr -->
                            <section id="adresse" class="bnavn">
                                <?php echo $row["adresse"]; ?>
                            </section>
                            <!-- Lukker adresse -->

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
			  <a href="/bergen.php?storsenter=<?php echo $row['storsenter'] ?>&submit=Search#">Vis butikkene</a>
			</div>
			<?php } ?>
		</ul>
	</section>
</section>
	<footer>
		
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