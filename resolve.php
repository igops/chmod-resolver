<?php
declare(strict_types=1);


use Kugaudo\Chmod\ChmodResolver;

require_once 'vendor/autoload.php';

$MODE   = (int)($argv[1] ?? -1);
$WHO    = $argv[2] ?? ChmodResolver::WHO_OWNER;
$OP     = $argv[3] ?? ChmodResolver::OP_READ;


$resolver = new ChmodResolver();

echo sprintf("%u mode matches %s+%s: %s", $MODE, $WHO, $OP,
        $resolver->matches($MODE, $WHO, $OP) ? 'YES' : 'NO'
    ) . PHP_EOL;
exit(0);
