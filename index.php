<?php
error_reporting(E_ALL);
require('Source/UserAgentParser.php');

$data = array(

	//Old School Yo

'Lynx/2.8.6rel.4 libwww-FM/2.14 SSL-MM/1.4.1 OpenSSL/0.9.7l Lynxlet/0.7.0' => array('platform' => '', 'browser' => 'Lynx', 'version' => '2.8.6'),
'curl/7.19.7 (universal-apple-darwin10.0) libcurl/7.19.7 OpenSSL/0.9.8r zlib/1.2.3' => array('platform' => '', 'browser' => 'curl', 'version' => '7.19.7'),
'Wget/1.12 (linux-gnu)' => array('platform' => 'Linux','browser' => 'Wget', 'version' => '1.12'),

'Mozilla/4.0 (Windows; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727)' => array('platform' => 'Windows', 'browser' => 'MSIE', 'version' => '6.0'),
'Mozilla/4.0 (MSIE 6.0; Windows NT 5.1)' => array('platform' => 'Windows', 'browser' => 'MSIE', 'version' => '6.0'),
'Mozilla/4.0 (MSIE 6.0; Windows NT 5.0)' => array('platform' => 'Windows', 'browser' => 'MSIE', 'version' => '6.0'),
'Mozilla/4.0 (compatible;MSIE 6.0;Windows 98;Q312461)' => array('platform' => 'Windows', 'browser' => 'MSIE', 'version' => '6.0'),
'Mozilla/4.0 (Compatible; Windows NT 5.1; MSIE 6.0) (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)' => array('platform' => 'Windows', 'browser' => 'MSIE', 'version' => '6.0'),
'Mozilla/4.0 (compatible; U; MSIE 6.0; Windows NT 5.1)' => array('platform' => 'Windows', 'browser' => 'MSIE', 'version' => '6.0'),
'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) ; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET4.0C; .NET4.0E)' => array('platform' => 'Windows', 'browser' => 'MSIE', 'version' => '7.0'),
'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E; Tablet PC 2.0)' => array('platform' => 'Windows', 'browser' => 'MSIE', 'version' => '8.0'),
'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) ; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; InfoPath.3; Tablet PC 2.0)' => array('platform' => 'Windows', 'browser' => 'MSIE', 'version' => '8.0'),
'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)' => array('platform' => 'Windows', 'browser' => 'MSIE', 'version' => '9.0'),

'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5 (.NET CLR 3.5.21022)'               => array('platform' => 'Windows', 'browser' => 'Firefox', 'version' => '3.5.5'),
'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.15) Gecko/20110303 Firefox/3.6.15 FirePHP/0.5'                      => array('platform' => 'Windows', 'browser' => 'Firefox', 'version' => '3.6.15'),

'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.13 (KHTML, like Gecko) Chrome/9.0.597.98 Safari/534.13'      => array('platform' => 'Windows', 'browser' => 'Chrome', 'version' => '9.0.597.98'),
'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.16 (KHTML, like Gecko) Chrome/10.0.648.114 Safari/534.16'    => array('platform' => 'Windows', 'browser' => 'Chrome', 'version' => '10.0.648.114'),
'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.7 (KHTML, like Gecko) Chrome/7.0.517.41 Safari/534.7'        => array('platform' => 'Windows', 'browser' => 'Chrome', 'version' => '7.0.517.41'),


'Opera/9.80 (Windows NT 6.0; U; en) Presto/2.8.99 Version/11.10' => array('platform' => 'Windows', 'browser' => 'Opera', 'version' => '11.10'),
'Opera/9.80 (Windows NT 5.1; U; cs) Presto/2.7.62 Version/11.01' => array('platform' => 'Windows', 'browser' => 'Opera', 'version' => '11.01'),
'Opera/9.80 (Macintosh; Intel Mac OS X 10.6.8; U; Edition MacAppStore; en) Presto/2.10.229 Version/11.61' => array('platform' => 'Macintosh', 'browser' => 'Opera', 'version' => '11.61'),
'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.13) Gecko/20101213 Opera/9.80 (Windows NT 6.1; U; zh-tw) Presto/2.7.62 Version/11.01' => array('platform' => 'Windows', 'browser' => 'Opera', 'version' => '11.01'),
'Mozilla/5.0 (Windows NT 6.1; U; nl; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6 Opera 11.01'                                                      => array('platform' => 'Windows', 'browser' => 'Opera', 'version' => '11.01'),
'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; de) Opera 11.01'                                                                            => array('platform' => 'Windows', 'browser' => 'Opera', 'version' => '11.01'),
'Mozilla/5.0 (Windows; U; Windows NT 6.1; tr-TR) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27'                      => array('platform' => 'Windows', 'browser' => 'Safari', 'version' => '5.0.4'),


/// MAC BROWSERS

'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.6; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3'                             => array('platform' => 'Macintosh', 'browser' => 'Firefox', 'version' => '3.6.3'),
'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:11.0) Gecko/20100101 Firefox/11.0'                                           => array('platform' => 'Macintosh', 'browser' => 'Firefox', 'version' => '11.0'),
'Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10_4_11; en) AppleWebKit/531.22.7 (KHTML, like Gecko) Version/4.0.5 Safari/531.22.7' => array('platform' => 'Macintosh', 'browser' => 'Safari', 'version' => '4.0.5'),
'Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10_4_11; en) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/4.1.2 Safari/533.18.5' => array('platform' => 'Macintosh', 'browser' => 'Safari', 'version' => '4.1.2'),
'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_3; en-us) AppleWebKit/533.16 (KHTML, like Gecko) Version/5.0 Safari/533.16'   => array('platform' => 'Macintosh', 'browser' => 'Safari', 'version' => '5.0'),
'Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10.5; it; rv:1.9.0.19) Gecko/2010111021 Camino/2.0.6 (MultiLang) (like Firefox/3.0.19)' => array('platform' => 'Macintosh', 'browser' => 'Camino', 'version' => '2.0.6'),
'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.6; en; rv:1.9.0.18) Gecko/2010021619 Camino/2.0.2 (like Firefox/3.0.18)'   => array('platform' => 'Macintosh', 'browser' => 'Camino', 'version' => '2.0.2'),
'Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; it; rv:1.8.1.21) Gecko/20090327 Camino/1.6.7 (MultiLang) (like Firefox/2.0.0.21pre)' => array('platform' => 'Macintosh', 'browser' => 'Camino', 'version' => '1.6.7'),
'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en; rv:1.8.1.11) Gecko/20071128 Camino/1.5.4' => array('platform' => 'Macintosh', 'browser' => 'Camino', 'version' => '1.5.4'),

/// MOBLE BROWSERS

'Mozilla/5.0 (Linux; U; Android 2.2; en-us; SGH-T959 Build/FROYO) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'                 => array('platform' => 'Android', 'browser' => 'Chrome', 'version' => '4.0'),

'Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.10'          => array('platform' => 'iPad', 'browser' => 'Safari', 'version' => '4.0.4'),
'Mozilla/5.0 (iPad; U; CPU iPhone OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B314 Safari/531.21.10'    => array('platform' => 'iPad', 'browser' => 'Safari', 'version' => '4.0.4'),
'Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.10'          => array('platform' => 'iPad', 'browser' => 'Safari', 'version' => '4.0.4'),

'Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_2_6 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8E200 Safari/6533.18.5' => array('platform' => 'iPhone', 'browser' => 'Safari', 'version' => '5.0.2'),
'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420+ (KHTML, like Gecko) Version/3.0 Mobile/1C25 Safari/419.3'                               => array('platform' => 'iPhone', 'browser' => 'Safari', 'version' => '3.0'),

'Mozilla/4.0 (compatible; MSIE 7.0; Windows Phone OS 7.0; Trident/3.1; IEMobile/7.0) Asus;Galaxy6'                 => array('platform' => 'Windows Phone OS', 'browser' => 'IEMobile', 'version' => '7.0'),
'Mozilla/4.0 (compatible; MSIE 7.0; Windows Phone OS 7.0; Trident/3.1; IEMobile/7.0; LG; GW910)'                   => array('platform' => 'Windows Phone OS', 'browser' => 'IEMobile', 'version' => '7.0'),
'Mozilla/4.0 (compatible; MSIE 7.0; Windows Phone OS 7.0; Trident/3.1; IEMobile/7.0) LG;LG-E900h)'                 => array('platform' => 'Windows Phone OS', 'browser' => 'IEMobile', 'version' => '7.0'),

/// EBOOK READERS

'Mozilla/4.0 (compatible; Linux 2.6.10) NetFront/3.3 Kindle/1.0 (screen 600x800)' => array('platform' => 'Kindle', 'browser' => 'Kindle', 'version' => '1'),
'Mozilla/5.0 (Linux; U; en-US) AppleWebKit/528.5+ (KHTML, like Gecko, Safari/528.5+) Version/4.0 Kindle/3.0 (screen 600x800; rotate)' => array('platform' => 'Kindle', 'browser' => 'Kindle', 'version' => '3.0'),
'Mozilla/5.0 (Linux; U; en-US) AppleWebKit/528.5+ (KHTML, like Gecko, Safari/538.5+) Version/4.0 Kindle/3.0 (screen 600x800; rotate)' => array('platform' => 'Kindle', 'browser' => 'Kindle', 'version' => '3.0'),

'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_3; en-us; Silk/1.0.13.81_10003810) AppleWebKit/533.16 (KHTML, like Gecko) Version/5.0 Safari/533.16 Silk-Accelerated=true' => array('platform' => 'Kindle', 'browser' => 'Silk', 'version' => '1.0.13.81'),

);

