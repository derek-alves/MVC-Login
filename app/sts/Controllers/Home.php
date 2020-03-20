<?php

namespace Sts\Controllers;
if(!defined('URL')){
    header("Location: /");
    exit();
}

class Home
{

    private $Dados;

    public function index(){

        $carregarView = new \Core\ConfigView("sts/Views/home/home");
        $carregarView->renderizar();  

        }
}

?>