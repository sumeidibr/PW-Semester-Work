<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!--Inicio-->
    <link rel="stylesheet" href="../inicio.css">

    <link rel="stylesheet" href="../seccao_1.css">

    <link rel="stylesheet" href="../marcas.css">

    <link rel="stylesheet" href="../featured.css">

      <!--- icons -->
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!--TODO PHP -->
    <?php
    include '../gestor.php';


    $obj = new Gestor();

    $sql = 'SELECT * FROM produto WHERE estoque >= 1 ORDER BY RAND() LIMIT 4';
    $result = $obj->EXE_QUERY($sql);

    ?>


    <div class="main">
        <!--- Slide animado para seccao 1 (inicio)-->

        <section class="containerproject">
            <div class="slide-container active">
                <div class="slide">
                    <div class="contentproject">
                        <h3>Título </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam natus aliquid autem, ut rem recusandae corrupti consectetur asperiores et. Quidem reprehenderit consectetur unde modi nisi. Harum ratione natus odio doloribus.</p>
                        <a href="background_1.avif" class="btnproj">saiba mais</a>
                    </div>
                </div>
            </div>

            <div class="slide-container">
                <div class="slide">
                    <div class="contentproject">
                        <h3>Conteúdo</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam natus aliquid autem, ut rem recusanssdae corrupti consectetur asperiores et. Quidem reprehenderit consectetur unde modi nisi. Harum ratione natus odio doloribus.</p>
                        <a href="background_1.avif" class="btnproj">saiba mais</a>
                    </div>
                </div>
            </div>

            <div class="slide-container">
                <div class="slide">
                    <div class="contentproject">
                        <h3>Objectivo</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam natus aliquid autem, ut rem recusandae corrupti consectetur asperiores et. Quidem reprehenderit consectetur unde modi nisi. Harum ratione natus odio doloribus.</p>
                        <a href="" class="btnproj">saiba mais</a>
                    </div>
                </div>
            </div>

            <div id="prev" onclick="prev()"> </div>
            <div id="next" onclick="next()"> </div>
        </section>




        <div class="marcas">
            <a><img src="assets/img/gucci.png" alt=""></a>
            <a><img src="assets/img/adidas.png" alt=""></a>
            <a><img src="assets/img/Dior.png" alt=""></a>
            <a><img src="assets/img/puma.png" alt=""></a>
            <a><img src="assets/img/vans.png" alt=""></a>
        </div>

        <div class="suporte">
        <a href="https://wa.me/message/XLUMIGURZ5QZK1"><i class='bx bx-support' style="color: white; margin-left: 5px; font-size: 2rem;"  ></i></a>
        </div>

        <!---Introducao-->
        <section class="conteudo">
            <!--<section class="introducao">
                <div class="divisao-1">
                    <h2>Tob_Sales</h2>
                    <img src="logo-1.png" alt="">
                </div>

                <div class="divisao-2">
                    <h2><span style="color: #1c0802;">Explorando o mundo da moda. <span></span> </span>Seu visual, sua historia, comece <span style="color: #1c0802;"> a escrever com </span> <span>nossas roupas.</span></h2>
                </div>
