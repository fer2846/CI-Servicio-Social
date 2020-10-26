<?php
    class MdMarcas extends CI_Model{
        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function listar(){
            //$this->load->database();
            /*$consulta=$this->db->query("SELECT id,nombre,CASE status
                                                         WHEN 1 THEN 'Activo'
                                                         WHEN 2 THEN 'Inactivo'
                                                         ELSE 'No asignado'
                                                         END AS status 
                                        FROM marcas");*/
            $this->db->select("id,nombre,CASE status
                                        WHEN 1 THEN 'Activo'
                                        WHEN 2 THEN 'Inactivo'
                                        ELSE 'No asignado'
                                        END AS status");
            $this->db->from('marcas');
            //echo var_dump($consulta->result());
            //return $consulta->result();
            $consulta=$this->db->get();
            return $consulta->result();
        }

        public function agregar($strNombre,$strDescripcion,$intStatus){
            //$this->load->database();
            /*$strSentencia="INSERT INTO marcas(nombre,descripcion,status) 
                            VALUES ('$strNombre','$strDescripcion',$intStatus)";
            $consulta= $this->db->query($strSentencia);*/
            $this->db->set('nombre',$strNombre);
            $this->db->set('descripcion',$strDescripcion);
            $this->db->set('status',$intStatus);
            $this->db->insert('marcas');
            
            return $this->db->affected_rows();
        }

        public function editar($intId,$strNombre,$strDescripcion,$intStatus){
            $this->db->set('nombre',$strNombre);
            $this->db->set('descripcion',$strDescripcion);
            $this->db->set('status',$intStatus);
            $this->db->where('id',$intId);
            $this->db->update('marcas');
            return ($this->db->affected_rows() or count($this->db->error())==0);
        }

        public function buscar($intId){
            $this->db->select("id,nombre,descripcion,status");
            $this->db->from('marcas');
            $this->db->where('id', $intId);
            $consulta=$this->db->get();
            return $consulta->row();
        }

        public function eliminar($intId){
            $this->db->where('id',$intId);
            $this->db->delete('marcas');
            return ($this->db->affected_rows() or count($this->db->error())==0);
        }

        public function buscarActivos(){
            $this->db->select("id,nombre");
            $this->db->from('marcas');
            $this->db->where('status', 1); // 1=Activo 2=Cancelar
            $consulta=$this->db->get();
            return $consulta->result();
        }
    }

?>