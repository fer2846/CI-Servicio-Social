<?php
    class MdModelos extends CI_Model{
        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function listar($intMarcaId){
            $this->db->select("id, marca_id, nombre,CASE status
                                        WHEN 1 THEN 'Activo'
                                        WHEN 2 THEN 'Inactivo'
                                        ELSE 'No asignado'
                                        END AS status");
            $this->db->from('modelos');
            $this->db->where('marca_id',$intMarcaId);
            $consulta=$this->db->get();
            return $consulta->result();
        }

        public function agregar($intMarcaId,$strNombre,$strDescripcion,$intStatus){
            $this->db->set('marca_id',$intMarcaId);
            $this->db->set('nombre',$strNombre);
            $this->db->set('descripcion',$strDescripcion);
            $this->db->set('status',$intStatus);
            $this->db->insert('modelos');
            
            return $this->db->affected_rows();
        }

        public function editar($intModeloId,$strNombre,$strDescripcion,$intStatus){
            $this->db->set('nombre',$strNombre);
            $this->db->set('descripcion',$strDescripcion);
            $this->db->set('status',$intStatus);
            $this->db->where('id', $intModeloId);
            $this->db->update('modelos');
            
            return ($this->db->affected_rows() or count($this->db->error())==0);
        }

        public function buscar($intModeloId){
            $this->db->select("id,nombre, descripcion, status");
            $this->db->from('modelos');
            $this->db->where('id', $intModeloId);
            return$this->db->get()->row();
        }

        public function eliminar($intModeloId){
            $this->db->where('id',$intModeloId);
            $this->db->delete('modelos');

            return $this->db->affected_rows();
            //return ($this->db->affected_rows() or count($this->db->error())==0);
        }

        public function contarPorMarcaId($intMarcaId){
            $this->db->select('id');
            $this->db->from('modelos');
            $this->db->where('marca_id', $intMarcaId);
            return count($this->db->get()->result());
        }
    }
?>