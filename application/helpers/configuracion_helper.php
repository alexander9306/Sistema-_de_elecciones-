<?php

function asgInput($nombre, $label, $value = '', $disable='', $type='text')
{
    $valor='';
    
    if(is_object($value) && isset($value->$nombre)){
        $valor=$value->$nombre;
    }
    $valor=htmlspecialchars($valor);

    $xml="<div class='input-group mb-3'>
            <div class ='input-group-prepend'>
                <span class='input-group-text' id='basiv-addon3'>{$label}<span>
            </div>
            <input value='{$valor}' name='{$nombre}' {$disable} type='{$type}' class='form-control'>
        </div>";
    return $xml;
}


class core_eleccion{
    static function cargarElecciones(){
        $CI=& get_instance();
        $rs = $CI->db->get('eleccion');
        if(!$rs){
            echo $CI->db->error();
        }
        return $rs->result();
    }
    static function cargarEleccionActivaID(){
        $CI=& get_instance();
        $CI->db->where('estado',1);
        $rs = $CI->db->get('eleccion');
        $rs = $rs->result();

        if(count($rs)>0){
            return $rs[0]->ideleccion;
        }
        return false;
    }
    static function guardarEleccion($eleccion){
        $CI=& get_instance();
        $eleccion['horario_comienzo']= $eleccion['horario_comienzo'].':00';
        $eleccion['horario_finalizacion']= $eleccion['horario_finalizacion'].':00';
        self::cambiarEstado();
        $CI->db->insert('eleccion',$eleccion);
    }
    static function nuevaEleccion(){
        $eleccion = new stdClass();
        $eleccion->ideleccion='';
        $eleccion->nombre='';
        $eleccion->fecha='';
        $eleccion->horario_comienzo='';
        $eleccion->horario_finalizacion='';
        $eleccion->estado=1;

        return $eleccion;
    }
    static function cambiarEstado(){
        $eleccion=array('estado' => 0); 
        $CI=& get_instance();
        $CI->db->where('estado',1);
        $CI->db->update('eleccion',$eleccion);
    }
    static function cargarEleccion($id){
        $CI=& get_instance();
        $CI->db->where('ideleccion',$id);
        $rs = $CI->db->get('eleccion');
        $rs = $rs->result();

        if(count($rs)>0){
            return $rs[0];
        }
        return false;
    }
    static function actualizarEleccion($id,$eleccion){ 
        $CI=& get_instance();
        self::cambiarEstado();
        $CI->db->where('ideleccion',$id);
        $CI->db->update('eleccion',$eleccion);
    }

}

class core_partido{
    static function cargarPartidos(){
        $CI=& get_instance();
        $rs = $CI->db->get('partido');
        if(!$rs){
            echo $CI->db->error();
        }
        return $rs->result();
    }
    static function nuevoPartido(){
        $partido = new stdClass();
        $partido->idpartido='';
        $partido->color='';  
        $partido->nombre='';
        $partido->siglas='';

        return $partido;
    }
    static function cargarPartido($id){
        $CI=& get_instance();
        $CI->db->where('idpartido',$id);
        $rs = $CI->db->get('partido');
        $rs = $rs->result();

        if(count($rs)>0){
            return $rs[0];
        }
        return false;
    }
    static function guardarPartido($partido){
        $CI=& get_instance();
        $CI->db->insert('partido',$partido);
    }
    static function actualizarPartido($id,$partido){ 
        $CI=& get_instance();
        $CI->db->where('idpartido',$id);
        $CI->db->update('partido',$partido);
    }
}

class core_persona{
    static function Edad($fechaNac){
        $fechaAct = date("Y");
        $edad = $fechaAct - date('Y', strtotime($fechaNac));
        return $edad;
    }
    
