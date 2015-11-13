<?php

class ControllerApiCategory extends Controller {
    public function index() {
        $this->load->language('api/category');

        // Delete old login so not to cause any issues if there is an error
        unset($this->session->data['api_id']);

        $keys = array(
            'username',
            'password'
        );

        foreach ($keys as $key) {
            if (!isset($this->request->post[$key])) {
                $this->request->post[$key] = '';
            }
        }


//        $this->load->model('account/api');
        $this->load->model('catalog/category');

        $getCategories = $this->model_catalog_category->getCategories();

        if ($getCategories) {

            $json['Categories'] = $getCategories;
            $json['Cookies'] = $this->session->getId();
            $json['Success'] = $this->language->get('text_success');

        } else {
            $json['error'] = $this->language->get('error_login');
        }

        $this->response->addHeader('Content-Type: application/json; charset=utf-8');
        $this->response->setOutput(json_encode($json,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
    }
}
