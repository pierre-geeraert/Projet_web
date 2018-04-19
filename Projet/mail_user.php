<?php
$to="pierre.geeraert@viacesi.fr";
$token="1fd534473a09b2e147ef375de54d47c09ab39aec";
//$message = 'Merci de copier le lien: http://127.0.0.1/validation_user.php/?token='.$token.'';
$message = '
     <!DOCTYPE html>
<body>
<a href=\"https://www.w3schools.com\">Visit W3Schools</a>
</body>
</html>
     ';

echo '
    <form name=mail id="mail" action="http://pi-ux-ce.alwaysdata.net/projet/mail.php" method="post">
        <input type="hidden" name="to" value="'.$to.'"/>
        <input type="hidden" name="subject" value="Validation compte BDE";/>
        <input type="hidden" name="message" value="'.$message.'"/>

    </form>
    <script language="JavaScript" type="text/JavaScript">document.mail.submit(); </SCRIPT>
    ';

?>
