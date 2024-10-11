<?php

class Reference_model extends CI_Model {

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


  // List client
  function list_client() {
    $sql = "SELECT id, name, icon, logo FROM Party WHERE type = 'client' ORDER BY name";
    $query = $this->db->query($sql);

    return $query;
  }

  
  // Add row
  function create($project, $customer, $term, $content, $istop, $display, $tag)
  {
    $data = array(
      'project' => $project,
      'customer' => $customer,
      'term' => $term,
      'content' => $content,
      'istop' => $istop,
      'display' => $display,
      'tag' => $tag
    );
    $result = $this->db->insert('Reference', $data);
    log_message('debug', 'Last query: ' . $this->db->last_query());

    return $result;

  } //add_row


  // Delete row
  function delete($id) 
  {
    $this->db->where('id', $id);
    $result = $this->db->delete('Reference');
    log_message('debug', 'Last query: ' . $this->db->last_query());

    return $result;

  } //delete_row


  // Update row
  function update($id, $project, $customer, $term, $content, $istop, $display, $tag)
  {
    $data = array(
      'project' => $project,
      'customer' => $customer,
      'term' => $term,
      'content' => $content,
      'istop' => $istop,
      'display' => $display,
      'tag' => $tag
    );
    $this->db->where('id', $id);
    $result = $this->db->update('Reference', $data);
    log_message('debug', 'Last query: ' . $this->db->last_query());

    return $result;

  } //update_row

}
