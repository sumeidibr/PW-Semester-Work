<?php 
    include 'gestor.php';

    $obj = new Gestor();

    $usuario = 'Ana';
    $senha = 'abc123';

    $params = array(
        ':usuario' => $usuario,
        ':senha' => password_hash($senha, PASSWORD_DEFAULT)
    );
    $obj->EXE_NON_QUERY('INSERT INTO users VALUES(0,:usuario,:senha)',$params);
    echo 'terminado';