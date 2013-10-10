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
	if( is_null($u_agent) && isset($_SERVER['HTTP_USER_AGENT']) ) $u_agent = $_SERVER['HTTP_USER_AGENT'];

	$platform = null;
	$browser  = null;
	$version  = null;

	$empty = array( 'platform' => $platform, 'browser' => $browser, 'version' => $version );

	if( !$u_agent ) return $empty;

	if( preg_match('/\((.*?)\)/im', $u_agent, $parent_matches) ) {

		preg_match_all('/(?P<platform>Android|CrOS|iPhone|iPad|Linux|Macintosh|Windows(\ Phone\ OS)?|Silk|linux-gnu|BlackBerry|PlayBook|Nintendo\ (WiiU?|3DS)|Xbox)
			(?:\ [^;]*)?
			(?:;|$)/imx', $parent_matches[1], $result, PREG_PATTERN_ORDER);

		$priority           = array( 'Android', 'Xbox' );
		$result['platform'] = array_unique($result['platform']);
		if( count($result['platform']) > 1 ) {
			if( $keys = array_intersect($priority, $result['platform']) ) {
				$platform = reset($keys);
			} else {
				$platform = $result['platform'][0];
			}
		} elseif( isset($result['platform'][0]) ) {
			$platform = $result['platform'][0];
		}
	}

	if( $platform == 'linux-gnu' ) {
		$platform = 'Linux';
	}
	if( $platform == 'CrOS' ) {
		$platform = 'Chrome OS';
	}

	preg_match_all('%(?P<browser>Camino|Kindle(\ Fire\ Build)?|Firefox|Safari|MSIE|AppleWebKit|Chrome|IEMobile|Opera|OPR|Silk|Lynx|Version|Wget|curl|NintendoBrowser|PLAYSTATION\ (\d|Vita)+)
			(?:\)?;?)
			(?:(?:[/ ])(?P<version>[0-9A-Z.]+)|/(?:[A-Z]*))%ix',
		$u_agent, $result, PREG_PATTERN_ORDER);

	$key = 0;

	// If nothing matched, return null (to avoid undefined index errors)
	if( !isset($result['browser'][0]) || !isset($result['version'][0]) ) {
		return $empty;
	}

	$browser = $result['browser'][0];
	$version = $result['version'][0];

	if( ($key = array_search('Playstation Vita', $result['browser'])) !== false ) {
		$platform = 'PlayStation Vita';
		$browser  = 'Browser';
	} elseif( ($key = array_search('Kindle Fire Build', $result['browser'])) !== false || ($key = array_search('Silk', $result['browser'])) !== false ) {
		$browser  = $result['browser'][$key] == 'Silk' ? 'Silk' : 'Kindle';
		$platform = 'Kindle Fire';
		if( !($version = $result['version'][$key]) || !is_numeric($version[0]) ) {
			$version = $result['version'][array_search('Version', $result['browser'])];
		}
	} elseif( ($key = array_search('NintendoBrowser', $result['browser'])) !== false || $platform == 'Nintendo 3DS' ) {
		$browser = 'NintendoBrowser';
		$version = $result['version'][$key];
	} elseif( ($key = array_search('Kindle', $result['browser'])) !== false ) {
		$browser  = $result['browser'][$key];
		$platform = 'Kindle';
		$version  = $result['version'][$key];
	} elseif( ($key = array_search('OPR', $result['browser'])) !== false ) {
		$browser = 'Opera Next';
		$version = $result['version'][$key];
	} elseif( ($key = array_search('Opera', $result['browser'])) !== false ) {
		$browser = 'Opera';
		$version = $result['version'][$key];
		if( ($key = array_search('Version', $result['browser'])) !== false ) {
			$version = $result['version'][$key];
		}
	} elseif( $browser == 'AppleWebKit' ) {
		if( ($platform == 'Android' && !($key = 0)) || $key = array_search('Chrome', $result['browser']) ) {
			$browser = 'Chrome';
			if( ($vkey = array_search('Version', $result['browser'])) !== false ) {
				$key = $vkey;
			}
		} elseif( $platform == 'BlackBerry' || $platform == 'PlayBook' ) {
			$browser = 'BlackBerry Browser';
			if( ($vkey = array_search('Version', $result['browser'])) !== false ) {
				$key = $vkey;
			}
		} elseif( $key = array_search('Safari', $result['browser']) ) {
			$browser = 'Safari';
			if( ($vkey = array_search('Version', $result['browser'])) !== false ) {
				$key = $vkey;
			}
		}

		$version = $result['version'][$key];
	} elseif( $browser == 'MSIE' ) {
		if( $key = array_search('IEMobile', $result['browser']) ) {
			$browser = 'IEMobile';
		} else {
			$browser = 'MSIE';
			$key     = 0;
		}
		$version = $result['version'][$key];
	} elseif( $key = array_search('playstation 3', array_map('strtolower', $result['browser'])) !== false ) {
		$platform = 'PlayStation 3';
		$browser  = 'NetFront';
	}

	return array( 'platform' => $platform, 'browser' => $browser, 'version' => $version );

}
