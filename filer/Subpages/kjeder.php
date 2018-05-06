<?php
$query = "SELECT DISTINCT kjede, id FROM butikker ORDER BY kjede ASC;";
$result = $con->query($query);
?>
<div id="omWrapper">
    <?php
    if (!$result) {
        echo "Nei vel";
    } else {
        while ($row = $result->fetch_assoc()) {
            ?>
        <a class="cardlink" href="<?php echo './index.php?page=butikk&id=' . $row['id']; ?>">
            <div class="card">
                <span><?php echo $row['kjede']; ?></span>
            </div>
            </a><?php
        }
    }
    ?>
</div>