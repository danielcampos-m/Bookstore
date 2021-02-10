<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/forms.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/bookstore/bootstrap/css/proprio.css">
    <title>Log In</title>
</head>
<body>
<?php include 'nav.php'; ?>
    <div class="container d-flex justify-content-center align-items-center p-5">
        <div class="d-flex light p-5 shadow rounded">
            <form action="<?php echo base_url('Usuario/login');?>" method="post" class="m-5">
                <div>
                    <h1 class="rosa">Log In</h1>
                    <label for="email">Email:</label><br>
                    <input type="email" name="email" id=""><br>
                    <label for="senha">Senha:</label><br>
                    <input type="password" name="senha" id=""><br>
                    <?php echo $session->getFlashdata('erro');?>
                </div>
                <input type="submit" value="Entrar">
            </form>
        </div>
        
    </div>
    
</body>
</html>