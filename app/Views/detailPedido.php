<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/forms.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/proprio.css">
    <title>Detalhes</title>
</head>
<body>
<?php include 'nav.php'; ?>

    <div class="container light p-5 shadow rounded">
        <h1>Detalhes do pedido</h1>
        <label for="">Numero do pedido: <?php echo $id;?></label><br>
        <label for="">Usuário: <?php echo $usuario;?></label><br>
        <label for="">Endereço para entrega: <?php echo $endereco;?></label><br>
        <label for="">Data e hora do pedido: <?php echo $data;?></label><br>
        <h3>Livros</h3><br>
        <table>
            <tr>
                <th>Código do Livro</th>
                <th>Título</th>
                <th>Preço Unitário</th>
                <th>Quantidade</th>
                <th>SubTotal</th>
            </tr>
            <?php foreach($livros as $livros): ?>
                <tr>
                        <td><?php echo $livros['id'];?></td>
                        <td><?php echo $livros['titulo'];?></td>
                        <td><?php echo $livros['Preco Unitario'];?></td>
                        <td><?php echo $livros['quantidade'];?></td>
                        <td><?php echo $livros['SubTotal'];?></td>
                </tr>
            <?php endforeach; ?>    
        </table>
        <span>TOTAL: </span><?php echo $total;?><br><br>
        <a href="http://localhost/bookstore/public/Admin">Voltar</a>
    </div>
    

</body>
</html>