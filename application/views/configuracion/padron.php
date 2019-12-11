
<form action="" method="post" id="busqueda" class="pt-5">
    <h2 class="pb-2">Padron Electoral</h2>
            <p class="pb-2">Agrega personas al padron </p>
    <div class='form-group row '>

        <div class="md-form col-5">
            <i class="fas fa-user prefix"></i>
            <input type="text" id="input" class="form-control"  name="cedula" type="number" maxlength="11" placeholder="">
            <label for="input">Cedula:</label>
            <p id='msg' class="text-danger"><?= $error ?></p>
        </div>
        <div class="col-5">
            <button class="btn btn-primary " onclick="validateInput()" type="button">Agregar</button>
            <a class="btn btn-danger" href="<?= base_url(); ?>" role="button">Cancelar</a>
        </div>
        
    </div>
</form>


<div class="container user-table pt-5 ">
        <table id="dtabla" class="table table-striped table-bordered table-sm" cellspacing="0" class="table">
            <thead class='black white-text'>
                <tr class="text-light">
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cedula</th>
                    <th>FechaNac</th>
                    <th>Zodiaco</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ps = core_persona::cargarPersonas();
                if(count($ps)>0){
                foreach ($ps as $p) {
                    $z = core_persona::cargar_zodiaco($p->fechanac);
                    $urlBorrar = base_url("configuracion/borrarPersona/{$p->idpersona}");
                    echo "<tr value='{$p->idpersona}'> 
                            <td>
                            <img src='{$p->foto}' width='80' height='80' alt='...' class='img-thumbnail'>
                            </td> 
                            <td>{$p->nombre}</td> 
                            <td>{$p->apellido}</td> 
                            <td>{$p->cedula}</td> 
                            <td>{$p->fechanac}</td> 
                            <td>$z</td> 
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
       
       function borrar(url) {    
            if (confirm("Seguro que desea eliminar esta persona")) {
                window.location.replace(url);
            }
        }
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