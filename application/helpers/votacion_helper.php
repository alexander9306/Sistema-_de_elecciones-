<?php

class core_votacion{
    static function guardarVotacion($votacion){
        $CI=& get_instance();
        $CI->db->insert('votacion',$votacion);
    }
    static function cargarVotaciones($votante){
        $CI=& get_instance();
        $CI->db->where('idvotante',$votante);
        $rs = $CI->db->get('votacion');
        $rs = $rs->result();

        if(count($rs)>0){
            return $rs;
        }
        return false;
    }

}