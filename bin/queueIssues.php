<?php
require_once  __DIR__ .'/../vendor/autoload.php';;

$env = __DIR__.'/env';
$queue = __DIR__.'/queue.json';

$jiraShell = new \EdmondsCommerce\JiraShell\JiraShell($queue, $env);
$reporter = new \EdmondsCommerce\PhpCompatibility\ReportAdapter($jiraShell, __DIR__.'/report.json');
$reporter->readReport()->queueIssues();

$outputPath = '';
$envPath = '';

