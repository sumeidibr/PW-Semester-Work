
 <?php 
        $erro_banco = '';
        $sucesso_banco = '';

    //Validacao de formulario
    if($_SERVER['REQUEST_METHOD']=='POST'){

        //validacao formulario
        if($_POST['formulario']=='email'){
                //verificar se existem todos campos
            $erro = '';
            if(!isset($_POST['text_email']) || !isset($_POST['text_subject']) || !isset($_POST['text_mensagem'])){
                $erro = 'Pelo menos um dos campos nao existe';
            }
            $email = $_POST['text_email'];
            $subject = $_POST['text_subject'];
            $mensagem = $_POST['text_mensagem'];
            //se nao tiver nenhum erro vai tentar validar o email e continuar para o processo seguinte 
            if(empty($erro)){
                //verificar se email e valido
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $erro = "Invalid email format";
                }
            }
            //Tentativa de enviar email
            if(empty($erro)){      
                include 'enviar_email.php'; 
            }

        }
        //formulario banco de dados
        if($_POST['formulario']=='newsletter'){
            $email = $_POST['text_email'];
            $nome = $_POST['text_nome'];
            


            include 'gestor.php';
            $obj = new Gestor();

            $parametros = array(
               ':email' => $email,
               ':nome' => $nome
            );

            //verificar se o email ja existe no banco de dados
             $parametro_busca = array(
               ':email' => $email
            );
            $busca = $obj->EXE_QUERY(
                'SELECT email FROM emails WHERE email = :email',$parametro_busca
            );
            if(count($busca)!=0){
                //email ja existe, se o email ja existir
                $erro_banco = 'Email ja registrado <br> Use outra conta';
            }else{
                //adicionar novo obj
                $obj-> EXE_NON_QUERY(
                    'INSERT INTO emails(email,nome) VALUES(:email,:nome)', $parametros
                );
                $sucesso_banco ='obrigado por ter registrado o seu email!';
             }
        } 
    }
?>

<div class="container m-3">
    <div class="row">
        <div class="offset-3 col-6 text-center">
            <?php if (!empty($erro_banco)): ?>
                <div class="alert alert-danger">
                    <?php echo $erro_banco; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($sucesso_banco)): ?>
                <div class="alert alert-success">
                    <?php echo $sucesso_banco; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<div class="container mb-5">
    <div class="row m3">
        <div class="offset-3 col-6">
        <h1>Contactos</h1>
            <!-- <form action="tratar.php" method="post" name="meu_form"  onsubmit="return validar()">   -->
            <form action="?p=contactos" method="post">

                <input type="hidden" name="formulario" value="email">

                <div class="form-group">
                     <input type="email" name="text_email"  placeholder="Email" required class="form-control mb-3"> 
                </div>

                <div class="form-group">
                    <input type="text" name="text_subject" placeholder="Assunto" required  class="form-control mb-3">
                </div>

                <div class="form-group">
                    <textarea name="text_mensagem"  cols="40" rows="3" required  class="form-control mb-3"></textarea>
                </div>

                <div class="text-center">
                     <input type="submit" value="Enviar Mensagem" class="btn btn-primary">
                </div>
                
            </form> 
        </div>
    </div>

    <div class="row mt-3 mb-5">
        <div class="offset-3 col-6">
            <hr>
        <h1>Banco de dados</h1>
            <form action="?p=contactos" method="post">
            
                <input type="hidden" name="formulario" value="newsletter">

                <div class="form-group">    
                    <input type="text" name="text_nome"  placeholder="nome" required class="form-control mb-3"> 
                </div>

                <div class="form-group">    
                    <input type="email" name="text_email"  placeholder="Email" required class="form-control mb-3"> 
                </div>
                
                <div class="text-center">
                    <input type="submit" value="Enviar banco de dados" class="btn btn-primary mb-5">
                </div>
                
            </form>
        </div>
    </div>
</div>



<!-- esse codigo so sera executado se a codicao for satisfeita-->
<?php if(!empty($erro)):?>
    <div style="color:red;"><?php echo $erro ?></div>
<?php endif; ?>

<!-- validacao com JS-->
<script>
    function validar(){
        let text_usuario = document.forms['meu_form']['text_usuario'].value;
        let text_senha = document.forms['meu_form']['text_senha'].value;

        if(text_usuario === ''){
            document.getElementById('erro').innerHTML = 'O usuário deve ser preenchido';
            return false;
        } else if(text_senha === ''){
            document.getElementById('erro').innerHTML = 'A senha deve ser preenchida';
            return false;
        } else {
            return true;
        }
    }
</script>
