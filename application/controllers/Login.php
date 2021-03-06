<?php

class Login extends CI_Controller
{
    public function index()
    {
        //This function loads the login page.
        $data['title'] = "Login | My Ultimate Collection";
        $data['main_content'] = 'login';
        $this->load->view('includes/template', $data);
    }
    
    public function loginUser()
    {

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('loginCred', 'Username or Email',  'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            //This part of the function loads the login model.

            $this->load->model('loginmodel');

            $loginCred = $this->input->post('loginCred');
            $password = hash('sha256', $this->input->post('password'));

            $userInfo = $this->loginmodel->checkUser($loginCred, $password);

            if($userInfo) {
                
                if($userInfo->account_type == 1) {
                    $data = array(
                        'user_id' => $userInfo->user_id,
                        'is_logged_in' => true,
                        'admin' => false,
                    );
                    $this->session->set_userdata($data);
                    redirect(base_url() . 'home');
                } else {
                    $data = array(
                        'user_id' => $userInfo->user_id,
                        'is_logged_in' => true,
                        'admin' => true,
                    );
                    $this->session->set_userdata($data);
                    redirect(base_url() . 'admin');
                }

            }
            else
            {
                $this->session->set_flashdata('error', 'error'); 
                redirect(base_url() . 'login');
            }
        }
    }

    function logout()
    {
        $this->load->helper('url');

        $this->session->sess_destroy();
        redirect(base_url() . 'home');
    }
}

?>