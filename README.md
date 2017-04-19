# monolog
PSR-3을 준수하는 php 로그 모듈

## 컴포저를 통한 설치
```
composer require monolog/monolog
```

## 기본개념
* 로그객체 생성후에, 로그가 실제로 작성될 핸들러를 여러개 등록할 수 있음. 각 핸들러들의 처리방법에따라 하나의 로그이벤트에대해서 여러개의 로그가 작성됨. 
* 각 핸들러가 호출되는 과정중에, 이벤트 버블링 개념이 있는 것 같음. `HandlerInterface` 의 `handle` 메소드 정의를 보면, 버블링을 멈추고싶으면 true 를 반환하면 됨. 로그 핸들러를 커스터마이징해서 새로 정의하는 경우에 참고해서 제작해야할 듯. 
* 채널 : 로그객체 한개를 의미. 로그를 남기게 되는 주체로 봐도될 것 같음. 디비에 관련된 로그, 비즈니스 로직에 관련된 로그. http 요청처리에 관한 로그 등.. 로그에대한 정의로 보면 될 듯.  
* 레코드 : 핸들러에 전달되는 로그 1건에 대한 구조체를 의미. 해당 로그안에 monolog에서 정의한 다양한 정보들이 각 핸들러에 전달됨. 
* 핸들러 : 전달받은 레코드를 가지고 실제 로그 작성을 담당함. 핸들러=로그작성방법 으로 봐도 될 것 같음. 
* 포매터 : 레코드 구조체 안에 포함된 로그 포맷. 커스터마이징해서 로그포맷을 변경할 수 있음.
 로그를 실제작성하는 핸들러에 포매터를 생성해서 등록하는 구조. `/format.php` 에 샘플있음
* 프로세서 : 핸들러에 레코드 구조체가 전달되기전에, 레코드 구조체 에대한 변형을 가할 콜백함수를 등록할 수 있다. 해당 콜백함수는 레코드 구조체를 인자로 받고, 처리끝난 레코드 구조체를 반환해줘야함. push/pop 구조로 여러개의 프로세스를 등록 할 수 있음. 
* 로그 등급 : 핸들러마다 위험도 등급이 지정되어 있어서, 해당 등급보다 높은경우만 로그 가 작성됨. 
  관련하여, 각 상황의 위험도에따른 처리를 아래와같은 구조로 하는게 어떨까 함.
  
    A안) 디버깅모드인경우, dev.log가 기록되고,  워닝이상의 정보가 log.txt 와 dev.log에 중복되어 기록되는 case
    ``` php
    $logger_db = new Logger('db'); //디비처리 로거
    $logger_req = new Logger('request'); //http요청처리 로거
    
    $logger_db->pushHandler(시스템 관리자에게 메일발송핸들러(크리티컬));
    $logger_db->pushHandler(log.txt 파일로그핸들러(워닝));
    if(실행모드==디버깅){ // 이부분에 따른 세분화는 실제프로젝트에서 고민하면됨. 
        $logger_db->pushHandler(dev.txt 파일로그핸들러(디버그));
    }//end if
    
    if(디비접속실패){
        $logger_db->addEmergency('디비접속안됨');
    }//end if
    ```
    B안) 디버깅모드인경우, log.txt에 디버깅 이상의 정보가 추가되어 기록되는 case. 로그파일이 실행모드에 상관없이 항상 동일하게 유지
    ``` php
    $logger_db = new Logger('db'); //디비처리 로거
    $logger_req = new Logger('request'); //http요청처리 로거
    
    $logger_db->pushHandler(시스템 관리자에게 메일발송핸들러(크리티컬));
    $level=워닝; //로그 위험도
    if(실행모드==디버깅){ // 이부분에 따른 세분화는 실제프로젝트에서 고민하면됨. 
        $level=디버깅;
    }//end if
    $logger_db->pushHandler(log.txt 파일로그핸들러($level));
    
    if(디비접속실패){
        $logger_db->addEmergency('디비접속안됨');
    }//end if
    ```

## 참고링크
* [모노로그 github](https://github.com/Seldaek/monolog)
* https://www.lesstif.com/pages/viewpage.action?pageId=23757072
* http://blog.appkr.kr/work-n-play/php-application-logging-to-elasticsearch-using-monolog/

