<?php

defined('ACCESS_PATCH') OR die('No direct script access.');

$app->group('/users', function () use ($app) {

	$app->group('/students', function () use ($app) {

		$app->get('/all', function () use ($app) {

			global $database;
			global $dataReturn;


		});

		$app->get('/:id', function ($id_student) use ($app) {

			global $database;
			global $dataReturn;

			$getTeachers = $database->prepare('SELECT name, photo, online, created_at FROM cm_users WHERE id = :id_student AND user_type = :user_type LIMIT 6');

			$getTeachers->bindValue(':id_student', $id_student);
			$getTeachers->bindValue(':user_type', 1); // Student *

			$getTeachers->execute();

			if ($getTeachers->rowCount() > 0) {

				$dataReturn->json(true, '', $getTeachers->fetchAll(PDO::FETCH_ASSOC));

			} else {

				$dataReturn->json(false);

			}

		});

		$app->post('/update_photo', function () use ($app) {

			global $database;
			global $dataReturn;

			if ($app->request->post('my_id') == '') {
				$dataReturn->json(false);
			}

			if (!empty($_FILES['image']['name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {

				include("Utility/SimpleImage.php");

			    // Limpa e obtem as variaveis com o arquivo
			    $fileSend = strip_tags($_FILES['image']['name']);
			    $fileTmpSend = strip_tags($_FILES['image']['tmp_name']);

			    // Captura a extensão
			    $fileExtension = explode(".", $fileSend);
			    $fileExtension = end($fileExtension);

			    // Seta a pasta de destino
			    $folderSave = 'Files/profile_image/';

			    // Verifica se o arquivo é válido
			    if (strtolower($fileExtension) != 'png' && strtolower($fileExtension) != 'jpg' && strtolower($fileExtension) != 'jpeg') {
			        $dataReturn->json(false, 'Escolha uma imagem com formato png ou jpg.');
			    }

			    // Cria a pasta de destino
			    if (!is_dir($folderSave)) {
			        mkdir($folderSave, 0777);
			    }

			    // Move o arquivo para a pasta de destino
			    if (move_uploaded_file($fileTmpSend, $folderSave . $fileSend)) {

					try {

						$fileNewName = md5(uniqid());

						rename($folderSave . $fileSend, $folderSave . $fileNewName . '.' . $fileExtension);

						$userUpdate = $database->prepare('UPDATE cm_users SET photo = :photo WHERE id = :my_id');

						$userUpdate->bindValue(':photo', $fileNewName . '.jpg');
						$userUpdate->bindValue(':my_id', $app->request->post('my_id'));

						$deleteOldPhoto = $database->prepare('SELECT photo FROM cm_users WHERE id = :my_id LIMIT 1');
						$deleteOldPhoto->bindValue(':my_id', $app->request->post('my_id'));
						$deleteOldPhoto->execute();

						$imgCrop = new SimpleImage($folderSave . $fileNewName . '.' . $fileExtension);
						$imgCrop->best_fit(400, 400)->save($folderSave . $fileNewName . '.jpg');

						$imgCrop = new SimpleImage($folderSave . $fileNewName . '.jpg');
						$imgCrop->best_fit(120, 120)->save($folderSave . $fileNewName . '-mini.jpg');

						if ($fileExtension != 'jpg') {
							@unlink($folderSave . $fileNewName . '.' . $fileExtension);
						}

						if ($deleteOldPhoto->rowCount() > 0) {

							$fetchOlderPhoto =  $deleteOldPhoto->fetchObject();

							@unlink($folderSave . $fetchOlderPhoto->photo);
							@unlink($folderSave . substr($fetchOlderPhoto->photo, 0, -4) . '-mini.jpg');

						}

						$userUpdate->execute(); // After delete older photo *

						$dataReturn->json(true, '', array('my_photo' => $fileNewName . '.jpg'));

					} catch (PDOException $e) {

						$dataReturn->json(false, 'Ocorreu ao salvar a foto, tente novamente.');

					}

			    }

			} else {

				$dataReturn->json(false, 'Ocorreu ao enviar a foto, tente novamente.');

			}

		});

		$app->put('/:id', function ($id_student) use ($app) {

			global $database;
			global $dataReturn;

		});

		$app->delete('/:id', function ($id_student) use ($app) {

			global $database;
			global $dataReturn;

		});

	});

	$app->group('/teachers', function () use ($app) {

		$app->get('/all', function () use ($app) {

			global $database;
			global $dataReturn;

			$getTeachers = $database->prepare('SELECT id, name, matter, photo FROM cm_users WHERE user_type = :user_type LIMIT 6');

			$getTeachers->bindValue(':user_type', 2); // Teachers *

			$getTeachers->execute();

			if ($getTeachers->rowCount() > 0) {

				$dataReturn->json(true, '', $getTeachers->fetchAll(PDO::FETCH_ASSOC));

			} else {

				$dataReturn->json(false, 'Nenhum professor cadastrado até o momento.');

			}

		});

		$app->get('/online', function () use ($app) {

			global $database;
			global $dataReturn;

			$getTeachers = $database->prepare('SELECT id, name, matter, photo FROM cm_users WHERE user_type = :user_type AND online = :online LIMIT 6');

			$getTeachers->bindValue(':user_type', 2); // Teachers *
			$getTeachers->bindValue(':online', 1); // Teachers *

			$getTeachers->execute();

			if ($getTeachers->rowCount() > 0) {

				$dataReturn->json(true, '', $getTeachers->fetchAll(PDO::FETCH_ASSOC));

			} else {

				$dataReturn->json(false, 'Nenhum Professor online.');

			}

		});

		$app->get('/:id', function ($id_teacher) use ($app) {

			global $database;
			global $dataReturn;

			$getTeachers = $database->prepare('SELECT id, name, matter, photo, about, online FROM cm_users WHERE id = :id_teacher AND user_type = :user_type LIMIT 6');

			$getTeachers->bindValue(':id_teacher', $id_teacher);
			$getTeachers->bindValue(':user_type', 2); // Teachers *

			$getTeachers->execute();

			if ($getTeachers->rowCount() > 0) {

				$dataReturn->json(true, '', $getTeachers->fetchAll(PDO::FETCH_ASSOC));

			} else {

				$dataReturn->json(false, 'O professor não foi encontrado, talvez tenha sido excluído.');

			}

		});

		$app->post('/', function () use ($app) {

			global $database;
			global $dataReturn;

		});

		$app->put('/:id', function ($id_teacher) use ($app) {

			global $database;
			global $dataReturn;

		});

		$app->delete('/:id', function ($id_teacher) use ($app) {

			global $database;
			global $dataReturn;

		});

	});

});

?>