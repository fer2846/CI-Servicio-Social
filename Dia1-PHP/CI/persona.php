<?php
        class Persona{
            var $nombre="Fernando";
            var $apellido="Sáncehz";
            function getNombreCompleto(){
                return $this->nombre." ".$this->apellido;
            }
        }
?>