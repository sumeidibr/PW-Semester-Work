

<nav>
    <div class="container">
        <div class="logo">
            <a href="index.php?p=inicio">E_COMMERCE</a>
        </div>
        <div class="menu">
            <a href="index.php?p=inicio"><i class="fas fa-home"></i> Início</a>
            <a href="index.php?p=produto"><i class="fas fa-box"></i> Produtos</a>
            <a href="index.php?p=carrinho"><i class="fas fa-shopping-cart"></i> Carrinho</a>
            <a href="index.php?p=historico"><i class="fas fa-shopping-bag"></i> Compras</a>
            <a href="index.php?p=perfil"><i class="fas fa-user"></i> Perfil</a>
           
        </div>

        <div class="container-perfil">
        
            <div class="icon-perfil">
        

                <img src="<?php echo '../'.$_SESSION['user']['imagem']?>" alt="Imagem_perfil">
            </div>
            <div class="user-perfil">
                <?php echo $_SESSION['user']['nome'] . ' ' . $_SESSION['user']['apelido'] ?>
            </div>
            <div class="logout-perfil">
                <a href="?p=logout"> logout</a>
            </div>
        </div>
    </div>
</nav>