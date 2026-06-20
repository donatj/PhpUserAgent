<?php

require(__DIR__ . '/../vendor/autoload.php');

$jsonfile = __DIR__ . '/../Tests/user_agents.dist.json';

$content = file_get_contents($jsonfile);
if( $content === false ) {
	echo "Failed to read file: $jsonfile\n";
	exit(1);
}

$uas = json_decode($content, true);
assert(is_array($uas));

foreach( $uas as $key => &$val ) {
	$val = parse_user_agent($key);
}

echo json_encode($uas);
