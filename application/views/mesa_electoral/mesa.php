

<?= form_open('mesa', 'class="pt-5" id="busqueda"')?>

<h2 class="pb-2">Mesa de votacion</h2>
            <p class="pb-2">Ejerce el voto </p>
    <div class='form-group row '>

        <div class="md-form col-5">
            <i class="fas fa-user prefix"></i>
            <input type="text" id="input" class="form-control"  name="cedula" type="number" maxlength="11" placeholder="">
            <label for="input">Cedula:</label>
            <p id='msg' class="text-danger"><?= validation_errors() ?></p>
        </div>
        <div class="col-5">
            <button class="btn btn-primary " onclick="validateInput()" type="button">Verificar</button>
        </div>
        
    </div>
</form>



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