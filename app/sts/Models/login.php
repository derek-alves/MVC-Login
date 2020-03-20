<?php 

namespace Sts\Models;
if(!defined('URL')){
    header('Location: /');
    exit();
}
class login{

        private $Dados;
        private $Resultado;

    function getResultado(){
        return $this->Resultado;
    }

    public function acesso(array $Dados){

        $this->Dados = $Dados;
        $this->validarDados();
        if($this->Resultado){
            $validaLogin = new \Sts\Models\helper\StsRead();
            $validaLogin->fullRead("SELECT id, nome, email, senha, imagem, adms_niveis_acesso_id FROM adms_usuarios
            WHERE email =:email LIMIT :limit", "email={$this->Dados['email']}&limit=1");
            $this->Resultado =  $validaLogin->getResultado();
            if($this->Resultado){
               $this->validarSenha();
            }else{
                $_SESSION['msg'] = "<div class='alert-danger'>Erro: Email ou senha invalidos!</div>";            
            
                $this->Resultado = false;
            }
        }
    }

    private function validarDados(){
        $this->Dados = array_map('strip_tags',$this->Dados);
        $this->Dados = array_map('trim',$this->Dados);
        if(in_array('',$this->Dados)){
            $_SESSION['msg'] = "<div class='alert-danger'>Erro: Necessário prencher todos os campos!</div>";            
            
            $this->Resultado = false;
        }else{
            $this->Resultado = true;

        }
    }

    private function validarSenha(){
        if(password_verify($this->Dados['pass'],$this->Resultado[0]['senha'])){
            $_SESSION['usuario_id'] = $this->Resultado[0]['id'];
            $_SESSION['usuario_nome'] = $this->Resultado[0]['nome'];
            $_SESSION['usuario_email'] = $this->Resultado[0]['email'];
            $_SESSION['usuario_imagem'] = $this->Resultado[0]['imagem'];
            $_SESSION['adms_niveis_acesso_id'] = $this->Resultado[0]['adms_niveis_acesso_id'];
            $this->Resultado = true;
        }else{
            $_SESSION['msg'] = "<div class='alert-danger'>Erro: Email ou senha invalidos!</div>";            
            
            $this->Resultado = false;
        }

    }

}


