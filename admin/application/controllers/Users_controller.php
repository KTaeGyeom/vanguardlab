<?php

class Users_controller extends CI_Controller {

   public $queryString = 'SELECT username, first_name, last_name, email_address, description FROM Users';

  // Responsable for auto load the model
  public function __construct()
  {
    parent::__construct();

    // Load Model
    $this->load->model('users_model');

    /*
    if(!$this->session->userdata('is_logged_in')) {
      redirect('login');
    */
  }


  // Load the main view with all the current model model's data.
  public function index()
  {
    $queryResult = $this->users_model->getQueryData('', $this->queryString, TRUE);
    $data['queryResult'] = $queryResult;

    //load view
    $data['main_content'] = 'users_view';
    $this->load->view('includes/template', $data);

  } //index


  // Query users table (json format)
  function get_json_data() {
    $queryResult = $this->users_model->getQueryData('', $this->queryString, FALSE);
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
  } //get_json_data

  /**
  * Create new user and store it in the database
  * @return void
  */
  function create() {
    $this->load->helper('email');

    $username = trim($this->input->post('username'));
    $password = trim($this->input->post('password'));
    $password2 = trim($this->input->post('password2'));
    $first_name = trim($this->input->post('first_name'));
    $last_name = trim($this->input->post('last_name'));
    $email_address = trim($this->input->post('email_address'));
    $description = trim($this->input->post('description'));

    // Validation - check user exists
    if ($this->users_model->check_user_exists($username)) {
      $returnArray['status'] = 'E';
      $returnArray['responseText'] = 'User already exists.';
      echo json_encode($returnArray);
      return;
    }

    // Validation - check password
    if ($password <> $password2) {
      $returnArray['status'] = 'E';
      $returnArray['responseText'] = 'Password and Confirm password is different.';
      echo json_encode($returnArray);
      return;
    }

    // Validation - check password rule
    if ($this->check_password_rule($password, 6, 30) == false) {
      $returnArray['status'] = 'E';
      $returnArray['responseText'] = 'Password must contain at least 6 characters including upper + lowercase, number and special character.';
      echo json_encode($returnArray);
      return;
    }

    // Validation - email
    if (! valid_email($email_address)) {
      $returnArray['status'] = 'E';
      $returnArray['responseText'] = 'Email format is not valid.';
      echo json_encode($returnArray);
      return;
    }

    $queryResult = $this->users_model->create($username, $password, $first_name, $last_name, $email_address, $description);
    if ($queryResult) {
      $returnArray['status'] = 'S';
      $returnArray['responseText'] = 'User ' . $username . ' created.';
      echo json_encode($returnArray);
      return;
    }
    else {
      $dbError = $this->db->error();
      $returnArray['status'] = 'E';
      $returnArray['responseText'] = $dbError['code'] . ' : ' . $dbError['message'];
      echo json_encode($returnArray);
      return;
    }
  } //create_user


  // Delete user and store it in the database
  function delete() {
    $username = trim($this->input->post('username'));

    // Validation - check user exists
    if (! $this->users_model->check_user_exists($username)) {
      $returnArray['status'] = 'E';
      $returnArray['responseText'] = 'Cannot find user "' . $username . '"';
      echo json_encode($returnArray);
      return;
    }

    $queryResult = $this->users_model->delete($username);
    if ($queryResult) {
      $returnArray['status'] = 'S';
      $returnArray['responseText'] = 'User ' . $username . ' deleted.';
      echo json_encode($returnArray);
      return;
    }
    else {
      $dbError = $this->db->error();
      $returnArray['status'] = 'E';
      $returnArray['responseText'] = $dbError['code'] . ' : ' . $dbError['message'];
      echo json_encode($returnArray);
      return;
    }
  } //delete_user


  // Update user and store it in the database
  function update() {
    $username = trim($this->input->post('username'));
    $password = trim($this->input->post('password'));
    $first_name = trim($this->input->post('first_name'));
    $last_name = trim($this->input->post('last_name'));
    $email_address = trim($this->input->post('email_address'));
    $description = trim($this->input->post('description'));

    // Validation - check user exists
    if (! $this->users_model->check_user_exists($username)) {
      $returnArray['status'] = 'E';
      $returnArray['responseText'] = 'Cannot find user "' . $username . '"';
      echo json_encode($returnArray);
      return;
    }

    $queryResult = $this->users_model->update($username, $password, $first_name, $last_name, $email_address, $description);
    if ($queryResult) {
      $returnArray['status'] = 'S';
      $returnArray['responseText'] = 'User ' . $username . ' updated.';
      echo json_encode($returnArray);
      return;
    }
    else {
      $returnCode = "E";
      $dbError = $this->db->error();
      $returnMessage = $dbError['code'] . ' : ' . $dbError['message'];
      echo json_encode($returnArray);
      return;
    }
  } //update_user


  /**
  * check the username and the password with the database
  * @return void
  */
  // admin / vlab2024@@
	function validate_credentials()	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$is_valid = $this->users_model->validate($username, $password);

		if($is_valid) {
      $systemName = $this->users_model->getSystemName();
      if ($systemName == '') {
        $systemName = 'Data Extract System for [Company Name]';
      }

      $_SESSION['username'] = $username;
      $_SESSION['is_logged_in'] = true;
      $_SESSION['systemname'] = $systemName;
      $_SESSION['theme'] = 'balham';

			redirect('home');
		}
		else { // incorrect username or password
			$data['message_error'] = TRUE;
			$this->load->view('login', $data);
		}
	}


  /**
  * Check if the user is logged in, if he's not, send him to the login page
  * @return void
  */
	function login() {
		if($this->session->userdata('is_logged_in')) {
        redirect('home');
    }
    else {
      $this->load->view('login');
    }
	}

	/**
  * Destroy the session, and logout the user.
  * @return void
  */
	function logout() {
    // $data = array(
    //   'username' . '_' . session_id(),
    //   'is_logged_in' . '_' . session_id(),
    //   'systemname' . '_' . session_id(),
    //   'theme' . '_' . session_id(),
    //   );
    // $this->session->unset_userdata($data);
		$this->session->sess_destroy();
 
		redirect('home');
	}

	/**
  * Check Password rule
  * @return boolean
  */
  function check_password_rule($password, $minLength, $maxLength) {

    $checkNumber = preg_match('/[0-9]/u', $password);
    $checkCharacter = preg_match('/[a-z]/u', $password);
    $checKSpace = preg_match("/[\!\@\#\$\%\^\&\*]/u", $password);
 
    if(strlen($password) < $minLength || strlen($password) > $maxLength) {
      //print "비밀번호는 영문, 숫자, 특수문자를 혼합하여 최소 " . $minLength . "자리 ~ 최대 " . $maxLength . "자리 이내로 입력해주세요." . PHP_EOL;
      return false;
    }
 
    if(preg_match("/\s/u", $password) == true) {
      //print "비밀번호는 공백없이 입력해주세요." . PHP_EOL;
      return false;
    }
 
    if( $checkNumber == 0 || $checkCharacter == 0 || $checKSpace == 0) {
      //print "영문, 숫자, 특수문자를 혼합하여 입력해주세요." . PHP_EOL;
      //return false;
    }
 
    return true;
  }


  // Change Theme
  function changeTheme() {
		$theme = $this->input->post('theme');

    $_SESSION['theme'] = $theme;

    $returnCode = "S";
    $returnMessage = "Success";

    $returnArray['status'] = $returnCode;
    $returnArray['responseText'] = $returnMessage;
    echo json_encode($returnArray);
  }

}

?>