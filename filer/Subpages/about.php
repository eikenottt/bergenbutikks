<link href="CSS/about.css" rel='stylesheet' type='text/css'>

<?php
//custom function to display an error message
function died($error)
{
    echo "We are very sorry, but there were error(s) found with the form you submitted.";
    echo "These errors appear below.<br /><br />";
    echo $error . "<br /><br />";
    echo "Please go back and fix these errors.<br /><br />";
    die();
}

//check for if the user filled out the feedback form
if (isset($_POST['email'])) {

    $email_to = "burntoutmatch@me.com";
    $email_subject = "Feedback from: " . $_POST['name'];

    if (!isset($_POST['email']) || !isset($_POST['name'])  || !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $email_from = $_POST['email'];
    $name = $_POST['name'];
    $comments = $_POST['comments'];
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email_from)) {

        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';

    }

    if (empty($name)) {
        $error_message .= 'Vennligst skriver navn på nytt. Det oppstod en feil.<br />';
    }

    //if string is less than 2 characters
    if (strlen($comments) < 2) {
        $error_message .= 'Du må skriver mer informasjon.<br />';
    }

    //if $error_message is greater than none, we display ALL error messages that apply
    if (strlen($error_message) > 0) {
        died($error_message);
    }

    $email_message = "Email Address: " . $email_from . "\n";
    $email_message .= "Last Name: " . $name . "\n";
    $email_message .= "Comments: " . $comments . "\n";

    // create email headers
    $headers = 'From: ' . $email_from . "\r\n" .
        'Reply-To: ' . $email_from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($email_to, $email_subject, $email_message, $headers);

    echo "Your message has been sent. We appreciate the feedback and will respond to your inquiry shortly.";
}

?>

<h1>Om Oss</h1>
<section id="about">
    <section id="info">
        <p>
            Beskrivelse om hvem vi er osv osv....
        </p>
    </section>

</section>

<h1 id="formheader">Kontakt Oss</h1>
<section id="feedback">

    <h3>Vi tar gjerne imot din henvendelse.</h3>

    <form name="contactform" method="POST" action="./index.php?page=<?php echo $_GET['page'] ?>">

        <label for="name">Navn</label>
        <input type="text" name="name" maxlength="50" size="30">

        <label for="email">E-post</label>
        <input type="text" name="email" maxlength="50" size="30">

        <label for="comments">Comments or Feedback</label>
        <textarea name="comments" maxlength="1000" cols="25" rows="6"></textarea>

        <input id="submit" name="submit" type="submit" value="Submit">

    </form>
</section>

