<?php

require __DIR__ . '/../vendor/autoload.php';

$class = new ReflectionClass($argv[1]);
foreach( $class->getConstants() as $constant ) {
	echo "- {$constant}\n";
}
