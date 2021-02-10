<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/proprio.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="http://localhost/bookstore/bootstrap/js/bootstrap.js"></script>
    <script src="http://localhost/bookstore/bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap\js\bootstrap.js"></script>
    <title>Livro</title>
</head>
<body>
<?php include 'nav.php'; ?>
    <!--Livro destaque-->
    <div class="container d-flex justify-content-center mb-5">
        <div class="d-flex light shadow rounded">
        <img src="<?php echo $livro['imagem'];?>" width="250" height="370" class="d-block shadow rounded">
                <div class="card-body p-5">
                    <h5 class="card-title"><?php echo $livro['titulo'];?></h5>
                <span><?php echo $livro['nome'];?></span><br><br>
                <h2><?php echo $livro['preco'];?></h2><br>
                <form action="<?php echo base_url('Usuario/addcarrinho');?>" method="post">
                    <input type="hidden" name="idlivro" value="<?php echo $livro['id'];?>">
                    <label for="quantidade">Quantidade:</label><br>
                    <input type="number" name="quantidade" id="" min="1" value="1">
                    <input type="submit" value="Adicionar ao carrinho">
                </form>
                </div>
        </div>
    </div>
    <label for="outros" class="pstitle m-3">Titulos semelhantes</label>
    <div class="d-flex">
    
            <div class="container-fluid bbooks">
                <?php foreach($obras as $obras): ?>
                    <div class="container-fluid light shadow-sm rounded card clivro p-0">
                        <form action="<?php echo base_url('Livro');?>" method="post" class="d-flex">
                                <input type="image" src="<?php echo base_url($obras['imagem']);?>" alt="Submit" width="220px" height="350px" class="">
                            
                                <div class="card-body p-5">
                                <h5 class="card-title font-weight-bold"><?php echo $obras['titulo'];?></h5>
                                <p class="">by <?php echo $obras['nome'];?></p>
                                <p class="card-text parags"><?php echo $obras['descricao'];?></p>
                                <input type="hidden" name="id" value="<?php echo $obras['id'];?>">
                                </div>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
                    
        <div class="container-fluid light p-4 shadow rounded">
        <label for="Descricao" class="pstitle">Descrição</label>
        <p><?php echo $livro['descricao'];?></p>
        </div>
    </div>
    <!--Obras Semelhantes-->
    
    
</body>
</html>