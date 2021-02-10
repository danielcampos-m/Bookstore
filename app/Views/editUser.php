<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/forms.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/proprio.css">
    <title>Alterar Senha</title>
</head>
<body>
<?php include 'nav.php'; ?>
    <div class="container light p-5 shadow rounded">
    <form action="http://localhost/bookstore/public/Admin/editUser" method="post" enctype="multipart/form-data">
        <input type="hidden" name="cpf" value="<?php echo $cpf;?>">
        <label for="">CPF:</label><br>
        <label for="id"><?php echo $cpf;?></label><br>
        <img src="<?php echo base_url($imagem);?>" alt="" width="220px" height="300px"><br>
        <input type="hidden" name="oldimagem" value="<?php echo $imagem;?>"><br>
        <input type="file" name="imagem"><br>
        <label for="">Nome:</label><br>
        <input type="text" name="nome" value="<?php echo $nome;?>"><br>
        <label for="">Email</label><br>
        <input type="email" name="email" value="<?php echo $email;?>"><br>
        <label for="">Senha</label><br>
        <input type="password" name="senha" id="" value="<?php echo $senha;?>"><br>
        <input type="submit" value="Editar">
    </form><br>
    <a href="http://localhost/bookstore/public/Admin">Voltar</a>
    </div>
</body>
</html>