<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

	/*--construct--*/
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_id') == '') {$this->session->set_flashdata('error', 'Oops you need to be logged in to access the page!'); redirect('login'); }
    
        $this->load->model('m_department');
        $this->load->library('form_validation');
        header_remove("X-Powered-By"); 
        header("X-Frame-Options: DENY");
        header("X-XSS-Protection: 1; mode=block");
        header("X-Content-Type-Options: nosniff");
        header("Strict-Transport-Security: max-age=31536000");
        header("Content-Security-Policy: frame-ancestors none");
        header("Referrer-Policy: no-referrer-when-downgrade");
        header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
        header("Pragma: no-cache"); //HTTP 1.0
    }
    /**
     * Admin login-> load view page
     * url : login
    **/

    public function list()
	{
		$data['title'] = 'Department - Kannada University';
		$data['page_name'] = 'Department';

        $this->load->library('pagination');

        $config['base_url'] = base_url('department/list');
        $config['total_rows'] = $this->m_department->get_count();
        $config['per_page'] = 10;

        $config['full_tag_open'] = '<div class="d-flex justify-content-center"><div class="pagination-wrap hstack gap-2">';
        $config['full_tag_close'] = '</div></div>';
        $config['first_tag_open'] = '<div class="page-item pagination-prev">';
        $config['first_tag_close'] = '</div>';
        $config['prev_tag_open'] = '<div class="page-item pagination-prev">';
        $config['prev_tag_close'] = '</div>';
        $config['last_tag_open'] = '<div class="page-item pagination-next">';
        $config['last_tag_close'] = '</div>';
        $config['next_tag_open'] = '<div class="page-item pagination-next">';
        $config['next_tag_close'] = '</div>';
        $config['num_tag_open'] = '<div class="page-item pagination-next">';
        $config['num_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<div class="page-item pagination-next" style="background: var(--vz-border-color);"><b>';
        $config['cur_tag_close'] = '</b></div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['data'] = $this->m_department->get_list($config["per_page"], $page);

        $this->load->view('pages/department/list.php', $data);
    }

	public function create()
	{
		$data['title'] = 'Department - Kannada University';
		$data['page_name'] = 'Department';

        $this->security->xss_clean($_POST);
        $this->form_validation->set_rules('code', 'Department Code', 'trim|required|min_length[3]|max_length[200]|is_unique[department.code]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s', 'is_unique'=>'This department code is already in use'));
        $this->form_validation->set_rules('name', 'Department Name', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
        if($this->form_validation->run()){
            $request['code'] = $this->input->post('code');
            $request['name'] = $this->input->post('name');
            if ($this->m_department->create($request)) {
                $this->session->set_flashdata('success', 'Department created Successfully');
                redirect('department/create', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong please try again!');
                redirect('department/create', 'refresh');
            }
        }else{
            $this->load->view('pages/department/create.php', $data);
        }
		
	}
	
    public function edit($id)
	{
		$data['title'] = 'Department - Kannada University';
		$data['page_name'] = 'Department';
		$data['id'] = $id;

        $department_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_department->get_data($department_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }

        $this->security->xss_clean($_POST);

        if($data['data']->code==$this->input->post('code')){
            $this->form_validation->set_rules('code', 'Department Code', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s', 'is_unique'=>'This department code is already in use'));
        }else{
            $this->form_validation->set_rules('code', 'Department Code', 'trim|required|min_length[3]|max_length[200]|is_unique[department.code]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s', 'is_unique'=>'This department code is already in use'));
        }

        $this->form_validation->set_rules('name', 'Department Name', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
        if($this->form_validation->run()){
            $request['code'] = $this->input->post('code');
            $request['name'] = $this->input->post('name');
            if ($this->m_department->update($department_id, $request)!=FALSE) {
                $this->session->set_flashdata('success', 'Department update Successfully');
                redirect('department/edit/'.$this->encryption_url->safe_b64encode($department_id), 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong please try again!');
                redirect('department/edit/'.$this->encryption_url->safe_b64encode($department_id), 'refresh');
            }
        }else{
            $this->load->view('pages/department/edit.php', $data);
        }
		
	}

    public function delete($id)
	{
        $department_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_department->get_data($department_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }
        if ($this->m_department->delete($department_id)!=FALSE) {
            $this->session->set_flashdata('success', 'Department deleted Successfully');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'Something went wrong please try again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

}