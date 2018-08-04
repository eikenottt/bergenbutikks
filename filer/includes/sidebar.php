<div class="browser-boundaries">
    <input type="checkbox" class="hidden" id="sidebar-float">
    <label for="sidebar-float" class="filter-label floating">Alternativer</label>
    <div id="sidebar">
        <label for="sidebar-float" class="button close">X</label>
        <?php
        $sql = "SELECT * FROM malls m, addresses a WHERE m.address = a.id Group by mall_name;";
        $result = $conn->query($sql);
        echo "<div>";
        while ($row = $result->fetch_assoc()) { ?>
            <div class="sidebar">
                <input type="checkbox" id="<?php echo str_replace(' ', '',$row['mall_name']) ?>info" class="hidden">
                <label for="<?php echo str_replace(' ', '',$row['mall_name']) ?>info" class="sidebar-label"><?php echo $row['mall_name']; ?></label>
                <div class="panel">
                    <p><?php echo str_replace("\n","<br>",$row['opening_hours']); ?></p>
                    <p><?php echo $row["street"]?></p>
                    <p><?php echo $row['zip']." ".$row['city']; ?></p>
                    <a class="link" href="<?php echo getLocation() . "/?mall_name%5B%5D=" . str_replace(' ', '+',$row['mall_name']); ?>">Vis butikkene</a>
                </div>
            </div>
        <?php }
        echo "</div>";
        if($loggedin) {
            echo "<div>";
            $username = $_COOKIE['username'];
            $query = "SELECT user_id FROM user_table WHERE username = '$username'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            ?>

            <div class="sidebar">
                <a href="<?php echo "../minside/".$row['user_id']; ?>">
                    Min side
                </a>
            </div>

            <?php
            if($admin) {
                echo "<div class='sidebar'><a href='../endrebutikker/'>Endre butikker</a></div>";
            }
            echo "</div>";
        }
        ?>
    </div>
</div>