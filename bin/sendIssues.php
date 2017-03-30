<?php
require_once  __DIR__ .'/../vendor/autoload.php';;

$env = __DIR__.'/env';
$queue = __DIR__.'/queue.json';
$reportFile = __DIR__.'/report.json';

$jiraShell = new \EdmondsCommerce\JiraShell\JiraShell($queue, $env);

echo "Sending queued issues to Jira in 5 seconds... ";
sleep(5);

$jiraShell->sendQueue();

echo "Done".PHP_EOL;

