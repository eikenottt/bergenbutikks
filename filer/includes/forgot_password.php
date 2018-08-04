<?php
if (MAGIC != "asdf1234"){
    die ("Can't read file directly. ");
}

$email = $conn->real_escape_string($_POST['email']);

$query = "SELECT * FROM user_table WHERE email = '$email'";

$result = $conn->query($query);

if($result) {
    if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        $active = $row['active'];
        if($active) {
            $username = $row['username'];
            $userid = $row['user_id'];
            $random_password_string = randomstr();
            $update_query = "UPDATE user_table SET email_code = '$random_password_string' WHERE user_id = $userid";
            if($conn->query($update_query)) {
                $to = $email;
                $subject = "Tilbakestill ditt passord";
                $text = "Hei, $username. \n\nLeit å høre at du har glemt ditt passord.\nMen ikke fortvil, her er din gjenoppretningslenke:\nhttps://dikult205.k.uib.no/1FW17/assignment8/bergen/forgottenpassword/?email=".$email."&code=".$random_password_string."\n\nHa ein fortsatt fin dag.\n\nBergenButikke\nBergensveien 00\n5051 Bergen";
                $headers = array('From' => 'kundeservice@bergenbutikker.no', 'Reply-To' => 'rei008@uib.no', 'Content-type' => "text/plain;charset=UTF-8");
                if(mail($to, $subject, $text, $headers)) {
                    $loginmsg = "En epost er sendt til epostadressen du oppgav med instrukser på hvordan du kan endre passord";
                    $loginclass = "pass message";
                }
                else {
                    $loginmsg = "Eposten ble ikke sendt. Det skjedde noe uforutsett når vi sendte eposten. Vennligst prøv en gang til.";
                    $loginclass = "fail message";
                }
            }
            else {
                $loginmsg = "Vi opplever problemer med tilkoblingen til vår tjener for øyblikket. Vi jobber med saken, Vennligst prøv igjen om noen minutter.";
                $loginclass = "fail message";
            }
        }
        else {
            $loginmsg = "Du har ikke aktivert kontoen din. Du må først aktivere kontoen før du kan endre passordet. Se etter en epost fra 'kundeservice@bergenbutikker.no'.";
            $loginclass = "fail message";
        }
    }
    elseif ($result->num_rows > 1) {
        $loginmsg = "Det har skjedd en feil på vår tjener. Vi jobber med å rette den så snart som mulig. Vennligst prøv igjen om noen minutter";
        $loginclass = "fail message";
    }
    else {
        $loginmsg = "Den epostadressen er ikke registrert hos oss. Vennligst <a href='signupform.php'>registrer deg</a> først.";
        $loginclass = "fail message";
    }
}

