<?php

class Test_model extends CI_Model {

  /**
  * Get data with the database
  * @param string $dbname
  * @param string $sql - SQL Statements
  * @param string $strunctOnly - if FALSE, result data is not queried
  * @return query
  */
  function getQueryData($sql, $strunctOnly = FALSE) 
  {

    if($strunctOnly) {
      $sql = "SELECT * FROM ( " . $sql . " ) WHERE 1 = 2";
    }

    $query = $this->db->query($sql);

    return $query;
  }

  // Add row
  function create($name, $type, $logo, $description) 
  {
    $data = array(
      'name' => $name,
      'type' => $type,
      'logo' => $logo,
      'description' => $description
    );
    $result = $this->db->insert('Test', $data);
    log_message('debug', 'Last query: ' . $this->db->last_query());

    return $result;

  } //add_row


  // Delete row
  function delete($id) 
  {
    $this->db->where('id', $id);
    $result = $this->db->delete('Test');
    log_message('debug', 'Last query: ' . $this->db->last_query());

    return $result;

  } //delete_row


  // Update row
  function update($id, $name, $type, $logo, $description) 
  {
    $data = array(
      'name' => $name,
      'type' => $type,
      'logo' => $logo,
      'description' => $description
    );
    $this->db->where('id', $id);
    $result = $this->db->update('Test', $data);
    log_message('debug', 'Last query: ' . $this->db->last_query());

    return $result;

  } //update_row

}