--->
            </section>
            <div class="parag">

                <p>Na Tob_Sales, abra as portas para um mundo de moda sem limites. Com uma seleção incomparável de roupas que refletem as últimas tendências e um compromisso inabalável com a qualidade, estamos aqui para ajudá-lo a expressar sua individualidade em cada peça que você veste.
                <div class="botaoo">
                    <button class="contact_btn">Contactar</button>
                </div>
                </p>
            </div>
        </section>


        <h2 style="text-align: center; margin-top: 20px; color:#ff5722 ;"><span style="color: #602f20; border-bottom: 1px solid #602f20; border-width: 4px;">Mais</span> Populares</h2>
        <div class="container_catalogo">

    



            <?php foreach ($result as $produto) : ?>
                <?php if ($produto['estoque'] >= 1) { ?>
                    <div class="card">
                        <img src="<?php echo '../' . $produto['imagem'] ?>" alt="imagem_produto">
                        <div class="info">
                            <p class="nome"><?php echo $produto['nome'] ?></p>
                            <?php

                            $hoje = date('Y-m-d');

                            $sql_promocao = 'SELECT * FROM produto_has_promocao WHERE idProduto = :id_produto AND :hoje BETWEEN Data_Inicio AND Data_Fim';
                            $params_promocao = array(':id_produto' => $produto['idproduto'], ':hoje' => $hoje);

                            $resultado_promocao = $obj->EXE_QUERY($sql_promocao, $params_promocao);
                            echo  '<p class="preco"> ' . $produto['preco'] . ' Mzn</p>';

                            if ($resultado_promocao) {
                                // var_dump($resultado_promocao);
                                //die();
                                echo 'Promoção: <br>';
                                echo 'Desconto: ' . $resultado_promocao[0]['desconto'] . '% <hr>';
                                echo '<p class="preco">Desconto: ' . ($produto['preco'] - ($produto['preco'] * ($resultado_promocao[0]['desconto'] / 100))) . '  Mzn</p>';
                                // O produto está em promoção
                            } else {
                                //echo 'nopnop';
                                // O produto não está em promoção
                            }
                            ?>
                        </div>
                        <a href="?add_carrinho=<?php echo $produto['idproduto'] ?>" class="botao">Adicionar</a>
                    </div>
                <?php } ?>
            <?php endforeach; ?>
        </div>



        <!------- featured-->
        <section class="featured container" id="featured">
            <!-- heading
        <div class="heading">
            <h2>Featured <span>Items</span></h2>
        </div>
       --->
            <div class="featured-container container">
                <!---box 1-->
                <div class="box">
                    <img src="assets/img/product1.png" alt="">
                    <div class="text">
                        <h2>Nova coleção<br> de camisetas</h2>
                        <a href="">Nao perca!</a>
                    </div>
                </div>
                <!---box 2-->
                <div class="box">
                    <div class="text">
                        <h2>20% de desconto<br> no boné</h2>
                        <a href="">Em breve!</a>
                    </div>
                    <img src="assets/img/product6.png" alt="">
                </div>

            </div>
        </section>


        <!---Marcas-->
        <section class="client-area">
            <div class="contentor">

                <h2> <span>Marcas</span>
                    <p style="text-align: center; color: rgb(125, 82, 3);">__________</p>
                </h2>

                <section class="logo-area slider">
                    <div class="slide"><img src="assets/img/umbro.png" alt=""></div>
                    <div class="slide"><img src="assets/img/vans.png" alt=""></div>
                    <div class="slide"><img src="assets/img/puma.png" alt=""></div>
                    <div class="slide"><img src="assets/img/Dior.png" alt=""></div>
                    <div class="slide"><img src="assets/img/adidas.png" alt=""></div>
                    <div class="slide"><img src="assets/img/gucci.png" alt=""></div>
                    <div class="slide"><img src="assets/img/vans.png" alt=""></div>
                    <div class="slide"><img src="assets/img/puma.png" alt=""></div>
                    <div class="slide"><img src="assets/img/Dior.png" alt=""></div>
                    <div class="slide"><img src="assets/img/adidas.png" alt=""></div>
                    <div class="slide"><img src="assets/img/gucci.png" alt=""></div>
                </section>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
        </section>


        <?php
        // Verificando se existe a chave 'adicionar' no array $_GET e se é um número inteiro positivo
        if (isset($_GET['adicionar']) && filter_var($_GET['adicionar'], FILTER_VALIDATE_INT) !== false && $_GET['adicionar'] >= 0) {
            $idpro = (int)$_GET['adicionar'];
            // Verificando se o produto com o id 'adicionar' existe no array $result
            $produto_encontrado = false;
            foreach ($result as $produto) {
                if ($produto['idproduto'] == $idpro) {

                    $hoje = date('Y-m-d');

                    $sql_promocao = 'SELECT * FROM produto_has_promocao WHERE idProduto = :id_produto AND :hoje BETWEEN Data_Inicio AND Data_Fim';
                    $params_promocao = array(':id_produto' => $produto['idproduto'], ':hoje' => $hoje);

                    $resultado_promocao = $obj->EXE_QUERY($sql_promocao, $params_promocao);

                    if ($resultado_promocao) {
                        $desconto =  $resultado_promocao[0]['desconto'];
                    }

                    $produto_encontrado = true;
                    $quantidade =  $produto['estoque'];
                    break;
                }
            }
            if ($produto_encontrado) {
                // Verificar se o produto tem promoção e ajustar o preço, se necessário
                $preco_final = $produto['preco']; // Preço padrão do produto
                if ($resultado_promocao) {
                    $preco_final = $produto['preco'] - ($produto['preco'] * ($desconto / 100)); // Preço com desconto da promoção
                }

                if (isset($_SESSION['carrinho'][$idpro])) {
                    if ($quantidade <= $_SESSION['carrinho'][$idpro]['quantidade']) {
                        echo '<script> alert("Sem mais unidades desse produto..."); </script>';
                    } else {
                        $_SESSION['carrinho'][$idpro]['quantidade']++;
                    }
                } else {
                    $_SESSION['carrinho'][$idpro] = [
                        'id' => $idpro,
                        'nome' => $produto['nome'],
                        'preco' => $preco_final, // Use o preço ajustado aqui
                        'imagem' => $produto['imagem'],
                        'quantidade' => 1
                    ];
                }
            } else {
                die('Parametro invalido');
            }
        }
        ?>
        <?php
        // Verificando se existe a chave 'add_carrinho' no array $_GET e se é um número inteiro positivo
        if (isset($_GET['add_carrinho']) && filter_var($_GET['add_carrinho'], FILTER_VALIDATE_INT) !== false && $_GET['add_carrinho'] >= 0) {
            $idpro = (int)$_GET['add_carrinho'];
            // Verificando se o produto com o id 'add_carrinho' existe no array $result
            $produto_encontrado = false;
            foreach ($result as $produto) {
                if ($produto['idproduto'] == $idpro) {
                    $produto_encontrado = true;

                    // Verificar se o produto tem uma promoção
                    $hoje = date('Y-m-d');
                    $sql_promocao = 'SELECT * FROM produto_has_promocao WHERE idProduto = :id_produto AND :hoje BETWEEN Data_Inicio AND Data_Fim';
                    $params_promocao = array(':id_produto' => $produto['idproduto'], ':hoje' => $hoje);
                    $resultado_promocao = $obj->EXE_QUERY($sql_promocao, $params_promocao);

                    if ($resultado_promocao) {
                        // Se houver promoção, ajustar o preço
                        $desconto =  $resultado_promocao[0]['desconto'];
                        $preco_final = $produto['preco'] - ($produto['preco'] * ($desconto / 100));
                    } else {
                        // Se não houver promoção, manter o preço original
                        $preco_final = $produto['preco'];
                    }

                    break;
                }
            }
            if ($produto_encontrado) {
                if (isset($_SESSION['carrinho'][$idpro])) {
                    echo '<script> alert("Erro Item ja adicionado ao carrinho"); </script>';
                } else {
                    $_SESSION['carrinho'][$idpro] = [
                        'id' => $idpro,
                        'nome' => $produto['nome'],
                        'preco' => $preco_final, // Use o preço ajustado aqui
                        'imagem' => $produto['imagem'],
                        'quantidade' => 1
                    ];
                    echo '<script> alert("O item foi adicionado ao carinho"); </script>';
                }
            } else {
                die('Parametro invalido');
            }
        }
        ?>


        <?php
        // Verificando se existe a chave 'remover' no array $_GET e se é um número inteiro positivo
        if (isset($_GET['remover']) && filter_var($_GET['remover'], FILTER_VALIDATE_INT) !== false && $_GET['remover'] >= 0) {
            $idpro = (int)$_GET['remover'];
            // Verificando se o produto com o id 'remover' existe no array $result
            $produto_encontrado = false;
            foreach ($result as $produto) {
                if ($produto['idproduto'] == $idpro) {
                    $produto_encontrado = true;
                    break;
                }
            }
            if ($produto_encontrado) {
                if (isset($_SESSION['carrinho'][$idpro])) {
                    if ($_SESSION['carrinho'][$idpro]['quantidade'] > 1) {
                        $_SESSION['carrinho'][$idpro]['quantidade']--;
                    } else {
                        unset($_SESSION['carrinho'][$idpro]); // Remove completamente o item do carrinho se a quantidade for 1
                    }
                } else {
                    echo '<script> alert("Impossivel reduzir sem antes ter"); </script>';
                }
            } else {
                die('Parametro invalido');
            }
        }
        ?>


        <?php
        // Verificando se existe a chave 'remover' no array $_GET e se é um número inteiro positivo
        if (isset($_GET['deletar_produt']) && filter_var($_GET['deletar_produt'], FILTER_VALIDATE_INT) !== false && $_GET['deletar_produt'] >= 0) {
            $idpro = (int)$_GET['deletar_produt'];
            // Verificando se o produto com o id 'remover' existe no array $result
            $produto_encontrado = false;
            foreach ($result as $produto) {
                if ($produto['idproduto'] == $idpro) {
                    $produto_encontrado = true;
                    break;
                }
            }
            if ($produto_encontrado) {
                if (isset($_SESSION['carrinho'][$idpro])) {
                    if ($_SESSION['carrinho'][$idpro]['quantidade'] >= 1) {
                        unset($_SESSION['carrinho'][$idpro]); // Remove completamente o item do carrinho se a quantidade for 1
                    }
                } else {
                    echo '<script> alert("Impossivel reduzir sem antes ter"); </script>';
                }
            } else {
                die('Parametro invalido');
            }
        }
        ?>



        <?php
        include '../payment.php';
        if (!empty($_POST)) {
            $payment = new Payment();

            //var_dump($_POST);
            $phone_number = "258" . $_POST['celular'];
            $amount = $_POST['valor'];
            $localizacao = $_POST['local_entrega'];
            $reference_id = $_POST['referencia'];
            
            $result = $payment->pay($phone_number, $amount, $reference_id);

            if ($result == 200 or $result == 201) {
                if (isset($_GET['efectuar_pagamento']) && isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
                    $obj->EXE_NON_QUERY('START TRANSACTION');

                    try {
                        // Calcula o total da compra
                        $total = 0;
                        foreach ($_SESSION['carrinho'] as $produto_carinho) {
                            $total += $produto_carinho['preco'] * $produto_carinho['quantidade'];
                        }

                        // Insere os detalhes da compra na tabela 'compra'
                        $query_compra = 'INSERT INTO compra (iduser, data, localizacao_entrega, total) VALUES (:iduser, NOW(), :localizacao_entrega, :total)';
                        $params_compra = array(
                            ':iduser' => $_SESSION['user']['id'],
                            ':localizacao_entrega' => $localizacao,
                            ':total' => $total
                        );
                        $obj->EXE_NON_QUERY($query_compra, $params_compra);

                        // Recupera o idcompra
                        $idcompra = $obj->EXE_QUERY('SELECT LAST_INSERT_ID() as idcompra')[0]['idcompra'];

                        // Insere os produtos associados à compra na tabela 'produto_has_compra'
                        $query_prod_comp = 'INSERT INTO produto_has_compra (idproduto, idcompra, quantidade) VALUES (:idproduto, :idcompra, :quantidade)';
                        foreach ($_SESSION['carrinho'] as $produto_carinho) {
                            $params_prod_comp = array(
                                ':idproduto' => $produto_carinho['id'],
                                ':idcompra' => $idcompra,
                                ':quantidade' => $produto_carinho['quantidade']
                            );
                            $obj->EXE_NON_QUERY($query_prod_comp, $params_prod_comp);

                            // Abate o estoque do produto removido
                            $query_abater_estoque = 'UPDATE produto SET estoque = estoque - :quantidade WHERE idproduto = :idproduto';
                            $params_abater_estoque = array(
                                ':quantidade' => $produto_carinho['quantidade'],
                                ':idproduto' => $produto_carinho['id']
                            );
                            $obj->EXE_NON_QUERY($query_abater_estoque, $params_abater_estoque);
                        }

                        // Limpa o carrinho após o pagamento ser efetuado
                        unset($_SESSION['carrinho']);
                    } catch (Exception $e) {
                        // Caso ocorra algum erro, desfaz as alterações e exibe uma mensagem de erro
                        echo '<script>alert("Erro ao processar pagamento dentro da atualização: ' . $e->getMessage() . '");</script>';
                    }
                }
                echo '<script> alert("Pagamento efectuado com sucesso"); </script>';
            } else {
                echo '<script> alert("Erro a  efectuar o pagamento try again :( "); </script>';
            }
        } else {
            //  echo "<p style='color: red; padding: 10px'>Nenhum dado foi enviado através do formulário!</p>";
        }
        ?>
