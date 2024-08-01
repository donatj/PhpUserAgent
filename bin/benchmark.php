<?php

require __DIR__ . '/../src/UserAgentParser.php';

$time = microtime(true);
$jsonfile = __DIR__ . '/../tests/user_agents.dist.json';
$content = file_get_contents($jsonfile);
if( $content === false ) {
	echo "Failed to read file: $jsonfile\n";
	exit(1);
}

$uas = json_decode($content, true);
assert(is_array($uas));

foreach( $uas as $ua => $junk ) {
	$uatime = microtime(true);
	for( $i = 0; $i <= 1000; $i++ ) {
		\parse_user_agent($ua);
	}


	echo microtime(true) - $uatime;
	echo " : $ua\n";
}


echo microtime(true) - $time;
echo " : TOTAL\n";