    static function guardarPersona($persona){
        $CI=& get_instance();
        $CI->db->insert('persona',$persona);
    }
    static function cargarPersona($id){
        $CI=& get_instance();
        $CI->db->where('idpersona',$id);
        $rs = $CI->db->get('persona');
        $rs = $rs->result();

        if(count($rs)>0){
            return $rs[0];
        }
        return false;
    }
    static function cargarPersonaId($cedula){
        $CI=& get_instance();
        $CI->db->where('cedula',$cedula);
        $rs = $CI->db->get('persona');
        $rs = $rs->result();

        if(count($rs)>0){
            return $rs[0]->idpersona;
        }
        return false;
    }
    static function cargarPersonas(){
        $CI=& get_instance();
        $rs = $CI->db->get('persona');
        if(!$rs){
            echo $CI->db->error();
        }
        return $rs->result();
    }
    static function borrarPersona($id){
        $CI=& get_instance();
        $CI->db->where('idpersona',$id);
        $CI->db->delete('persona');
    }
    static function cargar_zodiaco($fechaNac){
        $zodiac = '';
        list($year, $mes, $dia) = explode('-', $fechaNac);

        if (($mes == 3 && $dia > 20) || ($mes == 4 && $dia < 20)) {
            $zodiac = "Aries";
        } elseif (($mes == 4 && $dia > 19) || ($mes == 5 && $dia < 21)) {
            $zodiac = "Tauro";
        } elseif (($mes == 5 && $dia > 20) || ($mes == 6 && $dia < 21)) {
            $zodiac = "Géminis";
        } elseif (($mes == 6 && $dia > 20) || ($mes == 7 && $dia < 23)) {
            $zodiac = "Cáncer";
        } elseif (($mes == 7 && $dia > 22) || ($mes == 8 && $dia < 23)) {
            $zodiac = "Leo";
        } elseif (($mes == 8 && $dia > 22) || ($mes == 9 && $dia < 23)) {
            $zodiac = "Virgo";
        } elseif (($mes == 9 && $dia > 22) || ($mes == 10 && $dia < 23)) {
            $zodiac = "Libra";
        } elseif (($mes == 10 && $dia > 22) || ($mes == 11 && $dia < 22)) {
            $zodiac = "Escorpio";
        } elseif (($mes == 11 && $dia > 21) || ($mes == 12 && $dia < 22)) {
            $zodiac = "Sagitario";
        } elseif (($mes == 12 && $dia > 21) || ($mes == 1 && $dia < 20)) {
            $zodiac = "Capricornio";
        } elseif (($mes == 1 && $dia > 19) || ($mes == 2 && $dia < 19)) {
            $zodiac = "Acuario";
        } elseif (($mes == 2 && $dia > 18) || ($mes == 3 && $dia < 21)) {
            $zodiac = "Piscis";
        }

        return $zodiac;
    }
}

class core_nivel{
    static function cargarNiveles(){
        $CI=& get_instance();
        $rs = $CI->db->get('nivel');
        if(!$rs){
            echo $CI->db->error();
        }
        return $rs->result();
    }
    static function nuevoNivel(){
        $nivel = new stdClass();
        $nivel->idnivel='';
        $nivel->nombre='';

        return $nivel;
    }
    static function cargarNivel($id){
        $CI=& get_instance();
        $CI->db->where('idnivel',$id);
        $rs = $CI->db->get('nivel');
        $rs = $rs->result();

        if(count($rs)>0){
            return $rs[0];
        }
        return false;
    }
    static function guardarNivel($nivel){
        $CI=& get_instance();
        $CI->db->insert('nivel',$nivel);
    }
    static function actualizarNivel($id,$nivel){ 
        $CI=& get_instance();
        $CI->db->where('idnivel',$id);
        $CI->db->update('nivel',$nivel);
    }
}

class core_candidato{
    static function cargarCandidatos(){
        $CI=& get_instance();
        $rs = $CI->db->get('candidato');
        if(!$rs){
            echo $CI->db->error();
        }
        return $rs->result();
    }
    static function cargarCandidatosNivel($id){
        $CI=& get_instance();
        $CI->db->where('idnivel',$id);
        $rs = $CI->db->get('candidato');
        if(!$rs){
            echo $CI->db->error();
        }
        return $rs->result();
    }
    static function nuevoCandidato(){
        $candidato = new stdClass();
        $candidato->idcandidato='';
        $candidato->idpartido='';
        $candidato->idnivel='';

        return $candidato;
    }
    static function guardarCandidato($candidato){
        $CI=& get_instance();
        $CI->db->insert('candidato',$candidato);
    }
    static function borrarCandidato($id){
        $CI=& get_instance();
        $CI->db->where('idcandidato',$id);
        $CI->db->delete('candidato');
    }
}
class core_usuario{
    static function nuevoUsuario(){
        $usuario = new stdClass();
        $usuario->idusuario='';
        $usuario->clave='';
        $usuario->idrol='';

        return $usuario;
    }
    static function cargarUsuarios(){
        $CI=& get_instance();
        $rs = $CI->db->get('usuario');
        if(!$rs){
            echo $CI->db->error();
        }
        return $rs->result();
    }
    static function actualizarUsuario($id,$usuario){ 
        $CI=& get_instance();
        $CI->db->where('idusuario',$id);
        $CI->db->update('usuario',$usuario);
    }
    static function guardarUsuario($usuario){
        $CI=& get_instance();
        $CI->db->insert('usuario',$usuario);
    }
    static function borrarUsuario($id){
        $CI=& get_instance();
        $CI->db->where('idusuario',$id);
        $CI->db->delete('usuario');
    }
    static function cargarUsuario($id){
        $CI=& get_instance();
        $CI->db->where('idusuario',$id);
        $rs = $CI->db->get('usuario');
        $rs = $rs->result();

        if(count($rs)>0){
            return $rs[0];
        }
        return false;
    }
}

class core_rol{
    static function cargarRoles(){
        $CI=& get_instance();
        $rs = $CI->db->get('rol');
        if(!$rs){
            echo $CI->db->error();
        }
        return $rs->result();
    }
    static function cargarRol($id){
        $CI=& get_instance();
        $CI->db->where('idrol',$id);
        $rs = $CI->db->get('rol');
        $rs = $rs->result();

        if(count($rs)>0){
            return $rs[0];
        }
        return false;
    }
}
