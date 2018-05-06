<!-- This is the page for searching in the entire database-->
<?php

// if you have a strange character in your table name, like a space, use ``
// b = butikker
// k = kategori
// tt = tea_types

// $butikkUniqueId = 'butikker.id';
// $kategoriUniqueId = 'kategori.id';
// $butikkKategori = 'butikker.kategoriID';

$query = "SELECT *, b.id AS bid FROM butikker b
          INNER JOIN kategori k ON b.kategoriID = k.id";

$searchtext = $_GET['finn'];

?>

<!-- CSS -->
<link href="../CSS/omraade.css" rel='stylesheet' type='text/css'>

<!-- SEARCH BOX -->
<section id="search">
    <form method="GET" action="">
        <label for="">Search: </label>
        <input type="text" name="finn" value="<?php echo $searchtext; ?>">
        <input type="submit" value="search" style="display: block;">
    </form>
</section>


<?php

// b = butikker
// k = kategori
//if a search is there, we apply the query to filter/find the results
//in order to search we need % - is a wildcard
if (!empty($searchtext)) {
    $query .= " WHERE b.aapningstider LIKE '%$searchtext%'
    OR b.adresse LIKE '%$searchtext%' 
    OR b.omraade LIKE '%$searchtext%' 
    OR b.storsenter LIKE '%$searchtext%' 
    OR b.butikknavn LIKE '%$searchtext%' 
    OR b.kjede LIKE '%$searchtext%' 
    OR b.nettside LIKE '%$searchtext%'
    OR k.kategori LIKE '%$searchtext%'
    ORDER BY b.butikknavn";
}
$result = $con->query($query);

//ANOTHER EXAMPLE FOR SEARCHING


// applies to the where a user can search for a shop
// if there exists text in the search box
// we get that information and store it in the link &search=
// if not in use, empty string
$searchBoxParameter = "";
if (isset($_POST['searchBox']) && !empty($_POST['searchBox'])) {
    $searchBoxParameter = "&search=" . $_POST['searchBox'];
} elseif (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchBoxParameter = "&search=" . $_GET['search'];
}

//ORIGINALLY ALL TEAS
//FIND WHERE H2 is originally in TEA.php project
if ($page == "search") {
    echo "<h2>ALL SHOPS</h2>";
}

// if the query does not go through, we cannot retrieve teas
if (!$result) {
    echo "<p class='errormessage'>Could not retrieve shops from the directory</p>";
} // if the query goes through but we dont find any shops display $messageNoShops
elseif ($result->num_rows == 0) {
    echo "We could not find any shops.";
} else {
    ?>

    <section id="butikkCollection" style="padding-left: 10px">
        <?php
        while ($row = $result->fetch_assoc()) {
            if ($result->num_rows > 0) {
                $erstatt = array(" ", "æ", "ø", "å");
                $kjedesub = strtolower(str_replace($erstatt, '', $row['kjede']));
                ?>
                <section id="butikkContainer" class="card">
                    <!-- index.php?page=kategorier -->
                    <a href="<?php echo './index.php?page=butikk&id=' . $row['bid']; ?>">

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

                    </a>
                </section> <!-- Lukker butikkContainer -->


            <?php
            } else {
                echo "0 results";
            }
        }
        ?>
    </section> <!-- Lukker butikkCollection -->
<?php
}
?>
