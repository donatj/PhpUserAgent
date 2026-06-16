<?php


class ClassConsistencyTest extends \PHPUnit\Framework\TestCase {

	public function testClassConsistency() {
		$out = [];
		if( file_exists(__DIR__ . '/user_agents.json') && filesize(__DIR__ . '/user_agents.json') > 0 ) {
			$uas = json_decode(file_get_contents(__DIR__ . '/user_agents.json'), true);
		} else {
			$uas = json_decode(file_get_contents(__DIR__ . '/user_agents.dist.json'), true);
		}

		$browsers = [];
		foreach( $uas as $ua ) {
			if( isset($browsers[$ua['browser']]) ) {
				$this->assertSame(
					isset($ua['class']) ? $ua['class'] : false,
					$browsers[$ua['browser']],
					"Browser '{$ua['browser']}' is not consistently classified"
				);
			} else {
				$browsers[$ua['browser']] = isset($ua['class']) ? $ua['class'] : false;
			}
		}
	}

}
