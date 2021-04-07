<?php

class Utilities
{

    public $tipo = [1 => "Software", 2 => "Redes", 3 => "Multimedia", 4 => "Mecatronica", 5 => "Seguridad Informatica"];


    public function getLastElement($list)
    {

        $countList = count($list);

        $lastElement = $list[$countList - 1];

        return $lastElement;
    }

    public function searchProperty($list, $property, $value)
    {

        $filters = [];

        foreach ($list as $item) {

            if ($item->$property == $value) {
                array_push($filters, $item);
            }
        }

        return $filters;
    }


    public function getIndexElement($list, $property, $value)
    {

        foreach ($list as $key => $item) {

            if ($item->$property == $value) {

                return $key;
            }
        }
    }
    public function uploadImage($directory, $name, $tmpFile, $type, $size)
    {

        $IsSuccess = false;

        if (($type == "image/jpg")
            || ($type == "image/png")
            || ($type == "image/jpeg")
            || ($type == "image/gif") && ($size) < 1000000
        ) {

            if (!file_exists($directory)) {

                mkdir($directory, 0777, true);


                if (file_exists($directory)) {

                    $this->uploadFile($name, $tmpFile);

                    $IsSuccess = false;
                }
            } else {

                $this->uploadFile($name, $tmpFile);

                $IsSuccess = true;
            }
        } else {
            $IsSuccess = false;
        }

        return $IsSuccess;
    }

    private function uploadFile($name, $tmpFile)
    {

        if (file_exists($name)) {
            unlink($name);
        }

        move_uploaded_file($tmpFile, $name);
    }
}
