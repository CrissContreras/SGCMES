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