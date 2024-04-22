
    <?php if(isset($_SESSION['user'])): ?>

        <h1>Area Reservada</h1>
    
    <?php else:?>
        <h2>Hello</h2>
      
         <?php   header("Location: formulario_registro.php"); ?>
    <?php endif;?>
    
    <script>
        $('#erro').delay(3000).fadeOut('slow');
    </script>
    