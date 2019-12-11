<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Electoral extends CI_Controller{
    
    public function index(){
        $this->load->view('plantillas/encabezado');
        $this->load->view('plantillas/pie');
    }
 
}
