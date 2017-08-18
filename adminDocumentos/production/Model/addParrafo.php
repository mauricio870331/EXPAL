<?php
session_start();

if ($_POST['opc'] == 1) {
    $array = array();
    $array['cons'] = $_POST['cons'];
    $array['desc'] = $_POST['desc'];
    $array['conv'] = $_POST['conv'];
    if (isset($_POST['url'])) {
        $array['url'] = $_POST['url'];
    }
    if (isset($_POST['link'])) {
        $array['link'] = $_POST['link'];
    }
    $_SESSION['objectP'][] = $array;
    for ($i = 0; $i < count($_SESSION['objectP']); $i++) {
        ?>
        <tr>
            <td style = "vertical-align: middle"><?php echo $_SESSION['objectP'][$i]['cons']; ?></td>
            <td style = "vertical-align: middle"><?php echo $_SESSION['objectP'][$i]['desc']; ?></td>
            <td style = "vertical-align: middle"><?php echo $_SESSION['objectP'][$i]['conv']; ?></td>       
        </tr>  
        <?php
    }
} else {
    unset($_SESSION['objectP']);
}
?>


