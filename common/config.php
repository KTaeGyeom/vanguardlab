<?php

  /*--------------------------------------------------------------
   # Set Environments
   --------------------------------------------------------------*/
   /* Page Location */
  //define ('PAGE_HOME', '/_HISTORY/2022/');
  define ('PAGE_HOME', '');
  // define( 'PAGE_HOME', siteURL() );
  define ('FILE_HOME', dirname(__FILE__) . '/../');

  /* Image file location */
  $logoPath = PAGE_HOME . '/img/logo/';

  /* Database filename */
  define ('DB_FILE', FILE_HOME . 'common/vanguardlab.sqlite');

  /* Set Database filename */
  $MenuXml = simplexml_load_file(FILE_HOME . 'common/menu.xml');


  /* Open databae */
  class MyDB extends SQLite3 {
    function __construct() {
      $this->open(DB_FILE);
    }
  }

  $db = new MyDB();
  if (!$db) {
      echo "데이터베이스에 접속할 수 없습니다 : " . $db->lastErrorMsg();
  } else {
    //echo "Opened database successfully <br />";
  }


  /*--------------------------------------------------------------
   # Functions
   --------------------------------------------------------------*/

  // Get sitename
  function getSiteUrl() {
      $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
      $domainName = $_SERVER['HTTP_HOST'];
      return $protocol.$domainName;
  }

  // Get page url
  // function getPageUrl() {

  //   foreach($MenuXml->Menu as $menu) {
  //     $nodeCount = count($menu->SubMenu);

  //     if ($nodeCount == 0) {
  //       if (isset($menu['target']))
  //         echo '    <li><a href="' . $menu['url'] . '" target="' . $menu['target'] . '">' . $menu['text'] . '</a></li>' . PHP_EOL;
  //       else
  //         echo '    <li><a href="' . PAGE_HOME . '/' . $menu['url'] . '">' . $menu['text'] . '</a></li>' . PHP_EOL;
  //     } else {
  //       echo '      <li class="dropdown"><a href="#"><span>' . $menu['text'] . '</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>' . PHP_EOL;
  //       echo '        <ul>' . PHP_EOL;
  //       foreach($menu->SubMenu as $submenu) {
  //           echo '        <li><a href="' . PAGE_HOME . '/' .$submenu['url'] . '">' . $submenu['text'] . '</a></li>' . PHP_EOL;
  //       }
  //     }
  //   }

  // }

?>