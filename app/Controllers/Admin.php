<?php namespace App\Controllers;

class Admin extends BaseController
{
    public function index(){
        helper(['form', 'url']);
        $session = session();
        $usuariomodel = model('UsuarioModel');
        $users = $usuariomodel->findAll();

        $autoresmodel = model('AutorModel');
        $autores = $autoresmodel->findAll();

        $livromodel = model('LivroModel');
        $livros = $livromodel->findAll();

        $chart = $livros;

        $pedidos = $this->calcPedidos();
        //dd($pedidos);

        $dados = [
            'users' => $users,
            'autores' => $autores,
            'livros' => $livros,
            'pedidos' => $pedidos,
            'session' => $session,
            'chart' =>$chart
        ];
        echo view('admin', $dados);

    }

    public function newPedido(){
        helper(['form', 'url']);
        $dados = $this->request->getPost();
        $validation =  \Config\Services::validation();
        
        $validation = [
            'cpf' => 'required',
            'endereco' => 'required'
        ];

        

        if(empty($dados)){
            return view('newPedido');
        }else{
            if(isset($dados['titulos'])&&isset($dados['quantidades'])){
            //dd($dados);
            if(!$this->validate($validation)){
                echo view('newPedido',[
                    'validation' => $this->validator
                ]);
                }else{
                    //dd($dados);
                    $user = $dados['cpf'];
                    $end = $dados['endereco'];

                    $pedido = [
                        'cpf_usuario' => $user,
                        'endereco' => $end
                    ];
                
                    
                    $db = \Config\Database::connect();
                    $builder = $db->table('pedidos');

                    $builder->insert($pedido);
                    $insertID = $db->insertID();
                    
                    $builder = $db->table('pedido_livro');

                    $livromodel = model('LivroModel');
                    
                    for($i=0;$i<sizeof($dados['titulos']);$i++){

                        $livro = $livromodel->find($dados["titulos"][$i]);
                        //dd($livro);
                        if($livro!=NULL){
                            $pedlivro = [
                                'id_pedido' => $insertID,
                                'id_livro' => $dados["titulos"][$i],
                                'quantidade' => $dados["quantidades"][$i]
                            ];
    
                            $builder->insert($pedlivro);
                        }                        
                    }   
                    return redirect()->to(base_url('Admin'));
                }
            }else{
                echo view('newPedido',[
                    'msg' => "O pedido deve conter ao menos um titulo e quantidade.",
                    'validation' => $this->validator
                ]);
                }
        
        
        }
    }

    public function calcPedidos(){

            $db = \Config\Database::connect();
            $builder = $db->table('pedidos');

            $builder->select('pedidos.id,pedidos.cpf_usuario,SUM(livros.preco*pedido_livro.quantidade)"Valor Total",pedidos.endereco,pedidos.data',FALSE);
            $builder->join('pedido_livro','pedido_livro.id_pedido = pedidos.id')
                    ->join('livros','pedido_livro.id_livro = livros.id');
            $builder->groupBy('pedidos.id');
            $builder->orderBy('pedidos.data');
            //$builder->where('nome',$aut['searchautor']);
            $query = $builder->get();
            $resultado = $query->getResultArray();
            $pedidos = $resultado;

        return($pedidos);
    }

    public function newAutor(){
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();
        
        $validation = [
            'nomeautor' => 'required',
            'descricaoautor' => 'required'
        ];

        $dados = $this->request->getPost();
        
        if(!empty($dados)){
            //dd($this->validate($validation));
            if(!$this->validate($validation)){
                echo view('newautor',[
                    'validation' => $this->validator
                ]);
            }else{
                //Cuidando do arquivo recebido
                $file = $this->request->getFile('imagemautor');
                
                if($file->getSize() > 0){
                    $file->move('upload/autores',$file->getRandomName());
                    /*echo '<img src="../upload/'.$file->getName().'">
                        <p>'.$dados["nomeautor"].'</p><br><p>'.$dados["descricaoautor"].'</p>';*/
                    $caminho = ('upload/autores/'.$file->getName());
                }else{
                    $caminho = ('upload/autores/hm.png');
                }
                
                $autor = [
                    'nome' => $dados['nomeautor'],
                    'descricao' => $dados['descricaoautor'],
                    'imagem' => $caminho
                ];

                $ok = $this->verificaExistencia($autor,'autores');
                //dd($ok);
                if($ok){
                    echo view('newautor');
                    echo 'Autor já cadastrado';
                }else{
                    //echo 'Vamos inserir';
                    $db = \Config\Database::connect();
                    $builder = $db->table('autores');

                    $builder->insert($autor);
                    return redirect()->to(base_url('Admin'));
                }
            
            }
            
        }else{
            return view('newautor');
        }
    }

