<?php defined('BASEPATH') or exit('No direct script access allowed');

class Catalogo extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CatalogoModel','model');
    }
	
    public function index()
    {
        $data = $this->model->index_mdl();

        $this->load->view('cabecera.php');
        $this->load->view('CatalogoIndex.php',$data);
        $this->load->view('pie.php');
    }

	public function crear()
    {
        $this->load->view('cabecera.php');
        $this->load->view('crearCatalogo.php');
        $this->load->view('pie.php');
    }

    public function almacenar()
    {
        $this->model->almacenar_mdl();

        redirect("administracion/Catalogo", 'refresh');
    }

    public function modificar()
    {
        $data = $this->model->datos_mdl();
        $this->load->view('cabecera.php');
        $this->load->view('modificarCatalogo.php', $data);
        $this->load->view('pie.php');
	}
    public function actualizar()
    {
        $this->model->actualizar_mdl();

        redirect("administracion/Catalogo", 'refresh');
	}

    public function eliminar()
    {
        echo $this->model->eliminar_mdl();
	}
    
	public function comboCatalogo()
	{
		$data = $this->administracionModel->listMenuSistema();
		echo json_encode($data);
	}
}