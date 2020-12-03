<?php
/* Change to "1" to enable debug mode */
define('_DEBUGMODE',0);
/* Specify the numeric ID of your website (instead of 12345) */
define('_USECHANNEL',12345);
/* Cache file path. Note that the script must have write access to the specified file. */
define('_CACHEFILE','./sitemap.xml');

if(_DEBUGMODE)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
else
    error_reporting(0);

header('Content-type:text/xml; charset=utf-8');

if(!file_exists(_CACHEFILE))
{
    $fc=fopen(_CACHEFILE,'a+');fclose($fc);
    chmod(_CACHEFILE,0777) or die( 'Error! Lets you set File Permissions on '._CACHEFILE );
}

if(!isset($_GET['f']))
{
    $querypath='/channels/'._USECHANNEL.'.xml';
    $mod=(filesize(_CACHEFILE) ? 'If-Modified-Since: '.gmdate('r',filemtime(_CACHEFILE))."\r\n" : null);
}
else
{
    $querypath='/temp/'.$_GET['f'];
    $mod=null;
}

$fp=fsockopen('www.mysitemapgenerator.com',80,$errno,$errstr,10)
    or die( file_get_contents(_CACHEFILE) );
    fputs($fp,'GET '.$querypath.' HTTP/1.0'."\r\n".
          'Host: www.mysitemapgenerator.com'."\r\n".$mod.
          'Connection: Close'."\r\n\r\n");    
    
    for($Buffer=Null;!feof($fp);)
    {
        $Buffer.=fgets($fp);
    }    
    fclose($fp);
    
if(!$Buffer || stristr($Buffer,'304 Not Modified'))
    die( file_get_contents(_CACHEFILE) );

$Buffer=trim(substr($Buffer,strpos($Buffer,"\r\n\r\n")));
/* The patch is only for special cases */
$Buffer=preg_replace(Array('/^[^<]+</','/>[^>]+$/'),Array('<','>'),$Buffer);
        
if(!$Buffer || (!stristr($Buffer,'urlset') && !($index=stristr($Buffer,'sitemapindex'))) || stristr($Buffer,'!--Error'))
    die( file_get_contents(_CACHEFILE) );
else
{
    if(isset($index) && $index)
        $Buffer=str_replace('http://www.mysitemapgenerator.com/temp/',((isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT']=='443') ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].str_replace(Array('\\','//'),Array('/','/'),pathinfo($_SERVER['REQUEST_URI'],PATHINFO_DIRNAME).pathinfo($_SERVER['REQUEST_URI'],PATHINFO_BASENAME)).'?f=',$Buffer);
    
    if(!isset($_GET['f']))
    {
        $fc=fopen(_CACHEFILE,'w');
        if(!flock($fc, LOCK_EX | LOCK_NB))
            {	header('HTTP/1.0 503 Service Temporarily Unavailable'); die();	}
    
            fwrite($fc,$Buffer);
            flock($fc, LOCK_UN);
            fclose($fc);
    }
    
    die( $Buffer );
}
?>