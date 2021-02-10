<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/forms.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/proprio.css">
    <title>Novo Livro</title>
    
</head>
<body>
<?php include 'nav.php'; ?>
    <div class="container light p-5 shadow rounded">
    <?php if(isset($validation)){echo ($validation->listErrors());} ?>
    <br>   
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
    <table>
            <tr>
                <th>Generos</th>
            </tr>
            
    </table><br>
    <form action="<?php echo base_url('Admin/newLivro');?>" method="post" enctype="multipart/form-data" id='titles'>
        <label for="capalivro">Capa do livro</label><br>
        <input type="file" name="capalivro" id=""><br>
        <label for="titulo">Titulo</label><br>
        <input type="text" name="titulo" id=""><br>
        <label for="descricaolivro">Descrição do livro</label><br>
        <input type="text" name="descricaolivro" id=""><br>
        <label for="autorlivro">Autor</label><br>
        <select name="autorlivro" id="">
            <option value="">Selecione um autor </option>
            <?php foreach($autores as $autores): ?>
                <option value="<?php echo $autores['id'];?>">
                        <?php echo $autores['nome'];?>
                </option>
            <?php endforeach; ?>  
        </select><br>
        <label for="preco">Preço</label><br>
        <input type="number" name="preco" id="" step="0.1"><br>
        <label for="quantidade">Quantidade</label><br>
        <input type="number" name="quantidade" id=""><br>
        <input type="submit" value="Confirmar">
    </form><br>
    <a href="<?php echo base_url('Admin');?>">Voltar</a>
    </div>

    
    <script>
        var $lista = document.querySelector('table');
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

    <a href="<?php echo base_url('Admin');?>">Voltar</a>
</body>
</html>
