<?php
/**
 * 날짜별 파일 테스트
 */

require 'vendor/autoload.php';

use \Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

$stream = new RotatingFileHandler('log/rotate.log', Logger::DEBUG);
$logger=new Logger('app');
$logger->pushHandler($stream);
$logger->addDebug('debug message');