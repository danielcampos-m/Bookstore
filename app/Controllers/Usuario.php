<?php namespace App\Controllers;

class Usuario extends BaseController
{
    public function index(){
        $session = session();
        echo view('login',[
            'session' => $session
        ]);
    }

    public function login(){
        $modelUsuario = model('UsuarioModel');
        $session = session();

        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('senha');

        $dadosuser = $modelUsuario->getDadosByEmail($email);
                
        //VALIDANDO DADOS INSERIDOS 
        if($dadosuser!=false){
            //VALIDANDO SENHA INSERIDA
            $hash = $dadosuser['senha'];
            if(password_verify($pass,$hash)){
                //INICIANDO SESSÃO DO USUÁRIO
            

                $dados = [
                    'logado' => true,
                    'cpf' => $dadosuser["cpf"],
                    'nome' => $dadosuser["nome"],
                    'email' => $dadosuser["email"],
                    'isadmin' => $dadosuser["isadmin"],
                    'carrinho' => []
                ];
                
                $session->set($dados);
                //dd($dados);
                return redirect()->to(base_url());
            }else{
                //SENHA INCORRETA
                $session->setFlashdata('erro','Usuário ou senha incorretos');
                return redirect()->to(base_url('Usuario'));
            }
        }else{
            //DADOS INCORRETOS
            $session->setFlashdata('erro','Usuário ou senha incorretos');
            return redirect()->to(base_url('Usuario'));
        }
    }
    
    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url());
    }

    public function signup(){
        echo view('signup');
    }

    public function cadastro(){
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();
        
        $validation = [
            'email' => 'is_unique[usuarios.email]|valid_email|required',
            'confemail' => 'matches[email]|required',
            'senha' => 'min_length[6]|required',
            'confsenha' => 'matches[senha]|required',
            'cpf' => 'exact_length[11]|required'
        ];

        if(!$this->validate($validation)){
            echo view('signup',[
                'validation' => $this->validator
            ]);
        }else{
            $dados = $this->request->getPost();
        
                //Cuidando do arquivo recebido
            $file = $this->request->getFile('foto');
            
            if($file!=null){
                $file->move('upload/usuarios',$file->getRandomName());
                $caminho = ('upload/usuarios/'.$file->getName());
            }else{
                $caminho = ('upload/usuarios/padrao.png');
            }

            $user = [
                'cpf' => $dados["cpf"],
                'nome' => $dados["nome"],
                'email' => $dados["email"],
                'senha' => password_hash($dados['senha'],PASSWORD_BCRYPT),
                'imagem' => $caminho
            ];

            $db = \Config\Database::connect();
            $builder = $db->table('usuarios');

            $builder->insert($user);
            //dd($user);
            return redirect()->to(base_url('Usuario'));
        }
    }

    public function perfil(){
        $session = session();
        $modelUsuario = model('UsuarioModel');
        $dadosuser = $modelUsuario->getDadosByEmail($session->get('email'));

        echo view('meuperfil',$dadosuser);
    }

    public function newEmail(){
        $newemail = $this->request->getPost('newemail');
        $session = session();
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();
        
        $validation = [
            'newemail' => 'is_unique[usuarios.email]|valid_email|required',
            'confnewemail' => 'matches[newemail]|required'
        ];
        
        if(!$this->validate($validation)){

            $session->setFlashdata('erro','Preencha o email corretamente');
            return redirect()->to(base_url('Usuario/perfil'));
        }else{
            $dados = [
                'email' => $newemail
            ];
            $db = \Config\Database::connect();
            $builder = $db->table('usuarios');
            $builder->where('cpf',$session->get("cpf"));
            $builder->update($dados);

            return redirect()->to(base_url('Usuario/logout'));
        }
    }

    public function newSenha(){
        $newsenha= $this->request->getPost('newsenha');
        $session = session();
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();
        
        $validation = [
            'oldsenha' => 'required',
            'newsenha' => 'min_length[6]|required',
            'confnewsenha' => 'matches[newsenha]|required'
        ];
        
        if(!$this->validate($validation)){

            $session->setFlashdata('erro','Preencha a senha corretamente');
            return redirect()->to(base_url('Usuario/perfil'));
        }else{
            $dados = [
                'senha' => password_hash($newsenha,PASSWORD_BCRYPT)
            ];
            $db = \Config\Database::connect();
            $builder = $db->table('usuarios');
            $builder->where('cpf',$session->get("cpf"));
            $builder->update($dados);

            return redirect()->to(base_url('Usuario/logout'));
        }
    }

    public function newfoto(){
        $session = session();
        $file = $this->request->getFile('newfoto');
        $old = $this->request->getPost('oldfoto');
        $padrao = 'upload/usuarios/padrao.png';
        //dd($file);
        if($file!=null){
            if($old!=$padrao){
                if(file_exists($old)){
                    unlink($old);
                }                
            }
            
            $file->move('upload/usuarios',$file->getRandomName());
                    
            $caminho = ('upload/usuarios/'.$file->getName());


            $dados = [
                'imagem' => $caminho
            ];

            $db = \Config\Database::connect();
            $builder = $db->table('usuarios');
            $builder->where('cpf',$session->get("cpf"));
            $builder->update($dados);

            return redirect()->to(base_url('Usuario/perfil'));
        }
        echo "alo";
    }

    public function addcarrinho(){
        $session = session();        
        $dados = $this->request->getPost();
        //$med = $session->get('carrinho');
        $ok = false;
        if(!empty($_SESSION['carrinho'])){
            for($i=0;$i<sizeof($_SESSION['carrinho']);$i++){
                if($_SESSION['carrinho'][$i]['idlivro'] == $dados['idlivro']){
                    $_SESSION['carrinho'][$i]['quantidade'] = $_SESSION['carrinho'][$i]['quantidade'] + $dados['quantidade'];
                    $ok = true;
                }
            }
            if($ok == false){
                $produto = [$dados];
                $session->push('carrinho',$produto);
            }
        }else{
            $produto = [$dados];
            $session->push('carrinho',$produto);
        }
        //dd($session->get());
        
        return redirect()->to(base_url('Usuario/showcarrinho'));

    }

    public function showcarrinho(){
        $session = session();

        if(!empty($_SESSION['carrinho'])){
            $tamcar = sizeof($session->get('carrinho'));

        $db = \Config\Database::connect();

            $mee = [];
            for($i=0;$i<$tamcar;$i++){
                $mee[$i] = $_SESSION['carrinho'][$i]["idlivro"];
                
            }
            $mee = array_unique($mee);
            $aki = '';

            for($i=0;$i<sizeof($mee);$i++){
                if($i==0){
                    $aki = $aki.($mee[$i]);
                }else{
                    $aki = $aki.','.$mee[$i];
                }
            }
            //array_unique($aki);
            //dd($aki);
            
            $sql = 'Select livros.id,livros.titulo,livros.preco,livros.imagem,autores.nome
            from livros
            inner join autores_livros on livros.id = autores_livros.id_livro
            inner join autores on autores_livros.id_autor = autores.id
            where livros.id in ('.$aki.') group by livros.id';
            $query = $db->query($sql);

            $result = $query->getResultArray();



            echo view('carrinho',[
                'livro' => $result,
            ]);
            //dd($result);
        }else{
            echo view('carrinho');
        }
        
    }

    public function atualizacarrinho(){
        $dados = $this->request->getPost();
        $session = session();
        //dd($dados);
        if($dados['fzr']=='menos'){
            for($i=0;$i<sizeof($_SESSION['carrinho']);$i++){
                if($_SESSION['carrinho'][$i]['idlivro'] == $dados['id']){
                    $_SESSION['carrinho'][$i]['quantidade'] = ($_SESSION['carrinho'][$i]['quantidade'] - 1);
                }
            }
           
        }else if($dados['fzr']=='mais'){
            for($i=0;$i<sizeof($_SESSION['carrinho']);$i++){
                if($_SESSION['carrinho'][$i]['idlivro'] == $dados['id']){
                    $_SESSION['carrinho'][$i]['quantidade'] = ($_SESSION['carrinho'][$i]['quantidade'] + 1);
                }
            }
            
        }else if($dados['fzr']=='remover'){
            for($i=0;$i<sizeof($_SESSION['carrinho']);$i++){
                if($_SESSION['carrinho'][$i]['idlivro'] == $dados['id']){
                
                    unset($_SESSION['carrinho'][$i]);
                    //dd($_SESSION['carrinho']);
                }
            }
            
            $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
            
        }
        return redirect()->to(base_url('Usuario/showcarrinho'));
    }
}