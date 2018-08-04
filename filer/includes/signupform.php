<input type="checkbox" id="signup_float" class="hidden" name="signup">
<div class="signup">
    <label for="signup_float" class="whole_page level0"></label>
    <div class="float_middle">
        <label for='signup_float' class="button close">X</label>
        <div class="floating">
            <form class="form_input" method='post' accept-charset="UTF-8" >
                <fieldset>
                    <legend>Registrer Deg</legend>
                    <input name='signup_username' type="text" pattern=".{3,}" title="Brukernavnet må ha minimum 3 tegn" placeholder="Brukernavn" required>
                    <input name='signup_password' type="password" pattern=".{8,}" title="Passordet må ha minimum 8 tegn" placeholder="Passord" required>
                    <input name='confirm_password' type='password' pattern=".{8,}" placeholder='Bekrefte Passord' required>
                    <input name='email' type='email' placeholder='eksempel@eksempel.com' required>
                    <input class="button" name='signup_submit' type='submit' value='Registrer deg'>
                </fieldset>
            </form>
        </div>
    </div>
</div>