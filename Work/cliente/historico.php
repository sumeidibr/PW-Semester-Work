<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
     body{
            background-color: #e0c6c1;
        }

    .modal {
    display: none; /* Oculta por padrão */
    position: fixed; /* Mantém a modal no lugar */
    z-index: 1; /* Coloca a modal na parte superior */
    left: 0;
    top: 0;
    width: 100%; /* Cobrir toda a janela */
    height: 100%; /* Cobrir toda a janela */
    overflow: auto; /* Habilita rolagem se necessário */
    background-color: rgba(0, 0, 0, 0.4); /* Fundo preto semi-transparente */
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% do topo e centralizado horizontalmente */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Largura da modal */
    border-radius: 15px;
    box-shadow: 1px 1px 3px black;
}

/* Fechar botão (x) */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

    .container-historico {
        width: 80%;
        box-shadow: 1px 1px 5px #fdb1a2;
        padding: 20px;
        padding: 10px;
        margin: auto;
        margin-top: 20px;
        background-color: #fff;
        border-radius: 10px;
    }

    .table-wrapper {
        overflow-x: auto;
       padding: 20px;
       border-radius: 10px;
       
    }

    .styled-table {
        width: 70%;
        border-collapse: collapse;
        border-spacing: 0;
      
    }

    .styled-table tr{
        
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .styled-table th {
        background-color: #fd846c;
        /* cor de fundo do cabeçalho */
        color: #45251e;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: rgb(250, 250, 250, 0.7);
        /* cor de fundo de linhas pares */
    }

    .styled-table tbody tr:hover {
        background-color: #ececec;
        /* cor de fundo ao passar o mouse */

        
    }
    .container-historico h1{
    color: #dc5e45;
}

.show-details-btn{
    background-color: #dc5e45;
    color: white;
    border: none;
    border-radius: 7px;
    padding: 4px;
    font-weight: bold;
}

</style>
</head>
<body>
<?php
include '../gestor.php';

$obj = new Gestor();
$params = array(
    ':userid' => $_SESSION['user']['id'],
);
$sql = "SELECT * FROM compra WHERE iduser = :userid";
$result = $obj->EXE_QUERY($sql, $params);
?>


<div class="container-historico">
 
    <div class="table-wrapper">
  
        <table class="styled-table">
            
        <h1 class="text-align: right; ">Historico</h1>
            <thead>
                <tr>
                    <th>Id_compra</th>
                    <th>Id_usuario</th>
                    <th>Data_compra</th>
                    <th>Localizacao_entrega</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Detalhes</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php foreach ($result as $compra) : ?>
                    <tr>
                        <td><?php echo $compra['idcompra'] ?></td>
                        <td><?php echo $compra['iduser'] ?></td>
                        <td><?php echo $compra['data'] ?></td>
                        <td><?php echo $compra['localizacao_entrega'] ?></td>
                        <td><?php echo $compra['total'] ?></td>
                        <td><?php echo $compra['status'] ?></td>
                        <!-- Adicionei uma coluna para o botão Detalhes -->
                        <td>
                            <button class="show-details-btn">Detalhes</button>
                            <div class="modal-data" style="display: none;">
                                <h1 style="color: #dc5e45;">Detalhes</h1>
                                <ul>
                                    <?php
                                    $params = array(
                                        ':idcompra' => $compra['idcompra'],
                                    );
                                    $sql = "SELECT * FROM produto_has_compra WHERE idcompra = :idcompra";
                                    $result_details = $obj->EXE_QUERY($sql, $params);
                                    foreach ($result_details as $produto_compra) : ?>
                                        ID Produto: <?php echo $produto_compra['id_produto_compra']. '<br>'; ?>
                                        Quantidade: <?php echo $produto_compra['quantidade']; ?>
                                        <?php echo '<hr>'; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
  
<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modalData">
            <!-- Aqui serão inseridos os detalhes da compra -->
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tableBody = document.getElementById("tableBody");
        tableBody.addEventListener("click", function(event) {
            var target = event.target;
            while (target && target.parentNode !== tableBody) {
                target = target.parentNode;
            }
            if (target.tagName === "TR") {
                var modalData = target.querySelector(".modal-data").innerHTML;
                document.getElementById("modalData").innerHTML = modalData;
                document.getElementById("myModal").style.display = "block";
            }
        });

        document.querySelector(".close").addEventListener("click", function() {
            document.getElementById("myModal").style.display = "none";
        });
    });
</script>

</body>
</html>


