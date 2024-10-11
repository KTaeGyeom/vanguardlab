<div class='d-sm-flex align-items-center justify-content-between mb-4'>
  <h1 class='h3 mb-0 text-gray-800'><i class='fas fa-fw fa-building'></i> Test</h1>
</div>

<!-- ag-grid -->
<div class='ag-grid-full' style='height:calc(100% - 50px); min-height:200px;'>
  <div class='button-bar' style='margin-bottom: 5px;'>
    <div class='row'>
      <div class='col-lg-4'>
        <div class='input-group input-group-sm'>
          <div class='input-group-prepend'>
            <div class='input-group-text'><i class='fas fa-filter'></i></div>
          </div>
          <input type='text' id='filter-text-box' class='form-control form-control-sm' placeholder='Filter...' onInput='onFilterTextBoxChanged()'/>
        </div>
      </div>
      <div class='col-lg-8' style='text-align:right;'>
        &nbsp;&nbsp;&nbsp;
        <button id='btnRefresh' type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Refresh' onclick='onRefreshRow()'>
          <i class='fas fa-sync'></i>
        </button>
        &nbsp;
        <button id='btnDownload' type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Export to csv' onclick='onDownload()'>
          <i class='fas fa-file-excel'></i>
        </button>
        &nbsp;
        <button id='btnEdit' type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Edit' onclick='onEdit()'>
          <i class='fas fa-edit'></i>
        </button>
        &nbsp;
        <button id='btnEdit' type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Edit' onclick='onAdd()'>
          <i class='fas fa-plus'></i>
        </button>
        &nbsp;
        <button id='btnDelete' type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Delete' onclick='onDelete()'>
          <i class='fas fa-trash'></i>
        </button>
        &nbsp;
        <button id='btnSave' type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Save' onclick='onSave()'>
          <i class='fas fa-save'></i>
        </button>
      </div>
      <div id="updateRows" style="height:100px;border:1px solid #f4f4f4;margin:5px 0"></div>
    </div>
  </div>
  <div style='display:none;'>
    Selection:
    <span id='selectedRows'></span>
  </div>
  <div id='myGrid' style='width:100%; height:100%;' class='ag-theme-balham';></div>
</div>

