<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_model extends CI_Model {

    public function insert_attendance($data) {
        return $this->db->insert('attendance_reports', $data);
    }

public function getData()
{
    $this->db->order_by('created_at', 'DESC');
    return $this->db->get('attendance_reports')->result_array(); // includes 'viewed'
}

    public function getTotalReports() {
    return $this->db->count_all('attendance_reports');
}

    public function getDataById($id) {
        $this->db->where('id', $id);
        return $this->db->get('attendance_reports')->row_array();
        
    }
public function update_record($id, $data) {
    $this->db->where('id', $id);
    return $this->db->update('attendance_reports', $data);
}


    // Login - check `users` table only
        public function get_user($username, $password) {
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $query = $this->db->get('users');
            return $query->row();
        }

        // Create a new user
        public function create_user($data) {
            $this->db->insert('users', $data);
            return $this->db->insert_id();
        }

        // Check existing user by username or email
        public function get_user_by_username_or_email($username, $email) {
            $this->db->group_start();
            $this->db->where('username', $username);
            $this->db->or_where('email', $email);
            $this->db->group_end();
            $query = $this->db->get('users');
            return $query->row();
        }
public function mark_as_viewed($report_id)
{
    $report = $this->db->get_where('attendance_reports', ['id' => $report_id])->row();

    if ($report && $report->viewed == 0) {
        $this->db->where('id', $report_id);
        $this->db->set('viewed', 'viewed + 1', FALSE); // increment view count
        $this->db->update('attendance_reports');
    }
}



public function getTotalViewed() {
    return $this->db->where('viewed >', 0)->count_all_results('attendance_reports');
}


}