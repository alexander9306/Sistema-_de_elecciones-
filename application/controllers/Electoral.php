<?php
defined('BASEPATH') OR exit('No direct script access allowed');


session_start(); 

class Electoral extends CI_Controller{

    public function __construct(){
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        //$this->load->library('session');
    }
    
    public function index(){
        $this->form_validation->set_rules('cedula','cedula','trim|required|numeric|max_length[11]|min_length[11]',
            array(
                'required'=>'El campo %s es requerido',
                'numeric'=>'El campo %s debe ser numerico',
                'min_length'=>'El campo %s debe tener un minimo de 11 caracteres'
            )
            );
        $this->form_validation->set_message('comprobarCedula','Hubo un error al procesar su cedula');
        $this->form_validation->set_rules('clave','clave','required|max_length[20]',array('required'=>'El campo %s es requerido'));

        if ($this->form_validation->run() == false)
        {
            $this->load->view('plantillas/encabezado');
            $this->load->view('mesa_electoral/login');
            $this->load->view('plantillas/pie');
        }
        else{
            $usuario= array(
                'cedula'=>$this->input->post('cedula'),
                'clave'=>$this->input->post('clave')
            );
            if(core_usuario::verificarUsuario($usuario)){
                $usuario=core_usuario::cargarUsuarioCed($usuario['cedula']);
                if($usuario->rol==2){
                    $usuario = array(
                        'cedula'=>$usuario->cedula,
                        'rol'=>$usuario->rol,
                        'valido'=>true
                    );
                    $_SESSION['usuario']= $usuario;
                    redirect('electoral/mesa');
                }
                
            }else{
                $usuario['mensaje_error'] = 'Usuario o contraseña incorrectos';
                $this->load->view('plantillas/encabezado');
                $this->load->view('mesa_electoral/login',$usuario);
                $this->load->view('plantillas/pie');
            }
        }
    }

    public function logout(){
        unset($_SESSION['usuario']);
        $usuario['mensaje_error'] = 'El usuario ha sido deslogueado correctamente';
        $this->load->view('plantillas/encabezado');
        $this->load->view('mesa_electoral/login',$usuario);
        $this->load->view('plantillas/pie');
    }
    
    public function mesa(){
        if(isset($_SESSION['usuario'])){
            $this->load->view('plantillas/encabezado');
            $this->load->view('mesa_electoral/mesa');
            $this->load->view('plantillas/pie');
        }else{
            redirect('electoral');
        }
    }
 
}
