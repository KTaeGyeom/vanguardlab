<?php 

  function siteURL()
  {
      $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
      $domainName = $_SERVER['HTTP_HOST'].'/';
      return $protocol.$domainName;
  }
  define( 'SITE_URL', siteURL() );

  echo 'DOCUMENT_ROOT (현재 사이트가 위치한 서버상의 위치):' . $_SERVER['DOCUMENT_ROOT'] . '<br />';
  echo 'HTTP_ACCEPT_ENCODING (인코딩 방식):' . $_SERVER['HTTP_ACCEPT_ENCODING'] . '<br />';
  echo 'HTTP_ACCEPT_LANGUAGE (언어):' . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . '<br />';
  echo 'HTTP_USER_AGENT (사이트에 접속한 사용자 환경):' . $_SERVER['HTTP_USER_AGENT'] . '<br />';
  echo 'REMOTE_ADDR (사이트 접속한 사용자 IP):' . $_SERVER['REMOTE_ADDR'] . '<br />';
  echo 'SCRIPT_FILENAME (실행되고 있는 위치와 파일명):' . $_SERVER['SCRIPT_FILENAME'] . '<br />';
  echo 'SERVER_NAME (사이트 도메인):' . $_SERVER['SERVER_NAME'] . '<br />';
  echo 'SERVER_PORT (사이트가 사용하는 포트):' . $_SERVER['SERVER_PORT'] . '<br />';
  echo 'SERVER_SOFTWARE (서버의 소프트웨어 환경):' . $_SERVER['SERVER_SOFTWARE'] . '<br />';
  echo 'GATEWAY_INTERFACE (CGI 정보):' . $_SERVER['GATEWAY_INTERFACE'] . '<br />';
  echo 'SERVER_PROTOCOL (사용된 서버 프로토콜):' . $_SERVER['SERVER_PROTOCOL'] . '<br />';
  echo 'REQUEST_URI (현재페이지의 주소에서 도메인 제외):' . $_SERVER['REQUEST_URI'] . '<br />';
  echo 'PHP_SELF (현재페이지의 주소에서 도메인과 넘겨지는 값 제외):' . $_SERVER['PHP_SELF'] . '<br />';
  echo 'APPL_PHYSICAL_PATH (현재페이지의 실제 파일 주소):' . $_SERVER['APPL_PHYSICAL_PATH'] . '<br />';

  echo 'SITE_URL (SITE_URL):' . SITE_URL . '<br />';


  echo 'Memory Usage: ' . number_format(memory_get_usage()) . ' bytes';
  phpinfo(); 
?>