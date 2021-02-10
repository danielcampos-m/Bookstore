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
    <script src="http://localhost/bookstore/bootstrap/js/bootstrap.js"></script>
    <title>Home</title>
</head>
<body class="basic">
    <?php include 'nav.php'; ?>
    <!--Carousel-->
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        <div class="container w-100 cfirst d-flex justify-content-center align-items-center">
            <div class="d-flex">
            <img class="d-block shadow rounded" src="<?php echo base_url();?>\upload\livros\a8b9ff74ed0f3efd97e09a7a0447f892.jpg" alt="First slide" width="220px" height="350px">
            <div class="card-body p-5">
                <h5 class="card-title">Ten Thousand Skies Above You</h5>
                <p>by Claudia Grey</p>
                <p class="parags format">In this sequel to A Thousand Pieces of You by New York Times bestselling author Claudia Gray, Marguerite races through various dimensions to save the boy she loves.Ever since she used the Firebird, her parents' invention, to cross through to alternate dimensions.</p>
                <input type="submit" value="Veja o livro" class="booksee">
            </div>
            </div>
        </div>
    </div>
    <div class="carousel-item">
    <div class="container w-100 csec d-flex justify-content-center align-items-center">
            <div class="d-flex">
            <img class="d-block shadow rounded" src="<?php echo base_url();?>\upload\livros\10.jpg" alt="First slide" width="220px" height="350px">
            <div class="card-body p-5">
                <h5 class="card-title">A Tale for the Time Being</h5>
                <p>by Ruth Ozeki</p>
                <p class="parags format">A Tale for the Being Being é um romance metaficcional de Ruth Ozeki narrado por dois personagens, uma japonesa japonesa de dezesseis anos em Tóquio que mantém um diário e uma escritora nipo-americana.</p>
                <input type="submit" value="Veja o livro" class="booksee">
            </div>
            </div>
        </div>
    </div>
    <div class="carousel-item">
    <div class="container w-100 cter d-flex justify-content-center align-items-center">
            <div class="d-flex">
            <img class="d-block shadow rounded" src="<?php echo base_url();?>\upload\livros\1595428257_c55f1e5e2352bda548a6.jpg" alt="First slide" width="220px" height="350px">
            <div class="card-body p-5">
                <h5 class="card-title">Dominicana</h5>
                <p>by Angie Cruz</p>
                <p class="parags format">Fifteen-year-old Ana Cancion never dreamed of moving to America, the way the girls she grew up with in the Dominican countryside did. But when Juan Ruiz proposes and promises to take her to New York City, she has to say yes.</p>
                <input type="submit" value="Veja o livro" class="booksee">
            </div>
            </div>
        </div>
    </div>
  </div>
</div>
    <!-- Autores-->
    <div class="d-flex alo">
        <div class="d-none container-fluid d-md-block w-25 mt-4">
            <label for="Autores" class="pstitle">Autores</label>
            <form action="http://localhost/bookstore/public/Home/autores" method="post">
                    <input type="text" name="searchautor" id="" placeholder="Procure um autor">
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
    

        <!-- Menu de generos para ordenação -->
        <div class="container-fluid">
        <div class="menugen mb-3"> 
                <form action="http://localhost/bookstore/public/Home/generos" method="post" class="d-flex flex-row bd-highlight p-4">
                    <label for="genero" class="p-1 bd-highlight mr-auto pstitle">Generos</label>
                    <input type="submit" value="Ficcao" name="genero" class="p-1 bd-highlight">
                    <input type="submit" value="Quadrinhos" name="genero" class="p-1 bd-highlight">
                    <input type="submit" value="Romance" name="genero" class="p-1 bd-highlight">
                    <input type="submit" value="Terror" name="genero" class="p-1 bd-highlight">
                    <input type="submit" value="Aventura" name="genero" class="p-1 bd-highlight">
                    <input type="submit" value="Fantasia" name="genero" class="p-1 bd-highlight">
                    <input type="submit" value="Outros" name="genero" class="p-1 bd-highlight">
                </form>
        </div>
        <!--
        <form action="http://localhost/bookstore/public/Home/titulos" method="post">
            <input type="text" name="search" id="" placeholder="Procure um título">
            <input type="submit" value="Procurar">
        </form>-->
        
        
        
        <!-- Livros e ordenação de livros -->
        <div class="container-fluid gbooks">
            <?php foreach($livros as $livros): ?>
                <div class="container-fluid fundo card clivro p-0 border-0">
                    <form action="<?php echo base_url('Livro');?>" method="post" class="d-flex light shadow rounded">
                            <input type="image" src="<?php echo base_url($livros['imagem']);?>" alt="Submit" width="220px" height="350px" class="">
                        
                            <div class="card-body p-5">
                            <h5 class="card-title font-weight-bold"><?php echo $livros['titulo'];?></h5>
                            <p class="">by <?php echo $livros['autor'];?></p>
                            <p class="card-text parags"><?php echo $livros['descricao'];?></p>
                            <input type="hidden" name="id" value="<?php echo $livros['id'];?>">
                            </div>
                    </form>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>