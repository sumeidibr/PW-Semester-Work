<?php
include '../gestor.php';
$obj = new Gestor();
$sql = "SELECT * FROM produto";
$sql_dois = "SELECT * FROM promocao";

$result = $obj->EXE_QUERY($sql);
$result_promocao = $obj->EXE_QUERY($sql_dois);


$result_prod_prom = $obj->EXE_QUERY('select * from produto_has_promocao');
?>


<div class="container_promocao">
    <div class="container_promocao_registro">
        <h1>Associar Promoção a Produto</h1>
        <form action="metodos\produto_promocao_registrar.php" method="post">
            <div>
                <label for="id_promocao">Selecione a promoção:</label>
                <select id="id_promocao" name="id_promocao">
                    <?php
                    if ($result_promocao) {
                        foreach ($result_promocao as $promocao) {
                            echo '<option value="' . $promocao['idpromocao'] . '">' . $promocao['nome'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Nenhum resultado encontrado.</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="desconto">Desconto:</label>
                <input type="number" max="70" min="1" id="desconto" name="desconto">
            </div>

            <div>
                <label for="id_produto">Selecione o(s) Produto(s):</label>
                <select id="id_produto" name="id_produto[]" multiple>
                    <?php
                    if ($result) {
                        foreach ($result as $produto) {
                            echo '<option value="' . $produto['idproduto'] . '">' . $produto['nome'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Nenhum resultado encontrado.</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="dataInicio">Data de Início:</label>
                <input type="date" id="dataInicio" name="dataInicio">
            </div>

            <div>
                <label for="dataFim">Data de Fim:</label>
                <input type="date" id="dataFim" name="dataFim">
            </div>

            <div>
                <label for="status">Status:</label><br>
                <label><input type="radio" name="status" id="status_cd" value="1" >Ativo</label>
                <label><input type="radio" name="status" id="status_cd" value="0" >Inativo</label>
            </div>

            <input type="submit" value="Associar Produto ao Desconto">
        </form>
    </div>


    <div class="container_promocao_atualizar">
        <h1>Atualizar Associação</h1>
        <form action="metodos\produto_promocao_actualizar.php" method="post">
            <div>
                <label for="id">ID:</label>
                <input type="text" id="update_id" name="id" readonly>
            </div>
            <div>
                <label for="id_produto">ID Produto:</label>
                <input type="text" id="update_id_produto" name="id_produto" readonly>
            </div>
            <div>
                <label for="id_promocao">ID Promoção:</label>
                <input type="text" id="update_id_promocao" name="id_promocao" readonly>
            </div>
            <div>
                <label for="dataInicio">Data de Início:</label>
                <input type="text" id="update_dataInicio" name="dataInicio" readonly>
            </div>
            <div>
                <label for="dataFim">Data de Fim:</label>
                <input type="text" id="update_dataFim" name="dataFim" readonly>
            </div>
            <div>
                <label for="desconto">Desconto:</label>
                <input type="text" id="update_desconto" name="desconto">
            </div>
            <div>
                <label for="update_status">Estado:</label><br>
                <label><input type="radio" name="update_status" id="update_status" value="1"> Ativo</label>
                <label><input type="radio" name="update_status" id="update_status" value="0"> Inativo</label>
            </div>
            <input type="submit" value="Atualizar Promoção">
        </form>
    </div>

    <div class="container_lista_promocoes">
        <h1>Produto/Associacao</h1>
        <table class="border" cellspacing="2" cellpadding="7">
            <thead>
                <tr>
                    <th data-field="id">ID_Ass</th>
                    <th data-field="idproduto">idproduto</th>
                    <th data-field="idpromocao">idpromocao</th>
                    <th data-field="datainicio">data_inicio</th>
                    <th data-field="datafim">data_fim</th>
                    <th data-field="desconto">desconto</th>
                    <th data-field="estado">estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result_prod_prom as $prod_promo) : ?>
                    <tr>
                        <td><?php echo $prod_promo['idAssociacao'] ?></td>
                        <td><?php echo $prod_promo['idProduto'] ?></td>
                        <td><?php echo $prod_promo['idPromocao'] ?></td>
                        <td><?php echo $prod_promo['Data_Inicio'] ?></td>
                        <td><?php echo $prod_promo['Data_Fim'] ?></td>
                        <td><?php echo $prod_promo['desconto'] ?></td>
                        <td><?php echo $prod_promo['estado'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Função para preencher todos os componentes do formulário com as informações da linha clicada na tabela
        function preencherFormulario(idAssociacao, idProduto, idPromocao, dataInicio, dataFim, desconto, qtMax, qtMin, estado) {
            document.getElementById('update_id').value = idAssociacao;
            document.getElementById('update_id_produto').value = idProduto;
            document.getElementById('update_id_promocao').value = idPromocao;
            document.getElementById('update_dataInicio').value = dataInicio;
            document.getElementById('update_dataFim').value = dataFim;
            document.getElementById('update_desconto').value = desconto;
           // document.getElementById('update_status').value = estado;
        }

        // Captura o clique em uma linha da tabela
        document.addEventListener('DOMContentLoaded', function() {
            const linhasTabela = document.querySelectorAll('table tbody tr');
            linhasTabela.forEach(function(linha) {
                linha.addEventListener('click', function() {
                    const colunas = this.getElementsByTagName('td');
                    const idAssociacao = colunas[0].innerText;
                    const idProduto = colunas[1].innerText;
                    const idPromocao = colunas[2].innerText;
                    const dataInicio = colunas[3].innerText;
                    const dataFim = colunas[4].innerText;
                    const desconto = colunas[5].innerText;
                    const estado = colunas[6].innerText;
                    // Preenche todos os componentes do formulário com as informações da linha clicada na tabela
                    preencherFormulario(idAssociacao, idProduto, idPromocao, dataInicio, dataFim, desconto, estado);
                });
            });
        });
    </script>