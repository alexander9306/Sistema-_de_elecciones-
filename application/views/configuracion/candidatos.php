
<form action="" method="post" id="busqueda" class="pt-5">
    <h2>Candidatos</h2>
 <p  class="pb-2">Agrega candidatos</p>
 <div class="md-form col-5">
        <i class="fas fa-user prefix"></i>
        <input type="text" id="input" class="form-control"  name="cedula" type="number" maxlength="11" placeholder="">
        <label for="input">Cedula:</label>
        <p id='msg' class="text-danger"><?= $error ?></p>
</div>

<div class="container pb-3">
<div class="row pb-4">
    <div class="col-1">
      <br>
      Partido:</div>
    <div class="col-5">
<select class="selectpicker" data-show-subtext="false" data-live-search="true" name="idpartido" id="">
    <?php
            $js= core_partido::cargarPartidos();
            foreach ($js as $j){
              $nombre=htmlspecialchars($j->nombre);
              if($js>0){
                echo "
                <option selected value={$j->idpartido} data-subtext='{$j->siglas}'>{$nombre}</option>
                ";
              }else{
                echo "
                <option selected value='0'>No hay Partidos disponibles</option>
                ";
              }
              
            }  
    ?>
</select>
        </div>  
</div>

<div class="row">
    <div class="col-1">
      <br>
      Nivel:
      </div>
    <div class="col-5">
<select class="selectpicker" data-show-subtext="false" data-live-search="true" name="idnivel" id="">
    <?php
            $js= core_nivel::cargarNiveles();
            foreach ($js as $j){
              $nombre=htmlspecialchars($j->nombre);
              if($js>0){
                echo "
                <option selected value={$j->idnivel}>{$nombre}</option>
                ";
              }else{
                echo "
                <option selected value='0'>No hay Niveles disponibles</option>
                ";
              }
              
            }  
    ?>
</select>
    </div>
</div>
</div >
    <div class="col-5 pt-3">
            <button class="btn btn-primary " onclick="validateInput()" type="button">Agregar</button>
            <a class="btn btn-danger" href="<?= base_url(); ?>" role="button">Cancelar</a>
        </div>
</form>




<div class="container user-table pt-5 ">
        <table id="dtabla" class="table table-striped table-bordered table-sm" cellspacing="0" class="table">
            <thead class='black white-text'>
                <tr class="text-light">
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Partido</th>
                    <th>Nivel</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ps = core_candidato::cargarCandidatos();
                if(count($ps)>0){
                foreach ($ps as $p) {
                    $persona=core_persona::cargarPersona($p->idcandidato);
                    $partido = core_partido::cargarPartido($p->idpartido);
                    $nivel = core_nivel::cargarNivel($p->idnivel);

                    $foto=htmlspecialchars($persona->foto);
                    $nombre=htmlspecialchars($persona->nombre);
                    $apellido=htmlspecialchars($persona->apellido);
                    $partido=htmlspecialchars($partido->nombre);
                    $nivel=htmlspecialchars($nivel->nombre);

                    $urlBorrar = base_url("configuracion/borrarCandidato/{$p->idcandidato}");
                    echo "<tr value='{$p->idcandidato}'> 
                            <td>
                            <img src='{$foto}' width='80' height='80' alt='...' class='img-thumbnail'>
                            </td> 
                            <td>{$nombre}</td> 
                            <td>{$apellido}</td> 
                            <td>{$partido}</td> 
                            <td>{$nivel}</td> 
                            <td> 
                            <a class='text-danger' href='{$urlBorrar}'>Eliminar</a>
                            </td>
                            </tr>";
                }
              }
                else{
                  echo "<tr> 
                            <td><p class='text-danger'>No hay Registros</p></td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>




<script>
function validateInput(){
        msg= document.getElementById('msg');
        input = document.getElementById('input').value;
        if(input.length<11 || input.length>11){
            msg.innerHTML='La cedula debe tener 11 caracteres';
        }
        else if(!/^\d+$/.test(input)){
            msg.innerHTML='La cedula debe tener solo numeros';
        }
        else{
            document.getElementById('busqueda').submit();
        }
    }
 </script>