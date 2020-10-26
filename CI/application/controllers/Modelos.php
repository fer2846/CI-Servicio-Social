<?php
    class Modelos extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
            $this->load->model('MdModelos');
        }

        public function index($arrDatos=[]){
            $intMarcaId=$this->input->post('intMarcaId');
            if($intMarcaId==''){
                $intMarcaId=0;
            }
            $this->load->model('MdMarcas');
            $arrDatosLista['arrMarcas']=$this->MdMarcas->buscarActivos();
            $arrDatosLista['arrModelos']=$this->MdModelos->listar($intMarcaId);
            $arrDatosLista['intMarcaId']=$intMarcaId;
            foreach($arrDatosLista['arrModelos'] as $objModelo){
                $objModelo->strId = $this->encrypt->encode($objModelo->id);
            }
            if(isset($arrDatos['arrMensajes']) and $arrDatos['arrMensajes'][0]['intTipo']==1){
                $arrDatosLista['intExito']=1;
            }else{
                $arrDatosLista['intExito']=0;
            }

            if(isset($arrDatos['registro'])){
                $arrDatosLista['registro']=$arrDatos['registro'];
            }
            //var_dump($arrDatosLista['arrModelos']);
            $arrDatos['strActivo']='modelos';
            $arrDatos['strContenido']=$this->load->view('modelos/listar', $arrDatosLista, TRUE);
            $this->load->view('principal.php', $arrDatos);
        }

        public function guardar(){
            $intId=$this->input->post('intId');
            $this->form_validation->set_rules(
                'strNombre', 'Nombre', 'required', //|is_unique[marcas.nombre]
                array(
                        'required'      => 'Tiene que ingresar un %s.'
                        //'is_unique'     => 'El %s ya existe, ingrese uno distinto.'
                )
            );

            $this->form_validation->set_rules(
                'intMarcaId', 'Marca', 'required|integer', //|is_unique[marcas.nombre]
                array(
                        'required'      => 'Tiene que seleccionar una %s.',
                        'integer'       => 'El "%s" debe de ser un numero.'
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
                if($intId==''){
                    $this->index();
                }else {
                    $this->editar($intId, TRUE);
                }
            }
            else
            {
                $intMarcaId=$this->input->post('intMarcaId');
                $strNombre=$this->input->post('strNombre');
                $strDescripcion=$this->input->post('strDescripcion');
                $intStatus=$this->input->post('intStatus');
                $this->load->model('MdMarcas');
                $intResultado=0;

                if($intId==''){
                    $intResultado=$this->MdModelos->agregar($intMarcaId,$strNombre,$strDescripcion,$intStatus);
                } else {
                    echo 'prueba';
                    $intResultado=$this->MdModelos->editar($intId,$strNombre,$strDescripcion,$intStatus);
                }

                if($intResultado==1){
                    $arrDatos['arrMensajes']= [array('intTipo' => 1, //succes
                                                    'strMensaje' => 'El registro se guardo correctamente')];
                      
                } else {
                    $arrDatos['arrMensajes']= [array('intTipo' => 2, //Danger
                                                    'strMensaje' => 'No se pudo guadar el registro, intentelo nuevamente')];
                   
                }
                $this->index($arrDatos);
            }
            
        }

        public function editar($intId=0, $EsEditarGuardar=FALSE){
            $strId=$this->input->post('strId');
            if(($strId != '' and $this->encrypt->decode($strId)!='0') or $intId !=0){
                if($intId==0){
                    $intId=$this->encrypt->decode($strId);
                }
                if(!$EsEditarGuardar){
                    $arrDatos['registro']= $this->MdModelos->buscar($intId);
                }
                
            }else{
                $arrDatos['arrMensajes']= [array('intTipo' => 2,
                                                 'strMensaje' => 'No se puede editar, intentelo de manera correcta')];
            }
            $this->index($arrDatos);
        }

        public function eliminar(){
            $strId=$this->input->post('strId');
            if($strId != ''){
                $intId=$this->encrypt->decode($strId);
                if($this->MdModelos->eliminar($intId)==1){
                    $arrDatos['arrMensajes']= [array('intTipo' => 1,
                                                    'strMensaje' => 'El registro se elimino correctamente')];
                }else{
                    $arrDatos['arrMensajes']= [array('intTipo' => 2,
                                                    'strMensaje' => 'El registro no se pudo eliminar')];
                }
            }else{
                $arrDatos['arrMensajes']= [array('intTipo' => 2,
                                                    'strMensaje' => 'Elimine correctamente un registro, solo presione el boton Eliminar')];
            }
            $this->index($arrDatos);
        }
    }
?>