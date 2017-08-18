<?php
session_start();

if ($_POST['opc'] == 1) {
    $array = array();
    $array['id_titulo'] = $_POST['id_titulo'];
    $array['desc'] = $_POST['desc'];   
    $_SESSION['objectP'][] = $array;
    for ($i = 0; $i < count($_SESSION['objectP']); $i++) {
        ?>
        <tr>          
            <td style = "vertical-align: middle"><?php echo $_SESSION['objectP'][$i]['desc']; ?></td>        
        </tr>  
        <?php
    }
} else {
    unset($_SESSION['objectP']);
    ?>
    <tr>
        <td style = "vertical-align: middle"></td>     
    </tr> 
    <?php
}
?>


