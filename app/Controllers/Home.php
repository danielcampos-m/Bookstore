<?php namespace App\Controllers;

class Home extends BaseController
{	

	public function index()
	{
		//Construção consulta dos livros
		$resultado = $this->livros();
		$session = session();
		$autoresmodel = model('AutorModel');
		$autores = $autoresmodel->findAll();
		
		$livros = $resultado;
		//dd($resultado);
		

		
		echo view('home',[
			'autores' => $autores,
			'livros' => $livros,
			'session' => $session
		]);
	}

	public function livros(){
		$db = \Config\Database::connect();
		$builder = $db->table('livros');

		$builder->select('livros.id,livros.imagem"imagem", livros.titulo"titulo",autores.nome"autor", livros.descricao"descricao"', FALSE);
		$builder->join('autores_livros', 'autores_livros.id_livro = livros.id')
				->join('autores', 'autores.id = autores_livros.id_autor');

		//$builder->where('generos.nome',$genero);
		$query = $builder->get();
		$resultado = $query->getResultArray();
		//dd($query);
		return ($resultado);
	}

	public function generos(){
		//Receber resultado do menu de generos
		$gen = $this->request->getPost();
		$genero = strtoupper($gen['genero']);
		//dd($genero);

		//Construção da consulta por genero
		$db = \Config\Database::connect();
		$builder = $db->table('livros');

		$builder->select('livros.id,livros.imagem"imagem", livros.titulo"titulo", autores.nome"autor", livros.descricao"descricao"', FALSE);
		$builder->join('genero_livro', 'genero_livro.id_livro = livros.id')
				->join('generos', 'generos.id = genero_livro.id_genero')
				->join('autores_livros', 'autores_livros.id_livro = livros.id')
				->join('autores', 'autores.id = autores_livros.id_autor');

		$builder->where('generos.nome',$genero);
		$query = $builder->get();
		$resultado = $query->getResultArray();
		//dd($resultado);
		
		//Autores mostrados por padrão
		$autoresmodel = model('AutorModel');
		$autores = $autoresmodel->findAll();

		//Variaveis setadas para compatibilidade no reaproveitamento de Home
		$livros = $resultado;
		$session = session();
		$dados = [
			'autores' => $autores,
			'livros' => $livros,
			'session' => $session
		];

		echo view('home',$dados);
	}

	public function titulos(){
		$titulo = $this->request->getPost();

		$db = \Config\Database::connect();
		$builder = $db->table('livros');

		$builder->select('livros.imagem"imagem", livros.titulo"titulo", autores.nome"autor", livros.descricao"descricao"', FALSE);
		$builder->join('autores_livros', 'autores_livros.id_livro = livros.id')
				->join('autores', 'autores.id = autores_livros.id_autor');

		$builder->where('livros.titulo',$titulo);
		$query = $builder->get();
		$livros = $query->getResultArray();
		//dd($resultado);

		$autoresmodel = model('AutorModel');
		$autores = $autoresmodel->findAll();
		$session = session();
		$dados = [
			'autores' => $autores,
			'livros' => $livros,
			'session' => $session
		];

		echo view('home',$dados);
	}

	public function autores(){
		$autor = $this->request->getPost();
		//dd($autor);
		$db = \Config\Database::connect();
		$builder = $db->table('autores');

		$builder->select('imagem"imagem",nome"nome"',FALSE);
		$builder->where('nome',$autor['searchautor']);
		$query = $builder->get();
		$resultado = $query->getResultArray();
		$autores = $resultado;

		$livros = $this->livros();
		//dd($resultado);
		$session = session();
		$dados = [
			'autores' => $autores,
			'livros' => $livros,
			'session' => $session
		];
		//dd($resultado);
		echo view('home',$dados);
	}

	//--------------------------------------------------------------------

}
