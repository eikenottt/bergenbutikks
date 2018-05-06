<?php
// Her e ein kommentar
include('./connect.php');
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>bergenbutikker.no</title>

    <!-- <meta name="robots" content="noindex,nofollow"> -->
    <link href="CSS/reset.css" rel='stylesheet' type='text/css'>
    <link href="CSS/index.css" rel='stylesheet' type='text/css'>
    <link href="CSS/omraade.css" rel='stylesheet' type='text/css'>
    <link href="SCSS/test.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Raleway:200" rel="stylesheet">


    <!--[if lte IE 7]>
    <link href="CSS/ie.css" rel="stylesheet" type="text/css"/><![endif]-->
</head>

<body>
<section id="heading">
<div class="text">
    <svg>
        <defs>
            <mask id="mask" x="0" y="0" width="100%" height="100%">
                <!-- alpha rectangle -->
                <rect id="alpha" x="0" y="0" width="100%" height="100%"/>
                <!-- All text that you want -->
                <text id="title" x="50%" y="0" dy="1em">BERGENBUTIKKER.NO</text>
                <text id="subtitle" x="50%" y="0" dy="7em">Din Butikkoversikt på nett</text>
            </mask>
        </defs>
        <!-- Apply color here! -->
        <rect id="base" x="0" y="0" width="100%" height="100%"/>
    </svg>
    </div>

    <section class="intro"></section>
</section>
<nav>
    <ul>
        <li class=""><a href="./index.php">Hjem</a></li>
        <li class=""><a href="./index.php?page=search">Search</a></li>
        <li class=""><a href="./index.php?page=newsearch">NewSearch</a></li>

        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Kategorier</a>

            <div class="dropdown-content" id="myDropdown1">
                <a href="index.php?page=kategori&id=1">Elektronikk</a>
                <a href="index.php?page=kategori&id=2">Klær Sko Vesker</a>
                <a href="index.php?page=kategori&id=5">Hjem Hobby</a>
                <a href="index.php?page=kategori&id=6">Barn</a>
                <a href="index.php?page=kategori&id=7">Helse Velvære</a>
                <a href="index.php?page=kategori&id=9">Optikk</a>
                <a href="index.php?page=kategori&id=10">Sport Fritid</a>
                <a href="index.php?page=kategori&id=1">Smykke Ur Gull</a>
                <a href="./index.php?page=kategorier">Vis Alle</a>
            </div>
        </li>

        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Omraader</a>

            <div class="dropdown-content" id="myDropdown2">
                <a href="./index.php?page=omraade&id=1">Bergen Sentrum</a>
                <a href="./index.php?page=omraade&id=2">Fyllingsdalen</a>
                <a href="./index.php?page=omraader">Vis Alle</a>
            </div>
        </li>

        <li class=""><a href="./index.php?page=about">About</a></li>

    </ul>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    /* When the user clicks on the button,
     toggle between hiding and showing the dropdown content */
    jQuery(document).ready(function (e) {
    function t(t) {
        e(t).bind("click", function (t) {
            t.preventDefault();
            e(this).parent().fadeOut()
        })
    }
    e(".dropbtn").click(function () {
        var t = e(this).parents(".dropdown").children(".dropdown-content").is(":hidden");
        e(".dropdown .dropdown-content").hide();
        e(".dropdown .dropbtn").removeClass("show");
        if (t) {
            e(this).parents(".dropdown").children(".dropdown-content").toggle().parents(".dropdown").children(".dropbtn").addClass("show")
        }
    });
    e(document).bind("click", function (t) {
        var n = e(t.target);
        if (!n.parents().hasClass("dropdown")) e(".dropdown .dropdown-content").hide();
    });
    e(document).bind("click", function (t) {
        var n = e(t.target);
        if (!n.parents().hasClass("dropdown")) e(".dropdown .dropbtn").removeClass("show");
    })
});
</script>


<section id="main">
    <?php

    //this page is the template that we use
    // to control the url's on the website to look the same

    $page = "home";


    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    $pageFile = "./Subpages/" . $page . ".php";
    if (file_exists($pageFile)) {
        include($pageFile);
    } else {
        echo "Unknown location.";
    }
    ?>
</section>
</body>
<footer>
    <p>Skribenter:</p>
    <ul>
        <li>Rune</li>
        <li>Alexandra</li>
        <li>Anders</li>
    </ul>
</footer>
</html>
