<?php

class Template extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('templateModel');
    }

    public function index(){
        $this->load->view('template/portada_v'); 
    }

    function template($data = NULL)
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            /*$sistema = $this->templateModel->sistema();

            foreach ($sistema as $row) { 
                $data['TEMA'] = $row->GEN_TEMA;
                $data['COLOR'] = $row->GEN_COLOR;
                $data['MENU'] = $row->GEN_LATERAL;
                $data['TIME_SISTEMA'] = $row->GEN_TIME_SESION;
            }*/

            $data['USUARIO_LOG_ID'] = $session_data['ID_USUARIO'];
            $data['USUARIO_LOGUEADO'] = $session_data['NOMBRE_USUARIO'];
            $this->load->view('template/tamplate_v', $data);
            
        } else {
            redirect('login');
        }

    }
    function user_template($data = NULL)
    {
        $this->load->view('template/user_template_v', $data); 
    }
    
    public function updatePass()
	{
		$data = $this->templateModel->updatePass();
		echo json_encode($data);
	}
    
    public function Perfil()
	{
		$data = $this->templateModel->Perfil();
		echo json_encode($data);
	}
}
