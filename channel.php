<?php
/**
 * 채널 활용법
 * 각기 다른 채널을 따로 생성한 후, 핸들러를 같은걸 등록하거나
 * 어차피 같은 핸들러를 사용한다면, 이름만 변경해서 또다른 로거를 생성해도 됨
 */

require 'vendor/autoload.php';

use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

$stream = new StreamHandler('log/channel.log', Logger::DEBUG);
$stream2 = new StreamHandler('log/channel2.log', Logger::DEBUG);


$logger = new Logger('logger1');
$logger->pushHandler($stream);
$logger->pushHandler($stream2);

$logger2 = new Logger('logger2'); // 따로 로거 생성해서 스트림만 공유해서 사용한 경우
$logger2->pushHandler($stream);
$logger2->pushHandler($stream2);

$logger3 = $logger->withName('logger3');//채널이름 변경해서 새로운 객체로 카피한 경우

$logger->addDebug('debug message');
$logger2->addDebug('debug message2');
$logger3->addDebug('debug message333333');

$logger->pushProcessor(function($recode){
    $recode['message']='로그메세지';
    return $recode;
});
$logger->addDebug('debug message');
$logger2->addDebug('debug message2');
$logger3->addDebug('debug message333333');