<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/forms.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/proprio.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/controle.css">
    <title>Adiministrador</title>
</head>
<body>
<!--Navegação-->
    <?php include 'nav.php';?>

<!--Controle-->

<!--Controle pedidos-->
<div class="container-fluid p-5 light">
    <label for="Pedidos">Pedidos</label>
    <a href="<?php echo base_url('Admin/newPedido');?>">Novo</a>
        <table class="table">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">USUÁRIO</th>
                <th scope="col">VALOR TOTAL</th>
                <th scope="col">ENDEREÇO</th>
                <th scope="col">DATA</th>
                <TH scope="col">#</TH>
                <TH scope="col">X</TH>
            </tr>
                <?php foreach($pedidos as $pedidos): ?>
                    <tr>
                        <td><?php echo $pedidos['id'];?></td>
                        <td><?php echo $pedidos['cpf_usuario'];?></td>
                        <td><?php echo $pedidos['Valor Total'];?></td>
                        <td><?php echo $pedidos['endereco'];?></td>
                        <td><?php echo $pedidos['data'];?></td>
                        <td><form action="<?php echo base_url('Admin/buildForm');?>" method="post">
                            <input type="hidden" name="nometabela" value="pedidos">
                            <button type="submit" value="<?php echo $pedidos['id'];?>" name="idpedido">Editar</button>
                        </form></td>
                        <td><form action="<?php echo base_url('Admin/deletePedido');?>" method="post">
                            <button type="submit" value="<?php echo $pedidos['id'];?>" name="idpedido">Deletar</button>
                        </form></td>
                        <td><form action="<?php echo base_url('Admin/detailPedido');?>" method="post">
                            <button type="submit" value="<?php echo $pedidos['id'];?>" name="idpedido">Detalhar</button>
                        </form></td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
<br>
<!--Controle usuários-->
    <div class="container-fluid p-4 light">
    <label for="Usuarios">Usuários</label>
    <a href="<?php echo base_url('Admin/newUser');?>">Novo</a>
        <table class="table">
            <tr>
                <th scope="col">FOTO</th>
                <th scope="col">CPF</th>
                <th scope="col">NOME</th>
                <th scope="col">EMAIL</th>
                <TH scope="col">#</TH>
                <TH scope="col">X</TH>
            </tr>
                <?php foreach($users as $users): ?>
                    <tr>
                        <td><?php echo $users['imagem'];?></td>
                        <td><?php echo $users['cpf'];?></td>
                        <td><?php echo $users['nome'];?></td>
                        <td><?php echo $users['email'];?></td>
                        <td><form action="<?php echo base_url('Admin/buildForm');?>" method="post">
                            <input type="hidden" name="nometabela" value="usuarios">
                            <button type="submit" value="<?php echo $users['cpf'];?>" name="cpfedit">Editar</button>
                        </form></td>
                        <td><form action="<?php echo base_url('Admin/deleteUser');?>" method="post">
                            <input type="hidden" name="deletearquivo" value="<?php echo $users['imagem'];?>">
                            <button type="submit" value="<?php echo $users['cpf'];?>" name="idremover">Delete</button>
                        </form></td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
<br>
<!--Controle Livros-->

<div class="container-fluid p-4 light">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Titulo');
    data.addColumn('number', 'Quantidade');
        data.addRows([
            
            <?php foreach($chart as $chart): ?>
                 [<?php echo "'".$chart["titulo"]."'";?>,<?php echo $chart['quantidade'];?>],
            <?php endforeach; ?>
          
          ['ok', 0]
        ]);

        // Set chart options
        var options = {'title':'Livros em estoque',
                       'width':1000,
                       'height':800};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    
<div id="chart_div" class="container"></div>

    <label for="Livros">Livros</label>
    <a href="<?php echo base_url('Admin/newLivro');?>">Novo</a>
        <table class="table w-100">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">CAPA</th>
                <th scope="col">TITULO</th>
                <th scope="col">PREÇO</th>
                <th scope="col">QUANTIDADE</th>
                <TH scope="col">#</TH>
                <TH scope="col">X</TH>
            </tr>
                <?php foreach($livros as $livros): ?>
                    
                    <tr class="">
                        <td><?php echo $livros['id'];?></td>
                        <td><?php echo $livros['imagem'];?></td>
                        <td><?php echo $livros['titulo'];?></td>
                        <td><?php echo $livros['preco'];?></td>
                        <td><?php echo $livros['quantidade'];?></td>
                        <td><form action="<?php echo base_url('Admin/buildForm');?>" method="post">
                            <input type="hidden" name="nometabela" value="livros">
                            <button type="submit" value="<?php echo $livros['id'];?>" name="idedit">Editar</button>
                        </form></td>
                        <td><form action="<?php echo base_url('Admin/deleteLivro');?>" method="post">
                            <input type="hidden" name="deletearquivo" value="<?php echo $livros['imagem'];?>">
                            <button type="submit" value="<?php echo $livros['id'];?>" name="idremover">Delete</button>
                        </form></td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
<br>
<!--Controle Autores-->
<div class="container-fluid p-5 light">
    <label for="Usuarios">Autores</label>
    <a href="<?php echo base_url('Admin/newAutor');?>">Novo</a>
        <table class="table">
            <tr>
                <th scope="col">FOTO</th>
                <th scope="col">ID</th>
                <th scope="col">NOME</th>
                <th scope="col">DESCRIÇÃO</th>
                <TH scope="col">#</TH>
                <TH scope="col">X</TH>
            </tr>
                <?php foreach($autores as $autores): ?>
                    <tr>
                        <td><?php echo $autores['imagem'];?></td>
                        <td><?php echo $autores['id'];?></td>
                        <td><?php echo $autores['nome'];?></td>
                        <td><?php echo $autores['descricao'];?></td>
                        <td><form action="<?php echo base_url('Admin/buildForm');?>" method="post">
                            <input type="hidden" name="nometabela" value="autores">
                            <button type="submit" value="<?php echo $autores['id'];?>" name="idedit">Editar</button>
                        </form></td>
                        <td><form action="<?php echo base_url('Admin/deleteAutor');?>" method="post">
                            <input type="hidden" name="deletearquivo" value="<?php echo $autores['imagem'];?>">
                            <button type="submit" value="<?php echo $autores['id'];?>" name="idremover">Delete</button>
                        </form></td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
    
</body>
</html>