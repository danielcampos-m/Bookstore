<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/forms.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/proprio.css">
    <title>Editar pedido</title>
</head>
<body> 
<?php include 'nav.php'; ?>
    <div class="container p-5 light shadow rounded">
    <div>
    <br>
    <label for="Titulos">Adicionar titulo:</label><br>
        <label for="idtitulo">Código do livro:</label><br>
        <input type="number" id="tituloid"><br>
        <label for="qtde">Quantidade:</label><br>
        <input type="number" id="quantidade" min="1" value="1"><br>
        <button id="add">Add</button><br><br>
    <table id='tab'>
            <tr>
                <th>Codigo</th>
                <th>Quantidade</th>
            </tr>
            
    </table><br>
    </div>
<form action="<?php echo base_url('Admin/buildForm');?>" method="post" id="titles">
    <h4>Detalhes do pedido</h4>
    
    <input type="hidden" name="nometabela" value="pedidos">
    <input type="hidden" name="idpedido" value="<?php echo $pedido['id'];?>">
    <label for="id">Código do pedido: </label><span><?php echo $pedido['id'];?></span><br>
    <label for="cpf">Usuário: </label><span><?php echo $pedido['cpf_usuario'];?></span><br>
    <label for="data">Data do pedido: </label><span><?php echo $pedido['data'];?></span><br>
    <label for="endereco">Endereço para entrega: </label><br>
    <input type="text" name="newendereco" value="<?php echo $pedido['endereco'];?>"><br><br>
    <table>
        <tr>
            <th>Código</th>
            <th>Quantidade</th>
            <th>Remover</th>
        </tr>
        <?php foreach($titulos as $titulos): ?>
            <tr>
                    <td><?php echo $titulos['id_livro'];?></td>
                    <td><?php echo $titulos['quantidade'];?></td>
                    <td><input type="checkbox" name="remover[]" id="" value="<?php echo $titulos['id_livro'];?>"></td>
            </tr>
         <?php endforeach; ?>    
    </table><br>
    <input type="submit" value="Alterar Pedido">
    </form><br>
    <a href="<?php echo base_url('Admin');?>">Voltar</a>
    </div>

    <script>
        var $lista = document.querySelector('#tab');
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
</body>
</html>