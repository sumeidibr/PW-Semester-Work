<style>
    .container {
        width: 80%;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .styled-table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .styled-table th {
        background-color: #2c3e50;
        /* cor de fundo do cabeçalho */
        color: #fff;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
        /* cor de fundo de linhas pares */
    }

    .styled-table tbody tr:hover {
        background-color: #ececec;
        /* cor de fundo ao passar o mouse */
    }
</style>
<?php
include '../gestor.php';

$obj = new Gestor();
$params = array(
    ':userid' => $_SESSION['user']['id'],
);
$sql = "SELECT * FROM compra WHERE iduser = :userid";
$result = $obj->EXE_QUERY($sql, $params);
?>

<div class="container">
    <h1>Sobre Cliente</h1>
    <div class="table-wrapper">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>idcompra</th>
                    <th>iduser</th>
                    <th>data_compra</th>
                    <th>localizacao_entrega</th>
                    <th>Total</th>
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
                        <!-- Adicionei uma coluna para o botão Detalhes -->
                        <td>
                            <button class="show-details-btn">Detalhes</button>
                            <div class="modal-data" style="display: none;">
                                <h1>Detalhes da compra:</h1>
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
