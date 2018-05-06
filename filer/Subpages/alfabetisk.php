<?php
$query = "SELECT * FROM butikker ORDER BY butikknavn ASC;";
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
                <span><?php echo $row['butikknavn']; ?></span>
            </div>
            </a><?php
        }
    }
    ?>
</div>