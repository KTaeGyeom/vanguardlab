<?php
class Systemlog_controller extends CI_Controller {

  // https://github.com/SeunMatt/codeigniter-log-viewer/blob/master/src/CILogViewer.php

  const LOG_LINE_START_PATTERN = "/((INFO)|(ERROR)|(DEBUG)|(ALL))[\s\-\d:\.\/]+(-->)/";
  const LOG_DATE_PATTERN = ["/^((ERROR)|(INFO)|(DEBUG)|(ALL))\s\-\s/", "/\s(-->)/"];
  const LOG_LEVEL_PATTERN = "/^((ERROR)|(INFO)|(DEBUG)|(ALL))/";

 
  // Responsable for auto load the model
  public function __construct() 
  {
    parent::__construct();
    
    // Load Model
    //$this->load->model('reports_model');

    if(!$this->session->userdata('is_logged_in')) {
      redirect('login');
    }
  }
  
  
  // System Log
  public function index() {
  
    //load view
    $data['main_content'] = 'systemlog_view';
    $this->load->view('includes/template', $data);
  }


  // System Log Lists (json format)
  public function systemlog_json() {
    $logDir = FCPATH . 'application/logs/';

    // open this directory 
    $dir = opendir($logDir);

    $dirArray = array();

    // get each entry
    while($file = readdir($dir)) {
      if ($file != "." && $file != ".." && $file != "index.html") {
        $dirRowArray['filename'] = $file;
        //$dirRowArray['filetype'] = filetype($logDir . $file);
        $dirRowArray['filesize'] = number_format(filesize($logDir . $file));
        $dirRowArray['filectime'] = date('Y-m-d H:i:s', filectime($logDir . $file));
        $dirRowArray['fileatime'] = date('Y-m-d H:i:s', fileatime($logDir . $file));
        array_push($dirArray, $dirRowArray);
      }
    }
    
    closedir($dir);
    rsort($dirArray);
    //print_r($dirArray);

    echo json_encode($dirArray);
  }


  // System Log Contents (json format)
  public function systemlog_detail_json() {
        
    $logDir = FCPATH . 'application/logs/';
    $fileName = $logDir . $this->uri->segment(3);

    $logs = file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    $logArray = array();
    
    foreach ($logs as $log) {
      $logLineStart = $this->getLogLineStart($log);
      
      if(!empty($logLineStart)) {
        //this is actually the start of a new log and not just another line from previous log
        $level = $this->getLogLevel($logLineStart);
        $logMessage = preg_replace(self::LOG_LINE_START_PATTERN, '', $log);

        $logRowArray['loglevel'] = $level;
        $logRowArray['logdate'] = $this->getLogDate($logLineStart);
        $logRowArray['logmessage'] = $logMessage;
        array_push($logArray, $logRowArray);
      }
    }
    
    echo json_encode($logArray);
  }
  
  /////////////

  private function getLogLevel($logLineStart) {
    preg_match(self::LOG_LEVEL_PATTERN, $logLineStart, $matches);
    return $matches[0];
  }

  private function getLogDate($logLineStart) {
    return preg_replace(self::LOG_DATE_PATTERN, '', $logLineStart);
  }

  private function getLogLineStart($logLine) {
    preg_match(self::LOG_LINE_START_PATTERN, $logLine, $matches);
    if(!empty($matches)) {
      return $matches[0];
    }
    return "";
  }

  private function getLogs($fileName) {
    return file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  }

}

?>