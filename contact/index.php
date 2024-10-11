<?php $page_title = "Contact" ?>
<?php include_once "../common/config.php"; ?>
<?php include_once "../common/pageHeader.php"; ?>

  <main id="main">

    <!-- Breadcrumbs -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex">
          <h2>Contact</h2>
          <!-- <ol>
            <li><a href="/index.php">Home</a></li>
            <li>Contact</li>
          </ol> -->
        </div>

      </div>
    </section>
    <!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">

        <div class="section-title">
          <h2>찾아오시는 길</h2>
        </div>

        <section class="map">
          <div class="container" data-aos="fade-up">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1537.943102604644!2d126.8961396035475!3d37.483937862489135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357c9e24f25b8799%3A0x6093f94dd623a869!2z7L2U7Jik66Gx65SU7KeA7YS47YOA7JuM67mM656A7Yq4!5e0!3m2!1sko!2skr!4v1643251755144!5m2!1sko!2skr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            <div class="tableType mt30">
              <table>
                <colgroup>
                  <col style="width: 20%;" />
                  <col />
                  <col style="width: 20%;"/>
                  <col />
                </colgroup>
                <tbody>
                  <tr>
                    <th scope="row">주소</th>
                    <td colspan="3">[08390] 서울시 구로구 디지털로32길 30, 1201호(코오롱디지털타워빌란트1차)</td>
                  </tr>
                  <tr>
                    <th scope="row">전화번호</th>
                    <td>02-2103-5567</td>
                    <th scope="row" class="line">팩스번호</th>
                    <td>02-2103-5566</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </section>

        <section class="">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>문의 담당자</h2>
            </div>
            <!-- <h4 class="text_small_tit mt50">문의 담당자</h4> -->

            <div class="tableType">
              <table summary="제안, 구축, 기술 문의">
                <colgroup>
                  <col width="40%" />
                  <col />
                </colgroup>
                <thead>
                <tr>
                  <th scope="col" class="">분류</th>
                  <th scope="col" class="noline-left">이메일</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td class="noline-left al_center">제안, 구축 문의</td>
                  <td>contact@vanguardlab.net</td>
                </tr>
                <tr>
                  <td class="noline-left al_center">기술지원 문의</td>
                  <td>support@vanguardlab.net</td>
                </tr>
                <tr>
                  <td class="noline-left al_center">채용 문의</td>
                  <td>recruit@vanguardlab.net</td>
                </tr>
              </table>
            </div>

          </div>
        </section>

      </div>
    </section>

  </main><!-- End #main -->

<?php include_once "../common/pageFooter.php"; ?>
