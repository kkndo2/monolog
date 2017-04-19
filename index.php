<?php
require 'vendor/autoload.php';

use \Monolog\Logger as Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;


// 로거 채널 생성
$log =  new Logger('test');

// log/your.log 파일에 로그 생성. 로그 레벨은 Info
$log->pushHandler(new StreamHandler('log/your.log', Logger::ERROR));
//$log->pushHandler(new RotatingFileHandler('log/your2.log', Logger::INFO));

// add records to the log
$log->addInfo('Info log');
$log->addDebug('Debug log');
$log->addError('Error log');