  <!-- 팝업_시작 (Smart Report) -->
  <!-- <div id="pop-layer" class="pop-layer" style="top: 400px; left: 600px; width: 300px;"> -->
  <!-- <div id="pop-layer" class="pop-layer">
    <div id="pop-content">
      <a href="business/smartreport/smartreport.php" title="Smart Report 페이지로 이동">
        <img src="<?php echo PAGE_HOME ?>/business/smartreport/img/img_smartreport_ad.png" alt="스마트리포트" />
      </a>
    </div>
    <div class="btn-r">
      <p id="pop-close" class="btn-layerClose">Close</p>
    </div>
  </div>

  <script>
      $("#pop-close").click(function() {
        $("#pop-layer").hide();
        return false;
        });
  </script> -->
  <!-- 팝업_끝 -->

  <!-- 팝업_시작 (송파 비즈밸리 인터뷰) -->
  <!-- <div id="pop-layer" class="pop-layer" style="top: 400px; left: 1050px; width: 500px;"> -->
  <!-- <div id="pop-layer" class="pop-layer">
    <div id="pop-content">
      <a href="http://songpa.bizvalley.or.kr/html/tenant/company_interview.asp?no=281" target="_blank" title="기업 인터뷰 페이지로 이동">
        <img src="<?php echo PAGE_HOME ?>/image/promotion/20211026_msonpa_bizvally.png" alt="문정비즈밸리 기업 인터뷰" />
      </a>
    </div>
    <div class="btn-r">
      <p id="pop-close" class="btn-layerClose">Close</p>
    </div>
  </div>

  <script>
      $("#pop-close").click(function() {
        $("#pop-layer").hide();
        return false;
        });
  </script> -->
  <!-- 팝업_끝 -->

  <!-- 팝업_시작 (FIT MOU 체결) -->
  <div id="popup" class="popup">
    <div id="content" data-aos="fade-up">
      <a href="https://n.news.naver.com/article/018/0005154080" target="_blank" title="㈜에프아이티, 금융IT전문기업 ㈜뱅가드랩과 업무협약 체결 페이지로 이동">
        <img src="<?php echo PAGE_HOME ?>/popup/img/20220224_edaily_mou.png" alt="㈜에프아이티, 금융IT전문기업 ㈜뱅가드랩과 업무협약 체결" />
      </a>
    </div>
    <div class="popup-close">
      <form method="post" action="" name="popup_form">
        <span id="check"><input type="checkbox" name="chkbox" id="checkday" /><label for="checkday">오늘 하루 이 창 열지 않기</label></span>
        &nbsp;&nbsp;&nbsp;
        <span id="popup-close" class="btn-close"></span>
      </form>
    </div>
  </div>

  <script>
    // 쿠키 가져오기
    var getCookie = function (cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
        }
        return "";
    }

    // 24시간 기준 쿠키 설정하기  
    var setCookie = function (cname, cvalue, exdays) {
        var todayDate = new Date();
        todayDate.setTime(todayDate.getTime() + (exdays*24*60*60*1000));    
        var expires = "expires=" + todayDate.toUTCString(); // UTC기준의 시간에 exdays인자로 받은 값에 의해서 cookie가 설정 됩니다.
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }

    var popupClose = function(){
        if($("input[name='chkbox']").is(":checked") == true){
            setCookie("popup-close","Y",1);   //기간( ex. 1은 하루, 7은 일주일)
        }
        $("#popup").hide();
    }
    
    $(document).ready(function(){
        var cookiedata = document.cookie;
        // if(cookiedata.indexOf("popup-close=Y")<0){
        //     $("#popup").show();
        // } else{
        //     $("#popup").hide();
        // }
        if(cookiedata.indexOf("popup-close=Y")>=0){
          $("#popup").hide();
        }
        $("#popup-close").click(function(){
            popupClose();
        });
    });

    // $("#pop-close").click(function() {
    //   $("#popup").hide();
    //   return false;
    //   });
    // $("#pop-layer").click(function() {
    //   $("#popup").hide();
    //   return false;
    //   });
  </script>
  <!-- 팝업_끝 -->
