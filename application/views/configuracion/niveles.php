<form method="post" action="" class="pt-5">
    <h2 class="pb-2">Niveles</h2>
    <p  class="pb-2">Agrega niveles</p>
    <?= asgInput('idnivel', 'ID',$nivel,'disabled'); ?>
    <?= asgInput('nombre', 'Nombre',$nivel); ?>
    <div class="pt-4">
        <button type="submit" class="m-3 btn btn-primary">Guardar</button>
        <a class="btn btn-danger" href="<?= base_url(); ?>" role="button">Cancelar</a>
    </div>
</form>

<div class="container pt-5">
<table class="table ">
  <thead class="black white-text">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Editar</th>
    </tr>
  </thead>
  <tbody>
      <?php
      $js= core_nivel::cargarNiveles();
      if(count($js)>0){
      foreach ($js as $j){
        $urlEdit = base_url("configuracion/editarNivel/{$j->idnivel}");
        $nombre=htmlspecialchars($j->nombre);
        echo "<tr> 
            <th scope='row'>{$j->idnivel}</th>
            <td>{$nombre}</td> 
            <td> 
            <a href='{$urlEdit}' class=' text-warning H5 fas fa-edit'></a>
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