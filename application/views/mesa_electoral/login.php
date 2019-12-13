

<?= form_open('electoral', 'class="pt-5" id="busqueda"'); ?>
    <h2 class="pb-2">Mesa Electoral</h2>
    <p  class="pb-2">Inicie sección como usuario de la mesa electoral</p>
    <div class="md-form col-5">
        <i class="fas fa-user prefix"></i>
        <input type="text" id="input" class="form-control"  name="cedula" type="number" value="<?=set_value('cedula')?>" maxlength="11" placeholder="">
        <label for="input">Cedula:</label>
    </div>
    <div class="md-form col-5">
        <i class="fas fa-lock prefix"></i>
        <input type="password" maxlength="20" id="" class="form-control"  name="clave" placeholder="">
        <label for="input">Clave:</label>
        <?= validation_errors('<span class="text-danger" >', '<br></span>'); ?>
        <?php if(isset($mensaje_error)){echo "<p id='msg' class='text-danger'>$mensaje_error</p>"; } ?>
    </div>

    <div class="col-5 pt-3">
            <button class="btn btn-primary " onclick="" type="post">Entrar</button>
     </div>
</form>