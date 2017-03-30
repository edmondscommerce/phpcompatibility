#!/usr/bin/env bash
readonly DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )";
cd $DIR;
source "./_top.inc.bash"

function usage(){

echo "

Parses the report output adapts it in to a Jira ticket json payload for sending to a Jira project

Usage:

./$0 [reportFile]

"
}

if (( $# < 1 ))
then
    usage
    exit 1
fi

### Parameters ###
reportFile="$1"

if [[ ! -f "./env" ]]
then
    echo "No Jira ENV file detected, please create it (even if it is empty) and add configuration (touch env)";
    exit 1;
fi

if [[ ! -f "$reportFile" ]]
then
    echo "Error: Can not find report file: $reportFile";
    exit 1;
fi

if [[ ! -f "queue.json" ]]
then
    echo "Could not find queue.json in $DIR, creating it..."
    touch "$DIR/queue.json";
fi

echo "Converting report to Jira payload"
php -f "$DIR/queueIssues.php"
echo "Done";
