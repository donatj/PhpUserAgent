# PHP User Agent Parser

[![Latest Stable Version](https://poser.pugx.org/donatj/phpuseragentparser/v/stable.png)](https://packagist.org/packages/donatj/phpuseragentparser)
[![Build Status](https://travis-ci.org/donatj/PhpUserAgent.png?branch=master)](https://travis-ci.org/donatj/PhpUserAgent)

## What It Is

A simple, streamlined PHP user-agent parser!

Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php

## Why Use This

You have your choice in user agent parsers. This one detects **all modern browsers** in a very light, quick, understandable fashion. It is less than 150 lines of code, and consists of just two regular expressions! 

It offers 100% unit test coverage, is installable via Composer, and is very easy to use.

## Requirements

  - PHP 5.3.0+

## Installing

PHP User Agent is available through Packagist via Composer.

```json
{
	"require": {
		"donatj/phpuseragentparser": "*"
	}
}
```

## Sample Usage

```php
$ua_info = parse_user_agent();
/*
array(
	'platform' => '[Detected Platform]',
	'browser'  => '[Detected Browser]',
	'version'  => '[Detected Browser Version]',
);
*/
```

## Currently Detected Platforms

- Desktop
	- Windows
	- Linux
	- Macintosh
	- Chrome OS
- Mobile
	- Android
	- iPhone
	- iPad
	- Windows Phone OS
	- Kindle
	- Kindle Fire
	- BlackBerry
	- Playbook
- Console
	- Nintendo 3DS
	- Nintendo Wii
	- Nintendo WiiU
	- PlayStation 3
	- PlayStation Vita
	- Xbox 360

## Currently Detected Browsers

- BlackBerry Browser
- Camino
- Kindle / Silk
- Firefox / Iceweasel
- Safari
- Internet Explorer
- IEMobile
- Chrome
- Opera
- Midori
- Lynx
- Wget
- Curl



More information is available at [Donat Studios](http://donatstudios.com/PHP-Parser-HTTP_USER_AGENT).
