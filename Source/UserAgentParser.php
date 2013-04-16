<?php

/**
 * Parses a user agent string into its important parts
 * 
 * @author Jesse G. Donat <donatj@gmail.com>
 * @link https://github.com/donatj/PhpUserAgent
 * @link http://donatstudios.com/PHP-Parser-HTTP_USER_AGENT
 * @param string $u_agent
 * @return array an array with browser, version and platform keys
 */
function parse_user_agent( $u_agent = null ) { 
	if(is_null($u_agent) && isset($_SERVER['HTTP_USER_AGENT'])) $u_agent = $_SERVER['HTTP_USER_AGENT'];

	$data = array(
		'platform' => null,
		'browser'  => null,
		'version'  => null,
	);
	
	if(!$u_agent) return $data;
	
	if( preg_match('/\((.*?)\)/im', $u_agent, $parent_matches) ) {

		preg_match_all('/(?P<platform>Android|CrOS|iPhone|iPad|Linux|Macintosh|Windows(\ Phone\ OS)?|Silk|linux-gnu|BlackBerry|Nintendo\ (WiiU?|3DS)|Xbox)
			(?:\ [^;]*)?
			(?:;|$)/imx', $parent_matches[1], $result, PREG_PATTERN_ORDER);

		$priority = array('Android', 'Xbox');
		$result['platform'] = array_unique($result['platform']);
		if( count($result['platform']) > 1 ) {
			if( $keys = array_intersect($priority, $result['platform']) ) {
				$data['platform'] = reset($keys);
			}else{
				$data['platform'] = $result['platform'][0];
			}
		}elseif(isset($result['platform'][0])){
			$data['platform'] = $result['platform'][0];
		}
	}

	if( $data['platform'] == 'linux-gnu' ) { $data['platform'] = 'Linux'; }
	if( $data['platform'] == 'CrOS' ) { $data['platform'] = 'Chrome OS'; }

	preg_match_all('%(?P<browser>Camino|Kindle(\ Fire\ Build)?|Firefox|Safari|MSIE|AppleWebKit|Chrome|IEMobile|Opera|Silk|Lynx|Version|Wget|curl|NintendoBrowser|PLAYSTATION\ \d+)
			(?:;?)
			(?:(?:[/ ])(?P<version>[0-9A-Z.]+)|/(?:[A-Z]*))%x', 
	$u_agent, $result, PREG_PATTERN_ORDER);

	$key = 0;

	$data['browser'] = $result['browser'][0];
	$data['version'] = $result['version'][0];

	if( ($key = array_search( 'Kindle Fire Build', $result['browser'] )) !== false || ($key = array_search( 'Silk', $result['browser'] )) !== false ) {
		$data['browser']  = $result['browser'][$key] == 'Silk' ? 'Silk' : 'Kindle';
		$data['platform'] = 'Kindle Fire';
		if( !($data['version'] = $result['version'][$key]) || !is_numeric($data['version'][0]) ) {
			$data['version'] = $result['version'][array_search( 'Version', $result['browser'] )];
		}
	}elseif( ($key = array_search( 'NintendoBrowser', $result['browser'] )) !== false || $data['platform'] == 'Nintendo 3DS' ) {
		$data['browser']  = 'NintendoBrowser';
		$data['version']  = $result['version'][$key];
	}elseif( ($key = array_search( 'Kindle', $result['browser'] )) !== false ) {
		$data['browser']  = $result['browser'][$key];
		$data['platform'] = 'Kindle';
		$data['version']  = $result['version'][$key];
	}elseif( $result['browser'][0] == 'AppleWebKit' ) {
		if( ( $data['platform'] == 'Android' && !($key = 0) ) || $key = array_search( 'Chrome', $result['browser'] ) ) {
			$data['browser'] = 'Chrome';
			if( ($vkey = array_search( 'Version', $result['browser'] )) !== false ) { $key = $vkey; }
		}elseif( $data['platform'] == 'BlackBerry' ) {
			$data['browser'] = 'BlackBerry Browser';
			if( ($vkey = array_search( 'Version', $result['browser'] )) !== false ) { $key = $vkey; }
		}elseif( $key = array_search( 'Safari', $result['browser'] ) ) {
			$data['browser'] = 'Safari';
			if( ($vkey = array_search( 'Version', $result['browser'] )) !== false ) { $key = $vkey; }
		}
		
		$data['version'] = $result['version'][$key];
	}elseif( ($key = array_search( 'Opera', $result['browser'] )) !== false ) {
		$data['browser'] = $result['browser'][$key];
		$data['version'] = $result['version'][$key];
		if( ($key = array_search( 'Version', $result['browser'] )) !== false ) { $data['version'] = $result['version'][$key]; }
	}elseif( $result['browser'][0] == 'MSIE' ){
		if( $key = array_search( 'IEMobile', $result['browser'] ) ) {
			$data['browser'] = 'IEMobile';
		}else{
			$data['browser'] = 'MSIE';
			$key = 0;
		}
		$data['version'] = $result['version'][$key];
	}elseif( $key = array_search( 'PLAYSTATION 3', $result['browser'] ) !== false ) {
		$data['platform'] = 'PLAYSTATION 3';
		$data['browser']  = 'NetFront';
	}

	if(preg_match('/(?:Mac OS X (?P<version>[0-9_.]+))|(?:Windows (?:NT|Phone OS)* *(?P<version2>[0-9_.]+))|(?:Android (?P<version3>[^;)]+))|(?:Linux (?P<version4>[^;)]+))|(?:(?:iPhone|CPU) OS (?P<version5>[0-9_.]+))/i', $parent_matches[1], $regs)) {

		$data['platform_version'] = trim($regs['version'] . $regs['version1'] . $regs['version2'] . $regs['version3'] . $regs['version4'] . $regs['version5']);

		if($data['platform'] == 'Windows') {
			switch((float)$data['platform_version']) {
				case 5:
					$data['platform_version'] = '2000';
					break;
				case 5.1:
					$data['platform_version'] = 'XP';
					break;
				case 5.2:
					$data['platform_version'] = 'XP64';
					break;
				case 6:
					$data['platform_version'] = 'Vista';
					break;
				case 6.1:
					$data['platform_version'] = '7';
					break;
				case 6.2:
					$data['platform_version'] = '8';
					break;
			}
		}
		
		$data['platform_version'] = str_replace('_', '.', $data['platform_version']);

	} else {
		$result = "";
	}

	return $data;

}