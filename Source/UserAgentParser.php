<?php

/**
* Parses a user agent string into its important parts
* 
* @param string $u_agent
* @return array an array with browser, version and platform keys
*/
function UserAgentParser( $u_agent ) { 

	$data = array();

	# ^.+?(?<platform>Android|iPhone|iPad|Windows|Macintosh|Windows Phone OS)(?: NT)*(?: [0-9.]+)*(;|\))
	if (preg_match('/^.+?(?P<platform>Android|iPhone|iPad|Windows|Macintosh|Windows Phone OS)(?: NT)*(?: [0-9.]+)*(;|\))/im', $u_agent, $regs)) {
		$data['platform'] = $regs['platform'];
	} else {
		$result = "";
	}

	# (?<browser>Camino|Kindle|Firefox|Safari|MSIE|AppleWebKit|Chrome|IEMobile|Opera)(?:[/ ])(?<version>[0-9.]+)
	preg_match_all('%(?P<browser>Camino|Kindle|Firefox|Safari|MSIE|AppleWebKit|Chrome|IEMobile|Opera)(?:[/ ])(?P<version>[0-9.]+)%im', $u_agent, $result, PREG_PATTERN_ORDER);

	if( $result['browser'][0] == 'AppleWebKit' ) {
		if( ( $data['platform'] == 'Android' && !($key = 0) ) || $key = array_search( 'Chrome', $result['browser'] ) ) {
			$data['browser'] = 'Chrome';
		}elseif( $key = array_search( 'Kindle', $result['browser'] ) ) {
			$data['browser'] = 'Kindle';
		}elseif( $key = array_search( 'Safari', $result['browser'] ) ) {
			$data['browser'] = 'Safari';
		}else{
			$key = 0;
			$data['browser'] = 'webkit';
		}
		$data['version'] = $result['version'][$key];
	}elseif( $key = array_search( 'Opera', $result['browser'] ) ) {
		$data['browser'] = $result['browser'][$key];
		$data['version'] = $result['version'][$key];
	}elseif( $result['browser'][0] == 'MSIE' ){
		if( $key = array_search( 'IEMobile', $result['browser'] ) ) {
			$data['browser'] = 'IEMobile';
		}else{
			$data['browser'] = 'MSIE';
			$key = 0;
		}
		$data['version'] = $result['version'][$key];
	}else{
		$data['browser'] = $result['browser'][0];
		$data['version'] = $result['version'][0];
	}

	if( $data['browser'] == 'Kindle' ) {
		$data['platform'] = 'Kindle';
	}

	return $data;

} 