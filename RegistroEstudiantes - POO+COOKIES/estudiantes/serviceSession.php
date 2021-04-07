<?php

class ServiceSession
{
    private $sessionName;
    private $utilities;

    public function __construct()
    {
        session_start();
        $this->sessionName = "EstudianteList";
        $this->utilities = new Utilities();
    }


    public function Add($item)
    {
        $estudiantes = $this->GetList();

        if (count($estudiantes) == 0) {

            $item->Id = 1;
        } else {

            $lastElement = $this->utilities->getLastElement($estudiantes);

            $item->Id = $lastElement->Id + 1;
        }

        array_push($estudiantes, $item);

        $_SESSION[$this->sessionName] = $estudiantes;
    }


    public function GetList()
    {

        $estudiantes = isset($_SESSION[$this->sessionName]) ? $_SESSION[$this->sessionName] : [];

        return $estudiantes;
    }

    public function GetById($id)
    {
        $estudiantes = $this->GetList();

        $estudiantes = $this->utilities->searchProperty($estudiantes, "Id", $id);

        return $estudiantes[0];
    }


    public function Edit($item)
    {
        $estudiantes = $this->GetList();

        $index = $this->utilities->getIndexElement($estudiantes, "Id", $item->Id);
        

        if($index !== null){
            $estudiantes[$index] = $item;
            $_SESSION[$this->sessionName] = $estudiantes;

        }
    }

    public function Delete($item)
    {
        $estudiantes = $this->GetList();

        $index = $this->utilities->getIndexElement($estudiantes, "Id", $item);

        if (isset($index)) {

            unset($estudiantes[$index]);

            $_SESSION[$this->sessionName] = $estudiantes;
        }
    }

    public function Filtrar($item)
    {
        $estudiantes = $this->GetList();
        $estudiante = $this->GetById($item["CarreraId"]);

        if (!empty($estudiante)) {

            $index = $this->utilities->searchProperty($estudiantes, "CarreraId", $estudiante);

            $_SESSION[$this->sessionName] = $estudiantes;
        }
    }
}
