<?php
class Reference_controller extends CI_Controller {

  public $queryString = "SELECT r.id, r.project, r.customer, r.term, r.content, p.logo, p.icon, r.istop, r.display, r.tag FROM Reference r LEFT JOIN party p ON p.name  = r.customer AND p.type = 'client' ORDER BY r.term DESC";

  // Responsable for auto load the model
  public function __construct()
  {
    parent::__construct();

    // Load Model
    $this->load->model('reference_model');

    if(!$this->session->userdata('is_logged_in')) {
      redirect('login');
    }
  }


  // Load the main view with all the current model model's data.
  public function index()
  {
    $queryResult = $this->reference_model->getQueryData($this->queryString, TRUE);
    $data['queryResult'] = $queryResult;

    // Select database list
    $clientList = $this->reference_model->list_client();

    // Read client lists
    $data['clientList'] = $clientList;

    //load view
    $data['main_content'] = 'reference_view';
    $this->load->view('includes/template', $data);

  } //index


  // Query setting table (json format)
  function get_json_data () 
  {
    $queryResult = $this->reference_model->getQueryData($this->queryString, FALSE);
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
    $type = trim($this->input->post('type'));
    $customer = trim($this->input->post('customer'));
    $project = trim($this->input->post('project'));
    $term = trim($this->input->post('term'));
    $content = trim($this->input->post('content'));
    $istop = trim($this->input->post('istop'));
    $display = trim($this->input->post('display'));
    $tag = trim($this->input->post('tag'));

    $queryResult = $this->reference_model->create($project, $customer, $term, $content, $istop, $display, $tag);
    if ($queryResult) {
      $returnCode = "S";
      $returnMessage = "Project " . $project . " created.";
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

    $queryResult = $this->reference_model->delete($id);
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
    $customer = trim($this->input->post('customer'));
    $project = trim($this->input->post('project'));
    $term = trim($this->input->post('term'));
    $content = trim($this->input->post('content'));
    $istop = trim($this->input->post('istop'));
    $display = trim($this->input->post('display'));
    $tag = trim($this->input->post('tag'));

    $queryResult = $this->reference_model->update($id, $project, $customer, $term, $content, $istop, $display, $tag);
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