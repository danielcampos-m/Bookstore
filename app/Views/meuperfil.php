<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu perfil - Bookstore</title>
</head>
<body>
<?php include 'nav.php'; ?>
    <img src="<?php echo base_url($imagem);?>" width="230" height="300"><br>
    <label for="cpf">CPF:</label><br>
    <span><?php echo $cpf;?></span><br>
    <label for="cpf">Nome:</label><br>
    <span><?php echo $nome;?></span><br>
    <label for="cpf">Email:</label><br>
    <span><?php echo $email;?></span>
    <br><br>
    <h3>Alterar dados cadastrais</h3>
    <p>Obs: Após alterar os dados é necessário realizar novamente o Log In.</p><br>
    <?php echo $session->getFlashdata('erro');?><br>
    <form action="<?php echo base_url('Usuario/newfoto');?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="oldfoto" value="<?php echo base_url($imagem);?>">
        <label for="Title">Alterar Foto</label><br><br>
        <input type="file" name="newfoto"  id=""><br><br>
        <input type="submit" value="Alterar"><br>
    </form><br>
    <form action="<?php echo base_url('Usuario/newEmail');?>" method="post">
        <label for="Title">Alterar Email</label><br>
        <label for="newemail">Novo email:</label><br>
        <input type="email" name="newemail" id="">
        <br>
        <label for="Confirmar">Confirmar novo email:</label><br>
        <input type="email" name="confnewemail" id=""><br>
        <input type="submit" value="Alterar">
    </form>
<br>
    <form action="<?php echo base_url('Usuario/newSenha');?>" method="post">
        <label for="Title">Alterar senha</label><br>
        <label for="">Senha atual:</label><br>
        <input type="password" name="oldsenha" id="">
        <br>
        <label for="">Nova senha:</label><br>
        <input type="password" name="newsenha" id=""><br>
        <label for="Confirmar">Confirmar nova senha:</label><br>
        <input type="password" name="confnewsenha" id=""><br>
        <input type="submit" value="Alterar">
    </form>
</body>
</html>