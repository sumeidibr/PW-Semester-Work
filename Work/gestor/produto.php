<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

include '../gestor.php';
$obj = new  Gestor();

$sql = "SELECT * FROM produto";
$sql_select = 'SELECT * FROM categoria';

$resultados_produtos = $obj->EXE_QUERY($sql);
$result_categorias = $obj->EXE_QUERY($sql_select);
?>





<div class="container_produto">

    <div class="container_produto_registro">
        <h1>Cadastro de Produtos</h1>
        <form action="metodos\produto_registrar.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="nome">Nome</label>
                <input type="text" id="nome_cd" name="nome">
            </div>
           
            <div>
                <label for="preco">Preço</label>
                <input type="text" id="preco_cd" name="preco">
            </div>
            <div>
                <label for="estoque">Estoque</label>
                <input type="text" id="estoque_cd" name="estoque">
            </div>
            <div>
                <label for="categoria">Categoria</label>
                <select id="categoria_cd" name="categoria">
                    <?php
                    if ($result_categorias) {
                        foreach ($result_categorias as $categoria) {
                            echo '<option value="' . $categoria['id'] . '">' . $categoria['nome'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Nenhum resultado encontrado.</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="descricao">Descrição</label>
                <textarea id="descricao_cd" name="descricao"></textarea>
            </div>

            <div>
                
                <input type="file" id="imagem_cd" name="imagem">
            </div>
            <input type="submit" value="Adicionar">
        </form>
    </div>

    <div class="container_produto_atualizar">
        <h1>Atualizar Produtos</h1>
        <form action="metodos\produto_actualizar.php" method="post" enctype="multipart/form-data">

            <div>
                <input type="hidden" id="id_produto" name="id_produto">
            </div>
            <div>
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome">
            </div>
            
            <div>
                <label for="preco">Preço</label>
                <input type="text" id="preco" name="preco">
            </div>
            <div>
                <label for="estoque">Estoque</label>
                <input type="text" id="estoque" name="estoque">
            </div>
            <div>
                <label for="categoria">Categoria</label>
                <select id="categoria" name="categoria">
                    <?php
                    if ($result_categorias) {
                        foreach ($result_categorias as $categoria) {
                            echo '<option value="' . $categoria['id'] . '">' . $categoria['nome'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Nenhum resultado encontrado.</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao"></textarea>
            </div>
            <div>
            
                <input type="file" id="imagem_cd" name="imagem">
            </div>
            
            <input type="submit" value="Atualizar">
        </form>
    </div>

    <div class="container_lista_produtos">
        <h1>Lista de Produtos</h1>
        <table class="border" cellspacing="2" cellpadding="7">
            <thead>
                <tr>
                    <th data-field="id">id</th>
                    <th data-field="name">nome</th>
                    <th data-field="descricao">descricao</th>
                    <th data-field="price">preco</th>
                    <th data-field="estoque">estoque</th>
                    <th data-field="categoria">categoria</th>
                    <th data-field="imagem">imagem</th>


                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados_produtos as $produto) : ?>
                    <tr>
                        <td><?php echo $produto['idproduto'] ?></td>
                        <td><?php echo $produto['nome']     ?></td>
                        <td><?php echo $produto['descricao'] ?></td>
                        <td><?php echo $produto['preco']    ?></td>
                        <td><?php echo $produto['estoque']  ?></td>
                        <td><?php echo $produto['categoria'] ?></td>
                        <td style="height: 100px; width: 100px;">
    <img src="<?php echo '../'.$produto['imagem'] ?>" alt="" style="max-width: 100%; max-height: 100%;">
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>


<script>
    // Função para preencher o formulário com as informações do produto
    function preencherFormulario(id, nome, descricao, preco, estoque, categoria) {
        document.getElementById('id_produto').value = id;
        document.getElementById('nome').value = nome;
        document.getElementById('descricao').value = descricao;
        document.getElementById('preco').value = preco;
        document.getElementById('estoque').value = estoque;
        document.getElementById('categoria').value = categoria;
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
                const preco = colunas[3].innerText.replace('R$ ', ''); // Remove o 'R$ ' do preço
                const estoque = colunas[4].innerText;
                const categoria = colunas[5].innerText;

                // Preenche o formulário com as informações do produto clicado
                preencherFormulario(id, nome, descricao, preco, estoque, categoria);
            });
        });
    });
</script>
</body>
</html>






