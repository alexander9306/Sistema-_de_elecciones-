<?php
$CI =& get_instance();
$CI->load->view('plantillas/encabezado'); ?>

 <h3 class="pt-2">Sus datos</h3>

 <table class="table">
  <thead>
    <tr>
      <th>Foto</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Cedula</th>
    </tr>
  </thead>
  <tbody>
<?php
if($persona){
      $foto=htmlspecialchars($persona->foto);
      $nombre=htmlspecialchars($persona->nombre);
      $apellido=htmlspecialchars($persona->apellido);
      $cedula=htmlspecialchars($persona->cedula);
      echo "<tr value='{$persona->idpersona}'> 
              <td>
              <img src='{$foto}' width='100' height='100' alt='...' class='img-thumbnail'>
              </td> 
              <td>{$nombre}</td> 
              <td>{$apellido}</td> 
              <td>{$cedula}</td> 
              </tr>";
} else{
  echo "<tr'> 
        <td class='text-danger h3'>Error al cargar a la persona</td> 
        </tr>";
        }
  ?>
  </tbody>
</table>
<?php
  if($persona){
    $urlSiguiente=base_url('votacion/eleccion/'.$persona->idpersona);
    echo "
    <h4 class='pt-2'>Si son correctos, por favor dar a siguiente</h4>

    <a class='nav-link btn btn-info text-white' href='{$urlSiguiente}'>Siguiente</a>
    ";
  }
?>


<?php $CI->load->view('plantillas/pie'); ?>
