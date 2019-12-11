<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller{
    
    public function index(){
        $DB1 = $this->load->database('default',TRUE);
        if(!$DB1->database){
            redirect('install/index.php');
          }
        $this->load->view('plantillas/encabezado');
        $this->load->view('plantillas/pie');
    }
    public function install(){
        redirect('install');
    }
}
