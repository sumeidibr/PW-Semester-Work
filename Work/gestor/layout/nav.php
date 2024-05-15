
<nav class="nav">
    <div class="container_menu">
        <div class="logo">
        <a href="index.php?p=inicio">Tob_<span style="color: #ff5938">Sales</span></a>
        </div>
        <div class="menu">
            <a href="index.php?p=inicio" >Inicio</a>
            <a href="index.php?p=produto" onclick="menu_ativo()" id="a_produto">Produtos</a>
            <a href="index.php?p=categoria">Categorias</a>
            <a href="index.php?p=promocao">Promocoes</a>
            <a href="index.php?p=produto_promocao">Produto & Promo</a>
            <a href="index.php?p=cliente">Clientes</a>
            <a style="color: red;" href="index.php?p=logout">|&nbsp;logout</a>
        </div>
        <div class="search">
        <input type="text" placeholder="">
            <button type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</nav>

<script>
    

    function menu_ativo(){
        var produto = document.getElementById("a_produto");
     produto.style.color = "orange";
    }
</script>
