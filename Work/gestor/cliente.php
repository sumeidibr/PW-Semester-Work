<?php
    include '../gestor.php';
    $obj = new Gestor();


    $params = array(
        ':cli' => 'cliente');

    $sql= 'SELECT * FROM user WHERE tipo_user = :cli';

    $result = $obj->EXE_QUERY($sql,$params);

?>
<div class="container_clientes">
<h1> Gestor - Clientes</h1>
<div class="container_clientes_tabela">
        <table class="border" cellspacing="2" cellpadding="7">
            <thead>
                <tr>
                    <th data-field="id">id</th>
                    <th data-field="pnome">Primeiro Nome</th>
                    <th data-field="apelido">Apelido</th>
                    <th data-field="email">Email</th>
                    <th data-field="data_fim">Telefone</th>
                    <th data-field="quantidade">Quatidade Compras</th>
                    <th data-field="total">Total Gasto</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $user) : ?>
                    <tr>
                        <td><?php echo $user['iduser']?></td>
                        <td><?php echo $user['primeiro_nome'] ?></td>
                        <td><?php echo $user['apelido'] ?></td>
                        <td><?php echo $user['email']    ?></td>
                        <td><?php echo $user['telefone']  ?></td>
                        <td>0</td>
                        <td>0</td>
                      
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>