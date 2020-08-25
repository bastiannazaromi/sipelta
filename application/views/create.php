<html>

<head>
    <meta charset="utf-8" />
    <title>CI Uploads</title>
</head>

<body>
    <?php echo form_open_multipart('welcome/create') ?>

    <label for="filename">Upload File <?= $error; ?></label>
    <input type="file" name="filename" />
    <br>
    <button type="submit">Upload</button>
    <?php echo form_close() ?>
</body>

</html>