<?php

defined('ACCESS_PATCH') or die('No direct script access.');

$app->group('/authentication', function () use ($app) {

	$app->group('/students', function () use ($app) {

		$app->post('/login', function () use ($app) {

			global $database;
			global $authentication;
			global $dataReturn;

			if ($app->request->post('email') == '') {
				$dataReturn->json(false, 'Digite seu e-mail.');
			}

			if ($app->request->post('senha') == '') {
				$dataReturn->json(false, 'Digite sua senha.');
			}

			if (filter_var($app->request->post('email'), FILTER_VALIDATE_EMAIL) == false) {
				$dataReturn->json(false, 'Digite um e-mail válido.');
			}

			$userExists = $database->prepare('SELECT id AS user_id, photo FROM cm_users WHERE user_type = :user_type AND email = :email AND password = :password LIMIT 1');

			$userExists->bindValue(':user_type', 1); // Student *

			$userExists->bindValue(':email', $app->request->post('email'));
			$userExists->bindValue(':password', sha1($app->request->post('senha')));

			$userExists->execute();

			if ($userExists->rowCount() == 0) {

				$dataReturn->json(false, 'Dados incorretos.');

			}

			$fetchUser = $userExists->fetchObject();

			$tokenAuth = $authentication->generate_token();

			try {

				$insertSession = $database->prepare('INSERT INTO cm_sessions (user_id, token, login_data) VALUES (:user_id, :token, :login_data)');

				$insertSession->bindValue(':user_id', $fetchUser->user_id);
				$insertSession->bindValue(':token', $tokenAuth);
				$insertSession->bindValue(':login_data', date('Y-m-d H:i:s'));

				$insertSession->execute();

				$idSession = $database->lastInsertId();

			} catch (PDOException $e) {

				$dataReturn->json(false, 'Ocorreu ao iniciar sua sessão.');

			}

			try {

				$userUpdate = $database->prepare('UPDATE cm_users SET online = :online, last_active = :last_active WHERE id = :my_id');

				$userUpdate->bindValue(':online', 1);
				$userUpdate->bindValue(':last_active', date("Y-m-d H:i:s"));
				$userUpdate->bindValue(':my_id', $fetchUser->user_id);

				$userUpdate->execute();

			} catch (PDOException $e) {

				$dataReturn->json(false, 'Ocorreu ao iniciar sua sessão.');

			}

			$dataReturn->json(true, '', array('token' => $tokenAuth, 'my_id' => $fetchUser->user_id, 'my_photo' => $fetchUser->photo));

		});

		$app->get('/logout', function () use ($app) {

			global $authentication;
			global $dataReturn;
			global $database;

			$currentToken = $authentication->getCurrentToken();

			$destroyToken = $database->prepare('DELETE FROM cm_sessions WHERE token = :token LIMIT 1');

			$destroyToken->execute(
				array(
					':token' => $currentToken
				)
			);

			if ($destroyToken->rowCount() > 0) {

				$dataReturn->json(true, '');

			} else {

				$authentication->invalidToken($currentToken);

				$dataReturn->json(true, '');

			}

		});

		$app->post('/register', function () use ($app) {

			global $database;
			global $authentication;
			global $dataReturn;

			if ($app->request->post('nome') == '' || preg_match('/^[a-z\s]{3,35}$/i', trim($app->request->post('nome'))) == false) {
				$dataReturn->json(false, 'Digite seu nome corretamente, no máximo 35 caracteres.');
			}

			if ($app->request->post('genero') != 'm' && $app->request->post('genero') != 'f') {
				$dataReturn->json(false, 'Escolha o seu gênero');
			}

			if ($app->request->post('email') == '') {
				$dataReturn->json(false, 'Digite seu e-mail.');
			}

			if (filter_var($app->request->post('email'), FILTER_VALIDATE_EMAIL) == false) {
				$dataReturn->json(false, 'Digite um e-mail válido.');
			}

			if ($app->request->post('senha') == '') {
				$dataReturn->json(false, 'Digite sua senha.');
			}

			if (strlen($app->request->post('senha')) < 4 || strlen($app->request->post('senha')) > 8) {
				$dataReturn->json(false, 'Sua senha deve conter no mínimo 5 caracteres e no máximo 8.');
			}

			if ($app->request->post('idade') == '') {
				$dataReturn->json(false, 'Escolha a sua idade no slider acima.');
			}

			$userExists = $database->prepare('SELECT id FROM cm_users WHERE email = :email LIMIT 1');

			$userExists->bindValue(':email', $app->request->post('email'));

			$userExists->execute();

			if ($userExists->rowCount() > 0) {

				$dataReturn->json(false, 'Já existe uma pessoa cadastrada com esse e-mail.');

			}

			$name = ucfirst(substr(strtolower(trim($app->request->post('nome'))), 0, 35));

			$registerUser = $database->prepare('INSERT INTO cm_users (user_type, name, email, password, gender, age, last_active, created_at) VALUES (:user_type, :name, :email, :password, :gender, :age, :last_active, :created_at)');

			$registerUser->execute(
				array(
					':user_type' => 1, // Student *
					':name' => $name,
					':email' => $app->request->post('email'),
					':password' => sha1($app->request->post('senha')),
					':gender' => $app->request->post('genero'),
					':age' => $app->request->post('idade'),
					':last_active' => date("Y-m-d H:i:s"),
					':created_at' => date("Y-m-d H:i:s")
				)
			);

			$userId = $database->lastInsertId();

			if ($registerUser->rowCount() > 0) {

				$tokenAuth = $authentication->generate_token();

				try {

					$insertSession = $database->prepare('INSERT INTO cm_sessions (user_id, token, login_data) VALUES (:user_id, :token, :login_data)');

					$insertSession->bindValue(':user_id', $userId);
					$insertSession->bindValue(':token', $tokenAuth);
					$insertSession->bindValue(':login_data', date('Y-m-d H:i:s'));

					$insertSession->execute();

					$idSession = $database->lastInsertId();

					$dataReturn->json(true, '', array('token' => $tokenAuth, 'my_id' => $userId));

				} catch (PDOException $e) {

					$dataReturn->json(false, 'Por favor, faça login, sua conta já foi criada.');

				}

			} else {

				$dataReturn->json(false, 'Ocorreu um erro ao fazer o seu cadastro, tente novamente.');

			}

		});

	});

	$app->group('/teachers', function () use ($app) {

		$app->get('/all', function () use ($app) {

		});

		$app->get('/:id', function ($id_teacher) use ($app) {

		});

		$app->post('/', function () use ($app) {

		});

		$app->put('/:id', function ($id_teacher) use ($app) {

		});

		$app->delete('/:id', function ($id_teacher) use ($app) {

		});

	});

});

?>