    public function newLivro(){
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();

        $validation = [
            'titulo' => 'required',
            'descricaolivro' => 'required',
            'preco' => 'required',
            'quantidade' => 'required',
            'autorlivro' => 'required'
        ];

        $dados = $this->request->getPost();
        //dd($dados);
        if(!empty($dados)){
            //dd($this->validate($validation));
            if(!$this->validate($validation)){

                $autoresmodel = model('AutorModel');
                $autores = $autoresmodel->findAll();

                $generosmodel = model('GeneroModel');
                $generos = $generosmodel->findAll();

                echo view('newLivro',[
                    'validation' => $this->validator,
                    'autores' => $autores,
                    'generos' => $generos
                ]);
            }else{
                //Cuidando do arquivo recebido
                $file = $this->request->getFile('capalivro');
                
                if($file->getSize() > 0){
                    $file->move('upload/livros',$file->getRandomName());
                    /*echo '<img src="../upload/'.$file->getName().'">
                        <p>'.$dados["nomeautor"].'</p><br><p>'.$dados["descricaoautor"].'</p>';*/
                    $caminho = ('upload/livros/'.$file->getName());
                }else{
                    $caminho = ('upload/livros/book.svg');
                }

                $livro = [
                    'titulo' => $dados['titulo'],
                    'preco' => $dados['preco'],
                    'quantidade' => $dados['quantidade'],
                    'descricao' => $dados['descricaolivro'],
                    'imagem' => $caminho
                ];
                //dd($livro);
                $ok = $this->verificaExistencia($livro,'livros');
                //dd($ok);

                if($ok){
                    echo view('newLivro');
                    echo 'Livro já cadastrado';
                }else{
                    //echo 'Vamos inserir';
                    $db = \Config\Database::connect();                    
                    $builder = $db->table('livros');

                    $builder->insert($livro);
                    $last = $db->insertID();

                    $autorlivro = [
                        'id_autor' => $dados["autorlivro"],
                        'id_livro' => $last
                    ];
                    
                    $builder = $db->table('autores_livros');

                    $builder->insert($autorlivro);

                    for($i = 0;$i<sizeof($dados['generos']);$i++){
                        $builder = $db->table('generos');
                        $builder->select('id',false);
                        $builder->where('nome',$dados["generos"][$i]);
                        $query= $builder->get();
                        $resultado = $query->getResultArray();
                        $resultado = $resultado[0];

                        $generolivro = [
                            'id_genero' => $resultado["id"],
                            'id_livro' => $last,
                        ];

                        $builder = $db->table('genero_livro');
                        $builder->insert($generolivro);
                    }
                    
                     

                    //dd($autorlivro);

                    return redirect()->to(base_url('Admin'));
                }
               // return view('admin');
            }
            //echo 'alo';
        }else{
            $generosmodel = model('GeneroModel');
            $generos = $generosmodel->findAll();
            $autoresmodel = model('AutorModel');
            $autores = $autoresmodel->findAll();
            echo view('newLivro',['autores' => $autores,
            'generos' => $generos]);
        }
    }

