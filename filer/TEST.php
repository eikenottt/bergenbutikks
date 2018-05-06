<?php
// Her e ein kommentar
include('./connect.php');
session_start();

if(!empty($_GET['finn'])){
    $finn = $_GET['finn'];
}
else {
    $finn = "";
}
?>

<form method="get" action="">
<label for="">Search: </label>
<input type="text" name="finn"
       placeholder="search here" value="<?php if(isset($_GET['finn'])) { echo $finn; }?>">
<input type="submit" name = "submit" value="Search">
</form>

<?php


$sql = "SELECT * FROM butikker b 
WHERE b.butikknavn LIKE '%$finn%' 
OR b.omraade LIKE '%$finn%'
OR b.storsenter LIKE '%$finn%'
OR b.kjede LIKE '%$finn%'
OR b.telefonnr LIKE '%$finn%'
OR b.adresse LIKE '%$finn%'";
$result = $con->query($sql);

echo $finn;


?>

    <section id="butikkCollection" style="padding-left: 10px">
        <?php
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
        }
        ?>
    </section> <!-- Lukker butikkCollection -->
