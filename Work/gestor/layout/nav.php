<nav class="nav">
    <div class="container_menu">
        <div class="logo">
            <a href="index.php?p=inicio">Tob_<span style="color: #ff5938">Sales</span></a>
        </div>
        <div class="menu">
            <a href="index.php?p=inicio">Inicio</a>
            <a href="index.php?p=produto" onclick="menu_ativo()" id="a_produto">Produtos</a>
            <a href="index.php?p=categoria">Categorias</a>
            <a href="index.php?p=promocao">Promocoes</a>
            <a href="index.php?p=produto_promocao">Produto & Promo</a>
            <a href="index.php?p=cliente">Clientes</a>

        </div>

        <div>
            <i style="color: white;" class="fas fa-user"></i>
            <a style="color: white;" href="index.php?p=logout"><i class="fas fa-sign-out-alt"></i></a>

        </div>

    </div>
</nav>

<script>
    function menu_ativo() {
        var produto = document.getElementById("a_produto");
        produto.style.color = "orange";
    }
</script>