echo '<h1>Test Suite</h1>';

echo '<h2>YOU</h2>';
echo '<div>';

$x =  parse_user_agent();
echo '<div class="aspect version">' .  $x['version'] .  '</div>';
echo '<div class="aspect browser">' .  $x['browser'] .  '</div>';
if( $x['platform'] ) {
	echo '<div class="aspect platform">' . $x['platform'] . '</div>';
}
echo '<small>' . $_SERVER['HTTP_USER_AGENT'] . '</small><br /><div style="clear: both"></div>';

echo '</div>';

$prev = array('platform' => false, 'browser' => false, 'version' => false);

foreach( $data as $agent => $expected ) {

	$x = parse_user_agent($agent);
	
	if( $prev['platform'] != $x['platform'] ) {
		echo '<h2>'	. $expected['platform'] . '</h2>';
		$prev['browser'] = false;
		$prev['version'] = false;
	}
	
	if( $prev['browser'] != $x['browser'] ) {
		echo '<h3>'	. $expected['browser'] . '</h3>';
		$prev['version'] = false;
	}
	
	if( $prev['version'] != $x['version'] ) {
		echo '<h4>'	. $expected['version'] . '</h4>';
	}
	
	if( $x['platform'] == $expected['platform'] && $x['browser'] == $expected['browser'] && $x['version'] == $expected['version'] ) {
		echo '<div style="background:#a0b96a; margin: 1px 0;">';
	}else{
		echo '<div style="background:#b96a6a; margin: 1px 0;">';
	}
	
	echo '<div class="aspect version">' .  $x['version'] .  '</div>';
	echo '<div class="aspect browser">' .  $x['browser'] .  '</div>';
	if( $x['platform'] ) {
		echo '<div class="aspect platform">' . $x['platform'] . '</div>';
	}
	
	echo '<small>' . $agent . '</small><br />';
	echo '<div style="clear: both"></div>';
	
	echo '</div>';

	$prev = $expected;
	
}

?>
<style type="text/css">

div.aspect {
	float: right;
	color: white;
	padding: 4px;
	text-align: center;
	min-width: 100px;;
	margin: 1px;
	border-radius: 3px;
}

div.platform {
	background: #3693c1;	
}

div.version {
	background: #c080e5;	
}

div.browser{
	background: #ed4f23;	
}

body {
	margin: 0; padding: 0;	
}
h1 {
	text-align: center;	
}
h2, h3, h4 {
	padding: 0;
	margin: 0;	
	display: block;
}

h2 {
	background: #bbb;
	text-align: center;
}

h3 {
	background: #aaa;	
}

h4 {
	background: #999;	
}

</style>