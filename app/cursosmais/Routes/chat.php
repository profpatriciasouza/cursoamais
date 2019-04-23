<?php

defined('ACCESS_PATCH') OR die('No direct script access.');

$app->group('/chat', function () use ($app) {

	$app->post('/talk', function () use ($app) {

		global $database;
		global $dataReturn;

		$getTalk = $database->prepare('
			SELECT cm_chat.*, cm_users.*, cm_users.id AS user_id FROM cm_chat JOIN cm_users
			WHERE
			cm_chat.sender_id = :my_id AND cm_users.id = :my_id AND cm_chat.receiver_id = :id_teacher
			OR
			cm_chat.sender_id = :id_teacher AND cm_users.id = :id_teacher AND cm_chat.receiver_id = :my_id
			LIMIT 40
		');

		$getTalk->bindValue(':id_teacher', $app->request->post('id_teacher'));
		$getTalk->bindValue(':my_id', $app->request->post('my_id'));

		$getTalk->execute();

		if ($getTalk->rowCount() > 0) {

			$dataReturn->json(true, '', $getTalk->fetchAll(PDO::FETCH_ASSOC));

		} else {

			$dataReturn->json(false, '');

		}

	});

	$app->post('/active', function () use ($app) {

		global $database;
		global $dataReturn;

		$getTalks = $database->prepare('
			SELECT cm_chat.*, cm_users.*, cm_users.id AS user_id, LEFT(photo, 32) AS mini_photo_alias FROM cm_chat
			JOIN cm_users
			WHERE
			cm_chat.sender_id = :my_id AND cm_users.id = cm_chat.receiver_id
			OR
			cm_chat.sender_id = cm_users.id AND cm_chat.receiver_id = :my_id
			GROUP BY cm_users.id
			LIMIT 30
		');

		$getTalks->bindValue(':my_id', $app->request->post('my_id'));

		$getTalks->execute();

		if ($getTalks->rowCount() > 0) {

			$dataReturn->json(true, '', $getTalks->fetchAll(PDO::FETCH_ASSOC));

		} else {

			$dataReturn->json(false, '');

		}

	});

	$app->post('/message', function () use ($app) {

		global $database;
		global $dataReturn;

		if (isset($_SESSION['TEMP_CHAT_' . date('Y m d H i')])) {

			$_SESSION['TEMP_CHAT_' . date('Y m d H i')] += 1;


			if ($_SESSION['TEMP_CHAT_' . date('Y m d H i')] > 4) {
				$dataReturn->json(false, 'Calma, alguarde um minuto para enviar uma nova mensagem.');
			}

		} else {

			$_SESSION['TEMP_CHAT_' . date('Y m d H i')] = 1;

		}

		$getTalk = $database->prepare('INSERT INTO cm_chat (sender_id, receiver_id, message, date_send) VALUES (:sender_id, :receiver_id, :message, :date_send)');

		$getTalk->bindValue(':sender_id', $app->request->post('my_id'));
		$getTalk->bindValue(':receiver_id', $app->request->post('receiver_id'));
		$getTalk->bindValue(':message', $app->request->post('message'));
		$getTalk->bindValue(':date_send', date("Y-m-d H:i:s"));

		$getTalk->execute();

		if ($getTalk->rowCount() > 0) {

			$dataReturn->json(true);

		} else {

			$dataReturn->json(false);

		}

	});

});

?>