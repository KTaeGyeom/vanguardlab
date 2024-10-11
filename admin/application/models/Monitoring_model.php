<?php

class Monitoring_model extends CI_Model {

  // Get data with the database
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


  //
  function purgeDays($count) {
    $sql = "DELETE FROM ReportHistoryLine WHERE	HeaderId IN ( SELECT Id FROM ReportHistoryHeader WHERE StartTime <= '" . $count . "')";
    $query = $this->db->query($sql);

    $sql = "DELETE FROM ReportHistoryHeader WHERE StartTime <= '" . $count . "'";
    $query = $this->db->query($sql);

    //return $result;
  }
  
  
  //
  function purgeCount($count) {
    $sql = "DELETE FROM ReportHistoryLine WHERE HeaderId NOT IN ( SELECT Id FROM ReportHistoryHeader ORDER BY Id DESC LIMIT " . $count . " )";
    $query = $this->db->query($sql);

    $sql = "DELETE FROM ReportHistoryHeader WHERE Id NOT IN ( SELECT Id FROM ReportHistoryHeader ORDER BY Id DESC LIMIT " . $count . " )";
    $query = $this->db->query($sql);
    
  }


}
