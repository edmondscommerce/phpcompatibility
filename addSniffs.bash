#!/usr/bin/env bash
echo "Adding PHP Compatibility Sniff Path"
php vendor/bin/phpcs --config-set installed_paths vendor/wimg/php-compatibility
echo "Done";