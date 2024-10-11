<?php
class Image_controller extends CI_Controller {

  public $imageDir = FCPATH . '../img/logo/';
  
  // Responsable for auto load the model
  public function __construct() 
  {
    parent::__construct();
    
    if(!$this->session->userdata('is_logged_in')) {
      redirect('login');
    }
  }
  
  
  // System Log
  public function index() {
  
    //load view
    $data['main_content'] = 'image_view';
    $this->load->view('includes/template', $data);
  }


  // System Log Lists (json format)
  public function get_json_data() {
    // open this directory 
    $dir = opendir($this->imageDir);

    $dirArray = array();

    // get each entry
    while($file = readdir($dir)) {
      if ($file != "." && $file != ".." && $file != "index.html" && !is_dir($file)) {
        $dirRowArray['filename'] = $file;
        //$dirRowArray['filetype'] = filetype($logDir . $file);
        $dirRowArray['filesize'] = number_format(filesize($this->imageDir . $file));
        $dirRowArray['filectime'] = date('Y-m-d H:i:s', filectime($this->imageDir . $file));
        $dirRowArray['fileatime'] = date('Y-m-d H:i:s', fileatime($this->imageDir . $file));
        array_push($dirArray, $dirRowArray);
      }
    }
    
    closedir($dir);
    sort($dirArray);
    //print_r($dirArray);

    echo json_encode($dirArray);
  }

  
  // Add row
  function create() 
  {
    $config['upload_path'] = $this->imageDir;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('file')) {
      $returnCode = "E";
      $error = array('error' => $this->upload->display_errors());
      $returnMessage = $error['error'];
      print_r($error);
		}	
		else {
      $returnCode = "S";
      //$returnMessage = "Name " . $name . " created.";
      $returnMessage = "File uploaded";

		}

    $returnArray['status'] = $returnCode;
    $returnArray['responseText'] = $returnMessage;
    echo json_encode($returnArray);

  } //add_row
 

  // Delete row
  function delete() 
  {
    $filename = trim($this->input->post('filename'));

    unlink($this->imageDir . $filename);

    $returnCode = "S";
    $returnMessage = "Row deleted.";
    // }
    // else {
    //   $returnCode = "E";
    //   $dbError = $this->db->error();
    //   $returnMessage = $dbError['code'] . ' : ' . $dbError['message'];
    // }

    $returnArray['status'] = $returnCode;
    $returnArray['responseText'] = $returnMessage;
    echo json_encode($returnArray);

  } //delete_row

}

?>