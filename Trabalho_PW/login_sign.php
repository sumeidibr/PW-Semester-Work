<?php if(isset($_SESSION['user'])): ?>

<h1>Area Reservada</h1>

<?php else:?>

<div class="criar_Conta_Logar">
        <div class="card">
            <div class="card-text">
                <h3 class="text-center">Login/Sign</h3>
                <form action="?p=login_sign" method="post">
                    <div class="form-group m-3">
                        <input type="text" name="text_usuario" placeholder="Usuario" class="form-control">
                    </div>
                    <div class="form-group m-3">
                        <input type="password" name="text_senha" class="form-control" placeholder="password" >
                    </div>
                
                    <div class="text-center">
                        <input type="submit" value="Entrar" class="btn btn-primary m-3">
                       <a href="#">Criar conta</a>
                    </div>
                    <?php if($erro): ?>
                        <div class="alert alert-danger text-center" id="erro">
                            Login invalido
                        </div>
                    <?php endif; ?>

                </form>
            </div>
            <div class="texto-oculto">
                <h3 class="m-4">Registro de Usuário</h3>
                <form action="processar_registro.php" method="post">
                    <div class="form-group m-3">
                        <input type="text" name="txt_usuario" placeholder="Usuario" class="form-control" required>
                    </div>
                    <div class="form-group m-3">
                        <input type="password" placeholder="Senha" class="form-control" id="senha" name="txt_senha" required>
                    </div>
                    <div class="form-group m-3">
                        <input type="number" placeholder="Telemovel ex: 842156451" class="form-control" id="txt_numero" name="txt_numero" required>
                    </div>
                    <div class="form-group m-3">
                        <input type="txt" placeholder="Morada ex: Magoanine 'C'" class="form-control" id="txt_morada" name="txt_morada" required>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Registrar" class="btn btn-primary m-3">
                        <a href="#">Ja tem conta</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php endif;?>
<script>
    $('#erro').delay(3000).fadeOut('slow');
</script>