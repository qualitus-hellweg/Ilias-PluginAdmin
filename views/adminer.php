<?php
if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
    die();
}
$baseUrl = dirname( $_SERVER[ 'PHP_SELF' ] );

$ini = Inireader::getInstance();
$dbName = $ini->getDbName();
$dbArray = $ini->getDbArray();
$host = $dbArray[ 0 ];
$user = $dbArray[ 1 ];
$pass = $dbArray[ 2 ];

echo '
  <form id="adminerform" action="' . $baseUrl . '/ilAdminer.php?username=' . $user . '" method="post" id="formular">
  <input type="hidden" name="auth[driver]" value="server">
  <input type="hidden" name="auth[server]" value="' . $host . '">
  <input type="hidden" name="auth[db]" value="' . $dbName . '">
  <input type="hidden" name="auth[username]" value="' . $user . '">
  <input type="hidden" name="auth[password]" value="' . $pass . '">
  <input type="hidden" name="auth[permanent]" value="1" checked=checked>
  <input type="submit" value="Autologin">
  </form>
<script type="text/javascript">
form = document.getElementById( "adminerform" );
form.submit();
</script>

';

// */