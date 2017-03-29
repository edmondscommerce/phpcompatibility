#!/usr/bin/env bash
readonly DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )";
cd $DIR;
source "./_top.inc.bash"

function usage(){

echo "

This script will run the code sniffer with PHP 7 standards checks against the target directory
Only PHP and PHTML files will be checked and all non-php files and JS etc will be ignored

Usage:

./$0 [targetPath] (ignoreWarnings=false) (reportFile=\"report.json\")

"
}

if (( $# < 1 ))
then
    usage
    exit 1
fi

### Parameters ###
targetPath="$1"
ignoreWarnings=${2:-"false"}
reportFile=${3:-"report.json"}

commandFlags="--standard=PHPCompatibility \
--runtime-set testVersion 7.0 \
--extensions=php,phtml \
--report-file=$reportFile \
--report=json \
-p";
if [[ "$ignoreWarnings" == "true" ]]
then
    commandFlags="$commandFlags \
    -n"
fi

arguments="$commandFlags $targetPath"
echo "
Running checks for PHP7 compatibility
";

eval "$DIR/../vendor/bin/phpcs $arguments";
