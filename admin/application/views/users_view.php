<?php 
  $CI =& get_instance();
  $CI->load->library('view_library');

  echo $CI->view_library->html_title('user', 'Users'); // icon, title

  // Create Form
  echo $CI->view_library->html_formHeader('Create', 'modalCreate', 'modalLabelCreate', 'Add user', 'formCreate'); // processName, modalId, modalLable, modalTitle, formId
    echo $CI->view_library->html_formGroupText('Username', 'username', 'Input Username', '', TRUE, FALSE); // labelName, name, placeholder, value, required, readonly
    echo $CI->view_library->html_formGroupPassword('Passowrd', 'password', 'Input Password', '', TRUE, FALSE);
    echo $CI->view_library->html_formGroupPassword('Passowrd Confirm', 'password2', 'Input Password again', '', TRUE, FALSE);
    echo $CI->view_library->html_formGroupText('First Name', 'first_name', 'First Name', '', FALSE, FALSE);
    echo $CI->view_library->html_formGroupText('Last Name', 'last_name', 'Last Name', '', FALSE, FALSE);
    echo $CI->view_library->html_formGroupEmail('Email Address', 'email_address', 'Email', '', FALSE, FALSE);
    echo $CI->view_library->html_formGroupText('Description', 'description', 'Description', '', FALSE, FALSE);
    echo $CI->view_library->html_formAlert('messageCreate'); // message_id
  echo $CI->view_library->html_formFooterOpen();
    echo $CI->view_library->html_formFooterButton('primary', 'AddRow()', 'Submit'); // buttonStyle, onClickMethod, buttonLabel
  echo $CI->view_library->html_formFooterClose();

  // Delete Form
  echo $CI->view_library->html_formHeader('Delete', 'modalDelete', 'modalLabelDelete', 'Delete user', 'formDelete');
    echo $CI->view_library->html_formGroupText('Username', 'username', 'Username', '', TRUE, TRUE);
    echo $CI->view_library->html_formAlert('messageDelete');
  echo $CI->view_library->html_formFooterOpen();
    echo $CI->view_library->html_formFooterButton('primary', 'DeleteRow()', 'Submit');
  echo $CI->view_library->html_formFooterClose();

  // Update Form
  echo $CI->view_library->html_formHeader('Update', 'modalUpdate', 'modalLabelUpdate', 'Update user', 'formUpdate');
    echo $CI->view_library->html_formGroupText('Username', 'username', 'Userame', '', TRUE, TRUE);
    echo $CI->view_library->html_formGroupPassword('Passowrd', 'password', 'Input Password', '', TRUE, FALSE);
    echo $CI->view_library->html_formGroupPassword('Passowrd Confirm', 'password2', 'Input Password again', '', TRUE, FALSE);
    echo $CI->view_library->html_formGroupText('First Name', 'first_name', 'First Name', '', FALSE, FALSE);
    echo $CI->view_library->html_formGroupText('Last Name', 'last_name', 'Last Name', '', FALSE, FALSE);
    echo $CI->view_library->html_formGroupEmail('Email Address', 'email_address', 'Email', '', FALSE, FALSE);
    echo $CI->view_library->html_formGroupText('Description', 'description', 'Description', '', FALSE, FALSE);
    echo $CI->view_library->html_formAlert('messageUpdate');
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
    echo $CI->view_library->js_loadGridData('gridOptions', 'users/list_json');
    echo $CI->view_library->js_addEventListener('gridOptions', 'myGrid');
    echo $CI->view_library->js_processRow('AddRow', 'formCreate', 'users/create', 'messageCreate', 'modalCreate');
    echo $CI->view_library->js_processRow('DeleteRow', 'formDelete', 'users/delete', 'messageDelete', 'modalDelete');
    echo $CI->view_library->js_processRow('UpdateRow', 'formUpdate', 'users/update', 'messageUpdate', 'modalUpdate');
    echo $CI->view_library->js_modalCheck('delete', 'gridOptions', 'modalDelete', 'selectedRows', 'formDelete');
    echo $CI->view_library->js_modalCheck('update', 'gridOptions', 'modalUpdate', 'selectedRows', 'formUpdate');
  echo $CI->view_library->js_Footer();

?>