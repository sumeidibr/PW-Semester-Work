<?php
include 'gestor.php';

//Iniciar uma seccao
session_start();

$obj = new Gestor();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $paramns = array(
        ':email' => $email
    );
    $result = $obj->EXE_QUERY('SELECT * FROM user WHERE email= :email',$paramns);
    var_dump($result);

    if(count($result)==0){
        return false;
    }else{
        //usuario existe
        $senha_bd = $result[0]['password'];
        $id = $result[0]['iduser'];
        //verificar senha
        if(password_verify($senha,$senha_bd)){
            if($result[0]['tipo_user'] == 'cliente'){
                //direcionar ao ciente e pegar a seccao 
                $_SESSION['user'] = [
                    'id' => $result[0]['iduser'],
                    'nome' => $result[0]['primeiro_nome'],
                    'apelido' => $result[0]['apelido'],
                    'email' => $result[0]['email'],
                    'telefone' => $result[0]['telefone']
                ];
                
                header("Location: cliente/index.php");
            }else{
                header("Location: gestor/index.php");
            }
        }else{
            echo 'falso';
        }
    }

}

$_SESSION['user'] = [
    'id' => $result[0]['iduser'],
    'nome' => $result[0]['primeiro_nome']
];
header("Location: cliente/index.php");