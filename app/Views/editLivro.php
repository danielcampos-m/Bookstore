<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/forms.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/proprio.css">
    <title>Alterar Livro</title>
</head>
<body>
<?php include 'nav.php'; ?>
        <div class="container p-5 light shadow rounded">
        <br>
        <label for="genero">Adicionar generos ao livro:</label><br>
        <select name="genero" id="newgenero">
            <option value="" name="">-----------</option>
            <?php foreach($generos as $generos): ?>
                <option value="<?php echo ucfirst($generos['nome']);?>">
                    <?php echo $generos['nome'];?>
                </option>
            <?php endforeach; ?> 
            <option value="outros">outros</option>
        </select>
        <button id="add">Add</button><br><br>
    <table id="atable">
            <tr>
                <th>Generos</th>
            </tr>
            
    </table><br>
    <form action="<?php echo base_url('Admin/editLivro');?>" method="post" enctype="multipart/form-data" id="titles">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <img src="<?php echo base_url($imagem);?>" alt="" width="230" height="300"><br>
        <input type="hidden" name="oldimagem" value="<?php echo $imagem;?>"><br>
        <input type="file" name="imagem"><br>
        <label for="">Titulo</label>
        <input type="text" name="titulo" value="<?php echo $titulo;?>"><br>
        <label for="">Preço</label>
        <input type="number" name="preco" id="" value="<?php echo $preco;?>"><br>
        <label for="">Quantidade</label>
        <input type="number" name="quantidade" id="" value="<?php echo $quantidade;?>"><br>
        <label for="">Descrição</label>
        <input type="text" name="descricao" value="<?php echo $descricao;?>" ><br>
        <table>
        <tr>
            <th>Genero</th>
            <th>Remover</th>
        </tr>

        <?php foreach($genbook as $genbook): ?>
            <tr>
                    <td><?php echo $genbook['nome'];?></td>
                    <td><input type="checkbox" name="remover[]" id="" value="<?php echo $genbook["id"];?>"></td>
            </tr>
        <?php endforeach; ?>    
        </div>

    </table><br>
        <input type="submit" value="Editar"><br>
    </form><br>
    <a href="<?php echo base_url('Admin');?>">Voltar</a>
    <script>
        var $lista = document.querySelector('#atable');
        var $formulario = document.querySelector('#titles');
        var $gen = document.querySelector('#newgenero');
        var $botao = document.querySelector('#add');
       // var $nome = document.querySelector('#ola');

        $botao.addEventListener('click', function(){
            var item = '<tr><td>'+ $gen.value + '</td></tr>';
            $lista.innerHTML = $lista.innerHTML + item;
            
            var alo = '<input type="hidden" name="generos[]" value="'+$gen.value+'">';
            $formulario.innerHTML = $formulario.innerHTML + alo;

            $gen.value = '';
            })
    </script>
</body>
</html>