<?php
    include '../gestor.php';
    $obj = new Gestor();

/*
    $params = array(
        ':cli' => 'cliente');

    $sql= 'SELECT * FROM user WHERE tipo_user = :cli';

    $result = $obj->EXE_QUERY($sql,$params);
*/



    $sqls='SELECT * FROM (
        SELECT 
            c.iduser ,
            c.primeiro_nome ,
            c.tipo_user,
            c.apelido ,
            c.email ,
            c.telefone ,
            COUNT(co.iduser) AS total_compras,
            SUM(co.total) AS total_gasto
        FROM 
            user c
        LEFT JOIN 
            compra co ON c.iduser = co.iduser
        GROUP BY 
            c.iduser, c.primeiro_nome, c.tipo_user, c.apelido, c.email,c.telefone
    ) AS subquery where tipo_user = "cliente"
    order by total_compras desc;';
    $result = $obj->EXE_QUERY($sqls);
 //  var_dump($result);
    

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
                        <td><?php echo $user['total_compras']?></td>

                        <?php if($user['total_compras'] == 0){ ?>
                            <td><?php echo 0 ."  MT" ?></td>
                        <?php }else{?>
                        <td><?php echo $user['total_gasto']. "  MT"?></td>
                        <?php }?>
                        
                      
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>