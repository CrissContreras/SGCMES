<?php defined('BASEPATH') or exit('No direct script access allowed');

class Registro extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('registroModel');
    }

    public function index() {
        $this->load->view('registro/registro_v');
    }

    public function registro_nuevo_paciente() {
        $data = $this->registroModel->registro_nuevo_paciente();
        echo json_encode($data);
    }
}
