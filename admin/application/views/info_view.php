<?php
  echo '<pre>';
  echo '* System Envionments' . '<br />';
  echo '  - BASEPATH : ' . BASEPATH . '<br />';
  echo '  - APPPATH : ' . APPPATH . '<br />';
  echo '  - SERVER_NAME : ' . $_SERVER['SERVER_NAME'] . '<br />';
  echo '  - SERVER_PORT : ' . $_SERVER['SERVER_PORT'] . '<br />';
    
  echo '<br />';

  echo '* Session Envionments' . '<br />';
  echo '  - username : ' . $this->session->userdata('username') . '<br />';
  echo '  - session_id : ' . session_id() . '<br />';
  echo '  - is_logged_in : ' . $this->session->userdata('is_logged_in') . '<br />';
  echo '  - theme : ' . $this->session->userdata('theme') . '<br />';
  echo '</pre>';
?>