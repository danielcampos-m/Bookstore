<?php namespace App\Controllers;

class Autor extends BaseController
{
    public function index(){
        $session = session();
        $aut = $this->request->getPost();
        //Lista do menu autores
        if(isset($aut['searchautor'])){
            $db = \Config\Database::connect();
            $builder = $db->table('autores');

            $builder->select('imagem"imagem",nome"nome"',FALSE);
            $builder->where('nome',$aut['searchautor']);
            $query = $builder->get();
            $resultado = $query->getResultArray();
            $autores = $resultado;
        }else{
            $autoresmodel = model('AutorModel');
            $autores = $autoresmodel->findAll();
        }
        
        //Exibindo autor selecionado
        $autordestaque = $this->findAutor($aut['nomeautor']);
        //dd($autordestaque);
        //Coletando principais obras
        $obras = $this->findObras($aut['nomeautor']);
        //dd($obras);
        $dados = [
            'autores' => $autores,
            'destaque' => $autordestaque,
            'obras' => $obras,
            'session' => $session
        ];
        echo view('autores',$dados);
    }

    //Função que recebe nome do autor e retorna array com dados principais para autor destaque
    public function findAutor($nome){

        $nomme = strtoupper($nome);

        $db = \Config\Database::connect();
		$builder = $db->table('autores');

        $builder->select('autores.imagem"imagem",autores.nome"nome",autores.descricao"descricao"',FALSE);
		$builder->where('nome',$nome);
		$query = $builder->get();
        $autor = $query->getResultArray();
        //dd($autor);
        $autor = $autor[0];

        $builder = $db->table('generos');
        $builder->select('generos.nome',FALSE);
        $builder->join('genero_autor', 'genero_autor.id_genero = generos.id')
                ->join('autores','autores.id = genero_autor.id_autor');
		$builder->where('autores.nome',$nomme);
		$query = $builder->get();
        $generos = $query->getResultArray();
        $resu = '';

        //laço para percorrer os arrays com nomes dos generos
        for($i=0;$i<sizeof($generos);$i++){
            $resu = $generos[$i]['nome']." ".$resu;
            
        }

        $dadosautor =[
            'imagem' => $autor['imagem'],
            'nome' => $autor['nome'],
            'generos' => $resu,
            'descricao' => $autor['descricao']  
        ];
        return($dadosautor);
    }


    //Função recebe o nome de um autor e retorna principais obras por ordem de maior numero de pedidos
    public function findObras($nome){
        
        $db = \Config\Database::connect();
        $builder = $db->table('livros');
        $builder->select('livros.id,livros.imagem,livros.titulo,autores.nome,livros.descricao',FALSE);
        $builder->join('autores_livros','autores_livros.id_livro = livros.id')
                ->join('autores','autores.id = autores_livros.id_autor');
        $builder->where('autores.nome',$nome);
        $builder->groupBy('livros.titulo');

        $query=$builder->get();
        $resultado = $query->getResultArray();
        //dd($resultado);
        return($resultado);

    }
}