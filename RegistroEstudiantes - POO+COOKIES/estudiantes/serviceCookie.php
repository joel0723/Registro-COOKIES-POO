<?php


class ServiceCookies
{
    private $cookieName;
    private $utilities;

    public function __construct()
    {
        session_start();
        $this->cookieName = "EstudianteList";
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

        setcookie($this->cookieName,json_encode($estudiantes) , $this->getCookieTime(), "/");
    }


    public function GetList()
    {

        $estudiantes = array();

        if(isset($_COOKIE[$this->cookieName]))
        {
            $estudiantes =(array) json_decode($_COOKIE[$this->cookieName]) ;
        }

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
            setcookie($this->cookieName, json_encode($estudiantes), $this->getCookieTime(), "/");

        }
    }

    public function Delete($item)
    {
        $estudiantes = $this->GetList();

        $index = $this->utilities->getIndexElement($estudiantes, "Id", $item);

        if (isset($index)) {

            unset($estudiantes[$index]);

            setcookie($this->cookieName, json_encode($estudiantes), $this->getCookieTime(), "/");
        }
    }

    public function Filtrar($item)
    {
        $estudiantes = $this->GetList();
        $estudiante = $this->GetById($item["CarreraId"]);

        if (!empty($estudiante)) {

            $index = $this->utilities->searchProperty($estudiantes, "CarreraId", $estudiante);

            setcookie($this->cookieName, json_encode($estudiantes), $this->getCookieTime(), "/");
        }
    }

    private function getCookieTime(){
        return time() + 60* 60 * 24 * 30;
    }
}
