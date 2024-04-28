<?php 
    if(!isset($_SESSION['user'])){
        return;
    }
?>
<div style="background-color: blue; color:azure">
    <?php echo $_SESSION['user']?> | <a href="?p=logout"> logout</a>
</div>