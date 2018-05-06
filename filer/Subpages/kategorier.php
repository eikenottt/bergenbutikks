<?php
$query = "SELECT kategori, id FROM kategori;";
$result = $con->query($query);
?>
<div id="omWrapper">
    <?php
    if (!$result) {
        echo "Nei vel";
    } else {
        while ($row = $result->fetch_assoc()) {
            ?>
        <a class="cardlink" href="<?php echo './index.php?page=kategori&id=' . $row['id']; ?>">
            <div class="card">
                <span><?php echo $row['kategori']; ?></span>
            </div>
            </a><?php
        }
    }
    ?>
</div>