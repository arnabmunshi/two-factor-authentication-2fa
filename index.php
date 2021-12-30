<?php
include 'vendor/autoload.php';

use PragmaRX\Google2FA\Google2FA;

$google2fa = new Google2FA();

if (isset($_POST['submit'])) {
  $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();

  if ($g->checkCode($_POST['secret'], $_POST['code'])) {
    echo "YES";
  } else {
    echo "NO";
  }
}

$secretKey = $google2fa->generateSecretKey();

$qr_code_img = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate('user_name', $secretKey, 'APP_NAME');
?>

<div>
  <img src="<?=$qr_code_img?>" />
</div>

<div>
  <form method="post">
    <input type="text" name="secret" value="<?=$secretKey?>" />
    <input type="text" name="code" />
    <button type="submit" name="submit">Submit</button>
  </form>
</div>
