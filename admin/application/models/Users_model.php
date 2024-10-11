<?php

class Users_model extends CI_Model {


  /**
  * Get data with the database
  * @param string $dbname
  * @param string $sql - SQL Statements
  * @param string $strunctOnly - if FALSE, result data is not queried
  * @return query
  */
  function getQueryData($dbname = 'default', $sql, $strunctOnly = FALSE) {
 
    if($dbname <> 'default') {
      $this->db = $this->load->database($dbname, TRUE);
    }
    
    if($strunctOnly) {
      $sql = "SELECT * FROM ( " . $sql . " ) WHERE 1 = 2";
    }

    $query = $this->db->query($sql);

    return $query;
  }


  // Get system name
  function getSystemName() {
    $this->db->from('Setting');
    $this->db->where('name', 'system_name');
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      $data = $query->row_array();
      $value = $data['value'];
      return $value;
    }
    else {
      return '';
    }
	} //create


  /**
  * Validate the login's data with the database
  * @param string $username
  * @param string $password
  * @return void
  */
  function validate($username, $password) {
    $sql = "SELECT * FROM Users WHERE username = ? AND password = ?";
    $query = $this->db->query($sql, array($username, $password));
    
    if($query->num_rows() == 1) {
      return true;
    }
    else {
      return false;
    }

  } //validate

 
  /**
  * Check user exists in the database
  * @return boolean
  */  
  function check_user_exists($username) {
    $sql = "SELECT * FROM Users WHERE username = ?";
    $query = $this->db->query($sql, array($username));
    
    if($query->num_rows() > 0)  {
      return true;
    }
    else {
      return false;
    }
  } //check_user_exists


  /**
  * Store the new user's data into the database
  * @return boolean - insert
  */  
  // Create user (New)
  function create($username, $password, $first_name, $last_name, $email_address, $description) {
    $data = array(
      'username' => $username,
      'password' => md5($password),
      'first_name' => $first_name,
      'last_name' => $last_name,
      'email_address' => $email_address,
      'description' => $description
    );
    $result = $this->db->insert('Users', $data);
    return $result;
        
  } //create_user
  

  /**
  * Delete user's data into the database
  * @return boolean - delete
  */  
  // Delete user (New)
  function delete($username) {
    $this->db->where('username', $username);
    $result = $this->db->delete('Users');

    return $result;
        
  } //delete_user


  /**
  * Update user's data into the database
  * @return boolean - delete
  */  
  // Update user (New)
  function update($username, $password, $first_name, $last_name, $email_address, $description) {
    $data = array(
      'password' => md5($password),
      'first_name' => $first_name,
      'last_name' => $last_name,
      'email_address' => $email_address,
      'description' => $description
    );
    $this->db->where('Username', $username);
    $result = $this->db->update('Users', $data);

    return $result;
        
  } //update_user

} //Users_model
