<?php
/**
 * ALLE BUTIKKENE
 * Created by PhpStorm.
 * User: akbobrow
 * Date: 13/11/16
 * Time: 14:40
 */

$query = "SELECT DISTINCT omraade FROM butikker;";
$result = $con->query($query);
?>
<div id="omWrapper">
    <?php
    if (!$result) {
        echo "Nei vel";
    } else {
        $omraadeId = 0;
        while ($row = $result->fetch_assoc()) {
            $omraade = $row['omraade'];
            $omraadeId = $omraadeId + 1;?>
        <a class="cardlink" href="<?php echo './index.php?page=omraade&id=' . $omraadeId; ?>">
            <div class="card" style="background-image: url(../img/omraader/<?php echo $omraadeId ?>.jpg);">
                <span class="omraadeNavn"><?php echo $row['omraade']; ?></span>
            </div>
            </a><?php
        }
    }
    ?>
</div>