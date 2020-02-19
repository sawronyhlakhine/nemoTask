<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    private $user_id;

	public function __construct()
	{
        parent::__construct();
        if(!$this->session->has_userdata('logged_in')) {
			redirect("/auth");
        }
        $this->user_id = $this->session->userdata('logged_in')['id'];
        date_default_timezone_set('Asia/Rangoon');
        $this->load->model('task_model', 'task');
        $this->layout = "frontend";
		$this->parts['header'] = $this->load->view('includes/header', null, true);
		$this->parts['footer'] = $this->load->view('includes/footer', null, true);
	}

	public function index()
	{
		$this->title = "Home - Nemo Task";
        $data['tasks'] = $this->task->list($this->user_id);
        $data['done_tasks'] = $this->task->donelist($this->user_id);
        $this->load->view('task_main',$data);
        // echo date('F d, Y h:mA', strtotime('2009-10-14 19:00:00'));
    }
    
    public function add()
    {
        $this->title = "Add New Task - Nemo Task";
        $rawData = [
            'taskname' => 'trim|required|min_length[5]|max_length[60]'
        ];
        if(!$this->validate($rawData)) {
            $this->session->set_flashdata('task_error','Task Name does not valid.');
            $this->session->set_flashdata('task_name',$this->input->post('taskname'));
            redirect('/task');
        }
        $data = [
            'user_id' => $this->user_id,
            'name' => $this->input->post('taskname'),
            'description' => NULL,
            'todo_date' => NULL,
            'done' => 0,
            'created_datetime' => date('Y-m-d H:i:s'),
            'updated_datetime' => date('Y-m-d H:i:s')
            // GMT Time - gmdate("Y-m-d\TH:i:s\Z")
        ];
        $result = $this->task->insert($data);
        redirect('task');
    }

    public function edit($id = 0)
    {
        $rawData = [
            'taskname_edit' => 'trim|required|min_length[5]|max_length[60]'
        ];
        if(!$this->validate($rawData)) {
            $this->session->set_flashdata('toast','Failed to edit!');
            redirect('/task');
        }
        // die(var_dump((int)$id, $this->input->post('taskname_edit')));
        $result = $this->task->update((int)$id, ['name' => $this->input->post('taskname_edit')]);
        redirect('/task');
    }
    
    public function markdone($id = 0)
    {
        $result = $this->task->update((int)$id, ['done' => 1]);
        if ($result) {
            $this->session->set_flashdata('toast','Success Mark Done!,'.base_url("/task/undo/".$id));
        }
        redirect('/task');
    }
    
    public function undo($id=0)
    {
        $result = $this->task->update((int)$id, ['done' => 0]);
        if ($result) {
            $this->session->set_flashdata('toast','Success Undo!');
        }
        redirect('/task');
    }
    
    public function delete($id = 0)
    {
        $result = $this->task->delete((int)$id);
        if ($result) {
            $this->session->set_flashdata('toast','Success Delete!');
        }
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
}
