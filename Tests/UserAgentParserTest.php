<?php
error_reporting(E_ALL);
$local_path = dirname(__FILE__);
require($local_path . "/../Source/UserAgentParser.php");

class UserAgentParser_test extends PHPUnit_Framework_TestCase {

	function test_parse_user_agent() {
		global $local_path;
		$uas = json_decode(file_get_contents($local_path . '/user_agents.json'), true);

		foreach($uas as $ua => $expected_result) {
			$result = parse_user_agent($ua);
			$this->assertEquals($expected_result, $result, $ua . " failed!" );
		}

	}

	function test_pase_user_agent_empty() {
		$expected = array(
			'platform' => null,
			'browser'  => null,
			'version'  => null,
		);

		$result = parse_user_agent('');
		$this->assertEquals($result, $expected);

		$result = parse_user_agent('asdjkakljasdkljasdlkj');
		$this->assertEquals($result, $expected);

		$result = parse_user_agent('Mozilla (asdjkakljasdkljasdlkj) BlahBlah');
		$this->assertEquals($result, $expected);
	}

}