<?php
include '../gestor.php';
$obj = new Gestor();
$sql = "SELECT * FROM produto";
$sql_dois = "SELECT * FROM promocao";

$result = $obj->EXE_QUERY($sql);
$result_promocao = $obj->EXE_QUERY($sql_dois);

?>

<div class="container_promocao">

    <div class="container_promocao_registro">
        <h1>Registrar Promocoes</h1>
        <form action="metodos\promocao_registrar.php" method="post">

            <div>
                <label for="id_produto">Selecione o Produto:</label>

                <select id="id_produto" name="id_produto" ">
                    <?php

                    if ($result) {
                        foreach ($result as $produto) {
                            echo '<option value="' . $produto['id'] . '">' . $produto['nome'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Nenhum resultado encontrado.</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for=" descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" "></textarea>
            </div>
            <div>
                <label for=" desconto">Desconto:</label>
                <input type="number" max=70 min=1 id="desconto" name="desconto" ">
            </div>
            <div>
                <label for="dataInicio">Data de Início:</label>
                <input type="date" id="dataInicio" name="dataInicio" ">
            </div>
            <div>
                <label for="dataFim">Data de Fim:</label>
                <input type="date" id="dataFim" name="dataFim" ">
            </div>

            <div>
                <label for="status">Status:</label><br>
                true<input type="radio" name="status" id="status_cd" value="1">
                false<input type="radio" name="status" id="status_cd" value="0">
            </div>

            <input type="submit" value="Aplicar Desconto" >
        </form>
    </div>




<div class="container_promocao_atualizar">
    
<h1>Atualizacoes Promocoes</h1>
    <form action="metodos\promocao_actualizar.php" method="post">

        <div>
            <label for="id_produto">Selecione o novo Produto:</label>

            <select id="id_produto_cd" name="id_produto" >
                <?php

                if ($result) {
                    foreach ($result as $produto) {
                        echo '<option value="' . $produto['id'] . '">' . $produto['nome'] . '</option>';
                    }
                } else {
                    echo '<option value="">Nenhum resultado encontrado.</option>';
                }
                ?>
            </select>
        </div>
        <div>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao_cd" name="descricao" ></textarea>
            </div>

            <div>
                <label for="status">Status:</label><br>
                true<input type="radio" name="status" id="status_cd" value="1">
                false<input type="radio" name="status" id="status_cd" value="0">
            </div>

            <div>
                <label for="desconto">Desconto:</label>
                <input type="number" max=70 min=1 id="desconto_cd" name="desconto" >
            </div>
            <div>
                <label for="dataInicio">Data de Início:</label>
                <input type="date" id="dataInicio_cd" name="dataInicio" >
            </div>
            <div>
                <label for="dataFim">Data de Fim:</label>
                <input type="date" id="dataFim_cd" name="dataFim" >
            </div>
            <div>
                <input type="hidden" id="idpromocao" name="idpromocao" >
            </div>

            <input type="submit" value="Atualizar Desconto">
        </form>
    </div>




    <div class="container_lista_promocoes">
        <h1>Promocoes</h1>
        <table class="border" cellspacing="2" cellpadding="7">
            <thead>
                <tr>
                    <th data-field="id">id</th>
                    <th data-field="descricao">descricao</th>
                    <th data-field="Desconto">Desconto</th>
                    <th data-field="data_inicio">data_inicio</th>
                    <th data-field="data_fim">data_fim</th>
                    <th data-field="status">status</th>
                    <th data-field="id_produto">id_produto</th>
                    <th data-field="nome_produto">nome_produto</th>



                </tr>
            </thead>
            <tbody>
                <?php foreach ($result_promocao as $promocao) : ?>
                    <tr>
                        <td><?php echo $promocao['idpromocao']?></td>
                        <td><?php echo $promocao['descricao'] ?></td>
                        <td><?php echo $promocao['desconto'] ?></td>
                        <td><?php echo $promocao['data_inicio']    ?></td>
                        <td><?php echo $promocao['data_fim']  ?></td>
                        <td><?php echo $promocao['status_pro'] ?></td>
                        <td><?php echo $promocao['id_produto'] ?></td>
                        <?php
                        $id_produto = $promocao['id_produto'];
                        $nome_produto = "";

                        // Procurar o produto com o ID correspondente na lista de produtos
                        foreach ($result as $produto) {
                            if ($produto['idproduto'] == $id_produto) {
                                $nome_produto = $produto['nome'];
                                break;
                            }
                        }
                        ?>
                        <td><?php echo  $nome_produto ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</div>

<script>
    // Função para preencher o formulário com as informações do produto
    function preencherFormulario(id, nome, desconto, data_inicio, data_fim, id_) {
        document.getElementById('id_produto_cd').value = id;
        document.getElementById('descricao_cd').value = nome;
        document.getElementById('desconto_cd').value = desconto;
        document.getElementById('dataInicio_cd').value = data_inicio;
        document.getElementById('dataFim_cd').value = data_fim;
        document.getElementById('idpromocao').value = id_;
    }

    // Captura o clique em uma linha da tabela
    document.addEventListener('DOMContentLoaded', function() {
        const linhasTabela = document.querySelectorAll('table tbody tr');
        linhasTabela.forEach(function(linha) {
            linha.addEventListener('click', function() {
                const colunas = this.getElementsByTagName('td');
                const id = colunas[0].innerText;
                const nome = colunas[1].innerText;
                const desconto = colunas[2].innerText;
                const data_inicio = colunas[3].innerText;
                const data_fim = colunas[4].innerText;
                const id_ = colunas[0].innerText;
                // Preenche o formulário com as informações do produto clicado
                preencherFormulario(id, nome, desconto, data_inicio, data_fim, id_);
            });
        });
    });
</script>

