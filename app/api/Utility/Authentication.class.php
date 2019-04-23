<?php

namespace Utility;

defined('ACCESS_PATCH') OR die('No direct script access.');

Class Authentication
{

	private $is_logged = false;

	public function __construct () {

		global $app;
		global $database;
		global $dataReturn;

		if ($app->request->post('token') != '') {

			$token = $app->request->post('token');

		} else if ($app->request->put('token') != '') {

			$token = $app->request->put('token');

		} else if ($app->request->get('token') != '') {

			$token = $app->request->get('token');

		} else if ($app->request->delete('token') != '') {

			$token = $app->request->delete('token');

		}

		if (isset($_SESSION['INVALID_TOKEN']) && $token == $_SESSION['INVALID_TOKEN']) {

			$dataReturn->json(false, 'Por favor, faça login novamente.');

		}

	}

	public function is_logged () {

		if ($this->is_logged === true) {

			$app->run();

		} else {

			header('HTTP/1.0 401 Unauthorized');

			$dataReturn->json(false, 'Por favor, faça login novamente.');

		}

	}

	public function generate_token () {

		$characters = array('@', '#', '1', '0', '%', '*', '-', '+');

		$characters_total_real = count($characters) - 1;

		$conc_01 = $characters[round(0, $characters_total_real)];
		$conc_02 = uniqid(rand(), true);
		$conc_03 = $characters[round(0, $characters_total_real)];

		return sha1($conc_01 . $conc_02 . $conc_03);

	}

	public function invalidToken ($token) {

		$_SESSION['INVALID_TOKEN'] = $token;

	}

}

?>