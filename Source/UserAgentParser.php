<?php

/**
* Parses a user agent string into its important parts
* 
* @author Jesse G. Donat <donatj@gmail.com>
* @link https://github.com/donatj/PhpUserAgent
* @param string $u_agent
* @return array an array with browser, version and platform keys
*/
function parse_user_agent( $u_agent = null ) { 
	if(is_null($u_agent)) $u_agent = $_SERVER['HTTP_USER_AGENT'];

	$data = array();

	if( preg_match('/\((.*?)\)/im', $u_agent, $regs) ) {

		# (?<platform>Android|iPhone|iPad|Windows|Linux|Macintosh|Windows Phone OS|Silk|linux-gnu|BlackBerry)(?: x86_64)?(?: NT)?(?:[ /][0-9._]+)*(;|$)
		preg_match_all('%(?P<platform>Android|iPhone|iPad|Windows|Linux|Macintosh|Windows Phone OS|Silk|linux-gnu|BlackBerry)(?: x86_64)?(?: NT)?(?:[ /][0-9._]+)*(;|$)%im', $regs[1], $result, PREG_PATTERN_ORDER);
		$result['platform'] = array_unique($result['platform']);
		if( count($result['platform']) > 1 ) {
			if( ($key = array_search( 'Android', $result['platform'] )) !== false ) {
				$data['platform']  = $result['platform'][$key];
			}
		}else{
			$data['platform'] = $result['platform'][0];
		}

	}

	# (?<browser>Camino|Kindle|Firefox|Safari|MSIE|AppleWebKit|Chrome|IEMobile|Opera|Silk|Lynx|Version|Wget)(?:[/ ])(?<version>[0-9.]+)
	preg_match_all('%(?P<browser>Camino|Kindle|Firefox|Safari|MSIE|AppleWebKit|Chrome|IEMobile|Opera|Silk|Lynx|Version|Wget|curl)(?:[/ ])(?P<version>[0-9.]+)%im', $u_agent, $result, PREG_PATTERN_ORDER);

	if( $data['platform'] == 'linux-gnu' ) { $data['platform'] = 'Linux'; }

	if( ($key = array_search( 'Kindle', $result['browser'] )) !== false || ($key = array_search( 'Silk', $result['browser'] )) !== false ) {
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
		}elseif( $key = array_search( 'Kindle', $result['browser'] ) ) {
			$data['browser'] = 'Kindle';
		}elseif( $key = array_search( 'Safari', $result['browser'] ) ) {
			$data['browser'] = 'Safari';
			if( ($vkey = array_search( 'Version', $result['browser'] )) !== false ) { $key = $vkey; }
		}else{
			$key = 0;
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
	}elseif( $key = array_search( 'Kindle', $result['browser'] ) ) {
		$data['browser'] = 'Kindle';
		$data['platform'] = 'Kindle';
	}else{
		$data['browser'] = $result['browser'][0];
		$data['version'] = $result['version'][0];
	}

	return $data;

}