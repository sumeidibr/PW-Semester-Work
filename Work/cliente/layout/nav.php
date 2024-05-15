<nav class="nav">
    <div class="container_menu">
        <div class="logo">
            <a href="index.php?p=inicio">Tob_<span style="color: #ff5938">Sales</span></a>
        </div>
        <div class="menu">
            <a href="index.php?p=inicio"><i class="fas fa-home"></i> Início</a>
            <a href="index.php?p=produto"><i class="fas fa-box"></i> Produtos</a>
            <a href="index.php?p=carrinho"><i class="fas fa-shopping-cart"></i> Carrinho</a>
            <a href="index.php?p=historico"><i class="fas fa-shopping-bag"></i> Compras</a>
            <a href="index.php?p=perfil"><i class="fas fa-user"></i> Perfil</a>

        </div>

        <div class="search">
            <form action="?p=produto" method="POST">
                <input id="pesquisa" name="pesquisa" type="text" placeholder="Buscar" required>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <div class="container-perfil">

            <div class="icon-perfil">


                <img src="<?php echo '../' . $_SESSION['user']['imagem'] ?>" alt="Imagem_perfil">
            </div>
            <div class="user-perfil">
                <?php echo $_SESSION['user']['nome'] . ' ' . $_SESSION['user']['apelido'] ?>
            </div>
            <div class="logout-perfil">
                <a href="?p=logout"> Log out</a>
            </div>
        </div>
    </div>
</nav>