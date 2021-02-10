<?php namespace App\Controllers;

class Livro extends BaseController
{
    public function index(){
        $livroclic = $this->request->getPost();
        $session = session();
        //$livromodel = model('LivroModel');
        $livro = $this->findlivro($livroclic["id"]);
        
        $generos = $this->findgenero($livroclic["id"]);
        
        $obras = $this->getObrasByGenero($generos);

        echo view('livro',[
            'session' => $session,
            'livro' => $livro,
            'obras' => $obras
        ]);
        //dd($livro);
    }

    public function findlivro($id){

        $db = \Config\Database::connect();
		$builder = $db->table('livros');

        $builder->select('livros.id,livros.titulo,livros.quantidade,livros.preco,livros.descricao,livros.imagem,autores.nome',FALSE);
        $builder->join('autores_livros', 'autores_livros.id_livro = livros.id')
				->join('autores', 'autores.id = autores_livros.id_autor');
        $builder->where('livros.id',$id);
		$query = $builder->get();
        $livro = $query->getResultArray();
        //dd($livro);


        return($livro[0]);
    }

    public function findgenero($id){
        $db = \Config\Database::connect();
		$builder = $db->table('generos');

        $builder->select('generos.id"genero"',FALSE);
        $builder->join('genero_livro', 'genero_livro.id_genero = generos.id');
        $builder->where('genero_livro.id_livro',$id);
		$query = $builder->get();
        $generos = $query->getResultArray();

        return($generos);
    }

    public function getObrasByGenero($generos){
        //dd($generos);
        
        $db = \Config\Database::connect();
        //$builder = $db->table('livros');
        

            $aki = '';

            for($i=0;$i<sizeof($generos);$i++){
                if($i==0){
                    $aki = $aki.$generos[$i]["genero"];
                }else{
                    $aki = $aki.','.$generos[$i]["genero"];
                }
            }
            //dd($aki);
            $sql = 'Select livros.id,livros.titulo,livros.quantidade,livros.preco,livros.descricao,livros.imagem,autores.nome
            from livros 
            inner join genero_livro on livros.id = genero_livro.id_livro
            inner join autores_livros on livros.id = autores_livros.id_livro
            inner join autores on autores_livros.id_autor = autores.id
            where genero_livro.id_genero in ('.$aki.') group by livros.id';
            $query = $db->query($sql);

            $result = $query->getResultArray();
            //$resultado = array_unique($result);

            return($result);

    }
}