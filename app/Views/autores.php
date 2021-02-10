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
    <title>Autor</title>
</head>
<body>
        <!--Navegação-->
        <?php include 'nav.php'; ?>

        <!--Autor Destaque-->
        <div class="container d-flex align-items-center justify-content-center">
                <div class="d-flex mb-5">
                <img src="<?php echo base_url($destaque['imagem']);?>" alt="autor" class="d-block shadow rounded" width="250px" height="350px">
                <div class="card-body p-5">
                    <h5 class="card-title"><?php echo $destaque['nome'];?></h5>
                    <p><?php echo $destaque['generos'];?></p>
                    <p class="format"><?php echo $destaque['descricao'];?></p>
                </div>
            </div>
        </div>

        <!--Menu autores-->
        <div class="d-flex">
            <div class="d-none container-fluid d-md-block w-25">
                <label for="Autores" class="pstitle">Outros Autores</label>
            <form action="http://localhost/bookstore/public/Autor/index" method="post">
                    <input type="text" name="searchautor" id="" placeholder="Procure um autor">
                    <input type="hidden" name="nomeautor" value="<?php echo $destaque['nome'];?>">
                    <input type="submit" value="Procurar">

            </form>
            
                <table>
                    <tr>
                        <th>imagem</th>
                        <th>nome</th>
                    </tr>
                        <?php foreach($autores as $autores): ?>
                            <tr>
                                <form action="http://localhost/bookstore/public/Autor/index" method="post">
                                    <td><input type="image" src="<?php echo base_url($autores['imagem']);?>" alt="Submit" class="perfs"></td>
                                    <td><?php echo $autores['nome'];?></td>
                                    <input type="hidden" name="nomeautor" value="<?php echo $autores['nome'];?>">
                                </form>
                            </tr>
                        <?php endforeach; ?>
                </table><br>
                                </div>
        
        <!--Principais Obras-->
           
            <div class="container-fluid gbooks">
            
            <?php foreach($obras as $obras): ?>
                <div class="container-fluid card clivro p-0 fundo border-0">
                    <form action="<?php echo base_url('Livro');?>" method="post" class="d-flex light shadow ronded">
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
        </div>
            </div>
</body>
</html>