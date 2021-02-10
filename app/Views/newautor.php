<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/forms.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/proprio.css">
    <title>Novo Autor</title>
</head>
<body>
<?php include 'nav.php'; ?>
    <div class="container light p-5 shadow rounded">
    <form action="http://localhost/bookstore/public/Admin/newAutor" method="post" enctype="multipart/form-data">
        <label for="imagemautor">Foto do autor</label><br>
        <input type="file" name="imagemautor" id=""><br>
        <label for="nomeautor">Nome do autor</label><br>
        <input type="text" name="nomeautor" id=""><br>
        <label for="descricaoautor">Descrição do autor</label><br>
        <input type="text" name="descricaoautor" id=""><br>
        <input type="submit" value="Confirmar">
    </form><br>
    <?php if(isset($validation)){echo ($validation->listErrors());} ?><br>
    <a href="http://localhost/bookstore/public/Admin">Voltar</a><br>
    </div>
</body>
</html>
