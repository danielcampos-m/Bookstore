<?php
    $session = session();
    if($session->get('logado') == false){
        echo '<nav class="light d-flex flex-row bd-highlight shadow-sm mb-5 bg-white rounded"">
                <a href="'.base_url().'" class="p-5 bd-highlight mr-auto">BookStore</a>
                <a href="'.base_url().'" class="p-5 bd-highlight sublinhar">Home</a>
                <a href="'.base_url('Usuario').'" class="p-5 bd-highlight sublinhar">Log In</a>
                <a href="'.base_url('Usuario/signup').'" class="p-5 bd-highlight sublinhar">Sign Up</a>
            </nav>
        ';
    }else if($session->get('isadmin') == 0){
        $nome = $session->get('nome');
        echo '<nav class="light d-flex flex-row bd-highlight shadow-sm mb-5 bg-white rounded">
                <a href="'.base_url().'" class="p-5 bd-highlight mr-auto">BookStore</a>
                <a href="'.base_url().'" class="p-5 bd-highlight sublinhar">Home</a>
                <a href="'.base_url('Usuario/showcarrinho').'"class="p-5 bd-highlight sublinhar">Carrinho</a>
                <a href="'.base_url('Usuario/perfil').'" class="p-5 bd-highlight sublinhar">'.$nome.'</a>
                <a href="'.base_url('Usuario/logout').'" class="p-5 bd-highlight sublinhar">Log Out</a>
            </nav>
        ';
    }else if($session->get('isadmin') == 1){
        echo '<nav class="light d-flex flex-row bd-highlight shadow-sm mb-5 bg-white rounded">
                <a href="'.base_url().'" class="p-5 bd-highlight mr-auto">BookStore</a>
                <a href="'.base_url().'" class="p-5 bd-highlight sublinhar">Home</a>
                <a href="'.base_url('Admin').'" class="p-5 bd-highlight sublinhar">Controle</a>
                <a href="'.base_url('Usuario/logout').'" class="p-5 bd-highlight sublinhar">Log Out</a>
            </nav>
        ';
    }

?>