<script type='text/javascript' charset='utf-8'>
  // Specify the column headers
  var columnDefs = [
    { checkboxSelection: true, width: 20 },
    { headerName: "Id", field: "id", hide: true, editable: false },
    { headerName: "Name", field: "name" },
    { headerName: "Type", field: "type" },
    { headerName: "Logo", field: "logo" },
    { headerName: "Description", field: "description" },
  ];

  // let the grid know which columns and what data to use
  var gridOptions = {
    defaultColDef: {
      resizable: true,
      editable: true,
      sortable: true,
      filter: true
    },
    columnDefs: columnDefs,
    rowSelection: 'multiple',
    onSelectionChanged: onSelectionChanged,
  };

  // Set grid size to fit
  function sizeToFit() {
    gridOptions.api.sizeColumnsToFit();
  }

  // Set grid size to auto
  function autoSizeAll() {
    var allColumnIds = [];
    gridOptions.columnApi.getAllColumns().forEach(function(column) {
      allColumnIds.push(column.colId);
    });
    gridOptions.columnApi.autoSizeColumns(allColumnIds, true);
  }

  // Quick Filter
  function onFilterTextBoxChanged() {
    gridOptions.api.setQuickFilter(document.getElementById('filter-text-box').value);
  }

  // Refresh grid data
  function onRefreshRow() {
    gridOptions.api.setRowData([]); //clear grid data
    loadGridData();
  }

  // Export grid
  function onDownload() {
    var params = {
      skipHeader: false,
      allColumns: true,
      };
    gridOptions.api.exportDataAsCsv(params);
  }

  //
  function onStopEditing() {
    gridOptions.api.stopEditing();
  }

  //
  var removedRows = [];
  function onDelete() {
    var selectedRows = gridOptions.api.getSelectedRows();
    selectedRows.forEach( function(selectedRow, index) {
      removedRows.push(selectedRow);
      gridOptions.api.updateRowData({remove: [selectedRow]});
    });
  }

  //
  var updateRows = [];
  function onSave() {
    gridOptions.api.stopEditing();
    gridOptions.api.forEachNode( function(rowNode, index) {
      if (rowNode.data.edit){
        updateRows.push(rowNode.data);
      }
    });
    $("#updateRows").html(JSON.stringify(updateRows));
  }

  // Set selection when change selection
  function onSelectionChanged() {
    var selectedRows = gridOptions.api.getSelectedRows();
    var selectedRowsString = '';
    selectedRows.forEach( function(selectedRow, index) {
      if (index!==0) {
        selectedRowsString += ', ';
      }
      selectedRowsString += selectedRow.name;
    });
    document.querySelector('#selectedRows').innerHTML = selectedRowsString;

    $('#btnUpdate').attr('disabled', false);
    $('#btnDelete').attr('disabled', false);
  }

  // Call request grid data
  function loadGridData() {
    var httpRequest = new XMLHttpRequest();
    httpRequest.open('POST', '/admin/test/list_json');
    httpRequest.send();
    httpRequest.onreadystatechange = function() {
      if (httpRequest.readyState === 4 && httpRequest.status === 200) {
        var httpResult = JSON.parse(httpRequest.responseText);
        gridOptions.api.setRowData(httpResult);
        }
      };
    }

  // Setup the grid after the page has finished loading
  document.addEventListener('DOMContentLoaded', function() {
  var gridDiv = document.querySelector('#myGrid');
  new agGrid.Grid(gridDiv, gridOptions);
  loadGridData();
  sizeToFit();
  });

  // AddRow
  function AddRow() {
  var params = jQuery('#formCreate').serialize(); // serialize()
  $.ajax({
      type: 'POST',
      url: '/admin/test/create',
      data: params,
      dataType: 'json',
      success: function(data) {
        if(data.responseText) {
          document.querySelector('#messageCreate').innerHTML = data.responseText;
          if(data.status == 'S') {
            document.getElementById('formCreate').reset();
            onRefreshRow();
            document.querySelector('#messageCreate').innerHTML = '';
            $('#modalCreate').modal('hide');
          }
        }
      },
      error: function(xhr, status, error) {
        document.querySelector('#messageCreate').innerHTML = 'Error:' + error + ' / Status:' + status;
        return;
      }
  });
  }

  // DeleteRow
  function DeleteRow() {
  var params = jQuery('#formDelete').serialize(); // serialize()
  $.ajax({
      type: 'POST',
      url: '/admin/test/delete',
      data: params,
      dataType: 'json',
      success: function(data) {
        if(data.responseText) {
          document.querySelector('#messageDelete').innerHTML = data.responseText;
          if(data.status == 'S') {
            document.getElementById('formDelete').reset();
            onRefreshRow();
            document.querySelector('#messageDelete').innerHTML = '';
            $('#modalDelete').modal('hide');
          }
        }
      },
      error: function(xhr, status, error) {
        document.querySelector('#messageDelete').innerHTML = 'Error:' + error + ' / Status:' + status;
        return;
      }
  });
  }

  // UpdateRow
  function UpdateRow() {
  var params = jQuery('#formUpdate').serialize(); // serialize()
  $.ajax({
      type: 'POST',
      url: '/admin/test/update',
      data: params,
      dataType: 'json',
      success: function(data) {
        if(data.responseText) {
          document.querySelector('#messageUpdate').innerHTML = data.responseText;
          if(data.status == 'S') {
            document.getElementById('formUpdate').reset();
            onRefreshRow();
            document.querySelector('#messageUpdate').innerHTML = '';
            $('#modalUpdate').modal('hide');
          }
        }
      },
      error: function(xhr, status, error) {
        document.querySelector('#messageUpdate').innerHTML = 'Error:' + error + ' / Status:' + status;
        return;
      }
    });
  }

  // Set form data before modal show
  $('#modalDelete').on('shown.bs.modal', function () {
    if (document.querySelector('#selectedRows').innerHTML == '') {
      alert('Select row before delete.');
      return;
    }
    var selectedRows = gridOptions.api.getSelectedRows();
    var myForm = document.getElementById('formDelete');
    for (var i = 0; i < myForm.elements.length; i++) {
      myForm.elements[i].value = selectedRows[0][myForm.elements[i].name];
    }
  });

  // Reset form data after modal hide
  $('#modalDelete').on('hide.bs.modal', function () {
    document.getElementById('formDelete').reset();
  });

  // Set form data before modal show
  $('#modalUpdate').on('shown.bs.modal', function () {
    if (document.querySelector('#selectedRows').innerHTML == '') {
      alert('Select row before update.');
      return;
  }

  var selectedRows = gridOptions.api.getSelectedRows();
  var myForm = document.getElementById('formUpdate');
  for (var i = 0; i < myForm.elements.length; i++) {
    myForm.elements[i].value = selectedRows[0][myForm.elements[i].name];
  }
  });

  // Reset form data after modal hide
  $('#modalUpdate').on('hide.bs.modal', function () {
    document.getElementById('formUpdate').reset();
  });

</script>

