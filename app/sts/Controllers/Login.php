<?php

namespace Sts\Controllers; 
 
if(!defined('URL')){
    header("Location: /");
    exit();
}


class Login{

private $Dados;

    public function index(){
        #1)pega pela URL
        $this->Dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);
        #2)Testa se o botão foi pressionado
        if(!empty($this->Dados["sandLogin"])){
            unset($this->Dados["sandLogin"]);
        
        #3)Envia para model
            $visualLogin = new \Sts\Models\login;
            $visualLogin->acesso($this->Dados);
            var_dump($visualLogin);

        #4)Direciona para proxima pagina apos o login
            if($visualLogin->getResultado()){
                $UrlDestino = URL."Home/index";
                header("Location: $UrlDestino");
            }else{

            $this->Dados['form'] = $this->Dados;

            }
        }

        $carregarView = new \Core\ConfigView("sts/Views/login/login",$this->Dados);
        $carregarView->renderizar();            

    }   


}