<?php
//ett omraade

$query = "SELECT DISTINCT omraade FROM butikker;";
$result = $con->query($query);
$omraade[] = 0;
if (!$result) {
    echo "NEI";
} else {
    while ($row = $result->fetch_assoc()) {
        $omraade[] = $row['omraade'];
    }
}

$num = "";
if (isset($_GET['id'])) {
    $num = $_GET['id'];
} else {
    echo "FEILMELDING";
}
?>

<?php

$sql = "SELECT * FROM butikker b WHERE omraade = '$omraade[$num]'";
$result = $con->query($sql);

if (!$result) {
    die("Fil ikke funnet");
} // kollonner: id, butikknavn, kjede, omraade, storsenter, etg, adresse, telefonnr, aapningstider, nettside, beskrivelse

else {
    while ($row = $result->fetch_assoc()) {
        $erstatt = array(" ", "æ", "ø", "å");
        $kjedesub = strtolower(str_replace($erstatt, '', $row['kjede']));
        ?>
        <a class="cardlink" href="<?php echo './index.php?page=butikk&id=' . $row['id']; ?>">
            <section class="card result">
                <span class="bnavn"><?php echo $row['butikknavn'] ?></span>
                <span class="logo"><img src="../img/logo/<?php echo $kjedesub ?>.png"></span>
                <span class="bnavn"><?php echo $row['storsenter'] ?></span>
                <span class="bnavn"><?php echo $row['telefonnr'] ?></span>
                </br>
                <span class="bnavn aapningstid"><?php echo $row['aapningstider'] ?></span>
            </section>
        </a>

    <?php
    }
}