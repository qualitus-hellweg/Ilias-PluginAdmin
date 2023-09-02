<?php
if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
    die();
}
?>
<h1>info</h1>

<?php
    $ini = Inireader::getInstance();

    echo '<h2>ilias: <a href="' . $ini->getIliasUrl() . '" target="_blank">' . $ini->getIliasName() . '</a></h2>';
        
    echo '<table id="overview">';
    echo '<tr><th>Name</th><th>Value</th></tr>';    
    echo '<tr><td>IliasDir</td><td>' . ILIAS_FS_PATH . '</td></tr>';    
    echo '<tr><td>DataDir</td><td>' . $ini->getDataDir() . '</td></tr>';    
    echo '<tr><td>LogDir</td><td>' . $ini->getLogDir() . '</td></tr>';    
    echo '<tr><td>ErrorDir</td><td>' . $ini->getErrorDir() . '</td></tr>';    
    
    echo '</table>';
    
//    $ini->printme();
   
?>













<hr />
<h1>HowTo</h1>
1) change webserver-users loginshell( from /usr/sbin/nologin ) to /bin/bash in <b>/etc/passwd</b> eg<br />
www-data:x:33:33:www-data:/var/www:<b>/bin/bash</b> <br />
2) copy these commands, enter password once(username: <b>deploy</b> )<br />
<textarea>
su www-data
cd
git config --global --add safe.directory "*"
git config --global credential.helper store
git clone https://gitlab.qualitus.de/iliasplugins/AdminOverviewLive
</textarea><br />
<textarea>
[ -d AdminOverviewLive ] && rm -rf AdminOverviewLive
exit
</textarea>
<br />
3) change webserver-users loginshell( from /bin/bash ) to /usr/sbin/nologin in <b>/etc/passwd</b> eg<br />
www-data:x:33:33:www-data:/var/www:<b>/usr/sbin/nologin</b> <br />
