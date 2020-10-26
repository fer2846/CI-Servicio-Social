<?php
    class Marcas extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('MdMarcas');
            
        }

        public function index($arrDatos = [] ){
            
            //$this->load->model('MdMarcas');
            
            //De esta forma podemos iterar con 'arrMarcas' e imprimir en
            //pantalla lo de la base de datos.
            $arrDatosLista['arrMarcas']=$this->MdMarcas->listar();
            foreach($arrDatosLista['arrMarcas'] as $marca){
                $marca->strId = $this->encrypt->encode($marca->id);
            }

            //Cargamos $arrDatosMarcas al view listar por medio de $arrDatos
            //que despues se para a la principal gracias a $arrDatos. 
            $arrDatos['strActivo']='marcas';
            $arrDatos['strContenido']=$this->load->view('marcas', $arrDatosLista , TRUE);
            //Le pasamos el array datos y en la vista cargara, 
            //lo que tenga el array, mediante la KEY[''].
            $this->load->view('principal.php', $arrDatos);
        }

        public function agregar($arrDatos = [] ){
            $arrDatos['strActivo']='marcas';
            $arrDatos['strContenido']=$this->load->view('marcas/agregar', NULL, TRUE);
            $this->load->view('principal.php', $arrDatos);
        }

        public function guardar(){
            $arrDatos=[];
            $arrDatos['intExito']=0; //Negativo, no tuvo exito.
            $arrDatos['intErrorValidacion']=0;
            $intId=$this->input->post('intId');
            $this->form_validation->set_rules(
                'strNombre', 'Nombre', 'required', //|is_unique[marcas.nombre]
                array(
                        'required'      => 'Tiene que ingresar un %s.'
                        //'is_unique'     => 'El %s ya existe, ingrese uno distinto.'
                )
            );
            $this->form_validation->set_rules(
                'intStatus', 'Estatus', 'required|integer|greater_than[0]',
                array(
                        'required'      => 'Tiene que ingresar un %s.',
                        'integer'        => 'El "%s" debe de ser un numero.',
                        'greater_than'  => 'Seleccione un %s'
                )
            );
            if ($this->form_validation->run() == FALSE)
            {
                $arrDatos['intErrorValidacion']=1; 
                $arrDatos['strMensajes']=validation_errors();                
            }
            else
            {
                
                $strNombre=$this->input->post('strNombre');
                $strDescripcion=$this->input->post('strDescripcion');
                $intStatus=$this->input->post('intStatus');
                $intResultado=0;

                if($intId==''){
                    $intResultado=$this->MdMarcas->agregar($strNombre,$strDescripcion,$intStatus);
                } else {
                    echo 'prueba';
                    $intResultado=$this->MdMarcas->editar($intId,$strNombre,$strDescripcion,$intStatus);
                }

                if($intResultado==1){
                    $arrDatos['intExito']=1;
                    //echo 'El registro se guardo correctamente';
                    $arrDatos['strMensajes']= 'El registro se guardo correctamente';
                    //AQUI ES DONDE FALLA, EN LA PARTE QUE CARGA EL INDEX. El problema
                    //radica en las URL'S, ya que en principal no puedo agregar el link sin modificar
                    //el href de bootstrap
                } else {
                    $arrDatos['strMensajes']= 'No se pudo guadar el registro, intentelo nuevamente';
                }
                //echo $_POST['strNombre'];
                //echo $_GET();
            }

            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($arrDatos));
            
        }

        public function listar(){
            $arrDatos['arrMarcas']=$this->MdMarcas->listar();
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($arrDatos));
            
        }

        public function editar($intId=0, $EsEditarGuardar=FALSE){
            $strId=$this->input->post('strId');
            if(($strId != '' and $this->encrypt->decode($strId)!='0') or $intId !=0){
                if($intId==0){
                    $intId=$this->encrypt->decode($strId);
                }
                if(!$EsEditarGuardar){
                    $arrDatos['registro']= $this->MdMarcas->buscar($intId);
                }
                $arrDatos['strActivo']='marcas';
                $arrDatos['strContenido']=$this->load->view('marcas/agregar', $arrDatos, TRUE);
                $this->load->view('principal.php', $arrDatos);
            }else{
                $arrDatos['arrMensajes']= [array('intTipo' => 2,
                                                 'strMensaje' => 'No se puede editar, intentelo de manera correcta')];
                $this->index($arrDatos);
            }
        }

        public function eliminar(){
            $strId=$this->input->post('strId');
            if($strId != ''){
                $intId=$this->encrypt->decode($strId);

                $this->load->model('MdModelos');
                $intTieneModelos=$this->MdModelos->contarPorMarcaId($intId);
                if($intTieneModelos==0){
                    if($this->MdMarcas->eliminar($intId)==1){
                        $arrDatos['arrMensajes']= [array('intTipo' => 1,
                                                        'strMensaje' => 'El registro se elimino correctamente')];
                    }else{
                        $arrDatos['arrMensajes']= [array('intTipo' => 2,
                                                        'strMensaje' => 'El registro no se pudo eliminar')];
                    }
                }else{
                    $arrDatos['arrMensajes']= [array('intTipo' => 2,
                                                        'strMensaje' => 'La marca cuanta con registros, eliminelos primero')];
                }
            }else{
                $arrDatos['arrMensajes']= [array('intTipo' => 2,
                                                    'strMensaje' => 'Elimine correctamente un registro, solo presione el boton Eliminar')];
            }
            $this->index($arrDatos);
        }
    }
?>