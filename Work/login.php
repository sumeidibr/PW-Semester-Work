<div class="container_login">
    <div class="content first-content">

        <div class="first-column">
            <h2 class="title title-primary">Bem Vindo!</h2>
            <p class="description description-primary">Para se manter conectado conosco</p>
            <p class="description description-primary">por favor logue com suas informações pessoais</p>
            <button id="signin" class="btn btn-primary">entrar</button>
        </div><!-- FIRST-COLUMN -->

        <div class="second-column">
            <h2 class="title title-second">Criar conta</h2>
            <div class="social-midia">
                <ul class="list-social-midia">
                    <a class="link-social-midia" href="#">
                        <li class="item-social-midia"><i class="fab fa-facebook-f"></i></li>
                    </a><!-- FACEBOOK -->
                    <a class="link-social-midia" href="#">
                        <li class="item-social-midia"><i class="fab fa-google"></i></li>
                    </a><!-- GOOGLE -->
                    <a class="link-social-midia" href="#">
                        <li class="item-social-midia"><i class="fab fa-linkedin-in"></i></li>
                    </a><!-- LINKEDIN -->
                </ul>
            </div><!-- SOCIAL-MIDIA -->
            <!--Formulario Cadastrar -->
            <p class="description description-second">Registre-se com seu email</p>
            <form id="form" action="criar_conta.php" method="post" class="form_login" enctype="multipart/form-data">
                <label class="label-input icon-modify" for="pnome">
                    <i class="fas fa-user"></i>
                    <input type="text" id="pnome" placeholder="Stelio" name="pnome" pattern="[A-Za-zÀ-ÖØ-öø-ÿ]{3,}" minlength="3" title="O nome deve conter apenas letras e ter pelo menos 3 caracteres." required>
                </label>
                <label class="label-input icon-modify" for="apelido">
                    <i class="fas fa-user"></i>
                    <input type="text" id="apelido" placeholder="Mondlane" name="apelido" pattern="[A-Za-zÀ-ÖØ-öø-ÿ]{3,}" minlength="3" title="O apelido deve conter apenas letras e ter pelo menos 3 caracteres." required>
                </label>
                <label class="label-input icon-modify" for="email">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email" name="email" required>
                </label>

                <label class="label-input icon-modify" for="senha" required>
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Senha" name="senha" required>
                </label>

                <label class="label-input icon-modify" for="telefone">
                    <i class="fas fa-mobile-alt"></i>
                    <input type="text" id="telefone" placeholder="842156451" name="telefone" pattern="^(84|87|82|85|83|86)[0-9]{7}$" title="O número deve ter 9 dígitos e começar com 84, 87, 82, 85, 83 ou 86." required>
                </label>

                <input type="hidden" id="tipo" name="tipo_user" value="cliente" required>
                <label class="label-input icon-modify" for="imagem">
                    <input type="file" id="imagem" name="imagem">
                </label>
                <button class="btn btn-second">registre-se</button>
            </form>
        </div><!-- SECOND-COLUMN -->

    </div><!-- CONTENT FIRST-CONTENT -->

    <div class="content second-content">

        <div class="first-column">
            <h2 class="title title-primary">Olá,bem vindo!</h2>
            <p class="description description-primary">Insira seu dados pessoais</p>
            <p class="description description-primary">e comece sua jornada conosco.</p>
            <button id="signup" class="btn btn-primary">registre-se</button>
        </div><!-- FIRST-COLUMN -->

        <div class="second-column">
            <h2 class="title title-second">Entre na sua conta</h2>
            <div class="social-midia">
                <ul class="list-social-midia">
                    <a class="link-social-midia" href="#">
                        <li class="item-social-midia"><i class="fab fa-facebook-f"></i></li>
                    </a><!-- FACEBOOK -->
                    <a class="link-social-midia" href="#">
                        <li class="item-social-midia"><i class="fab fa-google"></i></li>
                    </a><!-- GOOGLE -->
                    <a class="link-social-midia" href="#">
                        <li class="item-social-midia"><i class="fab fa-linkedin-in"></i></li>
                    </a><!-- LINKEDIN -->
                </ul>
            </div><!-- SOCIAL-MIDIA -->
            <!--Formulario Entrar -->
            <p class="description description-second">Conectar-se com seu email</p>
            <form action="tratar_login.php" method="post" class="form_login" onsubmit="return validarFormulario()">
                <label class="label-input icon-modify" for="">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email" name="email" required>
                </label>
                <label class="label-input icon-modify" for="">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Senha" name="password" required>
                </label>
                <input type="hidden" name="tipo_login" value="cliente">
                <a class="password" href="#">esqueceu a senha?</a>
                <button type="submit" class="btn btn-second">entrar</button>
            </form>
        </div><!-- SECOND-COLUMN -->

    </div><!-- CONTENT SECOND-CONTENT -->

</div><!-- CONTAINER -->

<script>
    // Validação adicional com JavaScript para garantir compatibilidade
    document.getElementById('form').addEventListener('submit', function(event) {
        const pnome = document.getElementById('pnome').value;
        const apelido = document.getElementById('apelido').value;
        const pattern = /^[A-Za-zÀ-ÖØ-öø-ÿ]{3,}$/;

        if (!pattern.test(pnome)) {
            alert('O nome deve conter apenas letras e ter pelo menos 3 caracteres.');
            event.preventDefault();
        }

        if (!pattern.test(apelido)) {
            alert('O apelido deve conter apenas letras e ter pelo menos 3 caracteres.');
            event.preventDefault();
        }
    });
</script>

<script>
    // Validação adicional com JavaScript para garantir compatibilidade
    document.getElementById('form').addEventListener('submit', function(event) {
        const telefone = document.getElementById('telefone').value;
        const pattern = /^(84|87|82|85|83|86)[0-9]{7}$/;

        if (!pattern.test(telefone)) {
            alert('O número deve ter 9 dígitos e começar com 84, 87, 82, 85, 83 ou 86.');
            event.preventDefault();
        }
    });
</script>