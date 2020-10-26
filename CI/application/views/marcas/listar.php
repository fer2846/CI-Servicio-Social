<div class="card">
  <div class="card-header">Marcas <a href="<?php echo "http://localhost/".base_url();?>marcas/agregar" class="btn btn-primary float-right">Agregar</a>
  </div>
  <div class="card-body">
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
          <?php foreach($arrMarcas as $objetoMarca){?>
            <tr>
            <th scope="row"><?=$objetoMarca->id?></th>
            <td><?=$objetoMarca->nombre?></td>
            <td><?=$objetoMarca->status?></td>
            <td style="display:inline-block;">
                <form action="<?php echo "http://localhost/".base_url();?>marcas/editar/" method="post" style="display:inline-block;">
                  <input type="hidden" value="<?=$objetoMarca->strId?>" name="strId">
                  <button type="submit" class="btn btn-secondary">Editar</button>
                </form>
                <form action="<?php echo "http://localhost/".base_url();?>marcas/eliminar/" method="post" 
                      onsubmit="if(!confirm('¿Desea eliminar este registro?')) return false;" 
                      style="display:inline-block;">
                  <input type="hidden" value="<?=$objetoMarca->strId?>" name="strId">
                  <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
            </tr>
          <?php }?>
        </tbody>
        <hr>
    </table>
    <div class='row'>
      <div class='col-12'>
        <p class="float-right"><b><?php echo count($arrMarcas);?></b> Registros</p>
      </div>
    </div>
  </div>
</div>



