<?php
$file = $_FILES['file'];
?><!DOCTYPE html>
<html>
    <head>
        <title>Avatar changer</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script type="text/javascript">
<?php
$error = false;

if ($file['error'] == 1) {
    $error = 'file_size';
} elseif ($file['error']) {
    $error = 'file_error';
} elseif (!in_array(substr($file['type'], 6), array('jpeg', 'png', 'gif'))) {
    $error = 'image_type';
}

if ($error):
    ?>
                parent.AvatarChanger.error("<?php echo $error; ?>");
    <?php
else:
    ?>
                parent.AvatarChanger.dataURI("<?php echo 'data: ' . $file['type'] . ';base64,' . base64_encode(file_get_contents($file['tmp_name'])); ?>");
<?php
endif;
?>
        </script>
    </head>
    <body></body>
</html>