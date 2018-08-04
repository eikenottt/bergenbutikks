<?php
if (MAGIC != "asdf1234"){
    die ("Can't read file directly. ");
}
?>

<div class="loginform">

    <?php
    if ($loggedin) {
        echo "
                <form method=\"post\">
                    <fieldset>
                        <input class='button logout' name=\"logout\" type=\"submit\" value=\"Logout\">
                    </fieldset>
                </form>";

        $username = $_COOKIE['username'];

        $level = $admin ? '[ADMIN]' : "";

        $loginmsg = "Velkommen $username $level";
        $loginclass = "message";
    } else {
        echo "
            <input id=\"loginbutton\" class='hidden' name=\"login\" type=\"checkbox\">
            <label for=\"loginbutton\" class='button'>Logg inn</label>
            <div class=\"login-content hidden\">
                <form class='form_input' method=\"post\">
                    <fieldset>
                        <legend id='legend'>Login</legend>
                        <input name=\"login_username\" type=\"text\" placeholder=\"Brukernavn\" required>
                        <input name=\"login_password\" type=\"password\" placeholder=\"Passord\" required>
                        <label for='forgotten_password' class='link'>Glemt passordet?</label>
                        <input class='button' name=\"login\" type=\"submit\" value=\"Login\" id='login'>
                        <span>eller</span>
                        <label for='signup_float' class='link'>Registrer deg</label>
                    </fieldset>
                </form>
            </div>";
        }
?>
</div>
<?php
        if(!$loggedin) {
        echo '

                <input type="checkbox" id="forgotten_password" class="hidden">
                <label for="forgotten_password" class="whole_page level3 hidden"></label>
                <div id="forgotten_password_form" class="hidden">
                    <label for="forgotten_password" class="button close">X</label>
                    <form method="post">
                        <fieldset>
                            <legend>Forgotten password</legend>
                            <input type="email" name="email" placeholder="epost@eksempel.no">
                            <input type="submit" name="forgotten_password" class="button" value="Send nytt passord">
                        </fieldset>
                    </form>
                </div>';
    }

