<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View_library {

  protected $CI;
  

  // We'll use a constructor, as you can't directly call a function from a property definition.
  public function __construct() {
    // Assign the CodeIgniter super-object
    $this->CI =& get_instance();
  }


  /////////////////////////////////////////

  public function menu_divider() {
    $returnValue = "
      <hr class='sidebar-divider'>
      ";
    return $returnValue;
  } //

  
  public function menu_group($title) {
    $returnValue = "
      <div class='sidebar-heading'>" . $title . "</div>
      ";
    return $returnValue;
  } //


  public function menu_item($currentPage, $link, $title, $description, $icon) {
    $returnValue = "
      <li class='nav-item " . ($currentPage == $link ? "active" : "") . "'>
      <a class='nav-link' href='" . base_url() . $link . "' title='" . $description . "'>
        <i class='fas fa-fw fa-" . $icon . "'></i>
        <span>" . $title . "</span>
      </a>
      </li>
      ";
    return $returnValue;
  } //

  /////////////////////////////////////////

  public function html_title($icon, $title, $extra = "") {
    $returnValue = "
      <div class='d-sm-flex align-items-center justify-content-between mb-4'>
        <h1 class='h3 mb-0 text-gray-800'><i class='fas fa-fw fa-" . $icon . "'></i> " . $title . "</h1>
        " . $extra . "
      </div>
      ";
    return $returnValue;
  }


  public function html_formHeader($processName, $modalId, $modalLabel, $modalTitle, $formId, $isFile = False) {
    if ($isFile) {
      $enctype = "enctype='multipart/form-data' ";
    } else {
      $enctype = "";
    }

    $returnValue = "
      <!-- " . $processName . " -->
      <div class='modal fade' id='" . $modalId . "' tabindex='-1' role='dialog' aria-labelledby='" . $modalLabel . "' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title' id='" . $modalLabel . "'>" . $modalTitle . "</h4>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            </div>
            <form id='" . $formId . "' action='#' method='POST' accept-charset='utf-8' " . $enctype . "onsubmit='return false;'>
            <script type='text/javascript' charset='utf-8'>
              // Draggable modal
              $('#" . $modalId . "').draggable({ handle: '.modal-header' });
        
              // Resizable Modal
              $('#" . $modalId . "').resizable();
            </script>
                  <div class='modal-body'>
      ";
    return $returnValue;
  }

  
  public function html_formGroupText($labelName, $name, $placeholder, $value, $required, $readonly) {
    $returnValue = "
      <div class='form-group row'>
        <label class='col-sm-4 col-form-label col-form-label-sm'>" . $labelName . "</label>
        <div class='col-sm-8'><input type='text' class='form-control form-control-sm' name='" . $name . "' value='" . $value . "' placeholder='" . $placeholder . 
          "' " . ($required ? "required" : "") . " " . ($readonly ? "readonly" : "") . "></div>
      </div>
      ";
    return $returnValue;
  }


  public function html_formGroupTextArea($labelName, $name, $rows, $placeholder, $value, $required, $readonly) {
    $returnValue = "
      <div class='form-group row'>
        <label class='col-sm-4 col-form-label col-form-label-sm'>" . $labelName . "</label>
        <div class='col-sm-8'><textarea class='form-control form-control-sm' name='" . $name . "' rows='" . $rows . "' value='" . $value . "' placeholder='" . $placeholder . 
          "' " . ($required ? "required" : "") . " " . ($readonly ? "readonly" : "") . "></textarea></div>
      </div>
      ";
    return $returnValue;
  }


  public function html_formGroupPassword($labelName, $name, $placeholder, $value, $required, $readonly) {
    $returnValue = "
      <div class='form-group row'>
        <label class='col-sm-4 col-form-label col-form-label-sm'>" . $labelName . "</label>
        <div class='col-sm-8'><input type='password' class='form-control form-control-sm' name='" . $name . "' value='" . $value . "' placeholder='" . $placeholder . 
          "' " . ($required ? "required" : "") . " " . ($readonly ? "readonly" : "") . "></div>
      </div>
      ";
    return $returnValue;
  }


  public function html_formGroupEmail($labelName, $name, $placeholder, $value, $required, $readonly) {
    $returnValue = "
      <div class='form-group row'>
        <label class='col-sm-4 col-form-label col-form-label-sm'>" . $labelName . "</label>
        <div class='col-sm-8'><input type='email' class='form-control form-control-sm' name='" . $name . "' value='" . $value . "' placeholder='" . $placeholder . 
          "' " . ($required ? "required" : "") . " " . ($readonly ? "readonly" : "") . "></div>
      </div>
      ";
    return $returnValue;
  }


  public function html_formGroupSelect($labelName, $name, $optionArray) {
    $arrayLength = count($optionArray);
    $optionString = "";
    for ($row = 0; $row < $arrayLength; $row ++) {
      $optionString = $optionString . "
        <option value='" . $optionArray[$row][0] . "'>" . $optionArray[$row][1] . "</option>";
    }

    $returnValue = "
      <div class='form-group row'>
        <label class='col-sm-4 col-form-label col-form-label-sm'>" . $labelName . "</label>
        <div class='col-sm-8'>
          <select class='form-control form-control-select form-control-sm' name='" . $name . "'> " .
          $optionString . "
          </select>
        </div>
      </div>
      ";
    return $returnValue;
  }


  public function html_formGroupFile($labelName, $name, $placeholder, $value, $required, $readonly) {
    $returnValue = "
      <div class='form-group row'>
        <label class='col-sm-4 col-form-label col-form-label-sm'>" . $labelName . "</label>
        <div class='col-sm-8'><input type='file' class='form-control form-control-sm' name='" . $name . "' value='" . $value . "' placeholder='" . $placeholder . 
          "' " . ($required ? "required" : "") . " " . ($readonly ? "readonly" : "") . "></div>
      </div>
      ";
    return $returnValue;
  }


  public function html_formGroupCustom($html) {
    $returnValue = "
      <div class='form-group row'>
      " . $html . "
      </div>
      ";
    return $returnValue;
  }


  public function html_formAlert($message_id) {
    $returnValue = "
      <div class='alert alert-light alert-dismissible' role='alert'>
        <strong><p id='" . $message_id . "'></p></strong>
      </div>
      ";
    return $returnValue;
  }


  public function html_formFooterOpen() {
    $returnValue = "
      </div>
      <div class='modal-footer'>
        <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Cancel' data-dismiss='modal'><i class='fas fa-times'></i> Cacnel</button>
        ";
    return $returnValue;
  }


  public function html_formFooterButton($buttonStyle = 'primary', $onClickMethod, $buttonLabel = 'Submit', $icon = 'check') {
    $returnValue = "
      <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-" . $buttonStyle . " shadow-sm' title='" . $buttonLabel . "' onclick='" . $onClickMethod . "'><i class='fas fa-". $icon . "'></i> " . $buttonLabel . "</button>
      ";
    return $returnValue;
  }


  public function html_formFooterClose() {
    $returnValue = "
              </div>
            </form>
          </div>
        </div>
      </div>
      ";
  return $returnValue;
  }


  public function html_gridFullHeader($style) {
    $returnValue = "
      <!-- ag-grid -->
      <div class='ag-grid-full' style='" . ($style <> '' ? $style : "height:calc(100% - 50px)") . "; min-height:200px;'>
      ";
    return $returnValue;
  }


  public function html_buttonBarOpen($filterId, $filterEvent) {
    $returnValue = "
      <div class='button-bar' style='margin-bottom: 5px;'>
        <div class='row'>
          <div class='col-lg-4'>
            <div class='input-group input-group-sm'>
              <div class='input-group-prepend'>
                <div class='input-group-text'><i class='fas fa-filter'></i></div>
              </div>
              <input type='text' id='". $filterId . "' class='form-control form-control-sm' placeholder='Filter...' onInput='" . $filterEvent . "()'/>
            </div>
          </div>
          <div class='col-lg-8' style='text-align:right;'>
          ";
    return $returnValue;
  } //


  public function html_buttonBarItem($itemType, $itemId, $eventName) {
    switch ($itemType) {
//       case 'sizeToFit':
//         $returnValue = "<button id='" . $itemId . "' type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Size to fit' onclick='" . $eventName . "()'><i class='fas fa-arrows-alt-h'></i></button>";
//         break;
//       case 'autoSizeAll':
//         $returnValue = "<button id='" . $itemId . "' type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Auto size' onclick='" . $eventName  . "()'><i class='fas fa-arrows-alt'></i></button>";
//         break;
      case 'Refresh':
        $returnValue = "<button id='" . $itemId . "' type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Refresh' onclick='" . $eventName . "()'><i class='fas fa-sync'></i></button>";
        break;
      case 'Download':
        $returnValue = "<button id='" . $itemId . "' type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Export to csv' onclick='" . $eventName . "()'><i class='fas fa-file-excel'></i></button>";
        break;
      case 'Extract':
        $returnValue = "<button id='" . $itemId . "' type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Extract' data-toggle='modal' data-target='#" . $eventName . "'><i class='fas fa-file-export'></i></button>";
        break;
      case 'Create':
        $returnValue = "<button id='" . $itemId . "' type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Add' data-toggle='modal' data-target='#" . $eventName . "' data-backdrop='static' data-keyboard='false'><i class='fas fa-plus'></i></button>";
        break;
      case 'Update':
        $returnValue = "<button id='" . $itemId . "' type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Edit' data-toggle='modal' data-target='#" . $eventName . "' data-backdrop='static' data-keyboard='false'><i class='fas fa-edit'></i></button>";
        break;
      case 'Delete':
        $returnValue = "<button id='" . $itemId . "' type='button' class='d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm' title='Delete' data-toggle='modal' data-target='#" . $eventName . "' data-backdrop='static' data-keyboard='false'><i class='fas fa-trash'></i></button>";
        break;
      default:
        $returnValue = "";
        break;
    }
    return "&nbsp;" . $returnValue;
  } //


  public function html_buttonBarClose() {
    $returnValue = "
          </div>
        </div>
      </div>
      ";
    return $returnValue;
  } //


  public function html_selectedRows($selectedRows) {
    $returnValue = "
      <div style='display:none;'>
        Selection:
        <span id='selectedRows'></span>
      </div>
      ";
    return $returnValue;
  }


  public function html_grid($gridName, $style, $message, $theme) {
    
    $returnValue = "
      <div id='" . $gridName . "' style='" . ($style <> '' ? $style : "width:100%; height:100%;") . "' class='" . 
      // $this->CI->config->item('grid_theme') .
      "ag-theme-" . $theme .
      "';></div>" .
      ($message <> '' ? $message : "") .
    "";
    return $returnValue;
  }


  public function html_gridFullFooter() {
    $returnValue = "
      </div>
      ";
    return $returnValue;
  }

  /////////////////////////////////////////

  public function js_Header() {
    $returnValue = "
      <script type='text/javascript' charset='utf-8'>
    ";
    return $returnValue;
  }


  public function js_columnDefs($queryArray) {
    $columnString = "";
    foreach($queryArray->list_fields() as $name) {
      // Set editable column
      switch ($name) {
        case 'id':
          $columnString = $columnString . '{ headerName: "' . str_replace('_', ' ', ucfirst($name)) . '", field: "' . $name . '", hide: true, editable: false },' . PHP_EOL;
          break;
        case 'password':
          $columnString = $columnString . '{ headerName: "' . str_replace('_', ' ', ucfirst($name)) . '", field: "' . $name . '", hide: true },' . PHP_EOL;
          break;
        case 'icon':
        case 'logo':
          // $columnString = $columnString . '{ headerName: "' . str_replace('_', ' ', ucfirst($name)) . '", field: "' . $name . '", cellRenderer: "imageCellRenderer" },' . PHP_EOL;
          $columnString = $columnString . '{ headerName: "' . str_replace('_', ' ', ucfirst($name)) . '", field: "' . $name . '", cellRenderer: function(params) { return \'<img src="/img/logo/\' + params.value + \'" height="100%">\'; } },' . PHP_EOL;

          break;
        default:
          $columnString = $columnString . '{ headerName: "' . str_replace('_', ' ', ucfirst($name)) . '", field: "' . $name . '" },' . PHP_EOL;
      }
    }

    $returnValue = "
      // Specify the column headers
      var columnDefs = [" . PHP_EOL .
      $columnString . "
      ];
      ";
    return $returnValue;
  }


  public function js_gridOptions($gridOptions, $columnDefs, $selectionChangeEvent = "onSelectionChanged", $onRowDoubleClickedEvent = "onRowDoubleClicked") {
    $returnValue = "
      // let the grid know which columns and what data to use
      var " . $gridOptions . " = {
        defaultColDef: {
          resizable: true,
          //editable: true,
          sortable: true,
          filter: true
        },
        columnDefs: " . $columnDefs . ",
        rowSelection: 'single',
        onSelectionChanged: " . $selectionChangeEvent . 
        ($onRowDoubleClickedEvent <> '' ? ', onRowDoubleClicked: ' . $onRowDoubleClickedEvent : '') . "
      };
      ";
    return $returnValue;
  } //


  // public function js_imageRenderer() {
  //   $returnValue = "
  //     // Image Renderer
  //     class imageCellRenderer {
  //       init

  //       let cellContent: String = '';
  //       let fileName: String = params.value[attItr].logo;
  //       cellContent = '<img src=\"/' + fileName + \">';
  //       return cellContent;
  //     }
  //     ";
  //   return $returnValue;
  // } //


  public function js_sizeToFit($gridOptions, $eventName = "sizeToFit") {
    $returnValue = "
      // Set grid size to fit
      function " . $eventName . "() {
        " . $gridOptions . ".api.sizeColumnsToFit();
      }
      ";
    return $returnValue;
  } //


  public function js_autoSizeAll($gridOptions, $eventName = "autoSizeAll") {
    $returnValue = "
      // Set grid size to auto
      function " . $eventName . "() {
        var allColumnIds = [];
        " . $gridOptions . ".columnApi.getAllColumns().forEach(function(column) {
            allColumnIds.push(column.colId);
        });
        " . $gridOptions . ".columnApi.autoSizeColumns(allColumnIds, true);
      }
      ";
    return $returnValue;
  } //


  public function js_onFilterTextBoxChanged($gridOptions, $filterId = "filter-text-box", $eventName = "onFilterTextBoxChanged") {
    $returnValue = "
      // Quick Filter
      function " . $eventName . "() {
        " . $gridOptions . ".api.setQuickFilter(document.getElementById('" . $filterId . "').value);
      }
      ";
    return $returnValue;
  } //


  public function js_onRefreshRow($gridOptions, $eventName = "onRefreshRow", $loadEventName = "loadGridData") {
    $returnValue = "
      // Refresh grid data
      function " . $eventName . "() {
        " . $gridOptions . ".api.setRowData([]); //clear grid data
        " . $loadEventName . "();
      }
      ";
    return $returnValue;
  } //


  public function js_onDownload($gridOptions, $eventName = "onDownload") {
    $returnValue = "
      // Export grid
      function " . $eventName . "() {
        var params = {
          skipHeader: false,
          allColumns: true,
        };
        " . $gridOptions . ".api.exportDataAsCsv(params);
      }
      ";
    return $returnValue;
  } //
  

  public function js_onSelectionChanged($gridOptions, $querySelector) {
    $returnValue = "
      // Set selection when change selection
      function onSelectionChanged() {
        var selectedRows = " . $gridOptions . ".api.getSelectedRows();
        var selectedRowsString = '';
        selectedRows.forEach( function(selectedRow, index) {
          if (index!==0) {
            selectedRowsString += ', ';
          }
          selectedRowsString += selectedRow.name;
        });
        document.querySelector('#" . $querySelector . "').innerHTML = selectedRowsString;

        $('#btnUpdate').attr('disabled', false);
        $('#btnDelete').attr('disabled', false);
      }
      ";
    return $returnValue;
  } //


  public function js_onRowDoubleClicked($modal) {
    $returnValue = "
      // Set selection when change selection
      function onRowDoubleClicked() {
        $('#" . $modal . "').modal('show'); 
      }
      ";
    return $returnValue;
  } //


  public function js_loadGridData($gridOptions, $targetUrl) {
    $returnValue = "
      // Call request grid data
      function loadGridData() {
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('POST', '" . base_url() . $targetUrl . "');
        httpRequest.send();
        httpRequest.onreadystatechange = function() {
          if (httpRequest.readyState === 4 && httpRequest.status === 200) {
            var httpResult = JSON.parse(httpRequest.responseText);
            " . $gridOptions . ".api.setRowData(httpResult);
          }
        };
      }
      ";
    return $returnValue;
  } //


  public function js_addEventListener($gridOptions, $gridName) {
    $returnValue = "
      // Setup the grid after the page has finished loading
      document.addEventListener('DOMContentLoaded', function() {
        var gridDiv = document.querySelector('#" . $gridName . "');
        new agGrid.Grid(gridDiv, gridOptions);
        loadGridData();
        sizeToFit();
      });
      ";
    return $returnValue;
  } //


  public function js_processRow($processName, $form, $targetUrl, $message, $modal) {
    $returnValue = "
      // " . $processName . "
      function " . $processName . "() {
        var params = jQuery('#" . $form . "').serialize(); // serialize()
        $.ajax({
            type: 'POST',
            url: '" . base_url() . $targetUrl . "',
            data: params,
            dataType: 'json',
            success: function(data) {
              if(data.responseText) {
                document.querySelector('#" . $message . "').innerHTML = data.responseText;
                if(data.status == 'S') {
                  document.getElementById('" . $form . "').reset();
                  onRefreshRow();
                  document.querySelector('#" . $message . "').innerHTML = '';
                  $('#" . $modal . "').modal('hide');
                }
              }
            },
            error: function(xhr, status, error) {
              document.querySelector('#" . $message . "').innerHTML = 'Error:' + error + ' / Status:' + status;
              return;
            }
        });
      }
      ";
    return $returnValue;
  } //


  public function js_modalCheck($processName, $gridOptions, $modalId, $querySelector, $form) {
    $returnValue = "
      // Set form data before modal show
      $('#" . $modalId . "').on('shown.bs.modal', function () {
        if (document.querySelector('#" . $querySelector . "').innerHTML == '') {
          alert('Select row before " . $processName . ".');
          return;
        }
        var selectedRows = " . $gridOptions . ".api.getSelectedRows();
        var myForm = document.getElementById('" . $form . "');
        for (var i = 0; i < myForm.elements.length; i++) {
          myForm.elements[i].value = selectedRows[0][myForm.elements[i].name];
        }
      });

      // Reset form data after modal hide
      $('#" . $modalId . "').on('hide.bs.modal', function () {
        document.getElementById('" . $form . "').reset();
      });
      ";
    return $returnValue;
  } //
 

  public function js_connectionTest($processName, $form, $targetUrl, $message) {
    $returnValue = "
      // Test Connection (" . $processName . ")
      function " . $processName . "() {
        $('html, body').css('cursor', 'wait');
        document.querySelector('#" . $message . "').innerHTML = 'Connecting ...';
        var params = jQuery('#" . $form . "').serialize(); // serialize()
        $.ajax({
            type: 'POST',
            url: '" . base_url() . $targetUrl . "',
            data: params,
            async: false,
            dataType: 'json',
            success: function(data) {
              $('html, body').css('cursor', 'auto');
              if(data.responseText) {
                document.querySelector('#" . $message . "').innerHTML = data.responseText;
                //alert(data.responseText);
              }
            },
            error: function(xhr, status, error) {
              $('html, body').css('cursor', 'auto');
              document.querySelector('#" . $message . "').innerHTML = 'Error:' + error + ' / Status:' + status;
              //alert(data.responseText);
              return;
            }
        });
      }
      ";
    return $returnValue;
  } //
       

  public function js_Footer() {
    $returnValue = "
      </script>
    ";
    return $returnValue;
  } //
 
}