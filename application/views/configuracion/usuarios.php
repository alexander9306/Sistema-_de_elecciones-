
<form method="post" action="" id="busqueda" class="pt-5">
    <h2 class="pb-2">Usuarios</h2>
    <p  class="pb-2">Agrega usuarios o administradores</p>
    <div class="md-form col-5">
        <i class="fas fa-user prefix"></i>
        <input type="text" id="input" class="form-control" value='<?=$usuario->cedula?>'  name="cedula" type="number" maxlength="11" placeholder="">
        <label for="input">Cedula:</label>
    </div>
    <div class="md-form col-5">
        <i class="fas fa-lock prefix"></i>
        <input type="password" maxlength="20" id="" class="form-control" requiered  name="clave" placeholder="">
        <label for="input">Clave:</label>
        <p id='msg' class="text-danger"><?= $error ?></p>
        <?= validation_errors('<span class="text-danger" >', '<br></span>'); ?>
    </div>
    <div class="row pb-4">
    <div class="col-1">
      <br>
      Rol:</div>
    <div class="col-5">
    <select class="selectpicker" data-show-subtext="false" data-live-search="true" name="idrol" id="">
    <?php
            $js= core_rol::cargarRoles();
            foreach ($js as $j){
              $nombre=htmlspecialchars($j->nombre);
              if($js>0){
                echo "
                <option selected value={$j->idrol}>{$nombre}</option>
                ";
              }else{
                echo "
                <option selected value='0'>No hay Roles disponibles</option>
                ";
              }
              
            }  
    ?>
</select>
        </div>  
</div>

    <div class="col-5 pt-3">
            <button class="btn btn-primary " onclick="validateInput()" type="button">Agregar</button>
            <a class="btn btn-danger" href="<?= base_url(); ?>" role="button">Cancelar</a>
        </div>
</form>



<div class="container user-table pt-5 ">
        <table id="dtabla" class="table table-striped table-bordered table-sm" cellspacing="0" class="table">
            <thead class='black white-text'>
                <tr class="text-light">
                    <th>#</th>
                    <th>Cedula</th>
                    <th>Rol</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ps = core_usuario::cargarUsuarios();
                if(count($ps)>0){
                foreach ($ps as $p) {
                    $rol=core_rol::cargarRol($p->idrol);
                    $rol=htmlspecialchars($rol->nombre);
                    $cedula=htmlspecialchars($p->cedula);
                    $urlEdit = base_url("configuracion/editarUsuario/{$p->idusuario}");
                    $urlBorrar = base_url("configuracion/borrarUsuario/{$p->cedula}");
                    echo "<tr value='{$p->idusuario}'> 
                            <td>{$p->idusuario}</td> 
                            <td>{$cedula}</td> 
                            <td>{$rol}</td> 
                            <td> 
                                <a href='{$urlEdit}' class=' text-success'>Editar</a>
                            </td>
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