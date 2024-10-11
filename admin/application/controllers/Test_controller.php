<?php
class Test_controller extends CI_Controller {

   public $queryString = 'SELECT id, name, type, logo, description FROM Test';

  // Responsable for auto load the model
  public function __construct()
  {
    parent::__construct();

    // Load Model
    $this->load->model('test_model');

    if(!$this->session->userdata('is_logged_in')) {
      redirect('login');
    }
  }


  // Load the main view with all the current model model's data.
  public function index()
  {
    $queryResult = $this->test_model->getQueryData($this->queryString, TRUE);
    $data['queryResult'] = $queryResult;

    //load view
    $data['main_content'] = 'test_view';
    $this->load->view('includes/template', $data);

  } //index


  // Query setting table (json format)
  function get_json_data () 
  {
    $queryResult = $this->test_model->getQueryData($this->queryString, FALSE);
    $returnArray = array();
    if ($queryResult->num_rows() > 0) {
      foreach ($queryResult->result_array() as $row) {
        foreach($queryResult->list_fields() as $name) {
          $row_array[$name] = $row[$name];
        }
        array_push($returnArray, $row_array);
      }
    }

    echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);
  }


  // Add row
  function create() 
  {
    $name = trim($this->input->post('name'));
    $type = trim($this->input->post('type'));
    $logo = trim($this->input->post('logo'));
    $description = trim($this->input->post('description'));

    $queryResult = $this->test_model->create($name, $type, $logo, $description);
    if ($queryResult) {
      $returnCode = "S";
      $returnMessage = "Name " . $name . " created.";
    }
    else {
      $returnCode = "E";
      $dbError = $this->db->error();
      $returnMessage = $dbError['code'] . ' : ' . $dbError['message'];
    }

    $returnArray['status'] = $returnCode;
    $returnArray['responseText'] = $returnMessage;
    echo json_encode($returnArray);

  } //add_row


  // Delete row
  function delete() 
  {
    $id = trim($this->input->post('id'));

    $queryResult = $this->test_model->delete($id);
    if ($queryResult) {
      $returnCode = "S";
      $returnMessage = "Row deleted.";
    }
    else {
      $returnCode = "E";
      $dbError = $this->db->error();
      $returnMessage = $dbError['code'] . ' : ' . $dbError['message'];
    }

    $returnArray['status'] = $returnCode;
    $returnArray['responseText'] = $returnMessage;
    echo json_encode($returnArray);

  } //delete_row


  // Update row
  function update() 
  {
    $id = trim($this->input->post('id'));
    $name = trim($this->input->post('name'));
    $type = trim($this->input->post('type'));
    $logo = trim($this->input->post('logo'));
    $description = trim($this->input->post('description'));

    $queryResult = $this->test_model->update($id, $name, $type, $logo, $description);
    if ($queryResult) {
      $returnCode = "S";
      $returnMessage = "Row updated.";
    }
    else {
      $returnCode = "E";
      $dbError = $this->db->error();
      $returnMessage = $dbError['code'] . ' : ' . $dbError['message'];
    }

    $returnArray['status'] = $returnCode;
    $returnArray['responseText'] = $returnMessage;
    echo json_encode($returnArray);

  } //update_row


}

?>