<?php //echo var_dump($registro); ?>
<div class="card">
  <div class="card-header">Modelos </div>
  <div class="card-body">
    <form action="<?php echo "http://localhost/".base_url();?>modelos/index" method="POST">
      <?php echo form_error('intMarcaId');?>
      <div class="form-group">
          <label for="cmbMarca">Marcas</label>
          <select name="intMarcaId" id="cmbMarca" class="form-control" onchange="submit();" required>
              <option value="0" >Seleccione</option>
              <?php foreach($arrMarcas as $objetoMarca){?>
                <option value="<?=$objetoMarca->id?>" <?php if($objetoMarca->id == $intMarcaId) echo 'selected';?>><?=$objetoMarca->nombre?></option>
              <?php }?>
          </select>
      </div>
    </form>
    <div class="row">
      <div class="col-6">
        <div class="card">
          <h5 class="card-header"><?php if(isset($registro)) echo 'Editar'; else echo 'Agregar';?> Modelo </h5>
          <div class="card-body">
            <form action="<?php echo "http://localhost/".base_url();?>modelos/guardar" method="POST">
                <input type="hidden" name="intMarcaId" value="<?=$intMarcaId?>">

                <div class="form-group">
                    <label for="txtId">ID</label>
                    <input name="intId" type="text" class="form-control" id="txtId" placeholder="[Nuevo]" 
                          readonly="" value="<?php if(!$intExito) echo set_value('intId');
                                                   if(isset($registro)) echo $registro->id; ?>">
                  </div>
                <?php echo form_error('strNombre');?>
                <div class="form-group">
                    <label for="txtNombre">Nombre</label>
                    <input name="strNombre" type="text" class="form-control" id="txtNombre" placeholder="Ingrese el nombre" 
                          value="<?php if(!$intExito) echo set_value('strNombre');
                                       if(isset($registro)) echo $registro->nombre;?>"
                          required
                          <?php if($intMarcaId==0) echo 'disabled';?>>
                </div>
                <?php echo form_error('strDescripcion');?>
                <div class="form-group">
                    <label for="txtDescripcion">Descripción</label>
                    <textarea name="strDescripcion" class="form-control" id="txtDescripcion" 
                              placeholder="Ingrese una descripción" 
                              <?php  if($intMarcaId==0) echo 'disabled';?>
                              ><?php if(!$intExito) echo set_value('strDescripcion');
                                     if(isset($registro)) echo $registro->descripcion;?></textarea>
                </div>
                <?php echo form_error('intStatus');?>
                <div class="form-group">
                    <label for="cmbEstatus">Estatus</label>
                    <select name="intStatus" id="cmbEstatus" class="form-control" <?php if($intMarcaId==0) echo 'disabled';?>>
                        <option value="0" <?php if((!$intExito and set_value('intStatus') == 0) or (isset($registro) and $registro->status==0)) echo "selected"?>>Seleccione</option>
                        <option value="1" <?php if((!$intExito and set_value('intStatus') == 1) or (isset($registro) and $registro->status==1)) echo "selected"?>>Activo</option>
                        <option value="2" <?php if((!$intExito and set_value('intStatus') == 2) or (isset($registro) and $registro->status==2)) echo "selected"?>>Inactivo</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary float-right" <?php if($intMarcaId==0) echo 'disabled';?>>Guardar</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-6">
        <table class="table">
          <thead>
              <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col" width="120px">Estatus</th>
              <th scope="col" width="200px">Opciones</th>
              </tr>
          </thead>
          
          <tbody>
            <?php foreach($arrModelos as $objetoModelo){?>
              <tr>
              <th scope="row"><?=$objetoModelo->id?></th>
              <td><?=$objetoModelo->nombre?></td>
              <td><?=$objetoModelo->status?></td>
              <td style="display:inline-block;">
                  <form action="<?php echo "http://localhost/".base_url();?>modelos/editar/" method="post" style="display:inline-block;">
                    <input type="hidden" value="<?=$intMarcaId?>" name="intMarcaId">
                    <input type="hidden" value="<?=$objetoModelo->strId?>" name="strId">
                    <button type="submit" class="btn btn-secondary">Editar</button>
                  </form>
                  <form action="<?php echo "http://localhost/".base_url();?>modelos/eliminar/" method="post" 
                        onsubmit="if(!confirm('¿Desea eliminar este registro?')) return false;" 
                        style="display:inline-block;">
                    <input type="hidden" value="<?=$intMarcaId?>" name="intMarcaId">
                    <input type="hidden" value="<?=$objetoModelo->strId?>" name="strId">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                  </form>
              </td>
              </tr>
            <?php }?>
          </tbody>
        </table>
        <hr>
        <div class='row'>
          <div class='col-12'>
            <p class="float-right"><b><?php echo count($arrModelos);?></b> Registros</p>
          </div>
        </div> 
      </div>
    </div>
    
    
  </div>
</div>



