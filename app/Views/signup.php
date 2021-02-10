<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/forms.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/proprio.css">
    <title>Inscrever-se Bookstore</title>
</head>
<body>
<?php include 'nav.php'; ?>
    <div class="container d-flex light p-5 shadow rounded">
    <form action="<?php echo base_url('Usuario/cadastro');?>" method="post" enctype="multipart/form-data">
        <label for="foto">Coloque uma foto:</label><br>
        <input type="file" name="foto" id=""><br>
        <label for="Email">Email:</label><br>
        <input type="email" name="email" id=""><br>
        <label for="Confirmar email">Confirmar email:</label><br>
        <input type="email" name="confemail" id=""><br>
        <label for="Senha">Senha:</label><br>
        <input type="password" name="senha" id=""><br>
        <label for="Confirmar senha">Confirmar senha:</label><br>
        <input type="password" name="confsenha" id=""><br>
        <label for="cpf">CPF:</label><br>
        <input type="text" name="cpf" id="" maxlength="11"><br>
        <label for="Nome">Como devemos te chamar?</label><br>
        <input type="text" name="nome" id="" placeholder="nome"><br><br>
        <?php if(isset($validation)){echo ($validation->listErrors());} ?>
        <input type="submit" value="Cadastrar">
    </form>
    </div>
</body>
</html>