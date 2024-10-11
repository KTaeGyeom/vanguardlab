<?php $page_title = "References" ?>
<?php include "../common/config.php"; ?>
<?php include "../common/pageHeader.php"; ?>

  <main id="main">

    <!-- Breadcrumbs -->
    <section class="breadcrumbs">
      <div class="container">
        <div class="d-flex">
          <h2>References</h2>
          <ol>
            <li><a id="change-mode" onclick="toggleFunction()" href="#" title="Change View Mode"><i id="change-class" class="bi bi-table"></i></a></li>
          </ol>
        </div>
      </div>
    </section>
    <!-- End Breadcrumbs -->

    <section class="inner-page">

      <div class="container">

        <!-- Gallery mode Section -->
        <section id="gallery-mode" class="portfolio">

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

              <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">All</li>
                <li data-filter=".mendix">Mendix</li>
                <li data-filter=".financial">Financial</li>
                <li data-filter=".solution">Solution</li>
                <li data-filter=".perfectwin">PerfecTwin</li>
                <li data-filter=".cloud">Cloud</li>
                <li data-filter=".consulting">Consulting</li>
                <li data-filter=".ito">ITO</li>
                <li data-filter=".t2018">2018</li>
                <li data-filter=".t2019">2019</li>
                <li data-filter=".t2020">2020</li>
                <li data-filter=".t2021">2021</li>
                <li data-filter=".t2022">2022</li>
                <li data-filter=".t2023">2023</li>
                <li data-filter=".t2024">2024</li>
              </ul>

              <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

<?php
  //프로젝트 (sqlite db에서 읽어 와서 표시)
  $result = $db->query("SELECT r.id, r.project, r.customer, r.term, r.content, p.logo, p.icon, r.istop, r.display, r.tag FROM Reference r LEFT JOIN party p ON p.name  = r.customer and  p.type = 'client' WHERE r.display = 'Y' ORDER BY r.term DESC;");
  while($node = $result->fetchArray(SQLITE3_ASSOC)) {
?>

                <div class="col-lg-4 col-md-6 portfolio-item isotope-item <?php echo $node['tag'] . ' t' . substr($node['term'],0,4) . ' t' . substr($node['term'],10,4)?>" style="height: 4rem;">
                  <div class="portfolio-content h-100" style="padding-left: 2.5rem; text-indent: -2rem; padding-right: 0.5rem; padding-top: 0.2rem; margin-left: 10px; margin-right: 10px;">
                    <img src="<?php echo $logoPath . $node['icon'] ?>" width="20px" class="img-fluid" alt="" style="margin-left: 10px;">
                    <?php echo $node['project'] . '</br>' . '(' . $node['term'] . ')' ?>
                    <div class="portfolio-info" style="padding-top: 3.3rem;">
                      <p><?php echo $node['content'] ?></p>
                    </div>
                  </div>
                </div>

<?php
}
?>

              </div>

            </div>

          </div>

        </section>
        <!-- Gallery mode Section -->


        <!-- List mode Section -->
        <section id="list-mode" class="reference" style="display:none">
          <div class="container" data-aos="fade-up">

            <!-- <div class="section-title">
              <h2>List mode</h2>
            </div> -->

            <div class="tableType">
              <table summary="구축 사례">
                <colgroup>
                  <col width="30%" />
                  <col width="50%" />
                  <col width="20%" />
                </colgroup>
                <thead>
                  <tr>
                    <th scope="col" class="first">발주기관</th>
                    <th scope="col">사업명</th>
                    <th scope="col" class="noline-left">기간</th>
                  </tr>
                </thead>
                <tbody>
<?php
// 전체 프로젝트 (sqlite db에서 읽어 와서 표시)
$result = $db->query("SELECT * FROM Reference WHERE display = 'Y' ORDER BY term DESC;");
while($node = $result->fetchArray(SQLITE3_ASSOC)) {
?>

                  <tr>
                    <td class="noline-left"><?php echo $node['customer'] ?></td>
                    <td><?php echo $node['project'] ?></td>
                    <td class="center"><?php echo $node['term'] ?></td>
                  </tr>

<?php
}
?>
                </tbody>
              </table>
            </div>

          </div>
        </section>
        <!-- List mode Section -->

        <script>
          function togglebyId(id) {
            var x = document.getElementById(id);
            if (x.style.display === "none") {
              x.style.display = "block";
            } else {
              x.style.display = "none";
            }
          }

          function toggleFunction() {
            togglebyId("gallery-mode");
            togglebyId("list-mode");

            var x = document.getElementById("change-class");
            if (x.className == "bi bi-table") {
              x.className = "bi bi-card-image";
            } else {
              x.className = "bi bi-table";
            }
          }
        </script>

      </div>
    </section>

  </main><!-- End #main -->

  <?php include_once "../common/pageFooter.php"; ?>
