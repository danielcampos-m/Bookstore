<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/forms.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/proprio.css">
    <title>Novo Pedido</title>
</head>
<body>
<?php include 'nav.php'; ?>
    <div class="container light p-5 shadow rounded">
    <h1>Pedido</h1>     
    <br>
    <label for="Titulos">Adicionar titulo:</label><br>
        <label for="idtitulo">Código do livro:</label><br>
        <input type="number" id="tituloid"><br>
        <label for="qtde">Quantidade:</label><br>
        <input type="number" id="quantidade" min="1" value="1"><br>
        <button id="add">Add</button><br><br>
    <table>
            <tr>
                <th>Codigo</th>
                <th>Quantidade</th>
            </tr>
            
    </table><br>
    <form action="<?php echo base_url('Admin/newPedido');?>" method="post" enctype="multipart/form-data" id="formulario">
        <label for="cpf">CPF do usuário:</label><br>
        <input type="text" name="cpf" maxlength="11"><br>
        <label for="endereco">Endereço para entrega:</label><br>
        <input type="text" name="endereco"><br>
        <div id="titles"></div>
        <input type="submit" value="Confirmar">
    </form> <br><a href="<?php echo base_url('Admin');?>">Voltar</a>
    </div> 
        
    <script>
        var $lista = document.querySelector('table');
        var $formulario = document.querySelector('#titles');
        var $titulo = document.querySelector('#tituloid');
        var $qtde = document.querySelector('#quantidade');
        var $botao = document.querySelector('#add');

        $botao.addEventListener('click', function(){
            var item = '<tr><td>'+ $titulo.value + '</td><td>'+ $qtde.value +'</td></tr>';
             $lista.innerHTML = $lista.innerHTML + item;
            var alo = '<input type="hidden" name="titulos[]" value="'+$titulo.value+'">';
            $formulario.innerHTML = $formulario.innerHTML + alo;
            var qtdade = '<input type="hidden" name="quantidades[]" value="'+$qtde.value+'">';
            $formulario.innerHTML = $formulario.innerHTML + qtdade;

            $titulo.value = '';
            $qtde.value = '1';
            })
    </script>
    <?php if(isset($validation)){echo ($validation->listErrors());} ?>
    <?php if(isset($msg)){echo $msg;} ?><br>
    <a href="http://localhost/bookstore/public/Admin">Voltar</a>
</body>
</html>
