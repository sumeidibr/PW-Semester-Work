<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="assets/css/inicio_gestor.css">
</head>

<body>

    <main>
        <?php

            include '../gestor.php';

            $obj = new Gestor();

        $sqls = 'SELECT * FROM (
    SELECT 
        c.iduser ,
        c.primeiro_nome ,
        c.tipo_user,
        c.apelido ,
        c.email ,
        c.telefone ,
        COUNT(co.iduser) AS total_compras,
        SUM(co.total) AS total_gasto
    FROM 
        user c
    LEFT JOIN 
        compra co ON c.iduser = co.iduser
    GROUP BY 
        c.iduser, c.primeiro_nome, c.tipo_user, c.apelido, c.email,c.telefone
) AS subquery where tipo_user = "cliente"
order by total_compras desc;';

        $result = $obj->EXE_QUERY($sqls);

        $result = array_slice($result, 0, 3);


        $sql = 'SELECT * FROM (
            SELECT 
                p.nome,
                SUM(co.quantidade) AS total_compras
            FROM 
                produto p
            LEFT JOIN 
                produto_has_compra co ON p.idproduto = co.idproduto
            GROUP BY 
                p.nome
        ) AS subquery
        ORDER BY total_compras DESC;';
                $resultado_produtos = $obj->EXE_QUERY($sql);
        
                $resultado_produtos = array_slice($resultado_produtos, 0, 3);
        ?>





        <div class="faturamento">
            <div class="faturamento_diario">

            </div>
            <div class="faturamento_mensal">

            </div>

            <div class="usuarios">

            </div>

        </div>

        <div class="grafico">


            <div class="grafico_faturamento">
                <p>grafico de faturamento</p>
            </div>

            <div class="grafico_vendas">
                <p>grafico de vendas</p>
            </div>
        </div>

        <div class="relatorio">
            <div class="produtos">
                <p>Tabela de produtos mais vendidos Top 3</p>
                <div class="container_clientes_tabela">
                    <table class="border" cellspacing="2" cellpadding="7">
                        <thead>
                            <tr>
                                <th data-field="pnome">Nome Produto</th>
                                <th data-field="quantidade">Quantidade de Vendas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( $resultado_produtos as $prod) : ?>
                                <tr>
                                    <td><?php echo $prod['nome'] ?></td>
                                    <td><?php echo $prod['total_compras'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        

            <div class="clientes">
                <p>Tabela dos clientes com 3 dados, nome, numero de compras, e total gasto em compras</p>


                <div class="container_clientes_tabela">
                    <table class="border" cellspacing="2" cellpadding="7">
                        <thead>
                            <tr>
                                <th data-field="pnome">Nome</th>
                                <th data-field="quantidade">Quatidade Compras</th>
                                <th data-field="total">Total Gasto</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $user) : ?>
                                <tr>
                                    <td><?php echo $user['primeiro_nome'] ?></td>
                                    <td><?php echo $user['total_compras'] ?></td>
                                    <?php if ($user['total_compras'] == 0) { ?>
                                        <td><?php echo 0 . "  MT" ?></td>
                                    <?php } else { ?>
                                        <td><?php echo $user['total_gasto'] . "  MT" ?></td>
                                    <?php } ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </main>

    <section class="footer">

        <div class="footer-box">
            <a href="" class="logo">
                <h1>Tob_Sales<sup style="font-size: 0.5rem; ">TM</sup> </h1>
            </a>
            <div class="social">
                <div class="media">
                    <a href=""><i class='bx bxl-facebook'></i></a>
                    <a href=""><i class='bx bxl-instagram'></i></a>
                    <a href=""><i class='bx bxl-whatsapp'></i></a>
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
        <div class="footer-box">
            <h3>Sucursall</h3>
            <p>Maputo cifdade</p>
            <p>Matola</p>
            <p>Boane</p>
            <p>Xai-xai</p>
        </div>


    </section>
    <!--- COpyright-->

    <div class="copyright">
        <p style="color: #fff; font-weight: bold;"><strong style="color: #fb6547;">&#169; Tob_Sales</strong> 2024 Todos os direitos reservados</p>
    </div>
</body>

</html>