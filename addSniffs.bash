#!/usr/bin/env bash
echo "Adding PHP Compatibility Sniff Path"
cp ./vendor/wimg/php-compatibility ./vendor/squizlabs/php_codesniffer/CodeSniffer/Standards/PHPCompatibility -r
#php vendor/bin/phpcs --config-set installed_paths vendor/wimg/
echo "Done";

