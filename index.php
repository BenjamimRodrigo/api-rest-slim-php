<?php
require 'php/Slim/Slim.php';
require 'models/Aluno.php';

/**
 * 
 * FACOL - Faculdade Escritor Osman da Costa Lins
 * Sistemas Distribuídos - Marcus Vinícius
 * 
 * Middleware - API REST - Academia Desportiva
 * 
 * Alunos: Danilo Deivison; Benjamim Rodrigo; Jonathan Medeiros; José Álvaro.
 * 
 * 30/10/2018
 * 
 */


\Slim\Slim::registerAutoloader();

	$app = new \Slim\Slim();

	$app->group('/api/v1', function () use ($app) {

		$app->group('/alunos', function () use ($app) {

			// Listando todos os alunos
			$app->get('/', function() use ($app){
				(new Aluno($app))->lista();
			});

			// Listando apenas um aluno
			$app->get('/:id', function($id) use ($app){
				(new Aluno($app))->get($id);
			});

			// Inserindo um aluno
			$app->post('/', function() use ($app){
				(new Aluno($app))->inserir();
			});

			// Alterando um aluno
			$app->put('/:id', function($id) use ($app){
				(new Aluno($app))->alterar($id);
			});

			// Deletando um aluno
			$app->delete('/:id', function($id) use ($app){
				(new Aluno($app))->deletar($id);
			});
		});

	});

	$app->any('/', function () {
		echo json_encode(["status" => false, "erro" => "Este serviço oferece apenas recursos especificos."]);
	});

$app->run();

?>