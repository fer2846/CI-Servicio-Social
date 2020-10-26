<div class="card">
  <h5 class="card-header"><?php if(isset($registro)) echo 'Editar'; else echo 'Agregar';?> Marca <a href="<?php echo "http://localhost/".base_url();?>marcas" class="btn btn-secundary float-right">Regresar </a>
  </h5>
  <div class="card-body">
    <form action="<?php echo "http://localhost/".base_url();?>marcas/guardar" method="POST">
        <div class="form-group">
            <label for="txtId">ID</label>
            <input name="intId" type="text" class="form-control" id="txtId" placeholder="[Nuevo]" 
                   readonly="" value="<?=set_value('intId')?><?php if(isset($registro)) echo $registro->id;?>">
        </div>
        <?php echo form_error('strNombre');?>
        <div class="form-group">
            <label for="txtNombre">Nombre</label>
            <input name="strNombre" type="text" class="form-control" id="txtNombre" placeholder="Ingrese el nombre" 
                   value="<?=set_value('strNombre')?><?php if(isset($registro)) echo $registro->nombre;?>">
        </div>
        <?php echo form_error('strDescripcion');?>
        <div class="form-group">
            <label for="txtDescripcion">Descripción</label>
            <textarea name="strDescripcion" class="form-control" id="txtDescripcion" 
                      placeholder="Ingrese una descripción"><?=set_value('strDescripcion')?><?php if(isset($registro)) echo $registro->descripcion;?></textarea>
        </div>
        <?php echo form_error('intStatus');?>
        <div class="form-group">
            <label for="cmbEstatus">Estatus</label>
            <select name="intStatus" id="cmbEstatus" class="form-control">
                <option value="0" <?php if(set_value('intStatus') == 0 or (isset($registro) and $registro->status==0)) echo "selected"?>>Seleccione</option>
                <option value="1" <?php if(set_value('intStatus') == 1 or (isset($registro) and $registro->status==1)) echo "selected"?>>Activo</option>
                <option value="2" <?php if(set_value('intStatus') == 2 or (isset($registro) and $registro->status==2)) echo "selected"?>>Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </form>
  </div>
</div>