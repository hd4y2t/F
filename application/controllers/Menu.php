<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mmenu');
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['ni' => $this->session->userdata('ni')])->row_array();
        $data['title'] = 'Menu Management';
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');
    }

    public function input()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == false) {
            $data['user'] = $this->db->get_where('user', ['ni' => $this->session->userdata('ni')])->row_array();
            $data['title'] = 'Menu Management';
            $data['menu'] = $this->db->get('user_menu')->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('menu/index');
            $this->load->view('templates/footer');
        } else {
            $id = '';
            $menu = htmlspecialchars($this->input->post('menu', true));
            $array = array(
                'id' => $id,
                'menu' => $menu
            );
            $this->Mmenu->input($array);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert"> Menu Baru ditambahkan </div>'
            );
            redirect('menu');
        }
    }
    public function delete($id)
    {
        $this->Mmenu->delete($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('menu');
    }

    public function submenu()
    {
        $data['user'] = $this->db->get_where('user', ['ni' => $this->session->userdata('ni')])->row_array();
        $data['title'] = 'Sub Menu';
        $this->load->model('Mmenu', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $array = [

                'title' => $this->input->post('title', true),
                'menu_id' => $this->input->post('menu_id', true),
                'url' => $this->input->post('url', true),
                'icon' => $this->input->post('icon', true),
                'is_active' => $this->input->post('active', true),
            ];
            $this->db->insert('user_sub_menu', $array);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert"> Sub Menu Baru ditambahkan </div>'
            );
        }
    }


    public function deleteSubmenu($id)
    {
        $this->Mmenu->delete($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('menu/submenu');
    }
}
