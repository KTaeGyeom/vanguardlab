<?php 
  $CI =& get_instance();
  $CI->load->library('view_library');

  echo $CI->view_library->html_title('archive', 'Image'); // icon, title
?>

<?php
  // Create Form
  echo $CI->view_library->html_formHeader('Create', 'modalCreate', 'modalLabelCreate', 'Upload image', 'formCreate', true); // processName, modalId, modalLable, modalTitle, formId
    echo "<div class='dropzone' id='fileDropzone'></div>";
    echo $CI->view_library->html_formAlert('messageCreate'); // message_id
  echo $CI->view_library->html_formFooterOpen();
    // echo $CI->view_library->html_formFooterButton('primary', 'AddRow()', 'Submit'); // buttonStyle, onClickMethod, buttonLabel
  echo $CI->view_library->html_formFooterClose();

  // Delete Form
  echo $CI->view_library->html_formHeader('Delete', 'modalDelete', 'modalLabelDelete', 'Delete image', 'formDelete');
  echo $CI->view_library->html_formGroupText('Filename', 'filename', 'Filename', '', TRUE, TRUE);
  // echo $CI->view_library->html_formGroupText('Name', 'name', 'Name', '', TRUE, TRUE);
  echo $CI->view_library->html_formAlert('messageDelete');
  echo $CI->view_library->html_formFooterOpen();
    echo $CI->view_library->html_formFooterButton('primary', 'DeleteRow()', 'Submit');
  echo $CI->view_library->html_formFooterClose();
  
  // ag-grid
  echo $CI->view_library->html_gridFullHeader('height:calc(100vh - 230px)'); // style
    echo $CI->view_library->html_buttonBarOpen('filter-text-box', 'onFilterTextBoxChanged'); // filterId, filterEvent
      echo $CI->view_library->html_buttonBarItem('sizeToFit', 'sizeToFit', 'sizeToFit'); // itemType, itemId, eventName
      echo $CI->view_library->html_buttonBarItem('autoSizeAll', 'autoSizeAll', 'autoSizeAll');
      echo $CI->view_library->html_buttonBarItem('Refresh', 'btnRefresh', 'onRefreshRow');
      echo $CI->view_library->html_buttonBarItem('Create', 'btnCreate', 'modalCreate');
      echo $CI->view_library->html_buttonBarItem('Delete', 'btnDelete', 'modalDelete');
      echo $CI->view_library->html_buttonBarItem('Download', 'btnDownload', 'onDownload');
    echo $CI->view_library->html_buttonBarClose();
    echo $CI->view_library->html_selectedRows('selectedRows');
    //echo $CI->view_library->html_grid('myGrid', 'width:100%; height:calc(100% - 70px);', '', $this->session->userdata('theme')); // gridName, style, message
    echo $CI->view_library->html_grid('myGrid', '', '', $this->session->userdata('theme')); // gridName, style, message
  echo $CI->view_library->html_gridFullFooter();
?>

<script type="text/javascript" charset="utf-8">
  // specify the columns
  var columnDefs = [
    { headerName: "File Name", field: "filename", width: 200 },
    {
      headerName: "Image", 
      field: "filename", 
      cellRenderer: function(params) {
        return '<img src="/img/logo/' + params.value + '" height="100%">';
      }
    },
    { headerName: "Size", field: "filesize", cellStyle: { 'text-align': "right" }, width: 150 },
    { headerName: "Creation Date", field: "filectime", width: 200 },
    { headerName: "Modify Date", field: "fileatime", width: 200 }
  ];

  // Setup the grid after the page has finished loading
  document.addEventListener('DOMContentLoaded', function() {
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    loadGridData();
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
  }

</script>

<script>

// https://spatiumwdev.tistory.com/entry/DropzoneJs-%ED%8C%8C%EC%9D%BC-%EB%93%9C%EB%9E%98%EA%B7%B8%EC%95%A4%EB%93%9C%EB%9E%8D-%EA%B5%AC%ED%98%84
// Dropzone
Dropzone.aautoDiscover = false;

var dropzoneFile = new Dropzone("#fileDropzone", {
  url: 'image/create',
  maxFilesize: 100000,
  parallelUpload: 1,
  addRemoveLink: true,
  timeout: 300000,
  maxFiles: 1,
  paramNmae: 'file',
  autoQueue: true,
  createImageThumbnails: true,
  uploadMultiple: false,
  dictRemoveFile: 'delete',
  dictDefaultMessage: 'Drag and drop files here, then auto uploaded. <br />(icon:48x48, logo:140x45)',
  thumbnailHeight: 190,
  accept:function(file, done) {
    done();
  },
  init: function() {
    this.on('success', function(file, responseText) {
      var obj = JSON.parse(responseText);
      //서버로 파일이 전송되면 실행되는 함수이다. 
      //obj 객체를 확인해보면 서버에 전송된 후 response 값을 확인할 수 있다. 
    })
  }
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
    echo $CI->view_library->js_onSelectionChanged('gridOptions', 'selectedRows');
    echo $CI->view_library->js_onRowDoubleClicked('modalUpdate');
    echo $CI->view_library->js_loadGridData('gridOptions', 'image/list_json');

    // echo $CI->view_library->js_processRow('AddRow', 'formCreate', 'image/create', 'messageCreate', 'modalCreate');
    echo $CI->view_library->js_processRow('DeleteRow', 'formDelete', 'image/delete', 'messageDelete', 'modalDelete');
    echo $CI->view_library->js_modalCheck('delete', 'gridOptions', 'modalDelete', 'selectedRows', 'formDelete');

    echo $CI->view_library->js_Footer();
?>

<!-- ag-grid -->
