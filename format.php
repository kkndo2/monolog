<?php
/**
 * 포맷 커스터마이징 샘플
 */
require 'vendor/autoload.php';

use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use \Monolog\Formatter\LineFormatter;

//기본 포맷 핸들러
$log = new Logger('normal');//로거생성
$stream = new StreamHandler('log/format.log', Logger::DEBUG);
$log->pushHandler($stream);
$log->addDebug('포맷테스트');
//기본 포맷 핸들러 끝

//포맷 커스터마이징
$log = new Logger('cust');//로거생성
$stream = new StreamHandler('log/format.log', Logger::DEBUG);
$formatter = new LineFormatter( "%datetime% > %level_name% > %message% %context% %extra%\n", "Y n j, g:i a");
$stream->setFormatter($formatter);
$log->pushHandler($stream);
$log->addDebug('포맷테스트');
//포맷 커스터마이징 끝