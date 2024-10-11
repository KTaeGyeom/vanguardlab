      <?php 
        $CI =& get_instance();
        $CI->load->library('view_library');

        echo $CI->view_library->html_title('history', 'Report Monitoring', '<button id="purge_btn" type="button" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm" title="Purge log" data-toggle="modal" data-target="#modalPurge""><i class="fas fa-trash-alt"></i></button>'); // icon, title
    ?>

      <!-- Purge -->
      <div class="modal fade" id="modalPurge" tabindex="-1" role="dialog" aria-labelledby="modalLablePurge" aria-hidden="true" data-keyboard="false" data-backdrop="static">>
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modalLablePurge">Purge log</h4>
            </div>
            <form id="formPurge" action="#" method="post" accept-charset="utf-8" onsubmit="return false;">
            <div class="modal-body">
              <div class="form-group row">
                <iframe id="purgeFrame" width="100%" height="400px" frameborder="0" marginwidth="0" marginheight="0" scrolling="yes" style="overflow-x: scroll;"></iframe>
              </div>
          </div>
            <div class="modal-footer">
              <div class="input-group row col-sm">
                <div class="input-group-prepend"><span class="input-group-text" title="Purge history before"><i class="fas fa-fw fa-calendar-alt"></i></span></div>
                <input id="purgeCount" type="number" class="form-control form-control-sm" name="purgeCount" value="30" style="text-align:right;" required>
                <select id="purgeType" class="form-control form-control-select form-control-sm" name="purgeType">
                  <option value="daily">Daily</option>
                  <option value="monthly">Monthly</option>
                </select>
              </div>

              <!-- <label class="col-sm-4 col-form-label col-form-label-sm">Purge history before</label>
              <input id="purgeCount" type="text" class="form-control form-control-sm" name="purgeCount" value="30" style="text-align:right;" required>
              <select id="purgeType" class="form-control form-control-select form-control-sm" name="purgeType">
                <option value="day">days</option>
                <option value="count">count</option>
              </select> -->
              <button id="btnClose" type="button" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm" title="Cancel" data-dismiss="modal"><i class='fas fa-times'></i> Cancel</button>
              <button id="btnPurge" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" title="Submit"><i class='fas fa-check'></i> Submit</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Purge -->

      <?php
        // ag-grid master
        echo $CI->view_library->html_gridFullHeader('height:calc(40vh - 100px)'); // style
          echo $CI->view_library->html_buttonBarOpen('filter-text-box', 'onFilterTextBoxChanged'); // filterId, filterEvent
            echo $CI->view_library->html_buttonBarItem('sizeToFit', 'sizeToFit', 'sizeToFit'); // itemType, itemId, eventName
            echo $CI->view_library->html_buttonBarItem('autoSizeAll', 'autoSizeAll', 'autoSizeAll');
            echo $CI->view_library->html_buttonBarItem('Download', 'btnDownload', 'onDownload');
            echo $CI->view_library->html_buttonBarItem('Refresh', 'btnRefresh', 'onRefreshRow');
          echo $CI->view_library->html_buttonBarClose();
          echo $CI->view_library->html_selectedRows('selectedRows');
          echo $CI->view_library->html_grid('myGrid', 'width:100%; height:calc(100% - 70px);', '', $this->session->userdata('theme')); // gridName, style, message
        echo $CI->view_library->html_gridFullFooter();

        // ag-grid detail
        echo $CI->view_library->html_gridFullHeader('height:calc(60vh - 60px)'); // style
          echo $CI->view_library->html_buttonBarOpen('filter-text-box2', 'onFilterTextBoxChanged2'); // filterId, filterEvent
            echo $CI->view_library->html_buttonBarItem('sizeToFit', 'sizeToFit2', 'sizeToFit2'); // itemType, itemId, eventName
            echo $CI->view_library->html_buttonBarItem('autoSizeAll', 'autoSizeAll2', 'autoSizeAll2');
            echo $CI->view_library->html_buttonBarItem('Download', 'btnDownload2', 'onDownload2');
            echo $CI->view_library->html_buttonBarItem('Refresh', 'btnRefresh2', 'onRefreshRow2');
          echo $CI->view_library->html_buttonBarClose();
          echo $CI->view_library->html_selectedRows('selectedRows2');
          echo $CI->view_library->html_grid('myGrid2', 'width:100%; height:calc(100% - 50px);', '', $this->session->userdata('theme')); // gridName, style, message
        echo $CI->view_library->html_gridFullFooter();
      ?>

      <script type="text/javascript" charset="utf-8">
        // specify the columns
        var columnDefs = [
          { headerName: "Id", field: "Id", width: 10, hide: true },
          { headerName: "Start time", field: "StartTime", cellStyle: { 'text-align': "center" }, width: 150 },
          { headerName: "End time", field: "EndTime", cellStyle: { 'text-align': "center" }, width: 150 },
          { headerName: "Duration", field: "Duration", cellStyle: { 'text-align': "center" }, width: 150 },
          { headerName: "Report name", field: "ReportName", width: 300 },
          { headerName: "Master filename", field: "MasterFilename", width: 300 },
          { headerName: "Status", field: "Status", cellStyle: { 'text-align': "center" }, width: 100,
              cellClassRules: {
                'ag-grid-error': function(params) { return params.value === "Error" },
              },
            },
          { headerName: "Message", field: "Message" }
        ];

        var columnDefs2 = [
          { headerName: "Id", field: "Id", width: 10, hide: true },
          { headerName: "Start time", field: "StartTime", cellStyle: { 'text-align': "center" }, width: 150 },
          { headerName: "End time", field: "EndTime", cellStyle: { 'text-align': "center" }, width: 150 },
          { headerName: "Duration", field: "Duration", cellStyle: { 'text-align': "center" }, width: 150 },
          { headerName: "Report name", field: "ReportName", width: 300 },
          { headerName: "Report filename", field: "ReportFilename", width: 300 },
          { headerName: "File size", field: "FileSize", cellStyle: { 'text-align': "right" }, width: 100, valueFormatter: formatNumber },
          { headerName: "Data count", field: "DataCount", cellStyle: { 'text-align': "right" }, width: 100, valueFormatter: formatNumber },
          { headerName: "Status", field: "Status", cellStyle: { 'text-align': "center" }, width: 100,
              cellClassRules: {
                'ag-grid-error': function(params) { return params.value === "Error" },
              },
            },
          { headerName: "Message", field: "Message" }
        ];

        function formatNumber(number) {
            return Math.floor(number.value).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        }

        // Call request grid data
        function loadGridData2() {
          var id = document.querySelector('#selectedRows').innerHTML;
          var httpRequest = new XMLHttpRequest();
          
          if (id != "") {
            httpRequest.open('POST', '<?php echo base_url(); ?>monitoring/monitoring_detail_json/' + id);
            httpRequest.send();
            httpRequest.onreadystatechange = function() {
              if (httpRequest.readyState === 4 && httpRequest.status === 200) {
                var httpResult = JSON.parse(httpRequest.responseText);
                gridOptions2.api.setRowData(httpResult);
              }
            };
          }
        }

        // Setup the grid after the page has finished loading
        document.addEventListener('DOMContentLoaded', function() {
          var gridDiv = document.querySelector('#myGrid');
          new agGrid.Grid(gridDiv, gridOptions);
          loadGridData();

          var gridDiv2 = document.querySelector('#myGrid2');
          new agGrid.Grid(gridDiv2, gridOptions2);
          loadGridData2();
        });

        // Set selection when change selection
        function onSelectionChanged() {
          var selectedRows = gridOptions.api.getSelectedRows();
          var selectedRowsString = '';
          selectedRows.forEach( function(selectedRow, index) {
            if (index!==0) {
              selectedRowsString += ', ';
            }
            selectedRowsString += selectedRow.Id;
          });
          document.querySelector('#selectedRows').innerHTML = selectedRowsString;
          
          loadGridData2(); // Call log contents
        }

        function onSelectionChanged2() {
        }

        // Purge and hide closeButton
        $('#btnPurge').on('click', function() {
          $('#btnClose').attr('disabled', true);
          $('#btnPurge').attr('disabled', true);
          var purgeType = $('#purgeType').val();
          var purgeCount = $('#purgeCount').val();
          var purgeUrl = '<?php echo base_url(); ?>monitoring/purge/' + purgeCount + '/' + purgeType;
          //alert("'" + purgeUrl + "'");
          $('#purgeFrame').attr('src', purgeUrl);
          onRefreshRow();
          onRefreshRow2();
        });

        // Show closeButton after Load frame
        $('#purgeFrame').on('load', function() {
          $('#btnClose').attr('disabled', false);
          $('#btnPurge').attr('disabled', false);
        });

        // Reset frame after modal hide
        $('#modalPurge').on('hide.bs.modal', function () {
          $('#purgeFrame').attr('src', 'about:blank');
        });

      </script>

      <?php
        echo $CI->view_library->js_Header();
          echo $CI->view_library->js_gridOptions('gridOptions', 'columnDefs');
          echo $CI->view_library->js_sizeToFit('gridOptions');
          echo $CI->view_library->js_autoSizeAll('gridOptions');
          echo $CI->view_library->js_onFilterTextBoxChanged('gridOptions');
          echo $CI->view_library->js_onRefreshRow('gridOptions');
          echo $CI->view_library->js_onDownload('gridOptions');
          echo $CI->view_library->js_loadGridData('gridOptions', 'monitoring/monitoring_json');

          echo $CI->view_library->js_gridOptions('gridOptions2', 'columnDefs2', 'onSelectionChanged2');
          echo $CI->view_library->js_sizeToFit('gridOptions2', 'sizeToFit2');
          echo $CI->view_library->js_autoSizeAll('gridOptions2', 'autoSizeAll2');
          echo $CI->view_library->js_onFilterTextBoxChanged('gridOptions2', 'filter-text-box2', 'onFilterTextBoxChanged2');
          echo $CI->view_library->js_onRefreshRow('gridOptions2', 'onRefreshRow2', 'loadGridData2');
          echo $CI->view_library->js_onDownload('gridOptions2', 'onDownload2');
        echo $CI->view_library->js_Footer();
      ?>

      <!-- ag-grid -->
