#!/usr/bin/env bash
readonly DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )";
cd $DIR;
source "./_top.inc.bash"

function usage(){

echo "

This script will run the code sniffer with PHP compatibility checks against the target directory and PHP version
Only PHP and PHTML files will be checked and all non-php files and JS etc will be ignored

Usage:

./$0 [targetPath] (phpVersion=7.0) (warningSeverity=5) (reportType="json") (reportFile=\"report.json\")

"
}

if (( $# < 1 ))
then
    usage
    exit 1
fi

### Parameters ###
targetPath="$1"
phpVersion=${2:-"7.0"}
warningSeverity=${3:-"5"}
reportType=${4:-"json"};
reportFile=${5:-"report.json"}

echo "Generating compatibility report for $phpVersion for code in $targetPath to a $reportType report format and logging it to $reportFile"
echo "Warning severity level $warningSeverity":

commandFlags="--standard=PHPCompatibility \
--runtime-set testVersion 7.0 \
--extensions=php,phtml \
--report-file=$reportFile \
--warning-severity=$warningSeverity \
-d memory_limit=1024M \
--ignore=public/dev \
--report=$reportType \
-p";

arguments="$commandFlags $targetPath"
echo "
Running checks for PHP7 compatibility
";

eval "$DIR/../vendor/bin/phpcs $arguments";
