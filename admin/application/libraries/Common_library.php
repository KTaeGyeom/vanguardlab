<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_library {

  public $gzStreamLength = 1024 * 1024; // 1 MB

  protected $CI;
  

  // We'll use a constructor, as you can't directly call a function from a property definition.
  public function __construct() {
    // Assign the CodeIgniter super-object
    $this->CI =& get_instance();
  }

  
  // Get database group list from database.php file
  public function getDbList() {
    
    if ( ! file_exists($f = APPPATH . 'config/' . ENVIRONMENT . '/database.php')
      && ! file_exists($f = APPPATH . 'config/database.php')) {
      show_error('The configuration file database.php does not exist.');
    }

    include($f);
  
    // Use a NEW variable.  
    // Because $db is a reserved name!!
    $db_settings = $db;

    return $db_settings;
  } //getDbList()


  // Encrypt data
  public function encrypt($str) {
    $saltString = md5('1234567890');
    $saltLength = strlen($saltString);        
        
    $length = strlen($str);
    $result = '';
    for($i=0; $i<$length; $i++) {
      $char    = substr($str, $i, 1);
      $keychar = substr($saltString, ($i % $saltLength) - 1, 1);
      $char    = chr(ord($char) + ord($keychar));
      $result .= $char;
    }
    return base64_encode($result);
  } //encrypt($str)
  

  // Decrypt data
  public function decrypt($str) {
    $saltString = md5('1234567890');
    $saltLength = strlen($saltString);        

    $result = '';
    $str    = base64_decode($str);
    $length = strlen($str);
    for($i=0; $i<$length; $i++) {
        $char    = substr($str, $i, 1);
        $keychar = substr($saltString, ($i % $saltLength) - 1, 1);
        $char    = chr(ord($char) - ord($keychar));
        $result .= $char;
    }
    return $result;
  } //decrypt($str)


  // Compress
  function gzcompressfile($inFilename, $outFilename) {

    $level = 9;

    // Open input file
    $inFile = fopen($inFilename, "rb");
    if ($inFile === false) {
      throw new \Exception("Unable to open input file: $inFilename");
    }

    // Open output file
    $gzFilename = $outFilename;
    $mode = "wb" . $level;
    $gzFile = gzopen($gzFilename, $mode);
    if ($gzFile === false) {
      fclose($inFile);
      throw new \Exception("Unable to open output file: $gzFilename");
    }

    // Stream copy
    while (!feof($inFile)) {
      gzwrite($gzFile, fread($inFile, $this->gzStreamLength));
    }

    // Close files
    fclose($inFile);
    gzclose($gzFile);
    chmod($gzFilename, 0666);
    
    // Delete input File
    unlink ($inFilename);

  } //gzcompressfile($inFilename, $outFilename)
  
  
  // Delete directory with sub directory and files
  function delTree($dir) {
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
      (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
  } //delTree($dir)


  // Get Connection Array
  function getConnectionArray($connRow) {

    //$exp = null;

    switch ($connRow['drive']) {
      // SQL Server
      case 'pdo_sqlsvr':
        $dsnStr = 'sqlsrv:Server=' . $connRow['host'] . ',' . $connRow['port'] . ';Database=' . $connRow['default_database'];
        $exp = array(
          'dsn'   => $dsnStr,
          'username' => $connRow['username'],
          'password' => $this->decrypt($connRow['password']),
          'dbdriver' => 'pdo',
          'dbprefix' => '',
          'pconnect' => FALSE,
          'db_debug' => FALSE ,
          'cache_on' => FALSE,
          'cachedir' => '',
          'char_set' => $connRow['char_set'],
          'dbcollat' => $connRow['dbcollat'],
          'swap_pre' => '',
          'autoinit' => FALSE,
          'encrypt' => FALSE,
          'compress' => FALSE,
          'stricton' => FALSE,
          'failover' => array(),
          'save_queries' => FALSE
          );
        break;

      // MySQL(MariaDB)
      case 'pdo_mysql':
        $dsnStr = 'mysql:host=' . $connRow['host'] . ';port=' . $connRow['port'] . ';dbname=' . $connRow['default_database'];
        $exp = array(
          'dsn'   => $dsnStr,
          'username' => $connRow['username'],
          'password' => $this->decrypt($connRow['password']),
          'dbdriver' => 'pdo',
          'dbprefix' => '',
          'pconnect' => FALSE,
          'db_debug' => FALSE ,
          'cache_on' => FALSE,
          'cachedir' => '',
          'char_set' => $connRow['char_set'],
          'dbcollat' => $connRow['dbcollat'],
          'swap_pre' => '',
          'autoinit' => FALSE,
          'encrypt' => FALSE,
          'compress' => FALSE,
          'stricton' => FALSE,
          'failover' => array(),
          'save_queries' => FALSE
          );
        break;

      // SQLite3
      case 'pdo_sqlite':
        $dsnStr = 'sqlite:' . $connRow['default_database'];
        $exp = array(
            'dsn'   => $dsnStr,
            'dbdriver' => 'pdo',
            'dbprefix' => '',
            'pconnect' => FALSE,
            'db_debug' => FALSE ,
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => $connRow['char_set'],
            'dbcollat' => $connRow['dbcollat'],
            'swap_pre' => '',
            'autoinit' => FALSE,
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => FALSE
        );
        break;

      // Oracle
      case 'pdo_oci':
        //putenv("PATH=" . 'C:\KebHana\InstanceClient_12_2;' . getenv("PATH"));
        $dsnStr = 'oci:dbname=(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=' . $connRow['host'] . ')(PORT=' . $connRow['port'] . ')))' .
                        '(CONNECT_DATA=(SERVICE_NAME=' . $connRow['default_database'] . ')))';
        $exp = array(
          'dsn' => $dsnStr,
          'username' => $connRow['username'],
          'password' => $this->decrypt($connRow['password']),
          'dbdriver' => 'pdo',
          'dbprefix' => '',
          'pconnect' => FALSE,
          'db_debug' => FALSE ,
          'cache_on' => FALSE,
          'cachedir' => '',
          'char_set' => $connRow['char_set'],
          'dbcollat' => $connRow['dbcollat'],
          'swap_pre' => '',
          'autoinit' => FALSE,
          'encrypt' => FALSE,
          'compress' => FALSE,
          'stricton' => FALSE,
          'failover' => array(),
          'save_queries' => FALSE
          );
        break;

      case 'oci':
        $dsnStr = '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=' . $connRow['host'] . ')(PORT=' . $connRow['port'] . ')))' .
                        '(CONNECT_DATA=(SERVICE_NAME=' . $connRow['default_database'] . ')))';
        $exp = array(
          'hostname' => $dsnStr,
          'username' => $connRow['username'],
          'password' => $this->decrypt($connRow['password']),
          'dbdriver' => 'oci8',
          'dbprefix' => '',
          'pconnect' => FALSE,
          'db_debug' => FALSE ,
          'cache_on' => FALSE,
          'cachedir' => '',
          'char_set' => $connRow['char_set'],
          'dbcollat' => $connRow['dbcollat'],
          'swap_pre' => '',
          'autoinit' => TRUE,
          'encrypt' => FALSE,
          'compress' => FALSE,
          'stricton' => FALSE,
          'failover' => array(),
          'save_queries' => FALSE
          );
        break;

      // PostgreSQL
      case 'pdo_pgsql':
        $dsnStr = 'pgsql:host=' . $connRow['host'] . ';port=' . $connRow['port'] . ';dbname=' . $connRow['default_database'];
        $exp = array(
          'dsn'   => $dsnStr,
          'username' => $connRow['username'],
          'password' => $this->decrypt($connRow['password']),
          'dbdriver' => 'pdo',
          'dbprefix' => '',
          'pconnect' => FALSE,
          'db_debug' => FALSE ,
          'cache_on' => FALSE,
          'cachedir' => '',
          'char_set' => $connRow['char_set'],
          'dbcollat' => $connRow['dbcollat'],
          'swap_pre' => '',
          'autoinit' => FALSE,
          'encrypt' => FALSE,
          'compress' => FALSE,
          'stricton' => FALSE,
          'failover' => array(),
          'save_queries' => FALSE
          );

        break;

        default:

    }

    return $exp;

  } //getConnectionArray($connRow)


}