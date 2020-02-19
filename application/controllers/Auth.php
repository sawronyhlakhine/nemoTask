<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        date_default_timezone_set('Asia/Rangoon'); 
        $this->load->model('user_model', 'user');
        $this->layout = "login";
    }

    public function index()
    {
        if($this->session->has_userdata('logged_in')) {
			redirect("/task");
		}
        $this->title = 'Login - Nemo Task';
        $this->load->view('auth/login');
    }
    
    public function login()
    {
        $this->title = 'Login - Nemo Task';
        $rawData = [
            'email' => 'trim|required|valid_email|callback',
            'password' => 'required|callback_verify',
        ];
        // die(var_dump($this->validate($rawData)));
        if(!$this->validate($rawData)) {
            $this->session->set_flashdata('login_error','<div class="card-panel red accent-2 white-text">Invalid username or password.</div>');
            redirect('/auth');
        }
        redirect('/task');
    }

    public function logout()
    {
        session_destroy();
        redirect('/auth');
    }

    public function signup()
    {
        $this->title = 'Register - Nemo Task';
        $this->load->view('auth/register');
    }

    public function register()
    {
        $rawData = [
            'username' => 'trim|required|min_length[5]|max_length[100]',
            'email' => 'required|valid_email|is_unique[user.email]',
            'password' => 'required',
            'confirm_password' => 'required|matches[password]'
        ];
        if(!$this->validate($rawData)) {
            $this->session->set_flashdata('reg_error','<div class="card-panel red accent-2 white-text">User Name or password may be wrong.</div>');
            // $this->session->set_flashdata('task_name',$this->input->post('taskname'));
            redirect('/auth/signup');
        }
        $data = [
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'created_datetime' => date('Y-m-d H:i:s'),
            'updated_datetime' => date('Y-m-d H:i:s')
        ];
        // die(var_dump($data));
        $result = $this->user->insert($data);
        redirect('/task');
    }

    public function validate($rawArr)
    {
        $this->load->library('form_validation');
        foreach ($rawArr as $key => $value) {
            $this->form_validation->set_rules($key, ucfirst($key), $value);
        }
        if ($this->form_validation->run() == FALSE)
        {
            return false;
        }
        return true;
    }

    function verify($password)
    {
        $email = $this->input->post('email');
        $result = $this->user->checkLogin($email, $password);

        if($result) {
            $sess_array = array();
            foreach($result as $row) {
                $sess_array = [
                    'id' => $row->id,
                    'username' => $row->username,
                    'email' => $row->email
                ];
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return true;
        }
        return false;
    }
}