<form method="post" action="" class="pt-5">
    <h2 class="pb-2">Elecciones</h2>
    <p  class="pb-2">Agrega elecciones</p>
    <?= asgInput('ideleccion', 'ID',$eleccion,'disabled'); ?>
    <?= asgInput('nombre', 'Nombre',$eleccion); ?>
    <?= asgInput('fecha', 'Fecha',$eleccion,'','date'); ?>
    <?= asgInput('horario_comienzo', 'Hora_comienzo',$eleccion,'','time'); ?>
    <?= asgInput('horario_finalizacion', 'Hora_finalizacion',$eleccion,'','time'); ?>
   <div class="custom-control custom-checkbox custom-control-inline">
        <input type="checkbox" name="estado" checked value="<?=$eleccion->estado?>" class="custom-control-input" id="defaultInline1">
        <label class="custom-control-label" for="defaultInline1">Estado</label>
    </div>
    <div class="pt-4">
        <button type="submit" class="m-3 btn btn-primary">Guardar</button>
        <a class="btn btn-danger" href="<?= base_url(); ?>" role="button">Cancelar</a>
    </div>
</form>

<div class="container pt-5">
<table class="table">
  <thead class="black white-text">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Fecha</th>
      <th scope="col">Hora_comienzo</th>
      <th scope="col">Hora_final</th>
      <th scope="col">Estado</th>
      <th scope="col">Editar</th>
    </tr>
  </thead>
  <tbody>
      <?php
      $js= core_eleccion::cargarElecciones();
      if(count($js)>0){
      foreach ($js as $j){
        $urlEdit = base_url("configuracion/editarEleccion/{$j->ideleccion}");
        $nombre=htmlspecialchars($j->nombre);
        $fecha=htmlspecialchars($j->fecha);
        $hcomienzo=htmlspecialchars($j->horario_comienzo);
        $hfinalizacion=htmlspecialchars($j->horario_finalizacion);
        $estado=htmlspecialchars($j->estado);
        if($estado>0){
            $estado="<p class='text-success'> Activo </p>";
        }else{
            $estado="<p class='text-danger'> Inactivo </p>";
        }
        echo "<tr> 
            <th scope='row'>{$j->ideleccion}</th>
            <td>{$nombre}</td> 
            <td>{$fecha}</td> 
            <td>{$hcomienzo}</td> 
            <td>{$hfinalizacion}</td> 
            <td>{$estado}</td> 
            <td> 
            <a href='{$urlEdit}' class=' text-warning H5 fas fa-edit'></a>
            </td>
            </tr>";
      } 
    }else{
      echo "<tr> 
      <td><p class='text-danger'>No hay Registros</p></td>
      </tr>";
    } 
      ?>
  </tbody>
</table>
</div>