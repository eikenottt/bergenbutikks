<!-- informasjon om hver enkelt butikk linkes fra search
$butikknavn = $con->real_escape_string($_GET['butikknavn']);
$sql = "SELECT butikknavn, kjede, storsenter FROM `butikker` WHERE butikknavn LIKE '%".$_GET['butikknavn']."%'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        //echo "Butikknavn: " . $row["butikknavn"]. " - Kjede: " . $row["kjede"]. " " . $row["storsenter"]. "<br>";
        ?>

        -->

<?php
//id, butikknavn, kjede, omrade, storsenter, etasje, addresse, tlf
//aapningstid, nettside, kategori, beskrivelse
// SELECT * FROM BUTIKKER WHERE ID = GET(ID)
?>
<!-- <link href="CSS/reset.css" rel='stylesheet' type='text/css'>
<link href="CSS/index.css" rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Raleway:200" rel="stylesheet"> -->
<link rel="stylesheet" type="text/css" href="CSS/butikk.css">
<section id="wrap" onload="initialize()">
<?php
//INNER JOIN kategori k ON b.kategoriID = k.id
$id = $_GET['id'];
$sql = "SELECT * FROM butikker b, kategori k WHERE b.id = $id AND b.kategoriID = k.id";
//$row['id']
$result = $con->query($sql);

//if(isset($_GET['id'])){
// $id =

if ($result) {
    $row = $result->fetch_assoc();
    $navn = $row['butikknavn'];
    $erstatt = array(" ", "æ", "ø", "å");
    $kjedesub = strtolower(str_replace($erstatt, '', $row['kjede']));

    ?>
    <img src="../img/logo/<?php echo $kjedesub ?>.png">
    <h1><?php echo $navn ?></h1>
    <section style="width: 80%;">
        <section id="nettside" class="bnavn">
            <?php echo $row["nettside"]; ?>
        </section>
        <section id="etg" class="bnavn">
            <?php echo $row["etg"]; ?> Etasje
        </section>
        <section id="tlf" class="bnavn">
            <?php echo $row["telefonnr"]; ?>
        </section>
        <section class="bnavn">
            <?php echo $row["kategori"]; ?>
        </section>
    </section>
    <p><?php echo $row['beskrivelse'] ?></p>
    <div id="map" style="margin-top: 50px;height: 300px; width: 100%;">Kart skal plasseres her</div>
<?php
} else {
    echo 'no results found';
} ?>
</section>
    <script>
   var geocoder;
      var map;
      var mapOptions = {
          zoom: 17,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
      var marker;
      function initialize() {
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        codeAddress();
      }
      function codeAddress() {
        var address = 'Bergen'
        geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            if(marker)
              marker.setMap(null);
            marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                draggable: true
            });
            google.maps.event.addListener(marker, "dragend", function() {
              document.getElementById('lat').value = marker.getPosition().lat();
              document.getElementById('lng').value = marker.getPosition().lng();
            });
            document.getElementById('lat').value = marker.getPosition().lat();
            document.getElementById('lng').value = marker.getPosition().lng();
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSkehEkPbSVeqPOVc4HDIa4_MabhINGXA&callback=initMap">
    </script>