<section class="footer">
  
  <div class="footer-box">
      <a href="" class="logo">
          <h1>Tob_Sales<sup style="font-size: 0.5rem; ">TM</sup> </h1>
      </a>
      <div class="social">
          <div class="media">
              <a href=""><i class='bx bxl-facebook' ></i></a>
              <a href=""><i class='bx bxl-instagram' ></i></a>
              <a href=""><i class='bx bxl-whatsapp' ></i></a>
          </div>

         <p style="text-align: left; text-decoration: underline; font-size: 1.1rem;"><b>Inscreva-se Newsletter</b></p>
         <p style="width: 330px; font-size: 0.8rem;">Ao se inscrever você concorda com os termos de uso e politica de privacidade.</p>
          <div class="newsletter">
              <form action="">
                  <input type="email" name="" id="" placeholder="Enter your email..." class="email-box" required>
                  <input type="submit" value="Subscribe" class="btn">
              </form> 
          </div>

        <div class="contacts">
          <h3>Contactos</h3>
          <p><b>Email</b>: suporte@tob_sales.co.mz</p> <br>
          <p><b>Contacto do suporte</b>: +258 821234567</p>
          <p>Seg-Sex: 7:00H - 21:00H</p>
          <p>Sab-Dom: 8:15H - 20:00H</p>
        </div> 
      </div>
  </div>
  <div class="footer-box">
      <h3>Pages</h3>
      <a href="#home">Pagina inicial</a>
      <a href="#featured">Destaques</a>
      <a href="#shop">Sobre</a>
      <a href="#new">Categoria</a>
      <a href="#home">Login</a>
      </div>
  <div class="footer-box">
      <h3>Legal</h3>
      <a href="#">Politica de privacidade</a>
      <a href="#">Politica de Refundo</a>
      <a href="#">Termos de uso</a>
      <a href="#">Reclamações</a>
  </div>
      

     
</section>
<!--- COpyright-->


    </div>
        <script src="../seccao_1.js"></script>
        <script src="../marcas.js"></script>

</body>

</html>