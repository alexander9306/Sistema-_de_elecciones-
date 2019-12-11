<form method="post" action="" class="pt-5">
    <h2 class="pb-2">Partidos</h2>
    <p  class="pb-2">Agrega partidos</p>
    <?= asgInput('idpartido', 'ID',$partido,'disabled'); ?>
    <?= asgInput('nombre', 'Nombre',$partido); ?>
    <?= asgInput('color', 'Color',$partido,'','color'); ?>
    <?= asgInput('siglas', 'Siglas',$partido); ?>
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
      <th scope="col">Color</th>
      <th scope="col">Siglas</th>
      <th scope="col">Editar</th>
    </tr>
  </thead>
  <tbody>
      <?php
      $js= core_partido::cargarPartidos();
      if(count($js)>0){
      foreach ($js as $j){
        $urlEdit = base_url("configuracion/editarPartido/{$j->idpartido}");
        $nombre=htmlspecialchars($j->nombre);
        $color=htmlspecialchars($j->color);
        $siglas=htmlspecialchars($j->siglas);
        echo "<tr> 
            <th scope='row'>{$j->idpartido}</th>
            <td>{$nombre}</td> 
            <td > <div style='background-color:{$color}' width='60px'>&nbsp;</div></td> 
            <td>{$siglas}</td> 
            <td> 
            <a href='{$urlEdit}' class=' text-warning H5 fas fa-edit'></a>
            </td>
            </tr>";
      }
    } else {
      echo "<tr> 
              <td><p class='text-danger'>No hay Registros</p></td>
          </tr>";
    }  
      ?>
  </tbody>
</table>
</div>