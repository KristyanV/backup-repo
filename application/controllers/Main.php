<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

  public function __construct() {
        parent::__construct();
        $this->load->library('session'); 
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('Attendance_model');
        $this->load->helper('url');

        // Methods that don't require login
        $public_methods = ['index', 'checkLogin', 'signup', 'register'];
        $current_method = $this->router->fetch_method();

        // Prevent browser caching to avoid showing protected pages after signout
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

        // Redirect to login if trying to access protected methods
        if (!in_array($current_method, $public_methods)) {
            if (!$this->session->userdata('logged_in')) {
                redirect('Main');
            }
        }
    }

//User Admin Login 
    public function index() {
        $this->load->view('login_form');
    }

    public function checkLogin() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('login_form');
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Attendance_model->get_user($username, $password);

        if ($user) {
            // Set session data
            $this->session->set_userdata([
                'id' => $user->id,
                'username' => $user->username,
                'password' => $user->password,
                'name' => $user->name,
                'middlename' => $user->middlename,
                'surname' => $user->surname,
                'companyposition' => $user->companyposition,
                'logged_in' => true
            ]);
            
            redirect('main/list'); // Fix: Redirect to dashboard instead of login
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            $this->load->view('login_form'); // Added missing semicolon
        }
    }


    // Show signup page
    public function signup() {
        $this->load->view('signup_form');
    }

    // Handle signup POST
    public function register() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('name', 'First name', 'required');
        $this->form_validation->set_rules('surname', 'Surname', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('signup_form');
            return;
        }

        $email = $this->input->post('email');
        $username = $this->input->post('username');

        // Check duplicate username or email
        if ($this->Attendance_model->get_user_by_username_or_email($username, $email)) {
            $this->session->set_flashdata('error', 'Username or email already exists.');
            $this->load->view('signup_form');
            return;
        }

        $data = [
            'email' => $email,
            'username' => $username,
            'password' => $this->input->post('password'), // plaintext to match existing login logic
            'name' => $this->input->post('name'),
            'middlename' => $this->input->post('middlename'),
            'surname' => $this->input->post('surname'),
            'dateofbirth' => $this->input->post('dateofbirth'),
            'gender' => $this->input->post('gender'),
            'companyposition' => $this->input->post('companyposition'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->Attendance_model->create_user($data);

        $this->session->set_flashdata('success', 'Account created. Please login.');
        redirect('Main');
    }


//Data Table Viewed
public function list()
{
    $data['attendance_reports'] = $this->Attendance_model->getData();
    $data['total_reports'] = $this->Attendance_model->getTotalReports();
    $data['total_viewed'] = $this->Attendance_model->getTotalViewed(); // From DB

    $this->load->view('admin/data_table', $data);
}



public function mark_viewed($report_id)
{
    // 1. Increment the DB view count
    $this->Attendance_model->mark_as_viewed($report_id);

    // 2. Redirect to view page
    redirect('Public_page/view_report/' . $report_id);
}



public function get_attendance_data()
{
    $data['attendance_reports'] = $this->Attendance_model->get_all_reports(); // Adjust based on your model
    $data['viewed_reports'] = $this->session->userdata('viewed_reports') ?? [];
    
    // Format rows for DataTables
    $formattedData = [];
    foreach ($data['attendance_reports'] as $row) {
        $report_date = !empty($row['report_date']) ? date('m/d/Y', strtotime($row['report_date'])) : 'N/A';
        $created_at = !empty($row['created_at']) ? date('h:i:s A', strtotime($row['created_at'])) : 'N/A';
        $newBadge = !isset($data['viewed_reports'][$row['id']]) ? '<span class="badge bg-danger new-indicator">NEW</span>' : '';
        
        $formattedData[] = [
            htmlspecialchars($row['division']),
            $report_date,
            $created_at . ' ' . $newBadge,
            '<a href="' . base_url('Public_page/mark_viewed/' . $row['id']) . '" class="btn btn-primary btn-sm">VIEW</a>'
        ];
    }

    echo json_encode(['data' => $formattedData]);
}

    // Sign out user and destroy session
    public function signout() {
        // Clear session data
        $this->session->unset_userdata(['id', 'username', 'password', 'name', 'middlename', 'surname', 'companyposition', 'logged_in']);
        $this->session->sess_destroy();
        redirect('Main');
    }







	

}
