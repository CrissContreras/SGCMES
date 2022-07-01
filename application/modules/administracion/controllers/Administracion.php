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

	//Usuarios
	function Usuarios(){
		$data['contenido'] = 'administracion/usuarios_v';
		$this->template->template($data);
	}

	public function showUsuario()
	{
		$data = $this->administracionModel->showUsuario();
		echo json_encode($data);
	}

	public function updateUsusario()
	{
		$data = $this->administracionModel->updateUsusario();
		echo json_encode($data);
	}

	public function saveUsuario()
	{
		$data = $this->administracionModel->saveUsuario();
		echo json_encode($data);
	}

	public function deleteUsuario()
	{
		$data = $this->administracionModel->deleteUsuario();
		echo json_encode($data);
	}


    //Catalogo
	function Catalogo(){
		$data['contenido'] = 'administracion/catalogo_v';
		$this->template->template($data);
	}

	public function showCatalogo()
	{
		$data = $this->administracionModel->showCatalogo();
		echo json_encode($data);
	}

	public function updateCatalogo()
	{
		$data = $this->administracionModel->updateCatalogo();
		echo json_encode($data);
	}

	public function saveCatalogo()
	{
		$data = $this->administracionModel->saveCatalogo();
		echo json_encode($data);
	}

	public function deleteCatalogo()
	{
		$data = $this->administracionModel->deleteCatalogo();
		echo json_encode($data);
	}

	//Rol
	function Rol(){
		$data['contenido'] = 'administracion/rol_v';
		$this->template->template($data);
	}

	public function showRol()
	{
		$data = $this->administracionModel->showRol();
		echo json_encode($data);
	}

	public function updateRol()
	{
		$data = $this->administracionModel->updateRol();
		echo json_encode($data);
	}

	public function saveRol()
	{
		$data = $this->administracionModel->saveRol();
		echo json_encode($data);
	}

	public function deleteRol()
	{
		$data = $this->administracionModel->deleteRol();
		echo json_encode($data);
	}

	public function comboRol()
	{
		$data = $this->administracionModel->comboRol();
		echo json_encode($data);
	}

	//Especialidad
	function Especialidad(){
		$data['contenido'] = 'administracion/especialidad_v';
		$this->template->template($data);
	}

	public function showEspecialidad()
	{
		$data = $this->administracionModel->showEspecialidad();
		echo json_encode($data);
	}

	public function updateEspecialidad()
	{
		$data = $this->administracionModel->updateEspecialidad();
		echo json_encode($data);
	}

	public function saveEspecialidad()
	{
		$data = $this->administracionModel->saveEspecialidad();
		echo json_encode($data);
	}

	public function deleteEspecialidad()
	{
		$data = $this->administracionModel->deleteEspecialidad();
		echo json_encode($data);
	}

	public function comboEspecialidad()
	{
		$data = $this->administracionModel->comboEspecialidad();
		echo json_encode($data);
	}

	//Horario
	function Horario(){
		$data['contenido'] = 'administracion/horario_v';
		$this->template->template($data);
	}

	public function showHorario()
	{
		$data = $this->administracionModel->showHorario();
		echo json_encode($data);
	}

	public function updateHorario()
	{
		$data = $this->administracionModel->updateHorario();
		echo json_encode($data);
	}

	public function saveHorario()
	{
		$data = $this->administracionModel->saveHorario();
		echo json_encode($data);
	}

	public function deleteHorario()
	{
		$data = $this->administracionModel->deleteHorario();
		echo json_encode($data);
	}

	public function comboHorario()
	{
		$data = $this->administracionModel->comboHorario();
		echo json_encode($data);
	}

	public function saveHorarioUsuario()
	{
		$data = $this->administracionModel->saveHorarioUsuario();
		echo json_encode($data);
	}

    // citas medicas

	public function CitaMedica()
    {
        $data['contenido'] = 'administracion/citaMedica_v';
		$this->template->template($data);
	}
	
	public function showCitaMedica()
	{
		$data = $this->administracionModel->showCitaMedica();
		echo json_encode($data);
	}

	public function updateCitaMedica()
	{
		$data = $this->administracionModel->updateCitaMedica();
		echo json_encode($data);
	}

	public function saveCitaMedica()
	{
		$data = $this->administracionModel->saveCitaMedica();
		echo json_encode($data);
	}

	public function deleteCitaMedica()
	{
		$data = $this->administracionModel->deleteCitaMedica();
		echo json_encode($data);
	}
	
	




    
	public function listMenuSistema()
	{
		$data = $this->administracionModel->listMenuSistema();
		echo json_encode($data);
	}
}