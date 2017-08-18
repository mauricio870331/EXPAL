<?php
session_start();

if ($_POST['opc'] == 1) {
    $_SESSION['objectl'][] = $_POST['desc'];
    for ($i = 0; $i < count($_SESSION['objectl']); $i++) {
        ?>
        <tr>         
            <td style = "vertical-align: middle"><?php echo $_SESSION['objectl'][$i]; ?></td> 
            <td style = "vertical-align: middle">
                
            </td> 
        </tr>  
        <?php
    }
} else {
    unset($_SESSION['objectl']);
    ?>
    <tr>        
        <td style = "vertical-align: middle"></td>  
        <td style = "vertical-align: middle"></td>  

    </tr> 
    <?php
}
?>


