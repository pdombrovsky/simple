<?php

require_once('vendor/autoload.php');

defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: __DIR__);

define('AWS_ACCESS_KEY_ID', getenv('AWS_ACCESS_KEY_ID') ?: '');
define('AWS_SECRET_ACCESS_KEY', getenv('AWS_SECRET_ACCESS_KEY') ?: '');

define('REGION', getenv('REGION') ?: 'eu-west-1');
define('VERSION', getenv('VERSION') ?: 'latest');
define('ENDPOINT', getenv('ENDPOINT') ?: 'dynamodb-local:8000');