      <?php 
        $CI =& get_instance();
        $CI->load->library('view_library');

        echo $CI->view_library->html_title('archive', 'System Log'); // icon, title
      ?>

      <?php
        // ag-grid master
        echo $CI->view_library->html_gridFullHeader('height:calc(30vh - 100px)'); // style
          echo $CI->view_library->html_buttonBarOpen('filter-text-box', 'onFilterTextBoxChanged'); // filterId, filterEvent
            echo $CI->view_library->html_buttonBarItem('sizeToFit', 'sizeToFit', 'sizeToFit'); // itemType, itemId, eventName
            echo $CI->view_library->html_buttonBarItem('autoSizeAll', 'autoSizeAll', 'autoSizeAll');
            echo $CI->view_library->html_buttonBarItem('Refresh', 'btnRefresh', 'onRefreshRow');
            echo $CI->view_library->html_buttonBarItem('Download', 'btnDownload', 'onDownload');
          echo $CI->view_library->html_buttonBarClose();
          echo $CI->view_library->html_selectedRows('selectedRows');
          echo $CI->view_library->html_grid('myGrid', 'width:100%; height:calc(100% - 70px);', '', $this->session->userdata('theme')); // gridName, style, message
        echo $CI->view_library->html_gridFullFooter();

        // ag-grid detail
        echo $CI->view_library->html_gridFullHeader('height:calc(70vh - 60px)'); // style
          echo $CI->view_library->html_buttonBarOpen('filter-text-box2', 'onFilterTextBoxChanged2'); // filterId, filterEvent
            echo $CI->view_library->html_buttonBarItem('sizeToFit', 'sizeToFit2', 'sizeToFit2'); // itemType, itemId, eventName
            echo $CI->view_library->html_buttonBarItem('autoSizeAll', 'autoSizeAll2', 'autoSizeAll2');
            echo $CI->view_library->html_buttonBarItem('Refresh', 'btnRefresh2', 'onRefreshRow2');
            echo $CI->view_library->html_buttonBarItem('Download', 'btnDownload2', 'onDownload2');
          echo $CI->view_library->html_buttonBarClose();
          echo $CI->view_library->html_selectedRows('selectedRows2');
          echo $CI->view_library->html_grid('myGrid2', 'width:100%; height:calc(100% - 50px);', '', $this->session->userdata('theme')); // gridName, style, message
        echo $CI->view_library->html_gridFullFooter();
      ?>

      <script type="text/javascript" charset="utf-8">
        // specify the columns
        var columnDefs = [
          { headerName: "File Name", field: "filename", width: 150 },
          //{ headerName: "Type", field: "filetype" },
          { headerName: "Size", field: "filesize", cellStyle: { 'text-align': "right" }, width: 150 },
          { headerName: "Creation Date", field: "filectime", width: 200 },
          { headerName: "Modify Date", field: "fileatime", width: 200 }
        ];

        var columnDefs2 = [
          { headerName: "Level", field: "loglevel", width: 100,
              cellClassRules: {
                'ag-grid-error': function(params) { return params.value === "ERROR" },
              },
            },
          { headerName: "Date", field: "logdate", width: 150 },
          { headerName: "Message", field: "logmessage", width: 500 }
        ];

        function loadGridData2() {
          var logfilename = document.querySelector('#selectedRows').innerHTML;
          var httpRequest = new XMLHttpRequest();
          
          if (logfilename != "") {
            httpRequest.open('POST', '<?php echo base_url(); ?>systemlog/systemlog_detail_json/' + logfilename);
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
            selectedRowsString += selectedRow.filename;
          });
          document.querySelector('#selectedRows').innerHTML = selectedRowsString;
          
          loadGridData2(); // Call log contents
        }

        function onSelectionChanged2() {
        }

      </script>

      <?php
        echo $CI->view_library->js_Header();
          echo $CI->view_library->js_gridOptions('gridOptions', 'columnDefs', 'onSelectionChanged', '');
          echo $CI->view_library->js_sizeToFit('gridOptions');
          echo $CI->view_library->js_autoSizeAll('gridOptions');
          echo $CI->view_library->js_onFilterTextBoxChanged('gridOptions');
          echo $CI->view_library->js_onRefreshRow('gridOptions');
          echo $CI->view_library->js_onDownload('gridOptions');
          echo $CI->view_library->js_loadGridData('gridOptions', 'systemlog/systemlog_json');

          echo $CI->view_library->js_gridOptions('gridOptions2', 'columnDefs2', 'onSelectionChanged2', '', '');
          echo $CI->view_library->js_sizeToFit('gridOptions2', 'sizeToFit2');
          echo $CI->view_library->js_autoSizeAll('gridOptions2', 'autoSizeAll2');
          echo $CI->view_library->js_onFilterTextBoxChanged('gridOptions2', 'filter-text-box2', 'onFilterTextBoxChanged2');
          echo $CI->view_library->js_onRefreshRow('gridOptions2', 'onRefreshRow2', 'loadGridData2');
          echo $CI->view_library->js_onDownload('gridOptions2', 'onDownload2');
        echo $CI->view_library->js_Footer();
      ?>

      <!-- ag-grid -->
