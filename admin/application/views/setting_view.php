<?php 
  $CI =& get_instance();
  $CI->load->library('view_library');

  echo $CI->view_library->html_title('cog', 'Common Setup'); // icon, title

  // Create Form
  echo $CI->view_library->html_formHeader('Create', 'modalCreate', 'modalLabelCreate', 'Add setting', 'formCreate'); // processName, modalId, modalLable, modalTitle, formId
    echo $CI->view_library->html_formGroupText('Setup Group', 'setup_group', 'Setup Group', '', TRUE, FALSE); // labelName, name, placeholder, value, required, readonly
    echo $CI->view_library->html_formGroupText('Name', 'name', 'Name', '', TRUE, FALSE);
    echo $CI->view_library->html_formGroupText('Value', 'value', 'Value', '', TRUE, FALSE);
    echo $CI->view_library->html_formGroupText('Description', 'description', 'Description', '', FALSE, FALSE);
    echo $CI->view_library->html_formAlert('messageCreate'); // message_id
  echo $CI->view_library->html_formFooterOpen();
    echo $CI->view_library->html_formFooterButton('primary', 'AddRow()', 'Submit'); // buttonStyle, onClickMethod, buttonLabel, icon
  echo $CI->view_library->html_formFooterClose();

  // Delete Form
  echo $CI->view_library->html_formHeader('Delete', 'modalDelete', 'modalLabelDelete', 'Delete setting', 'formDelete');
  echo $CI->view_library->html_formGroupText('Id', 'id', 'Name', '', TRUE, TRUE);
  echo $CI->view_library->html_formGroupText('Name', 'name', 'Name', '', TRUE, TRUE);
  echo $CI->view_library->html_formAlert('messageDelete');
  echo $CI->view_library->html_formFooterOpen();
    echo $CI->view_library->html_formFooterButton('primary', 'DeleteRow()', 'Submit');
  echo $CI->view_library->html_formFooterClose();

  // Update Form
  echo $CI->view_library->html_formHeader('Update', 'modalUpdate', 'modalLabelUpdate', 'Update setting', 'formUpdate');
    echo $CI->view_library->html_formGroupText('Id', 'id', 'Id', '', TRUE, TRUE); // labelName, name, placeholder, value, required, readonly
    echo $CI->view_library->html_formGroupText('Setup Group', 'setup_group', 'Setup Group', '', TRUE, FALSE); // labelName, name, placeholder, value, required, readonly
    echo $CI->view_library->html_formGroupText('Name', 'name', 'Name', '', TRUE, FALSE);
    echo $CI->view_library->html_formGroupText('Value', 'value', 'Value', '', TRUE, FALSE);
    echo $CI->view_library->html_formGroupText('Description', 'description', 'Description', '', FALSE, FALSE);
    echo $CI->view_library->html_formAlert('messageUpdate'); // message_id
  echo $CI->view_library->html_formFooterOpen();
    echo $CI->view_library->html_formFooterButton('primary', 'UpdateRow()', 'Submit');
  echo $CI->view_library->html_formFooterClose();

  // ag-grid
  echo $CI->view_library->html_gridFullHeader(''); // style
    echo $CI->view_library->html_buttonBarOpen('filter-text-box', 'onFilterTextBoxChanged'); // filterId, filterEvent
    echo $CI->view_library->html_buttonBarItem('sizeToFit', 'sizeToFit', 'sizeToFit'); // itemType, itemId, eventName
    echo $CI->view_library->html_buttonBarItem('autoSizeAll', 'autoSizeAll', 'autoSizeAll');
    echo $CI->view_library->html_buttonBarItem('Refresh', 'btnRefresh', 'onRefreshRow');
    echo $CI->view_library->html_buttonBarItem('Download', 'btnDownload', 'onDownload');
    echo $CI->view_library->html_buttonBarItem('Create', 'btnCreate', 'modalCreate');
    echo $CI->view_library->html_buttonBarItem('Update', 'btnUpdate', 'modalUpdate');
    echo $CI->view_library->html_buttonBarItem('Delete', 'btnDelete', 'modalDelete');
    echo $CI->view_library->html_buttonBarClose();
    echo $CI->view_library->html_selectedRows('selectedRows');
    echo $CI->view_library->html_grid('myGrid', '', '', $this->session->userdata('theme')); // gridName, style, message
  echo $CI->view_library->html_gridFullFooter();

  // JavaScripts
  echo $CI->view_library->js_Header();
    echo $CI->view_library->js_columnDefs($queryResult); // queryArray
    echo $CI->view_library->js_gridOptions('gridOptions', 'columnDefs');
    echo $CI->view_library->js_sizeToFit('gridOptions');
    echo $CI->view_library->js_autoSizeAll('gridOptions');
    echo $CI->view_library->js_onFilterTextBoxChanged('gridOptions');
    echo $CI->view_library->js_onRefreshRow('gridOptions');
    echo $CI->view_library->js_onDownload('gridOptions');
    echo $CI->view_library->js_onSelectionChanged('gridOptions', 'selectedRows');
    echo $CI->view_library->js_onRowDoubleClicked('modalUpdate');
    echo $CI->view_library->js_loadGridData('gridOptions', 'setting/list_json');
    echo $CI->view_library->js_addEventListener('gridOptions', 'myGrid');
    echo $CI->view_library->js_processRow('AddRow', 'formCreate', 'setting/create', 'messageCreate', 'modalCreate');
    echo $CI->view_library->js_processRow('DeleteRow', 'formDelete', 'setting/delete', 'messageDelete', 'modalDelete');
    echo $CI->view_library->js_processRow('UpdateRow', 'formUpdate', 'setting/update', 'messageUpdate', 'modalUpdate');
    echo $CI->view_library->js_modalCheck('delete', 'gridOptions', 'modalDelete', 'selectedRows', 'formDelete');
    echo $CI->view_library->js_modalCheck('update', 'gridOptions', 'modalUpdate', 'selectedRows', 'formUpdate');
  echo $CI->view_library->js_Footer();

?>
