<?php

class Controller_Index extends System_Controller {

    public function index() {
        $ModelBanner = new Model_Banner();
        $ModelBanner->orderby("ban_in_order ASC");
        $this->banners = $ModelBanner->getRows();
    }

    public function add() {
        if (HTTP::isPost()) {
            $ModelBanner = new Model_Banner();
            foreach ($_POST as $k => $v) {
                $ModelBanner->$k = $v;
            }

            if (isset($_FILES['ban_ds_path']) && $_FILES['ban_ds_path']['size'] > 0) {
                $dir = System_CONFIG::get("upload_dir");
                $filename = preg_replace("/[^a-zA-Z0-9\.\-]/", "", $_FILES['ban_ds_path']['name']);
                $file = $filename;
                $tmp = $_FILES['ban_ds_path']['tmp_name'];

                $i = 1;
                while (file_exists($dir . $file)) {
                    $file = $i . "_" . $filename;
                    $i++;
                }

                move_uploaded_file($tmp, $dir . $file);
                $ModelBanner->ban_ds_path = $file;
            }
            $ban_id = $ModelBanner->salva();

            Error::add('BAN00001');

            HTTP::redirect($this->urlByAcao('edit', $ban_id));
        }

        $this->banner = new Model_Banner();
        $this->render("form");
    }

    public function edit() {
        if (HTTP::isPost()) {
            $ModelBanner = new Model_Banner();
            foreach ($_POST as $k => $v) {
                $ModelBanner->$k = $v;
            }

            if (isset($_POST['iban_ds_path']))
                $ModelBanner->ban_ds_path = $_POST['iban_ds_path'];
            if (isset($_FILES['ban_ds_path']) && $_FILES['ban_ds_path']['size'] > 0) {
                $dir = System_CONFIG::get("upload_dir");
                $filename = preg_replace("/[^a-zA-Z0-9\.\-]/", "", $_FILES['ban_ds_path']['name']);
                $file = $filename;
                $tmp = $_FILES['ban_ds_path']['tmp_name'];

                $i = 1;
                while (file_exists($dir . $file)) {
                    $file = $i . "_" . $filename;
                    $i++;
                }

                move_uploaded_file($tmp, $dir . $file);
                $ModelBanner->ban_ds_path = $file;
            }
            $ban_id = $ModelBanner->salva();

            Error::add('BAN00002');

            HTTP::redirect($this->urlByAcao('edit', $ban_id));
        }

        $ModelBanner = new Model_Banner();
        $this->banner = $ModelBanner->getById(Map::get('id'));
        $this->render("form");
    }

    public function delete() {
        if (Map::exists('id')) {
            $ModelBanner = new Model_Banner();
            $ModelBanner->deleteById(Map::get('id'));

            Error::add('BAN00003');
            HTTP::redirect($this->urlByAcao("index"));
        }

        HTTP::redirect($this->urlByAcao("index"));
    }

    public function editOrder() {
        if (HTTP::isPost()) {
            foreach ($_POST['banner'] as $id => $order) {
                $ModelBanner = new Model_Banner();
                $banner = $ModelBanner->getById($id);
                $banner->ban_in_order = $order;
                $banner->salva();
            }

            Error::add('BAN00004');
            HTTP::redirect($this->urlByAcao("index"));
        }
        HTTP::redirect($this->urlByAcao("index"));
    }

    public function init() {
        if (!Security::hasAccess()) {
            HTTP::redirect($this->url("publico"));
        }
    }

}
