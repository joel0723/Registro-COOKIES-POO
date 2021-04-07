<?php

    class Estudiante{

        public $Id;
        public $Name;
        public $Apellido;
        public $CarreraId;
        public $Materia;
        public $Check;
        public $Photo;

        public function __construct($id, $name, $apellido, $carreraid, $materia, $check)
        {
            $this->Id = $id;
            $this->Name = $name;
            $this->Apellido = $apellido;
            $this->CarreraId = $carreraid;
            $this->Materia = $materia;
            $this->Check = $check;
        }
       




    }




?>