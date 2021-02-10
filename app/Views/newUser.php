<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/forms.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/proprio.css">
    <title>Novo Livro</title>
</head>
<body>
<?php include 'nav.php'; ?>
    <div class="container light shadow rounded p-5">
    <?php if(isset($validation)){echo ($validation->listErrors());} ?>
    <form action="http://localhost/bookstore/public/Admin/newUser" method="post" enctype="multipart/form-data">
        <label for="imagem">Foto</label><br>
        <input type="file" name="imagem" id=""><br>
        <label for="cpf">CPF</label><br>
        <input type="text" name="cpf" id="" max="13"><br>
        <label for="nome">Nome</label><br>
        <input type="text" name="nome" id=""><br>
        <label for="email">Email</label><br>
        <input type="email" name="email" id=""><br>
        <label for="senha">Senha</label><br>
        <input type="password" name="senha" id=""><br>
        <input type="submit" value="Confirmar">
    </form><br>
    <a href="http://localhost/bookstore/public/Admin">Voltar</a>
    </div>
</body>
</html>
