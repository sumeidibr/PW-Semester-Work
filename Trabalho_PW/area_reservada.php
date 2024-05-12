
<?php if(isset($_SESSION['user'])): ?>

    <h1>Area Reservada</h1>

<?php else:?>
   
    <H1>Para acesssar esta area deve estar Logado...</H1>
    <h2>Faca Login ou crie uma conta</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos soluta inventore recusandae maiores exercitationem aut excepturi repellat deleniti nobis vero, eligendi accusantium, cupiditate nemo commodi reiciendis in mollitia tenetur ad.</p>

<?php endif;?>

<script>
    $('#erro').delay(3000).fadeOut('slow');
</script>
