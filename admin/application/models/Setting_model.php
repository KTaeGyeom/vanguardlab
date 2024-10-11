<?php

class Setting_model extends CI_Model {

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

  // Add row
  function create($setup_group, $name, $value, $description) {
    $data = array(
      'setup_group' => $setup_group,
      'name' => $name,
      'value' => $value,
      'description' => $description
    );
    $result = $this->db->insert('Setting', $data);
    log_message('debug', 'Last query: ' . $this->db->last_query());

    return $result;

  } //add_row


  // Delete row
  function delete($id) {
    $this->db->where('id', $id);
    $result = $this->db->delete('Setting');
    log_message('debug', 'Last query: ' . $this->db->last_query());

    return $result;

  } //delete_row


  // Update row
  function update($id, $setup_group, $name, $value, $description) {
    $data = array(
      'setup_group' => $setup_group,
      'name' => $name,
      'value' => $value,
      'description' => $description
    );
    $this->db->where('id', $id);
    $result = $this->db->update('Setting', $data);
    log_message('debug', 'Last query: ' . $this->db->last_query());

    return $result;

  } //update_row

}
