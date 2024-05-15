
<nav class="nav">
    <div class="container_menu">
        <div class="logo">
        <a href="index.php?p=inicio">Tob_<span style="color: #ff5938">Sales</span></a>
        </div>
        <div class="menu">
            <a href="index.php?p=inicio"><i class="fas fa-home"></i> Inicio</a>
            <a href="index.php?p=produto" onclick="menu_ativo()" id="a_produto"><i class="fas fa-box"></i> Produtos</a>
            <a href="index.php?p=categoria"><i class="fas fa-list"></i> Categorias</a>
            <a href="index.php?p=promocao"><i class="fas fa-tag"></i> Promocoes</a>
            <a href="index.php?p=produto_promocao"><i class="fas fa-folder"></i> Produto & Promo</a>
            <a href="index.php?p=cliente"><i class="fas fa-user"></i> Clientes</a>
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
