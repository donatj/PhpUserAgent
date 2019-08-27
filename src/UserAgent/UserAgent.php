<?php

namespace donatj\UserAgent;

class UserAgent {

	/**
	 * @var string|null
	 */
	private $platform;
	/**
	 * @var string|null
	 */
	private $browser;
	/**
	 * @var string|null
	 */
	private $browserVersion;

	/**
	 * UserAgent constructor.
	 *
	 * @param string|null $platform
	 * @param string|null $browser
	 * @param string|null $browserVersion
	 */
	public function __construct( $platform, $browser, $browserVersion ) {
		$this->platform       = $platform;
		$this->browser        = $browser;
		$this->browserVersion = $browserVersion;
	}

	/**
	 * @return string|null
	 */
	public function platform() {
		return $this->platform;
	}

	/**
	 * @return string|null
	 */
	public function browser() {
		return $this->browser;
	}

	/**
	 * @return string|null
	 */
	public function browserVersion() {
		return $this->browserVersion;
	}
}
