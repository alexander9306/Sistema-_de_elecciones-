<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Votacion extends CI_Controller{

    public function index(){
        redirect('');
    }

    public function votar($id=''){
        if($id==0 || $id==''){
            redirect('');
        }
            $persona = core_persona::cargarPersona($id);
            $this->load->view('plantillas/encabezado');
            $this->load->view('votacion/datos',['persona'=>$persona]);
            $this->load->view('plantillas/pie');
    }

    public function eleccion($votante,$nivel=1){
        $val=core_nivel::cargarNivel($nivel);
        $eleccion =core_eleccion::cargarEleccionActivaID();
        if($val!=false){
            if($_POST){
                core_votacion::guardarVotacion($_POST);
                redirect('votacion/eleccion/'.$votante.'/'.($nivel+1));
             }
             $this->load->view('plantillas/encabezado');
             $this->load->view('votacion/eleccion',['votante'=>$votante,'nivel'=>$nivel,'eleccion'=>$eleccion]);
             $this->load->view('plantillas/pie');
        }else{
            redirect('votacion/confirmacion/'.$votante.'/'.$eleccion);
        }
    }

    public function confirmacion($votante,$eleccion){
        $this->load->view('plantillas/encabezado');
        $this->load->view('votacion/confirmacion',['votante'=>$votante,'eleccion'=>$eleccion]);
        $this->load->view('plantillas/pie');
    }

}
