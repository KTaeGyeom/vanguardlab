<?php

class Home_controller extends CI_Controller {

  /**
  * Responsable for auto load the model
  * @return void
  */
  public function __construct()
  {
    parent::__construct();

    if(!$this->session->userdata('is_logged_in')){
      redirect('login');
    }
  }


  function index() {

    //load the view
    $data['main_content'] = 'home_view';
    $this->load->view('includes/template', $data);  
  }

  function info() {

    //load the view
    $data['main_content'] = 'info_view';
    $this->load->view('includes/template', $data);  
  }

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

  function test() {

    echo 'BASEPATH:' . BASEPATH . '<br />';
    echo 'APPPATH:' . APPPATH . '<br />';

    /*
    $SorBackupPath = '/RUS/GRSExtract/SorBackup';
    $purgeDirs = scandir($SorBackupPath);
    foreach ($purgeDirs as $purgeDir) {
      if ($purgeDir != "." && $purgeDir != "..") {
        $this->delTree($SorBackupPath . '/' . $purgeDir);
        echo $purgeDir . ' directory Purged <br />';
      }
    }
    */

    /*
    $time = new DateTime();
    echo $time->format('Y-m-d H:i:s') . '<br />';

    var_dump($time);
    */
    
    
    //$this->gzcompressfile('C:\Temp\test.dat', 'C:\Temp\test.dat.gz');

    /*
    // Load the DB utility class
    $this->load->dbutil();

    // Backup your entire database and assign it to a variable
    $backup = $this->dbutil->backup();
    
    // Load the file helper and write the file to your server
    $this->load->helper('file');
    //write_file('C:/Temp/backup.gz', $backup);

    // Load the download helper and send the file to your desktop
    $this->load->helper('download');
    force_download('mybackup.gz', $backup);
    */

    //echo "Port: " . $_SERVER['SERVER_PORT'];

  }

}

?>