#!/usr/bin/env bash

readonly DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )";
cd $DIR;
source "./_top.inc.bash"

function usage(){

echo "

This script will run the code sniffer with PHP 7 standards checks against the target directory
Only PHP and PHTML files will be checked and all non-php files and JS etc will be ignored

Usage:

./$0 [targetPath]

"
}

if (( $# < 1 ))
then
    usage
    exit 1
fi

### Paramaters ###
targetPath="$1"

echo "
Running checks for PHP7 compatibility
";