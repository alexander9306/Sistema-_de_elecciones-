
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>
  
<form action="" method="post" id='frm_general'>

<input type="hidden" name="estado"  class="custom-control-input" id="defaultInline1">


  <!-- Modal -->
  <div class="modal fade"  id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  
  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar persona</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">  &times;</span>
        </button>
      </div>
      <div class="modal-body">
      Desea borrar a <?php 
      $persona=core_persona::cargarPersona($id);
      echo $persona->nombre.' '.$persona->apellido ?>
      </div>
      <div class="modal-footer">
        <a class="btn btn-secondary" href="<?= base_url('/configuracion/padronjce'); ?>" role="button">Cancelar</a>
        <button type="button"  onclick="someter()" class="btn btn-danger">Borrar</button>
      </div>
    </div>
  </div>
</div>
</form>


<script>
    $("#exampleModalCenter").modal({ show : true });

    function someter(){ 
        document.getElementById('frm_general').submit();
    }
</script>

