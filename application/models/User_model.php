<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($params)
    {
        $dataArr = [];
        if(is_array($params) && !empty($params)) {
            foreach($params as $field => $value) {
                if($field == 'password') $value = md5($value);
                $dataArr[$field] = $value;
            }
            $result = $this->db->insert('user',$dataArr);
            if ($result) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function checkLogin($email, $password){
        $this
            ->db
            ->select(['id','username', 'email'])
            ->from('user')
            ->where(['email' => $email, 'password' => md5($password)])
            ->limit(1);
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            return $result->result();
        }
		return false;
    }
}