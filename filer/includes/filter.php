<?php
if (MAGIC != "asdf1234"){
    die ("Can't read file directly. ");
}
?>

<section id="filter">
    <label for="filters" id="hide_filters" class="filter-label">Skjul filter</label>
    <?php
    $new_href = removeAndReturnOne(getAddress(), ["page"]);
    $selected_filters = selected_filters($filterArray);
    if (count($selected_filters) > 0) {
        ?>
        <article class="show_filter">
            <h4 class="heading">Valgte filter</h4>
            <nav>
                <?php
                get_filters($selected_filters);
                ?>
            </nav>
        </article>
        <?php
    }

    ?>
    <input type="checkbox" id="filter-area" class="hidden" checked>
    <article >

        <?php
        $filterQuery = "SELECT COUNT(DISTINCT s.store_id) as amount, a.city FROM stores s, malls m, addresses a, categories c, category_store_link csl
                                                WHERE (CONCAT(s.store_name, a.city, m.mall_name,s.phone,a.street, a.zip) LIKE '%$finn%' 
                                                  ".search_categories($filterArray).") AND a.city NOT IN 
                                                    (SELECT city FROM addresses WHERE city ='".$selected_filters['city']."') 
                                                  AND m.address = a.id AND s.mall = m.id AND s.store_id = csl.store_id AND c.category_id = csl.category_id
		                                        GROUP BY a.city ORDER BY amount DESC";
        $result = $conn->query($filterQuery);
        if($result->num_rows > 0) {
            echo '<label for="filter-area"><span class="heading">Områder</span></label>';
        }
        echo '<nav>';
        while ($row = $result->fetch_assoc()) {
            $area = $row['city'];
            echo '<a href="' . $new_href . "&city%5B%5D=" . $area . '">' . $area . '<span>'.$row['amount'].'</span></a>';
        } ?>
        </nav>
    </article>
    <input type="checkbox" id="filter-mall" class="hidden" checked>
    <article>

        <?php
        $filterQuery = "SELECT COUNT(DISTINCT s.store_id) as amount, m.mall_name
                                              FROM stores s, malls m, addresses a, categories c, category_store_link csl
                                                WHERE (CONCAT(s.store_name, a.city, m.mall_name,s.phone,a.street, a.zip) LIKE '%$finn%' 
                                                ".search_categories($filterArray).") AND 
                                                m.mall_name NOT IN 
                                                (SELECT mall_name FROM malls
                                                  WHERE mall_name = '".$selected_filters['mall_name']."')
                                                  AND m.id = s.mall AND m.address = a.id AND s.store_id = csl.store_id AND c.category_id = csl.category_id
                                              GROUP BY m.id ORDER BY amount DESC";
        $result = $conn->query($filterQuery);
        if($result->num_rows > 0) {
            echo '<label for="filter-mall"><span class="heading">Storsenter</span></label>';
        }
        echo '<nav>';
        while ($row = $result->fetch_assoc()) {
            $mall = $row['mall_name'];
            echo '<a href="' . $new_href . "&mall_name%5B%5D=" . str_replace(' ', '+', $mall) . '">' . $mall .'<span>'.$row['amount']. '</span></a>';
        } ?>
        </nav>
    </article>
    <input type="checkbox" id="filter-category" class="hidden" checked>
    <article>
        <?php
        $filterQuery = "SELECT COUNT(DISTINCT s.store_id) as amount, c.category_id, c.category_name 
                                              FROM stores s, categories c, malls m, addresses a, category_store_link csl
                                                WHERE (CONCAT(s.store_name, a.city, m.mall_name,s.phone,a.street, a.zip) LIKE '%$finn%' 
                                              ".search_categories($filterArray).")
                                              AND c.category_name NOT IN 
                                                (SELECT c.category_name FROM categories c
                                                WHERE c.category_id='".$selected_filters['category_id']."') 
                                                AND csl.category_id = c.category_id AND csl.store_id = s.store_id AND s.mall = m.id
                                              GROUP BY c.category_name ORDER BY amount DESC";
        $result = $conn->query($filterQuery);
        if($result->num_rows > 0) {
            echo '<label for="filter-category"><span class="heading">Kategori</span></label>';
        }
        echo '<nav>';
        while ($row = $result->fetch_assoc()) {
            $category = $row['category_id'];
            echo '<a href="' . $new_href . "&category_id%5B%5D=" . $category . '">' . $row['category_name'] . "<span>".$row['amount'].'</span></a>';
        } ?>
        </nav>
    </article>
    <input type="checkbox" id="filter-chain" class="hidden" checked>
    <!--<article id="chain_filter">

                        <?php
    /*                            $filterQuery = "SELECT COUNT(*) as amount, store_chain
                                                  FROM stores s, categories c, malls m, addresses a, category_store_link csl
                                                    WHERE (CONCAT(s.store_name, a.city, m.mall_name,s.phone,a.street, a.zip) LIKE '%$finn%'
                                                    ".search_categories($filterArray).") AND store_chain NOT IN
                                                    (SELECT store_chain FROM stores
                                                    WHERE store_chain='".$selected_filters['store_chains']."')
                                                  GROUP BY store_chain ORDER BY amount DESC";
                                $result = $conn->query($filterQuery);
                                if($result->num_rows > 0) {
                                    echo '<label for="filter-chain"><h4 class="heading">Kjede</h4></label>';
                                }
                                if($result->num_rows > 6) {

                                echo '
                                    <input type="checkbox" id="chain" class="hidden">
                                    <label class="show_more" for="chain">Vis Mer</label>
                                    ';

                                }
                                echo '<nav class="filter-section">';
                                while ($row = $result->fetch_assoc()) {
                                    $store_chain = str_replace("&","%26",$row['store_chain']);
                                    echo '<a href="' . getAddress() . "store_chains[]=" . $store_chain . '&">' . $row['store_chain'] . "<span>".$row['amount'].'</a>';
                                } */?>
                        </nav>
                    </article>-->
</section>