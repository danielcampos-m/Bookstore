<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Bookstore</title>
</head>
<body>
    <?php include 'nav.php'; ?>
    <?php if(isset($livro)):?>
    <div>
    <?php foreach($livro as $livro): ?>
        <form action="<?php echo base_url('Livro');?>" method="post">
        <input type="image" src="<?php echo base_url($livro['imagem']);?>" width="200" height="300" alt="Submit">
        <?php echo $livro['titulo'];?>
        by <?php echo $livro['nome'];?>
        <?php echo $livro['preco'];?>
        <input type="hidden" name="id" value="<?php echo $livro['id'];?>">
        </form>
    <?php endforeach; ?>
    <?php foreach($_SESSION['carrinho'] as $qtde): ?>
        <form action="<?php echo base_url('Usuario/atualizacarrinho');?>" method="post">
        <label for="quantidade">Quantidade: </label><?php echo $qtde['quantidade'];?>
        <input type="hidden" name="id" value="<?php echo $qtde['idlivro'];?>">
        <input type="submit" name="fzr" value="menos">
        <input type="submit" name="fzr" value="mais">
        <input type="submit" name="fzr" value="remover">
        </form>
    <?php endforeach; ?>
    </div>
    <div>
        
    </div>
    <?php else: ?>
    <div>
        <h1>Seu carrinho está vazio</h1>
    </div>
    <?php endif; ?>
</body>
</html>