<?php 

  // $CI =& get_instance();
  // $CI->load->library('view_library');

  // echo $CI->view_library->html_title('building', 'Test'); // icon, title

  // $typeArray = array( array('financial', 'Financial'), array('solution', 'Solution') );
  // $displayArray = array( array('Y', 'Yes'), array('N', 'No') );

  // // Create Form
  // echo $CI->view_library->html_formHeader('Create', 'modalCreate', 'modalLabelCreate', 'Add setting', 'formCreate'); // processName, modalId, modalLable, modalTitle, formId
  // echo $CI->view_library->html_formGroupText('Name', 'name', 'Name', '', TRUE, FALSE);
  // echo $CI->view_library->html_formGroupSelect('Type', 'type', $typeArray);
  // echo $CI->view_library->html_formGroupText('Logo', 'logo', 'Logo', '', FALSE, FALSE);
  // echo $CI->view_library->html_formGroupText('Description', 'description', 'Description', '', FALSE, FALSE);
  // echo $CI->view_library->html_formAlert('messageCreate'); // message_id
  // echo $CI->view_library->html_formFooterOpen();
  //   echo $CI->view_library->html_formFooterButton('primary', 'AddRow()', 'Submit'); // buttonStyle, onClickMethod, buttonLabel, icon
  // echo $CI->view_library->html_formFooterClose();

  // // Delete Form
  // echo $CI->view_library->html_formHeader('Delete', 'modalDelete', 'modalLabelDelete', 'Delete setting', 'formDelete');
  // echo $CI->view_library->html_formGroupText('Id', 'id', 'Name', '', TRUE, TRUE);
  // echo $CI->view_library->html_formGroupText('Name', 'name', 'Name', '', TRUE, TRUE);
  // echo $CI->view_library->html_formAlert('messageDelete');
  // echo $CI->view_library->html_formFooterOpen();
  //   echo $CI->view_library->html_formFooterButton('primary', 'DeleteRow()', 'Submit');
  // echo $CI->view_library->html_formFooterClose();

  // // Update Form
  // echo $CI->view_library->html_formHeader('Update', 'modalUpdate', 'modalLabelUpdate', 'Update setting', 'formUpdate');
  //   echo $CI->view_library->html_formGroupText('Id', 'id', 'Id', '', TRUE, TRUE); // labelName, name, placeholder, value, required, readonly
  //   echo $CI->view_library->html_formGroupText('Name', 'name', 'Name', '', TRUE, FALSE);
  //   echo $CI->view_library->html_formGroupSelect('Type', 'type', $typeArray);
  //   echo $CI->view_library->html_formGroupText('Logo', 'logo', 'Logo', '', FALSE, FALSE);
  //   echo $CI->view_library->html_formGroupText('Description', 'description', 'Description', '', FALSE, FALSE);
  //     echo $CI->view_library->html_formAlert('messageUpdate'); // message_id
  // echo $CI->view_library->html_formFooterOpen();
  //   echo $CI->view_library->html_formFooterButton('primary', 'UpdateRow()', 'Submit');
  // echo $CI->view_library->html_formFooterClose();

  // // ag-grid
  // echo $CI->view_library->html_gridFullHeader(''); // style
  //   echo $CI->view_library->html_buttonBarOpen('filter-text-box', 'onFilterTextBoxChanged'); // filterId, filterEvent
  //   echo $CI->view_library->html_buttonBarItem('sizeToFit', 'sizeToFit', 'sizeToFit'); // itemType, itemId, eventName
  //   echo $CI->view_library->html_buttonBarItem('autoSizeAll', 'autoSizeAll', 'autoSizeAll');
  //   echo $CI->view_library->html_buttonBarItem('Refresh', 'btnRefresh', 'onRefreshRow');
  //   echo $CI->view_library->html_buttonBarItem('Download', 'btnDownload', 'onDownload');
  //   echo $CI->view_library->html_buttonBarItem('Create', 'btnCreate', 'modalCreate');
  //   echo $CI->view_library->html_buttonBarItem('Update', 'btnUpdate', 'modalUpdate');
  //   echo $CI->view_library->html_buttonBarItem('Delete', 'btnDelete', 'modalDelete');
  //   echo $CI->view_library->html_buttonBarClose();
  //   echo $CI->view_library->html_selectedRows('selectedRows');
  //   echo $CI->view_library->html_grid('myGrid', '', '', $this->session->userdata('theme')); // gridName, style, message
  // echo $CI->view_library->html_gridFullFooter();

  // // JavaScripts
  // echo $CI->view_library->js_Header();
  //   echo $CI->view_library->js_columnDefs($queryResult); // queryArray
  //   echo $CI->view_library->js_gridOptions('gridOptions', 'columnDefs');
  //   echo $CI->view_library->js_sizeToFit('gridOptions');
  //   echo $CI->view_library->js_autoSizeAll('gridOptions');
  //   echo $CI->view_library->js_onFilterTextBoxChanged('gridOptions');
  //   echo $CI->view_library->js_onRefreshRow('gridOptions');
  //   echo $CI->view_library->js_onDownload('gridOptions');
  //   echo $CI->view_library->js_onSelectionChanged('gridOptions', 'selectedRows');
  //   echo $CI->view_library->js_loadGridData('gridOptions', 'test/list_json');
  //   echo $CI->view_library->js_addEventListener('gridOptions', 'myGrid');
  //   echo $CI->view_library->js_processRow('AddRow', 'formCreate', 'test/create', 'messageCreate', 'modalCreate');
  //   echo $CI->view_library->js_processRow('DeleteRow', 'formDelete', 'test/delete', 'messageDelete', 'modalDelete');
  //   echo $CI->view_library->js_processRow('UpdateRow', 'formUpdate', 'test/update', 'messageUpdate', 'modalUpdate');
  //   echo $CI->view_library->js_modalCheck('delete', 'gridOptions', 'modalDelete', 'selectedRows', 'formDelete');
  //   echo $CI->view_library->js_modalCheck('update', 'gridOptions', 'modalUpdate', 'selectedRows', 'formUpdate');
  // echo $CI->view_library->js_Footer();

?>
