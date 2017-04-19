<?php
/**
 * 로그에 기타 정보 출력 방법
 *
 */

require 'vendor/autoload.php';

use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

$log = new Logger('extra');
$log->pushHandler(new StreamHandler('log/extra.log', Logger::INFO));
$log->addInfo('log message', array('id'=>'kkndo2', 'name'=>'이상철'));