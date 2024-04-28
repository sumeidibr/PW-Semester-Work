<?php
include '../gestor.php';

$obj = new Gestor();
$sql = "SELECT * FROM categoria";
$result = $obj->EXE_QUERY($sql);

?>

<div class="container_categoria">

    <div class="container_registrar_categoria">
        <h1>Criar Categorias</h1>
        <form action="metodos\categoria_registrar.php" method="post">
            <div>
                <label for="nome_categoria">Nome:</label>
                <input type="text" id="nome_categoria" name="nome_categoria">
            </div>
            <div>
                <label for="descricao_categoria">Descrição:</label>
                <textarea id="descricao_categoria" name="descricao_categoria"></textarea>
            </div>
            <div>
                <label for="tipo_cliente">Tipo de Cliente:</label>
                <select id="tipo_cliente" name="tipo_cliente">
                    <option value="H">Homem</option>
                    <option value="F">Mulher</option>
                    <option value="H|F">HOMEM|MULHER</option>
                    <option value="h">MENINO</option>
                    <option value="f">MENINA</option>
                    <option value="h|F">MENINO|MENINA</option>
                    <option value="hh">Adolescente HOMEM</option>
                    <option value="ff">Adolescente MULHER</option>
                    <option value="hh|FF">Adolescente HOMEM|MULHER</option>
                </select>
            </div>
            <input type="submit" value="Adicionar Categoria">
        </form>

    </div>


    <div class="container_actualizar_categoria">
        <h1>Actualizar Categoria</h1>
        <form action="metodos\categoria_actualizar.php" method="post">
            <input type="hidden" id="id" name="nome_categoria">
            <div>
                <label for="nome_categoria">Nome:</label>
                <input type="text" id="nome" name="nome_categoria">
            </div>
            <div>
                <label for="descricao_categoria">Descrição:</label>
                <textarea id="descricao" name="descricao_categoria"></textarea>
            </div>
            <div>
                <label for="tipo_cliente">Tipo de Cliente:</label>
                <select id="tipo_cliente" name="tipo_cliente">
                    <option value="H">Homem</option>
                    <option value="F">Mulher</option>
                    <option value="H|F">HOMEM|MULHER</option>
                    <option value="h">MENINO</option>
                    <option value="f">MENINA</option>
                    <option value="h|F">MENINO|MENINA</option>
                    <option value="hh">Adolescente HOMEM</option>
                    <option value="ff">Adolescente MULHER</option>
                    <option value="hh|FF">Adolescente HOMEM|MULHER</option>
                </select>
            </div>
            <input type="submit" value="Actualizar Categoria">
        </form>
    </div>



    <div class="container_lista_categorias">
        <h1>Categorias</h1>
        <table class="border" cellspacing="2" cellpadding="7">
            <thead>
                <tr>
                    <th data-field="id">id</th>
                    <th data-field="nome">nome</th>
                    <th data-field="descricao">descricao</th>
                    <th data-field="tipo_cliente">Tipo Cliente</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $categoria) : ?>
                    <tr>
                        <td><?php echo $categoria['idcategoria'] ?></td>
                        <td><?php echo $categoria['nome'] ?></td>
                        <td><?php echo $categoria['descricao'] ?></td>
                        <td><?php echo $categoria['tipo_cliente'] ?></td>
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