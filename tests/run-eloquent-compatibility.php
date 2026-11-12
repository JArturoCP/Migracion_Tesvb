<?php

$root = dirname(__DIR__);
require $root.'/vendor/autoload.php';
require __DIR__.'/Unit/EloquentCompatibilityTest.php';

// Run only the isolated model tests. Never bootstrap the application or load Feature tests.
$methods = [
    'test_all_models_autoload_with_their_existing_database_mapping',
    'test_model_imports_and_static_class_references_resolve_without_global_aliases',
    'test_zero_argument_relations_build_queries_without_database_access',
    'test_legacy_half_hour_ranges_use_numeric_carbon_units',
    'test_verified_timestamp_and_manual_key_sql_without_execution',
];

$total = 0;
foreach ($methods as $method) {
    $before = PHPUnit\Framework\Assert::getCount();
    $test = new Tests\Unit\EloquentCompatibilityTest($method);

    try {
        $test->runBare();
    } catch (Throwable $exception) {
        fwrite(STDERR, 'FAIL '.$method.': '.$exception->getMessage().PHP_EOL);
        exit(1);
    }

    $assertions = PHPUnit\Framework\Assert::getCount() - $before;
    $total += $assertions;
    echo 'PASS '.$method.' ('.$assertions.' assertions)'.PHP_EOL;
}

echo count($methods).' tests passed; '.$total.' assertions. No application bootstrap or database queries.'.PHP_EOL;
