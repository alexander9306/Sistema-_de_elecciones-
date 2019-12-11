
<form method="post" action="" id="busqueda">
    <input type="hidden" name="idcandidato" id="candidato">
    <div class='pt-5'>
<?php
    echo "<input type='hidden' name='ideleccion' value='$eleccion'> ";
    echo "<input type='hidden' name='idvotante' value='$votante'> ";
    $ps = core_candidato::cargarCandidatosNivel($nivel);
    $num=0;
    if(count($ps)>0){
        for ($i = 0; $i < count($ps); $i++) {
            echo "<div class='row'>
            ";
            for ($j = 0; $j < 6; $j++) {
                if($j>=count($ps)){
                    break;
                }
                $persona=core_persona::cargarPersona($ps[$num]->idcandidato);
                $partido = core_partido::cargarPartido($ps[$num]->idpartido);
                $nivel = core_nivel::cargarNivel($ps[$num]->idnivel);

                $foto=htmlspecialchars($persona->foto);
                $nombre=htmlspecialchars($persona->nombre);
                $apellido=htmlspecialchars($persona->apellido);
                $siglas=htmlspecialchars($partido->siglas);
                $nivel=htmlspecialchars($nivel->nombre);
                $nombre=$nombre.' '.$apellido;

                echo "<div class='col-2'>
                <p class='text-center'>{$siglas}</p>
                <img  class='' src='{$foto}' alt='' style='width:90%'>
                <p class='text-center'>{$nombre}</p>
                <button id='{$ps[$num]->idcandidato}' onclick='votar(this.id)' type='button' class='btn text-center'>Votar</button>
                </div>
                ";
                $num=$num+1;
            }
            echo "</div>";
            if(count($ps)<6){
            break;
            }
        }
    }
    else{
        $urlNivel = base_url('votacion/eleccion/'.$votante.'/'.($nivel+1));
        $nivel= core_nivel::cargarNivel($nivel);
        echo "
                <p class='text-danger pt-4 h3'>No hay candidatos en el nivel {$nivel->nombre}</p>
                <a class='nav-link btn btn-info text-white' href='{$urlNivel}'>Siguiente</a>
            ";
    }
?>

</div>

<form>

<script>
function votar(id){
    document.getElementById("candidato").value=id;
    document.getElementById("busqueda").submit();

}
</script>