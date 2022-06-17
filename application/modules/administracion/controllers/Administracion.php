<?php defined('BASEPATH') or exit('No direct script access allowed');

class Administracion extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('administracionModel');
    }
	
    public function index()
    {
        $data['contenido'] = 'administracion/principal_v';
		$this->template->template($data);
    }

	public function Principal()
    {
        $data['contenido'] = 'administracion/principal_v';
		$this->template->template($data);
    }

    public function AgendarCita()
    {
        $data['contenido'] = 'administracion/agendarCita_v';
		$this->template->template($data);
	}

    public function AgendaCitas()
    {
        $data['contenido'] = 'administracion/agendaCitas_v';
		$this->template->template($data);
	}
    
	public function listMenuSistema()
	{
		$data = $this->administracionModel->listMenuSistema();
		echo json_encode($data);
	}
	
}