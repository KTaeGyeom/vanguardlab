<?php
  include_once "config.php"; 
  if ( isset( $page_title ) ) {
    $title = $page_title . ' | ' . '뱅가드랩';
  } else {
    $title = '뱅가드랩 &#8211; IT Consulting &amp; Solution Leader';
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <title>뱅가드랩 &#8211; IT Consulting &amp; Solution Leader</title> -->
  <title><?php echo $title ?></title>
  <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="뱅가드랩">
  <meta name="keywords" content="뱅가드랩, VANGUARDLAB, 금융, ERP, 퍼펙트윈, PerfecTwin, 멘딕스, Mendix, 뱅킹, Banking, Global Banking" />
  <meta name="description" content="뱅가드랩은 Mendix, PerfecTwin, Banking, 시스템 통합 서비스를 제공하는 IT 전문 기업입니다." />
  <meta property="og.type" content="website">
  <meta property="og.title" content="뱅가드랩 - Mendix, PerfecTwin, 시스템 통합">
  <meta property="og.description" content="뱅가드랩은 Mendix, PerfecTwin, Banking, 시스템 통합 서비스를 제공하는 IT 전문 기업입니다.">
  <meta property="og.image" content="<?php echo PAGE_HOME ?>/img/logo-basic.png">
  <meta property="og.url" content="http://vanguardlab.net">
  <meta name="naver-site-verification" content="4d586c4fe9c6080037982f34b38dc0b093447fed" />

  <!-- Favicons -->
  <link href="<?php echo PAGE_HOME ?>/img/favicon.ico" rel="icon">
  <link href="<?php echo PAGE_HOME ?>/img/apple-touch-icon.png" rel="apple-touch-icon">


  <!-- Fonts -->
  <link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable.min.css" />

  <!-- Vendor CSS Files -->
  <link href="<?php echo PAGE_HOME ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo PAGE_HOME ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo PAGE_HOME ?>/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?php echo PAGE_HOME ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?php echo PAGE_HOME ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?php echo PAGE_HOME ?>/assets/css/main.css" rel="stylesheet">
  <link href="<?php echo PAGE_HOME ?>/assets/css/main_custom.css" rel="stylesheet">


  <!-- =======================================================
  * Template Name: Vesperr
  * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
  * Updated: Jun 29 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

<!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-153998336-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-153998336-1');
  </script>
  <!-- Global site tag (gtag.js) - Google Analytics -->

  <!-- Header -->
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="<?php echo PAGE_HOME ?>/" class="logo d-flex align-items-center me-auto">
        <img src="<?php echo PAGE_HOME ?>/img/logo-basic.png">
      </a>
      

      <nav id="navmenu" class="navmenu">
        
        <ul>
          <?php
            foreach($MenuXml->Menu as $menu) {
              $nodeCount = count($menu->SubMenu);

              // Target이 있는 경우
              if ($nodeCount == 0) {
                if (isset($menu['target']))
                  echo '    <li><a href="' . $menu['url'] . '" target="' . $menu['target'] . '">' . $menu['text'] . '</a></li>' . PHP_EOL;
                else
                  echo '    <li><a href="' . PAGE_HOME . '/' . $menu['url'] . '">' . $menu['text'] . '</a></li>' . PHP_EOL;
              } else {
                // 상위 메뉴 출력
                echo '      <li class="dropdown"><a href="#"><span>' . $menu['text'] . '</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>' . PHP_EOL;
                echo '        <ul>' . PHP_EOL;
                foreach($menu->SubMenu as $submenu) {
                  // 하위 메뉴 출력
                  if (isset($submenu['target']))
                    echo '        <li><a href="' . $submenu['url'] . '" target="' . $submenu['target'] . '">' . $submenu['text'] . '</a></li>' . PHP_EOL;
                  else
                    echo '        <li><a href="' . PAGE_HOME . '/' .$submenu['url'] . '">' . $submenu['text'] . '</a></li>' . PHP_EOL;
                }
                echo '        </ul>' . PHP_EOL;
                echo '      </li>' . PHP_EOL;
              }
            }
          ?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        

      </nav>
      <!--<div>
        <div class="btn">
            <i class="bi bi-list"></i>
            <div id="full-menu" class="full-nav">
              <ul>
                <!?php
                  foreach($MenuXml->Menu as $menu) {
                    $nodeCount = count($menu->SubMenu);

                    // Target이 있는 경우
                    if ($nodeCount == 0) {
                      if (isset($menu['target']))
                        echo '    <li><a href="' . $menu['url'] . '" target="' . $menu['target'] . '">' . $menu['text'] . '</a></li>' . PHP_EOL;
                      else
                        echo '    <li><a href="' . PAGE_HOME . '/' . $menu['url'] . '">' . $menu['text'] . '</a></li>' . PHP_EOL;
                    } else {
                      // 상위 메뉴 출력
                      echo '      <li class="dropdown"><a href="#"><span>' . $menu['text'] . '</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>' . PHP_EOL;
                      echo '        <ul>' . PHP_EOL;
                      foreach($menu->SubMenu as $submenu) {
                        // 하위 메뉴 출력
                        if (isset($submenu['target']))
                          echo '        <li><a href="' . $submenu['url'] . '" target="' . $submenu['target'] . '">' . $submenu['text'] . '</a></li>' . PHP_EOL;
                        else
                          echo '        <li><a href="' . PAGE_HOME . '/' .$submenu['url'] . '">' . $submenu['text'] . '</a></li>' . PHP_EOL;
                      }
                      echo '        </ul>' . PHP_EOL;
                      echo '      </li>' . PHP_EOL;
                    }
                  }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div-->
      
      <!-- <a class="btn-getstarted" href="index.html#about">ENG</a> -->

    </div>
  </header>
  <!-- End Header -->