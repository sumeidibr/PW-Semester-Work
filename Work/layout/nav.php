

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 
</head>
<body>
<!--<nav class="nav">
    <div class="container_menu">
        <div class="logo">
            <a href="index.php?p=inicio">Tob_<span style="color: #ff5938">Sales</span></a>
        </div>
        <div class="menu">
            <a href="index.php?p=inicio"><i class="fas fa-home"></i>Inicio</a>
            <a href="index.php?p=produto"><i class="fas fa-box"></i>Produtos</a>
            <a href="index.php?p=sobre">Sobre</a>
            <a href="index.php?p=login" style="color: white; background-color: #fd846c; padding: 7px; border-radius: 14px; font-weight: bold;">Login</a>
        </div>
        
        <div class="search">
            <input type="text" placeholder="">
            <button type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</nav>
--->

<nav class="nav">
    <div class="container_menu">
        <div class="logo">
            <a href="index.php?p=inicio">Tob_<span style="color: #ff5938">Sales</span></a>
        </div>
        <input type="checkbox" id="menu-bar">
        <label for="menu-bar" class="menu-icon">☰</label>
        <div class="menu">
            <a href="index.php?p=inicio"><i class="fas fa-home"></i>Inicio</a>
            <a href="index.php?p=produto"><i class="fas fa-box"></i>Produtos</a>
            <a href="index.php?p=sobre">Sobre</a>
            <a href="index.php?p=login" class="login-btn">Login</a>
        </div>
        <div class="search">
        <form action="?p=produto" method="POST">
                <input id="pesquisa" name="pesquisa" type="text" placeholder="Buscar" required>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
</nav>

</body>
</html>
