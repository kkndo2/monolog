<?php
/**
 * 로그에 기타 정보 출력 방법 - 프로세스를 등록해서 처리
 * 콜백 무명함수를 Process 로 등록하는 방식으로 처리됨.
 * 핸들러가 로그를 처리하기전에  등록한 프로세스가 처리된 후 처리된 레코드 구조체를 핸들러에 전달하는 것 같음.
 * 
 * 프로세스가 나중에 등록된게 먼저 호출됨. push/pop 구조인듯
 */

require 'vendor/autoload.php';

use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

$log = new Logger('extra2');
$log->pushHandler(new StreamHandler('log/extra2.log', Logger::INFO));
$log->pushProcessor(function($recode){

    $recode['extra']['process1']=$recode['message'].' .. .. .. ';
    return $recode;
});
$log->pushProcessor(function($recode){

    $recode['extra']['process2']=$recode['level'].' .. .. .. ';
    return $recode;
});
$log->pushProcessor(function($recode){

    $recode['message']='로그 메세지';
    return $recode;
});
$log->addInfo('log message');
$log->addError('log message');