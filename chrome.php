<?php
/**
 * 크롬 개발자도구 로그 테스트
 * 크롬에 http://www.chromephp.com/ 에서 제공한 확장프로그램을 설치해야 로그확인 가능하다.
 * 정상적인 html 문서가 아닌경우에는 ( body 태그가 없는경우) 에는 크롬 콘솔창에 로그가 두번씩 중복되어 출력된다.
 *
 */

require 'vendor/autoload.php';

use \Monolog\Logger;
use Monolog\Handler\ChromePHPHandler;

$stream = new ChromePHPHandler(Logger::DEBUG);
$logger=new Logger('app');
$logger->pushHandler($stream);
$logger->addDebug('debug message1');
$logger->addDebug('debug message2');

?>
<!doctype html>
<html lang="!">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
