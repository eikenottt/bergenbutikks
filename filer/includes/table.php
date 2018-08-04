<?php

$where = "";
$orderby = "s.store_name";
$sorting = "ASC";
$newsorting = "DESC";

if(isset($_GET['orderby'])) {
    $orderby = $_GET['orderby'];
}

if(isset($_GET['sorting'])) {
    $sorting = $_GET['sorting'];
    $newsorting = ($sorting == "ASC") ? "DESC" : "ASC";
}

?>


<table id="butikkCollection">
    <caption>Søkeresultat</caption>
    <colgroup>
        <col class="col">
        <col class="col">
        <col class="col">
        <col class="col">
        <col class="col">
    </colgroup>
    <thead class="store_container">
        <tr class="store_row">
            <?php
            $URL = removeAndReturnOne(getAddress(), ["orderby", "sorting"]);
            $storesort = "<a href=\"{$URL}&orderby=s.store_name&sorting=$newsorting\">Butikknavn</a>";
            $mallsort = "<a href=\"{$URL}&orderby=m.mall_name&sorting=$newsorting\">Storsenter</a>";
            $floorsort = "<a href=\"{$URL}&orderby=s.floor&sorting=$newsorting\">Etasje</a>";
            ?>
            <th class="store_cell logo">Logo</th>
            <th class="store_cell"><?php echo $storesort ?></th>
            <th class="store_cell"><?php echo $mallsort ?></th>
            <th class="store_cell">Telefonnummer</th>
            <th class="store_cell"><?php echo $floorsort ?></th>
        </tr>
    </thead>
    <tbody class="store_container">
    <?php
    $amount = 25;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else {
        $page = 1;
    }
    $offset = ($page-1) * $amount;

    $sql = "SELECT SQL_CALC_FOUND_ROWS s.*, m.mall_name FROM stores s, malls m, addresses a, categories c, category_store_link csl
                WHERE (CONCAT(s.store_name, a.city, m.mall_name,s.phone,a.street, a.zip) LIKE '%$finn%'
            ".search_categories($filterArray).") 
            AND s.mall = m.id AND m.address = a.id AND s.store_id = csl.store_id AND c.category_id = csl.category_id
            GROUP BY s.store_id
            ORDER BY $orderby $sorting
            LIMIT $offset, $amount";
    $result = $conn->query($sql);
    if (!$result) {
        echo "<tr class='not_found'><td>Fant ingen butikker</td></tr>";
    } else {
        $num_rows =$result->num_rows;
        if ($num_rows > 0) {
            $total_pages_sql =
                "SELECT FOUND_ROWS() as rows";
            $pages_result = $conn->query($total_pages_sql);
            $total_rows = $pages_result->fetch_assoc()['rows'];
            $total_pages = ceil(intval($total_rows) / $amount);

            $num_results = "Søket ditt gav ".$num_rows." resultat";
            while ($row = $result->fetch_assoc()) {
                $erstatt = array(" ", "æ", "ø", "å");
                $store_chain = $conn->real_escape_string($row['store_name']);
                $kjedesub = strtolower(str_replace($erstatt, '', $store_chain));
                $href = "https://dikult205.k.uib.no/1FW17/assignment8/store/".$row['store_id'];
                ?>

                    <tr class="store_row">

                        <td class="store_cell logo">
                            <a href="<?php echo $href; ?>">
                                <object data="../img/logo/<?php echo $kjedesub ?>.png" type="image/png">
                                    <img src="../img/default_cart.svg" alt="<?php echo $kjedesub ?>">
                                </object>
                            </a>
                        </td>
                        <td class="store_name store_cell">
                            <a href="<?php echo $href; ?>">
                                <?php echo $row["store_name"]; ?>
                            </a>
                        </td>
                        <!-- Lukker butikknavn og kjede -->
                        <td class="mall store_cell">
                            <a href="<?php echo $href; ?>">
                                <?php echo $row["mall_name"]; ?>
                            </a>
                        </td>
                        <!-- Lukker storsenter -->
                        <td contenteditable="<?php echo ($admin) ? "true" : "false"; ?>"
                            onblur="saveToDatabase(this,'phone','<?php echo $row["store_id"]; ?>')"
                            onclick="showEdit(this);" class="phone store_cell">
                            <a href="tel:<?php echo str_replace(' ', '', $row['phone']); ?>">
                                <?php echo $row["phone"]; ?>
                            </a>
                        </td>
                        <!-- Lukker telefonnr -->
                        <td contenteditable="<?php echo ($admin) ? "true" : "false"; ?>"
                            onblur="saveToDatabase(this,'floor','<?php echo $row["store_id"]; ?>')"
                            onclick="showEdit(this);" class="floor store_cell">
                            <a href="<?php echo $href; ?>">
                                <?php echo $row["floor"]; ?>
                            </a>
                        </td>
                        <!-- Lukker adresse -->

                    </tr>


                <?php
            }

        } else {
            echo "<tr class='not_found'><td colspan='5'>Søket gav ingen resultat, prøv noe annet.</td></tr>";

        }
    }
    ?>
    </tbody> <!-- Lukker butikkContainer -->
</table> <!-- Lukker butikkCollection -->
<?php
if($total_pages > 0) {
    $new_href = removeAndReturnOne(getAddress(), ["page"]);
    echo "<ul class='pagination'>";
    if (intval($page) !== 1) {
        echo "<li><a href='$new_href&page=1' title='Første side'><<</a></li>";
        $prev = $page - 1;
        echo "<li><a href='$new_href&page=$prev' title='Forrige side'><</a>";
    }
    echo "<li><a class='selected' href='$new_href&page=$page' title='Side $page'>$page</a></li>";

    if (intval($page) !== intval($total_pages)) {
        $next = $page + 1;
        echo "<li><a href='$new_href&page=$next' title='Neste side'>></a>";
        echo "<li><a href='$new_href&page=$total_pages' title='Siste side'>>></a></li>";
    }
    echo "</ul>";
}