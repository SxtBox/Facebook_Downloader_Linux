<?php

/*
  ┌────────────────────────────────────────────────────────────┐
  |  For More Modules Or Updates Stay Connected to Kodi dot AL |
  └────────────────────────────────────────────────────────────┘
  ┌─────────────┬──────────────────────────────────────────────┐
  │ Product     │ Facebook MP4 Video Extractor by Link         │
  │ Version     │ v1.1 PRO-DEV MODE                            │
  │ Provider    │ https://www.facebook.com                     │
  │ Support     │ MP4/Xtream Codes Panel                       │
  │ Licence     │ FREE                                         │
  │ Author      │ Olsion Bakiaj                                │
  │ Email       │ TRC4@USA.COM                                 │
  │ Author      │ Endrit Pano                                  │
  │ Email       │ INFO@ALBDROID.AL                             │
  │ Website     │ https://kodi.al                              │
  │ Facebook    │ /albdroid.official/                          │
  │ Created     │ Thursday, January 2, 2020                    │
  │ Required OS │ LINUX                                        │
  │ Tested on   │ Ubuntu 14.04                                 │
  │ Required    │ PHP 5-XXX - PHP 7-XXX                        │
  └────────────────────────────────────────────────────────────┘
*/

/*
- [NOTE]
- SCRIPTI ESHTE NE PUNE E SIPER PER OPSIONE TE TJERA ME TE AVANCUARA
- KY SCRIPT ESHTE FALAS PER TE GJITHE
- THIS SCRIPT IS FREE FOR ALL

- [INSTALL]

- [ALB]
- VENDOSE facebook.php NE /root/ HAP TERMINALIN EDHE SHKRUAJ => chmod 777 facebook.php OSE => chmod 777 /root/facebook.php
- SHARKIMI PER VIDEO NGA TERMINALI php facebook.php + ENTER EDHE VENDOS FULL VIDEO URL NGA FB
- PERSHEMBULL VIDEO https://www.facebook.com/albdroid.official/videos/181839896081939/
- VIDEOT RUHEN NE /var/www/html/Facebook
- PER TE NDERRUAR DESTINACININ SHKO TEK PJESA [GLOBAL DIR SETTINGS] EDHE NDERROJENI

- [ENG]
- PUT facebook.php IN /root/ OPEN TERMINAL AND TYPE => chmod 777 facebook.php OR => chmod 777 /root/facebook.php
- DOWNLOADER VIDEOS FROM TERMINAL facebook.php + ENTER AND INSERT FULL VIDEO URL FROM FB
- EXAMPLE VIDEO https://www.facebook.com/albdroid.official/videos/181839896081939/
- SAVING FOLDER /var/www/html/Facebook
- TO CHANGE DESTINATION GO TO [GLOBAL DIR SETTINGS] TAB AND CHANGE

*/
if(!$argc)
{
exit("<!doctype html>
<html>
<header>
<title>Facebook Video Downloader</title>
<link rel=\"shortcut icon\" href=\"https://kodi.al/panel.ico\"/>
<link rel=\"icon\" href=\"https://kodi.al/panel.ico\"/>
<b>
<center>
<font color=lime><h2>Facebook Video Downloader v1.1 PRO-DEV MODE</h2></b>
</center>
<center>
<font color=lime><b>[ALB] > </b><font color=red><b> Perdorni Kete Script Vetem nga <font color=lime><b>Terminali<font color=lime><b><b><br>
<font color=lime><b>[ENG] > </b><font color=red><b> You Can Only Run This Script From <font color=lime><b>Terminal<b><br>
</center>
<br/>
<b>
</font>
<body style='background-color:black'>
<b>
</font>
<br/>
<b>
<center>
&copy; <strong>TRC4</strong> <a href=\"http://kodi.al\" target=\"_blank\"><strong>kodi.al</strong></a>
<center/>
</font>
<br/>
<b>
<center>
<font color=lime>Source: https://kodi.al/</b>
</center>
</font>
<br/>
<b>
<center>
<font color=lime>FB:  <a href=\"https://www.facebook.com/albdroid.official\" target=\"_blank\">/albdroid.official/</b>
</center>
</font>
<br/>
<header/>
");
}

/*
  ┌─────────────────┐
  | ROOT Checker V1 |
  └─────────────────┘
*/

/*
$jam_root = trim(shell_exec("whoami"));
if (strcmp($jam_root, "root") !== 0) {
echo "\n  ┌───────────────────────────────────────────────┐ ";
echo "\n  | [ALB] > Duhet Ta Perdorni Kete Script si ROOT | ";
echo "\n  └───────────────────────────────────────────────┘ ";
echo "\n  ┌───────────────────────────────────────────────┐ ";
echo "\n  | [ENG] > You Have to Run This Script as ROOT   | ";
echo "\n  └───────────────────────────────────────────────┘\n";
    exit;
}
*/

/*
  ┌─────────────────┐
  | ROOT Checker V2 |
  └─────────────────┘
*/

$jam_root = trim( shell_exec( "whoami" ) );
if ( $jam_root != "root" )
{
	
echo "\n  ┌───────────────────────────────────────────────┐ ";
echo "\n  | [ALB] > Duhet Ta Perdorni Kete Script si ROOT | ";
echo "\n  └───────────────────────────────────────────────┘ ";
echo "\n  ┌───────────────────────────────────────────────┐ ";
echo "\n  | [ENG] > You Have to Run This Script as ROOT   | ";
echo "\n  └───────────────────────────────────────────────┘\n";
    exit;
}

/*
  ┌─────────────────────┐
  | GLOBAL DIR SETTINGS |
  └─────────────────────┘
*/

// SET DOWNLOADER PATH
define("MAIN_DIR", "/var/www/html/"); // MAIN HTTP SERVER DIR
shell_exec("mkdir " . MAIN_DIR . "Facebook > /dev/null 2>&1"); // MAKE FOLDER
shell_exec("chmod -R 755 " . MAIN_DIR . "/"); // CHMOD FACEBOOK FOLDER
define("FACEBOOK_DIR", MAIN_DIR . "Facebook"); // FACEBOOK FOLDER, IF U WANT CHANGE IT
chdir(FACEBOOK_DIR . "/");

/*
  ┌────────────────────┐
  | GET YOUR SERVER IP |
  └────────────────────┘
*/

// 192.XXX.XXX.XXX
function GetIP() {
    $ip_address = explode("\n", shell_exec("/sbin/ifconfig | grep 'inet addr:' | cut -d: -f2 | awk '{ print $1}'"));

    foreach ($ip_address as $addr) {
        if (strncmp("127", $addr, 3) !== 0) {
            $result = $addr;
            break;
        }
    }
    return $result;
}

$SRVER_IP = GetIP();
//echo $SRVER_IP;

// LOCALHOST 127.0.0.1
$localhost = gethostname();
$local_ip = gethostbyname( $localhost );
//echo $local_ip;

/*
  ┌───────────────┐
  | CURL FUNCTION |
  └───────────────┘
*/

// CURL V2 WITH HD OPTIONS
    function curl($url) {
     	$ch = @curl_init();
     	curl_setopt($ch, CURLOPT_URL, $url);
     	$header[] = "Connection: keep-alive";
     	$header[] = "Keep-Alive: 300";
     	$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
     	$header[] = "Accept-Language: en-us,en;q=0.5";
     	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'); // BROWSER HD
     	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
     	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
     	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
     	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
     	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
     	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
     	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
		$rp=rand(0,255).'.'.rand(0,255).'.'.rand(0,255).'.'.rand(0,255);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: $rp", "HTTP_X_FORWARDED_FOR: $rp"));
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/".rand(3,5).".".rand(0,3)." (Windows NT ".rand(3,5).".".rand(0,2)."; rv:2.0.1) Gecko/20100101 Firefox/".rand(3,5).".0.1");
     	$data = curl_exec($ch);
     	curl_close($ch);
     	return $data;
    }

system("clear");
echo "\n";
echo "\n  ┌────────────────────────────────────────────────────────────┐ ";
echo "\n  |  For More Moduled Or Updates Stay Connected to Kodi dot AL | ";
echo "\n  └────────────────────────────────────────────────────────────┘ ";
echo "\n  ┌───────────┬───────────────────────────┐ ";
echo "\n  │ Product   │ Facebook Video Downloader │ ";
echo "\n  │ Version   │ v1.0 BETA#1               │ ";
echo "\n  │ Support   │ MP4/Xream Codes Panel     │ ";
echo "\n  │ Licence   │ FREE                      │ ";
echo "\n  │ Author    │ Olsion Bakiaj             │ ";
echo "\n  │ Email     │ TRC4@USA.COM              │ ";
echo "\n  │ Author    │ Endrit Pano               │ ";
echo "\n  │ Email     │ INFO@ALBDROID.AL          │ ";
echo "\n  │ Website   │ https://kodi.al           │ ";
echo "\n  │ Facebook  │ /albdroid.official/       │ ";
echo "\n  │ Created   │ November 11, 2019         │ ";
echo "\n  └───────────────────────────────────────┘ \n";
echo "\n ┌─────────────────────────────────────────────────────────────────────────────────┐";
echo "\n | [!] Example: https://www.facebook.com/albdroid.official/videos/472201916733510/ |";
echo "\n └─────────────────────────────────────────────────────────────────────────────────┘";
echo "\n";
echo "\n";
echo "[+] Enter Video URL: ";
$get_video_url = trim(fgets(STDIN, 1024));
//echo "\n[+] Save As? : "; Custom Titles
//////////////////////////
echo "\n";
//$video_file_name = trim(fgets(STDIN, 1024)); // OLD FOR Custom Titles
$Replace_Video_Titles = trim($get_video_url); // TEST
//$Replace_Video_Titles = trim(fgets(STDIN, 1024)); // NEW FOR Custom Titles
$url = str_replace('', '', $get_video_url);
// GET VIDEOS REGEX
$replace_string_content = curl($url);

// TREGON SOURCE CODE NE TERMINAL - PER DEBUG
// SHOW SOURCE CODE ON TERMINAL - FOR DEBUG
// echo $replace_string_content;

// $video_regex = preg_match('/sd_src:"(http.*?)"/', $replace_string_content, $matches) ? $matches[1] : null; // SD VIDEOS
$video_regex = preg_match('/hd_src:"(http.*?)"/', $replace_string_content, $matches) ? $matches[1] : null; // HD VIDEOS
$video_url = urldecode($video_regex);
// GET VIDEOS REGEX
// REGEX TITLES TEST
$get_titles = curl($url);

// TREGON SOURCE CODE NE TERMINAL - PER DEBUG
// SHOW SOURCE CODE ON TERMINAL - FOR DEBUG
// echo $get_titles;

// EASY REGEX https://rubular.com/r/YabJFTTZZ2ytym
// KA PROBLEM NE DISA VIDEO NXJER NOINDEX.MP4
// PUNON POR KA DISA PROBLEME NE NXJERJEN E TITULLAVE
// $titles_regex = preg_match('/title".*content="(.+?)"/', $get_titles, $matches) ? $matches[1] : null;
// PUNON POR KA DISA PROBLEME NE NXJERJEN E TITULLAVE >> TITLE .MP4 KA BOSHLLEK NE FUND

$titles_regex = preg_match('/title id="pageTitle">(.*?.- )(.+?)(?:|Facebook|$)<\/title>/', $get_titles, $matches) ? $matches[2] : null;
//$output_titles = urldecode($titles_regex); // KETE
$output_titles = ltrim(($titles_regex));  // OSE KETE

// START REPLACE TITLES
$Replace_Video_Titles = str_replace(
array(
",",
"",
"!",
".",
"  ",
" |  ",
" | ",
"&amp;",
" .mp4"),
array(
".",
"",
"",
"",
"",
"",
" ",
"ft.",
".mp4"),
$output_titles
);
// END REPLACE TITLES

system("clear");
echo "\n";
echo " ┌────────────────────────────────┐ \n";
echo " │ Starting Video Downloading ... │ \n";
echo " └────────────────────────────────┘ \n";
echo "";
echo " GET Video (" . $Replace_Video_Titles . ".mp4)\n";
$wget_command = 'wget -O "' . $Replace_Video_Titles . '.mp4" --user-agent="Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36" "' . $video_url . '" -q ';
system($wget_command);
system("clear");
echo "\n";
echo " ┌────────────────────────────────┐ \n";
echo " │ Video Downloading Was Complete │ \n";
echo " └────────────────────────────────┘ \n";
echo "";
echo " ┌──────────────────────────────────────────────┐ \n";
echo " │ Video Destination: -> " . FACEBOOK_DIR . " │ \n";
echo " └──────────────────────────────────────────────┘ \n";
echo " ┌────────────────────────────────┐ \n";
echo " │ Video Saved As -> " . $Replace_Video_Titles . ".mp4  \n";
echo " └────────────────────────────────┘ \n";
exit(0);
?>