<?php

use Tally\Attribute\Before;
use Tally\Attribute\Warmup;

require_once __DIR__ . '/../src/UserAgentParser.php';

final class ParserBench {

	private array $userAgents;

	#[Before]
	public function loadUserAgents(): void {
		$contents = file_get_contents(__DIR__ . '/../tests/user_agents.dist.json');
		if( $contents === false ) {
			throw new RuntimeException('Unable to load user agents fixture');
		}

		$userAgents = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
		if( !is_array($userAgents) || !$userAgents ) {
			throw new RuntimeException('User agents fixture must be a non-empty object');
		}

		$this->userAgents = array_keys($userAgents);
	}

	#[Warmup(1)]
	#[\Tally\Attribute\Expected(instructions: '44.03M', cycles: '47.65M', memory: '5.969KiB')]
	public function benchParseUserAgents(): void {
		foreach( $this->userAgents as $userAgent ) {
			parse_user_agent($userAgent);
		}
	}
}
