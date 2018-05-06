<!-- NOTES

H&M, Lindex
alle H&M og Lindex butikker

Galleriet, H&M, Lindex
alle H&M og Lindex butikker i kun galleriet

Oasen, Fyllingsdalen, Lindex, Galleriet

Beklager, men vi kunne ikke fullføre søket ditt eller vi fant ingen resultater.


While fetch assoc
{
if{ Søk = "H&M", "HM", "H M", "H og M", "Hennes & Mauritz", "Hennes og Mauritz"}
    $result = "H&M"
elseif{ Søk = "b.young", "b young"}
    $result = "b.young"
elseif{ Søk = "Herskap Tjenere", "Herskap og Tjenere", "Herskap", "Tjenere"}
    $result = "Herskap & Tjenere"
elseif{ Søk = "R.Juuhls Blomster", "R Juuhls Blomster", "Rikhard Juuhls Blomster"}
    $result = "R.Juuhls Blomster"
elseif{ Søk = "Dromedar", "Dromedar Kaffebar", "Kaffebar"}
    $result = "Dromedar"
elseif{ Søk = "bit", "bit union"}
    $result = "bit"
elseif{ Søk = "F.Lohne", "F Lohne", "F Lohne Gull", "F.Lohne Gull", "Lohne Gull"}
    $result = "F.Lohne"
elseif{ Søk = "Optikus MON", "optikus martin o. nielsen", "optikus martin o nielsen", "martin o. nielsen", "martin o nielsen"}
    $result = "Optikus MON"
elseif{ Søk = "Kitch´n", "Kitchn", "Kitch n", "Kitchen"}
    $result = "Kitch´n"
elseif{anything else}
    do this
}

-->
<?php
$searchtext = "";
if (isset($_GET['newsearch']) && !empty($_GET['newsearch'])) {
//urldecode - reverts unknown/special characters to regular characters
    $a = array(1, 2, array("a", "b", "c"));
    var_dump($a);
    var_dump($searchtext);
}
?>

<!-- SEARCH BOX -->
<section id="search">
    <form method="GET" action="./index.php?page=<?php echo $_REQUEST['page']; ?>">
        <label for="">Search: </label>
        <input type="text" name="newsearch" value="<?php echo $searchtext; ?>">
        <input type="submit" value="newsearch" style="display: block;">
    </form>
</section>
