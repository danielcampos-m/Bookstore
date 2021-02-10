<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/forms.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/proprio.css">
    <title>Alterar Autor</title>
</head>
<body>
<?php include 'nav.php'; ?>
    <div class="container light shadow rounded p-5">
    <form action="http://localhost/bookstore/public/Admin/editAutor" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <h1>Editar autor</h1>
        <img src="<?php echo base_url($imagem);?>" alt="" width="250px" height="350px"><br>
        <input type="hidden" name="oldimagem" value="<?php echo $imagem;?>"><br>
        <input type="file" name="imagem"><br>
        <label for="">Nome</label><br>
        <input type="text" name="nome" value="<?php echo $nome;?>"><br>
        <label for="">Descrição</label><br>
        <input type="text" name="descricao" value="<?php echo $descricao;?>" ><br>
        <input type="submit" value="Editar">
    </form><br>
    <a href="http://localhost/bookstore/public/Admin">Voltar</a>
    </div>
</body>
</html>