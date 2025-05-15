<?php

require __DIR__ . '/../vendor/autoload.php';

// @phpstan-ignore argument.type
$class = new ReflectionClass($argv[1]);

echo "Predefined helper constants from `{$class->getName()}`\n\n";

echo "| Constant | {$argv[2]} | \n|----------|----------| \n";

foreach( $class->getConstants() as $constant => $value ) {
	assert(is_string($value));
	echo "| `{$class->getShortName()}::{$constant}` |  {$value} | \n";
}

echo "\n";
