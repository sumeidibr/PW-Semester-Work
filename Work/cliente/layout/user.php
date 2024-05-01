<?php 
    if(!isset($_SESSION['user'])){
        return;
    }
?>
<div style="background-color: blue; color:azure">
    <?php echo $_SESSION['user']['nome']?> | <a href="?p=logout"> logout</a>
</div>