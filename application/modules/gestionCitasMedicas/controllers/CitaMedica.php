<?php defined('BASEPATH') or exit('No direct script access allowed');

class CitaMedica extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('citaMedicaModel');
    }
	
    public function index()
    {
		$data['contenido'] = 'gestionCitasMedicas/citaMedica_v';
		$this->template->template($data);
		
    }

	public function showCitaMedica()
	{
		$data = $this->citaMedicaModel->showCitaMedica();
		echo json_encode($data);
	}

	public function updateCitaMedica()
	{
		$data = $this->citaMedicaModel->updateCitaMedica();
		echo json_encode($data);
	}

	public function saveCitaMedica()
	{
		$data = $this->citaMedicaModel->saveCitaMedica();
		echo json_encode($data);
	}

	public function deleteCitaMedica()
	{
		$data = $this->citaMedicaModel->deleteCitaMedica();
		echo json_encode($data);
	}
	
	public function comboPaciente()
	{
		$data = $this->citaMedicaModel->comboPaciente();
		echo json_encode($data);
	}
	public function comboMedico()
	{
		$data = $this->citaMedicaModel->comboMedico();
		echo json_encode($data);
	}
    public function comboHorarioCita()
	{
		$data = $this->citaMedicaModel->comboHorarioCita();
		echo json_encode($data);
	}

	public function comboEspecialidad()
	{
		$data = $this->citaMedicaModel->comboEspecialidad();
		echo json_encode($data);
	}
	
	public function updateDatosCitaMedica()
	{
		$data = $this->citaMedicaModel->updateDatosCitaMedica();
		echo json_encode($data);
	}

	public function archivosAlmacenar()
	{
		$data = $this->citaMedicaModel->archivosAlmacenar();
		echo json_encode($data);
	}
	public function archivosVer()
	{
		$data = $this->citaMedicaModel->archivosVer();
		echo json_encode($data);
	}

	public function archivosDescargar() {
        echo $this->citaMedicaModel->archivosDescargar();
		
    }

	public function listMenuSistema()
	{
		$data = $this->citaMedicaModel->listMenuSistema();
		echo json_encode($data);
	}

	
}