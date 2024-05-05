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
        <h1>Registrar Promocoes</h1>
        <form action="metodos\promocao_registrar.php" method="post">
            <div>
                <label for=" nome">Nome:</label>
                <input type="text" id="nome_promo" name="nome_promo" "></textarea>
            </div>
            <div>
                <label for=" descricao">Descrição:</label>
                <textarea id="descricao_promo" name="descricao_promo" "></textarea>
            </div>

            <input type="submit" value="Registrar Promoção">
        </form>
    </div>




    <div class="container_promocao_atualizar">
    <h1>Atualizar Promocao</h1>
    <form action="metodos\promocao_actualizar.php" method="post">

             <div>
                <label for=" id">ID:</label>
                <input type="text" id="id" name="id" readonly>
            </div>
             <div>
                <label for=" nome">Nome:</label>
                <input type="text" id="nome" name="nome" ">
            </div>
        <div>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" ></textarea>
            </div>

            <input type="submit" value="Atualizar Promoção">
        </form>
    </div>

    <div class="container_lista_promocoes">
        <h1>Promocoes</h1>
        <table class="border" cellspacing="2" cellpadding="7">
            <thead>
                <tr>
                    <th data-field="id">id</th>
                    <th data-field="nome">nome</th>
                    <th data-field="descricao">descricao</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($result_promocao as $promocao) : ?>
                    <tr>
                        <td><?php echo $promocao['idpromocao'] ?></td>
                        <td><?php echo $promocao['descricao'] ?></td>
                        <td><?php echo $promocao['nome'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</div>

<script>
    // Função para preencher o formulário com as informações do produto
    function preencherFormulario(id, nome, descricao) {
        document.getElementById('id').value = id;
        document.getElementById('nome').value = nome;
        document.getElementById('descricao').value = descricao;
    }

    // Captura o clique em uma linha da tabela
    document.addEventListener('DOMContentLoaded', function() {
        const linhasTabela = document.querySelectorAll('table tbody tr');
        linhasTabela.forEach(function(linha) {
            linha.addEventListener('click', function() {
                const colunas = this.getElementsByTagName('td');
                const id = colunas[0].innerText;
                const nome = colunas[1].innerText;
                const descricao = colunas[2].innerText;
                // Preenche o formulário com as informações do produto clicado
                preencherFormulario(id, nome, descricao);
            });
        });
    });
</script>