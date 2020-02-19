<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Task_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function list($uid)
    {
        $query = "SELECT * FROM task WHERE done = 0 AND `user_id` = $uid;";
		return $this->executeQuery($query);
    }

    public function donelist($uid)
    {
        $query = "SELECT * FROM task WHERE done = 1;";
		return $this->executeQuery($query);
    }

    public function insert($params)
    {
        $dataArr = [];
        if(is_array($params) && !empty($params)) {
            foreach($params as $field => $value) {
                $dataArr[$field] = $value;
            }
            $result = $this->db->insert('task',$dataArr);
            if ($result) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function update($id = 0, $params)
    {
        $dataArr = [];
        if(is_array($params) && !empty($params)) {
            foreach($params as $field => $value) {
                $dataArr[$field] = $value;
            }
            $this->db->where('id', $id);
            $result = $this->db->update('task',$dataArr);
            if ($result) {
                return $id;
            }
        }
        return false;
    }

    public function delete($id = 0)
    {
        $result = $this->db->delete('task', ['id'=> $id]);
        if($result) {
            return true;
        }
        return false;
    }

	protected function executeQuery($query)
	{
		$query_result = $this->db->query($query);
		if($query_result->num_rows() > 0) {
			return $query_result->result();
		}
		return [];
    }
    
}