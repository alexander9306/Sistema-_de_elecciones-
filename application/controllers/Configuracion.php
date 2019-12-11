<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends CI_Controller{
    
    public function index(){
        $this->load->view('plantillas/encabezado');
        $this->load->view('configuracion/menu');
        $this->load->view('plantillas/pie');
    }

    public function elecciones(){
        $eleccion=core_eleccion::nuevaEleccion();
        $this->load->view('plantillas/encabezado');
        $this->load->view('configuracion/menu');
        $this->load->view('configuracion/elecciones',['eleccion'=>$eleccion]);
        $this->load->view('plantillas/pie');
        if($_POST){
           core_eleccion::guardarEleccion($_POST);
           redirect('/configuracion/elecciones');
        }

    }

    public function editarEleccion($id=0){
        if($_POST){
            core_eleccion::actualizarEleccion($id,$_POST);
            redirect('/configuracion/elecciones');
        }
        if($id==0){
            redirect('');
        }
        $eleccion=core_eleccion::cargarEleccion($id);
        $this->load->view('plantillas/encabezado');
        $this->load->view('configuracion/menu');
        $this->load->view('configuracion/elecciones',['eleccion'=>$eleccion]);
        $this->load->view('plantillas/pie');
    }


    public function partidos(){
        $partido=core_partido::nuevoPartido();
        $this->load->view('plantillas/encabezado');
        $this->load->view('configuracion/menu');
        $this->load->view('configuracion/partidos',['partido'=>$partido]);
        $this->load->view('plantillas/pie');
        if($_POST){
            core_partido::guardarPartido($_POST);
            redirect('/configuracion/partidos');
        }
    }
    public function editarPartido($id=0){
        if($_POST){
            core_partido::actualizarPartido($id,$_POST);
            redirect('/configuracion/partidos');
        }
        if($id==0){
            redirect('');
        }
        $partido=core_partido::cargarPartido($id);
        $this->load->view('plantillas/encabezado');
        $this->load->view('configuracion/menu');
        $this->load->view('configuracion/partidos',['partido'=>$partido]);
        $this->load->view('plantillas/pie');
    }
    public function niveles(){
        $nivel=core_nivel::nuevoNivel();
        $this->load->view('plantillas/encabezado');
        $this->load->view('configuracion/menu');
        $this->load->view('configuracion/niveles',['nivel'=>$nivel]);
        $this->load->view('plantillas/pie');
        if($_POST){
            core_nivel::guardarNivel($_POST);
            redirect('/configuracion/niveles');
        }
    }
    public function editarNivel($id){
        if($_POST){
            core_nivel::actualizarNivel($id,$_POST);
            redirect('/configuracion/niveles');
        }
        if($id==0){
            redirect('');
        }
        $nivel=core_nivel::cargarNivel($id);
        $this->load->view('plantillas/encabezado');
        $this->load->view('configuracion/menu');
        $this->load->view('configuracion/niveles',['nivel'=>$nivel]);
        $this->load->view('plantillas/pie');
    }

    public function padronjce(){
        $error = '';

        if($_POST){
            $ruta = $_POST['cedula'];
            $direccion = "http://173.249.49.169:88/api/test/consulta/" . $ruta;
            $json = file_get_contents($direccion);
            $datos = json_decode($json, true);
            if (!$datos['Ok']) {
                $error = "La cedula no es válida";
            } elseif (core_persona::Edad($datos['FechaNacimiento']) < 18) {
                $error = "La edad es menor a 18 años";
            } else {
                $persona = new stdClass();
                $persona->nombre = $datos['Nombres'];
                $persona->apellido = $datos['Apellido1'];
                $persona->cedula = $datos['Cedula'];
                $persona->fechanac = date('Y-m-d', strtotime($datos['FechaNacimiento']));
                $persona->foto = $datos['Foto'];
                core_persona::guardarPersona($persona);
            }
        }
        $this->load->view('plantillas/encabezado');
        $this->load->view('configuracion/menu');
        $this->load->view('configuracion/padron',['error'=>$error]);
        $this->load->view('plantillas/pie');
    }
    public function borrarPersona($id){
       
        if($_POST){
            core_persona::borrarPersona($id);
            redirect('configuracion/padronjce');
        }
        $this->load->view('configuracion/borrarPersona',['id'=>$id]);
    }

    public function candidatos(){
        $error='';
        $candidato=core_candidato::nuevoCandidato();
        if($_POST){
            $id=core_persona::cargarPersonaId($_POST['cedula']);
            if($id){
                $candidato->idcandidato=$id;
                $candidato->idpartido=$_POST['idpartido'];
                $candidato->idnivel=$_POST['idnivel'];
                core_candidato::guardarCandidato($candidato);
                redirect('/configuracion/candidatos');
            }else{
                $error="La persona no esta en el padron electoral";
            }
        }
        $this->load->view('plantillas/encabezado');
        $this->load->view('configuracion/menu');
        $this->load->view('configuracion/candidatos',['candidato'=>$candidato,'error'=>$error]);
        $this->load->view('plantillas/pie');
        
    }

    public function borrarCandidato($id){
        if($_POST){
            core_candidato::borrarCandidato($id);
            redirect('/configuracion/candidatos');
        }
        $this->load->view('configuracion/borrarPersona',['id'=>$id]);
    }

    public function usuarios(){
        $error='';
        $usuario = core_usuario::nuevoUsuario();
        if($_POST){
            $id=core_persona::cargarPersonaId($_POST['cedula']);
            if($id){
                $usuario->idusuario=$id;
                $usuario->clave=$_POST['clave'];
                $usuario->idrol=$_POST['idrol'];
                core_usuario::guardarUsuario($usuario);
                redirect('/configuracion/usuarios');
            }else{
                $error="La persona no esta en el padron electoral";
            }
        }
        $this->load->view('plantillas/encabezado');
        $this->load->view('configuracion/menu');
        $this->load->view('configuracion/usuarios',['usuario'=>$usuario,'error'=>$error]);
        $this->load->view('plantillas/pie');
    }
    public function editarUsuario($id){
        $error='';
        if($_POST){
            $usuario = core_usuario::nuevoUsuario();
            $usuario->idusuario=$id;
            $usuario->clave=$_POST['clave'];
            $usuario->idrol=$_POST['idrol'];
            core_usuario::actualizarUsuario($id,$usuario);
            redirect('/configuracion/usuarios');
        }
        if($id==0){
            redirect('');
        }
        $usuario=core_usuario::cargarUsuario($id);
        $this->load->view('plantillas/encabezado');
        $this->load->view('configuracion/menu');
        $this->load->view('configuracion/usuarios',['usuario'=>$usuario,'error'=>$error]);
        $this->load->view('plantillas/pie');
    }
    public function borrarUsuario($id){
        if($_POST){
            core_usuario::borrarUsuario($id);
            redirect('/configuracion/usuarios');
        }
        $this->load->view('configuracion/borrarPersona',['id'=>$id]);
    }
 
}
