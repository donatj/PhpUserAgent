<?php

if( !isset($argv[1]) ) {
	fwrite(STDERR, "Usage: php bin/benchmark_ci.php <parser-file> [iterations]\n");
	exit(1);
}

$parserFile = $argv[1];
$iterations = isset($argv[2]) ? (int)$argv[2] : 10000;

if( $iterations < 1 ) {
	fwrite(STDERR, "Iterations must be >= 1\n");
	exit(1);
}

require $parserFile;

$uas = json_decode(file_get_contents(__DIR__ . '/../tests/user_agents.dist.json'), true);

if( !is_array($uas) ) {
	fwrite(STDERR, "Unable to load user agents fixture\n");
	exit(1);
}

$time = microtime(true);

foreach( array_keys($uas) as $ua ) {
	for( $i = 0; $i < $iterations; $i++ ) {
		parse_user_agent($ua);
	}
}

echo microtime(true) - $time;