    public function newUser(){
        helper(['form', 'url']);
        $validation =  \Config\Services::validation();

        $validation = [
            'cpf' => 'required|min_length[11]',
            'nome' => 'required',
            'email' => 'required|valid_email',
            'senha' => 'required'
        ];

        $dados = $this->request->getPost();
        //dd($dados);
        if(!empty($dados)){
            //dd($this->validate($validation));
            if(!$this->validate($validation)){
                echo view('newUser',[
                    'validation' => $this->validator
                ]);
            }else{
                //Cuidando do arquivo recebido
                $file = $this->request->getFile('imagem');
                
                if($file->getSize() > 0){
                    $file->move('upload/usuarios',$file->getRandomName());
                    $caminho = ('upload/usuarios/'.$file->getName());
                }else{
                    $caminho = ('upload/usuarios/padrao.png');
                }

                $user = [
                    'cpf' => $dados['cpf'],
                    'nome' => $dados['nome'],
                    'email' => $dados['email'],
                    'senha' => password_hash($dados['senha'],PASSWORD_BCRYPT),
                    'imagem' => $caminho
                ];
                //dd($livro);
                $ok = $this->verificaExistencia($user,'usuarios');
                //dd($ok);

                if($ok){
                    echo view('newUser');
                    echo 'Usuário já cadastrado';
                }else{
                    //echo 'Vamos inserir';
                    $db = \Config\Database::connect();
                    $builder = $db->table('usuarios');

                    $builder->insert($user);
                    return redirect()->to(base_url('Admin'));
                }
               // return view('admin');
            }
            //echo 'alo';
        }else{
            echo view('newUser');
        }
    }

    //-------------------------------------------------------------------------

