<?php echo $registro?>
<div class="card">
  <h5 class="card-header">Marcas 
    <button id="btnAgregar" class="btn btn-primary float-right">Agregar</button>
    <button id="btnAtras" class="btn btn-secondary float-right" style="display:none;">Atras</button>
  </h5>
    <div class="card-body">

        <div id="divListar">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col" width="120px">Estatus</th>
                <th scope="col" width="200px">Opciones</th>
                </tr>
            </thead>
            
            <tbody id="dgMarcas">
                <?php foreach($arrMarcas as $objetoMarca){?>
                    <tr>
                    <th scope="row"><?=$objetoMarca->id?></th>
                    <td><?=$objetoMarca->nombre?></td>
                    <td><?=$objetoMarca->status?></td>
                    <td style="display:inline-block;">
                        
                        <form style="display:inline-block;">
                            <input name="strId" type="hidden" value="<?=$objetoMarca->strId?>" id="strId">
                            <button id="btnEditar" type="button" class="btn btn-secondary">Editar</button>
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
            </table>
            <hr>
            <div class='row'>
                <div class='col-12'>
                    <p id="contarRegistros" class="float-right"><b><?php echo count($arrMarcas);?></b> Registros</p>
                </div>
            </div>
        </div>
        
        <div id="divFormulario" style="display:none;">
            <form>
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
                <button id="btnGuardar" type="button" class="btn btn-primary float-right">Guardar</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#btnAgregar').on('click', function(e){
        $('#divListar').toggle('fast');
        $('#divFormulario').toggle('fast');

        $('#btnAgregar').toggle('fast');
        $('#btnAtras').toggle('fast');
    });

    $('#btnAtras').on('click', function(e){
        $('#divListar').toggle('fast');
        $('#divFormulario').toggle('fast');
        
        $('#btnAgregar').toggle('fast');
        $('#btnAtras').toggle('fast');
    });

    function actualizarLista(){
        $.ajax({
            url:'<?php echo "http://localhost/".base_url();?>marcas/listar',
            method:'POST',
            data:{},
            dataType:"json"
        }).done(function(data){
            $('#dgMarcas').html('');
            data.arrMarcas.forEach(function(marca){
                strRenglon= '<tr>'
                strRenglon+= '<th scope="row">'+ marca.id +'</th>'
                strRenglon+= '<td>'+ marca.nombre +'</td>'
                strRenglon+= '<td>'+ marca.status +'</td>'
                strRenglon+= '<td style="display:inline-block;">'
                strRenglon+=    '<form action="<?php echo "http://localhost/".base_url();?>marcas/editar/" method="post" style="display:inline-block;">'
                strRenglon+=        '<input type="hidden" value="'+ marca.id +'" name="strId">'
                strRenglon+=        '<button type="submit" class="btn btn-secondary">Editar</button>'
                strRenglon+=    '</form>'
                strRenglon+=    '<form action="<?php echo "http://localhost/".base_url();?>marcas/eliminar/" method="post" '
                strRenglon+=        'onsubmit="if(!confirm(\'¿Desea eliminar este registro?\')) return false;" '
                strRenglon+=        'style="display:inline-block;">'
                strRenglon+=        '<input type="hidden" value="'+ marca.id +'" name="strId">'
                strRenglon+=        '<button type="submit" class="btn btn-danger">Eliminar</button>'
                strRenglon+=     '</form>'
                strRenglon+= '</td>'
                strRenglon+= '</tr>'
                $('#dgMarcas').append(strRenglon);
            });
            $('#contarRegistros').count();  
           
        });
    }

    $('#btnGuardar').on('click', function(e){
        
        $objData={
            intId: $('#txtId').val(),
            strNombre: $('#txtNombre').val(),
            strDescripcion: $('#txtDescripcion').val(),
            intStatus: $('#cmbEstatus').val()
        };

        request=$.ajax({
            url:'<?php echo "http://localhost/".base_url();?>marcas/guardar',
            method:'POST',
            data:$objData,
            dataType:"json"
        }).done(function(data){ //Este data no es le mismo que el de la linea 112, si no que es la respuesta del servidor.
            if(data.intErrorValidacion){
                $('#divMensajes').html(data.strMensajes);
            }else{
                strHtml='<div class="alert alert-';
                if(data.intExito==1)
                    strHtml+='success';
                else  
                    strHtml+='danger';
                strHtml+='" role="alert"><strong>';
                strHtml+='!</strong>'  + data.strMensajes + '</div>';

                $('#divMensajes').html(strHtml);

                if(data.intExito){
                    actualizarLista();
                    $('#btnAtras').click();
                }
            }
        }).fail(function(jqXHR, textStatus){
            alert("Request failed: "+ textStatus);
        });
    });

    $('#btnEditar').on('click', function(e){
        /*$objData={
            intId: $('#txtId').val(),
            strNombre: $('#txtNombre').val(),
            strDescripcion: $('#txtDescripcion').val(),
            intStatus: $('#cmbEstatus').val()
        };*/

        $objData={
            strId: $('#strId').val()
        };

        request=$.ajax({
            url:'<?php echo "http://localhost/".base_url();?>marcas/editar',
            method:'POST',
            data:$objData,
            dataType:"json"
        }).done(function(data){ //Este data no es le mismo que el de la linea 112, si no que es la respuesta del servidor.
            //Veo que en esta funcion solo hace post a strId en lugar de mandar todos los datos.
        }).fail(function(jqXHR, textStatus){
            alert("Request failed: "+ textStatus);
        });
    })
</script>