    public function verificaExistencia($elemento,$tabela){
        //dd($elemento,$tabela);
        $db = \Config\Database::connect();
        $builder = $db->table($tabela);

        $users = 'usuarios';
        $autores = 'autores';
        $livros = 'livros';
        
        if($tabela == $users){
            $builder->select('usuarios.imagem"imagem",usuarios.nome"nome",usuarios.cpf"cpf",usuarios.email"email"',FALSE);
            $builder->where('cpf',$elemento['cpf']);
            $query = $builder->get();
            $resultado = $query->getResultArray();

        }else if($tabela == $autores){
            $builder->select('autores.imagem"imagem",autores.nome"nome",autores.descricao"descricao"',FALSE);
            $builder->where('nome',$elemento['nome']);
            $query = $builder->get();
            $resultado = $query->getResultArray();

        }else if($tabela == $livros){
            $builder->select('livros.imagem"imagem",livros.titulo"titulo",livros.descricao"descricao"',FALSE);
            $builder->where('titulo',$elemento['titulo']);
            $query = $builder->get();
            $resultado = $query->getResultArray();
        }

        //dd($resultado);
        if(empty($resultado)){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function deleteAutor(){
        $idautor = $this->request->getPost();
        //dd($idautor);
        $padrao = 'upload/autores/hm.png';
        if($idautor['deletearquivo']!=$padrao){
            if(file_exists($idautor['deletearquivo'])){
                unlink($idautor['deletearquivo']);
            }
            
        }
        //Remover primeiro na tabela autores_livros por causa dos relacionamentos 
        $db = \Config\Database::connect();
        $builder = $db->table('autores_livros');

        $builder->delete(['id_autor' => $idautor['idremover']]);
        //Depois remover em genero_autor
        $db = \Config\Database::connect();
        $builder = $db->table('genero_autor');

        $builder->delete(['id_autor' => $idautor['idremover']]);
        //Agora é possivel remover o autor da tabela
        $db = \Config\Database::connect();
        $builder = $db->table('autores');

        $builder->delete(['id' => $idautor['idremover']]);

        return redirect()->to(base_url('Admin'));
        
    }

    public function deleteLivro(){

        $idlivro = $this->request->getPost();

        $padrao = 'upload/livros/book.svg';
        if($idlivro['deletearquivo']!=$padrao){
            if(file_exists($idlivro['deletearquivo'])){
                unlink($idlivro['deletearquivo']);
            }
            
        }
        //Deletando em genero_livro
        $db = \Config\Database::connect();
        $builder = $db->table('genero_livro');

        $builder->delete(['id_livro' => $idlivro['idremover']]);
        //Deletando em pedido_livro
        $db = \Config\Database::connect();
        $builder = $db->table('pedido_livro');

        $builder->delete(['id_livro' => $idlivro['idremover']]);
        //Deletando em autores_livros
        $db = \Config\Database::connect();
        $builder = $db->table('autores_livros');

        $builder->delete(['id_livro' => $idlivro['idremover']]);
        //Deletando o livro
        $db = \Config\Database::connect();
        $builder = $db->table('livros');

        $builder->delete(['id' => $idlivro['idremover']]);

        return redirect()->to(base_url('Admin'));
    }

    public function deleteUser(){
        $iduser = $this->request->getPost();
        //dd($idautor);
        
        $padrao = 'upload/usuarios/padrao.png';
        if($iduser['deletearquivo']!=$padrao){
            if(file_exists($iduser['deletearquivo'])){
                unlink($iduser['deletearquivo']);
            }
        }
        //Remover primeiro na tabela pedido_livro por causa dos relacionamentos 

        //Pegar id do pedidos pelo cpf
        $db = \Config\Database::connect();
        $builder = $db->table('pedidos');

        $builder->where('cpf_usuario',$iduser["idremover"]);
        $query = $builder->get();
        $pedido = $query->getResultArray();
        //dd($pedido);
        if(!empty($pedido)){
            for($i=0;$i<sizeof($pedido);$i++){
                $pedidoid = $pedido[$i]['id'];

                $builder = $db->table('pedido_livro');
                $builder->delete(['id_pedido' => $pedidoid]);
            }
        }

        $builder = $db->table('pedidos');
        $builder->delete(['cpf_usuario' => $iduser["idremover"]]);

        $builder = $db->table('usuarios');
        $builder->delete(['cpf' => $iduser["idremover"]]);


        return redirect()->to(base_url('Admin'));
    }

    public function deletePedido(){
        $dados = $this->request->getPost();

        $idpedido = $dados['idpedido'];
        //dd($idpedido);
        
        $db = \Config\Database::connect();
        $builder = $db->table('pedido_livro');
        $builder->delete(['id_pedido' => $idpedido]);

        $builder = $db->table('pedidos');
        $builder->delete(['id' => $idpedido]);

        return redirect()->to(base_url('Admin'));
    }

    //------------------------------------------------------------------------

    public function editAutor(){
        $autor = $this->request->getPost();
        //dd($autor);
        $padrao = 'upload/autores/hm.png';
        $file = $this->request->getFile('imagem');

        if($file->getSize() > 0){
            if($autor['oldimagem']!=$padrao){
                if(file_exists($autor['oldimagem'])){
                    unlink($autor['oldimagem']);
                }
                
            }
            
            $file->move('upload/autores',$file->getRandomName());
                    
                    $caminho = ('upload/autores/'.$file->getName());
        }
        
        $newnome = $autor['nome'];
        $newdescricao = $autor['descricao'];
        $newimagem = $caminho;

        $newautor = [
            'nome' => $newnome,
            'descricao' => $newdescricao,
            'imagem' => $newimagem
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('autores');
        $builder->where('id',$autor["id"]);
        $builder->update($newautor);

        return redirect()->to(base_url('Admin'));
    }

    public function editUser(){
        $user = $this->request->getPost();
        //dd($autor);
        $padrao = 'upload/usuarios/padrao.png';
        $file = $this->request->getFile('imagem');

        if($file->getSize() > 0){
            if($user['oldimagem']!=$padrao){
                if(file_exists($user['oldimagem'])){
                    unlink($user['oldimagem']);
                }
                
            }
            
            $file->move('upload/usuarios',$file->getRandomName());
                    
                    $caminho = ('upload/usuarios/'.$file->getName());
        }
        
        $newnome = $user['nome'];
        $newemail = $user['email'];
        $newsenha = $user['senha'];
        $newimagem = $caminho;

        $newuser = [
            'nome' => $newnome,
            'email' => $newemail,
            'senha' => $newsenha,
            'imagem' => $newimagem
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('usuarios');
        $builder->where('cpf',$user["cpf"]);
        $builder->update($newuser);

        return redirect()->to(base_url('Admin'));
    }

    public function editLivro(){
        $livro = $this->request->getPost();
        //dd($autor);
        $padrao = 'upload/livros/book.svg';
        $file = $this->request->getFile('imagem');

        if($file->getSize() > 0){
            if($livro['oldimagem']!=$padrao){
                if(file_exists($livro['oldimagem'])){
                    unlink($livro['oldimagem']);
                }
            }
            
            $file->move('upload/livros',$file->getRandomName());
                    
            $caminho = ('upload/livros/'.$file->getName());
        }else{
            $caminho = ($livro['oldimagem']);
        }
        
        $newtitulo = $livro['titulo'];
        $newpreco = $livro['preco'];
        $newquantidade = $livro['quantidade'];
        $newdescricao = $livro['descricao'];
        $newimagem = $caminho;

        $newlivro = [
            'titulo' => $newtitulo,
            'preco' => $newpreco,
            'quantidade' => $newquantidade,
            'descricao' => $newdescricao,
            'imagem' => $newimagem
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('livros');
        $builder->where('id',$livro["id"]);
        $builder->update($newlivro);

        if(isset($livro['remover'])){
            for($i = 0;$i<sizeof($livro['remover']);$i++){
                $builder = $db->table('genero_livro');
                $builder->where('id',$livro["remover"][$i]);
                $builder->delete();
            }
        }
        
        if(isset($livro['generos'])){
            for($i = 0;$i<sizeof($livro['generos']);$i++){
                $builder = $db->table('generos');
                $builder->select('id',false);
                $builder->where('nome',$livro["generos"][$i]);
                $query= $builder->get();
                $idgen = $query->getResultArray();
                $idgen = $idgen[0];

                $builder = $db->table('genero_livro');
                //$builder->where('id',$livro["generos"][$i]);
                $newgenbook  = ['id_genero'=>$idgen,'id_livro'=>$livro["id"]];
                $builder->insert($newgenbook);
            }
        }
        

        return redirect()->to(base_url('Admin'));
    }

    public function buildForm(){

        $autores = 'autores';
        $usuarios = 'usuarios';
        $livros = 'livros';
        $pedidos = 'pedidos';

        $dados = $this->request->getPost();
        //dd($dados);

        if(($dados['nometabela'])==$autores){
            $db = \Config\Database::connect();
            $builder = $db->table($autores);

            $builder->select('autores.id,autores.nome,autores.descricao,autores.imagem',FALSE);
            $builder->where('id',$dados['idedit']);
            $query = $builder->get();
            $resultado = $query->getResultArray();
            $autor = $resultado[0];
            //dd($autor);
            echo view('editAutor',$autor);
            //dd($autor);
        }else if(($dados['nometabela'])==$usuarios){
            $db = \Config\Database::connect();
            $builder = $db->table($usuarios);

            $builder->select('usuarios.cpf,usuarios.nome,usuarios.email,usuarios.senha,usuarios.imagem',FALSE);
            $builder->where('cpf',$dados['cpfedit']);
            $query = $builder->get();
            $resultado = $query->getResultArray();
            $user = $resultado[0];
            //dd($autor);
            echo view('editUser',$user);
        }else if(($dados['nometabela'])==$livros){
            $db = \Config\Database::connect();
            $builder = $db->table($livros);

            $builder->select('livros.id,livros.titulo,livros.preco,livros.quantidade,livros.descricao,livros.imagem',FALSE);
            $builder->where('id',$dados['idedit']);
            $query = $builder->get();
            $resultado = $query->getResultArray();
            $livro = $resultado[0];

            $generosmodel = model('GeneroModel');
            $generos = $generosmodel->findAll();
            //dd($generos);

            //$genlivrosmodel = model('GenlivroModel');
            //$genlivro = $generosmodel->findAll();
            $db = \Config\Database::connect();
            $builder = $db->table('genero_livro');
            $builder->select('generos.nome,genero_livro.id',false);
            $builder->join('generos','generos.id = genero_livro.id_genero');
            $builder->where('id_livro',$dados["idedit"]);
            $query = $builder->get();
            $genbook = $query->getResultArray();
            //dd($genbook);
            echo view('editLivro',[
                'id' => $livro["id"],
                'titulo' => $livro["titulo"],
                'quantidade' => $livro["quantidade"],
                'preco' => $livro["preco"],
                'descricao' => $livro["descricao"],
                'imagem' => $livro["imagem"],
                'generos' => $generos,
                'genbook' => $genbook
            ]);
        }else if(($dados['nometabela'])==$pedidos){
            if(isset($dados['newendereco'])){
                $db = \Config\Database::connect();
                $builder = $db->table('pedidos');
                $builder->where('id',$dados["idpedido"]);
                $data = ['endereco'=>$dados["newendereco"]];
                $builder->update($data);

                $insertID = $dados["idpedido"];
                $builder = $db->table('pedido_livro');

                $livromodel = model('LivroModel');

                if(!empty($dados['titulos'])){
                    for($i=0;$i<sizeof($dados['titulos']);$i++){

                        $livro = $livromodel->find($dados["titulos"][$i]);
                        //dd($livro);
                        if($livro!=NULL){
                            $pedlivro = [
                                'id_pedido' => $insertID,
                                'id_livro' => $dados["titulos"][$i],
                                'quantidade' => $dados["quantidades"][$i]
                            ];
    
                            $builder->insert($pedlivro);
                        }                        
                    }
                }

                if(isset($dados['remover'])){
                    //dd($dados['remover'][1]);
                    
                    $db = \Config\Database::connect();
                    $builder = $db->table('pedido_livro');
                    for($i=0;$i<sizeof($dados['remover']);$i++){
                        $builder->where('id_pedido',$insertID);
                        $builder->delete(['id_livro' => ($dados["remover"][$i])]);
                    }
                    
                    

                }
                 
                //dd($dados);
            }
            
                $db = \Config\Database::connect();
                $builder = $db->table('pedidos');
                $builder->where('id',$dados["idpedido"]);
                $query = $builder->get();
                $pedido = $query->getResultArray();
                $pedido = $pedido[0];

                $builder = $db->table('pedido_livro');
                $builder->select('id,id_livro,SUM(quantidade)"quantidade"');
                $builder->where('id_pedido',$dados["idpedido"]);
                $query = $builder->get();
                $titulos = $query->getResultArray();

                $retorno = [
                    'pedido' => $pedido,
                    'titulos' => $titulos
                ];

                //dd($retorno);
                echo view('editPedido',$retorno);

        }

    }
    
    //------------------------------------------------------------------------

    public function detailPedido(){
        $dados = $this->request->getPost();
        $idpedido = $dados['idpedido'];

        $db = \Config\Database::connect();
        $builder = $db->table('pedidos');
        $builder->select('*',FALSE);
        $builder->where('id',$idpedido);
        $query = $builder->get();
        $resultado = $query->getResultArray();
        $resultado = $resultado[0];
        //dd($resultado);

        $builder = $db->table('pedido_livro');
        $builder->select('livros.id,livros.titulo,livros.preco"Preco Unitario",pedido_livro.quantidade,(livros.preco*pedido_livro.quantidade)"SubTotal"',FALSE);
        $builder->join('livros','livros.id = pedido_livro.id_livro')
                ->join('pedidos','pedidos.id = pedido_livro.id_pedido');
        $builder->where('pedido_livro.id_pedido',$idpedido);
        $query = $builder->get();
        $newresult = $query->getResultArray();
        //$newresult = $newresult[0];
        //dd($newresult);
        $total = 0;
        
        for($i=0;$i<sizeof($newresult);$i++){
            $total += $newresult[$i]['SubTotal'];
        }
        $total = number_format($total,2,".",',');
        //dd($total);
        $pedidoc = [
            'id' => $resultado['id'],
            'usuario' => $resultado['cpf_usuario'],
            'endereco' => $resultado['endereco'],
            'data' => $resultado['data'],
            'livros' => $newresult,
            'total' => $total
        ];
        //dd($pedidoc);
        echo view('detailPedido',$pedidoc);

    }
}