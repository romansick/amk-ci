<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $data['title'] = "Home";
        $this->load->view('template/home/head', $data);
        $this->load->view('template/home/header', $data);
        $this->load->view('template/home/sidebar', $data);
        $this->load->view('home/index', $data);
        $this->load->view('template/home/footer', $data);
    }

    public function lokasi()
    {
        $data['title'] = "Lokasi";
        $data['lokasi'] = $this->db->get('lokasi_rumah')->result_array();

        $this->load->view('template/home/head', $data);
        $this->load->view('template/home/header', $data);
        $this->load->view('template/home/sidebar', $data);
        $this->load->view('home/lokasi', $data);
        $this->load->view('template/home/footer', $data);
    }

    public function listrumah($id)
    {
        $data['title'] = 'List Rumah';


        $this->load->model('Rumah_model');
        $data['total'] = $this->Rumah_model->getLokasi($id);
        $data['list'] = $this->Rumah_model->getRumah($id);
        $data['rumah'] = $this->Rumah_model->getRumah($id);
        $data['lokasi'] = $this->db->get_where('lokasi_rumah', ['id' => $id])->row_array();

        $data['tersedia'] = $this->Rumah_model->tersedia($id);
        $data['terjual'] = $this->Rumah_model->terjual($id);


        $this->load->view('template/home/head', $data);
        $this->load->view('template/home/header', $data);
        $this->load->view('template/home/sidebar', $data);
        $this->load->view('home/list_rumah', $data);
        $this->load->view('template/home/footer', $data);
    }

    public function galleri($id)
    {
        $data['title'] = 'Galleri Rumah';

        $data['rumah'] = $this->db->get_where('list_rumah', ['id' => $id])->row_array();

        $data['galleri'] = $this->db->get_where('galleri', ['list_id' => $id])->result_array();

        $this->load->view('template/home/head', $data);
        $this->load->view('template/home/header', $data);
        $this->load->view('template/home/sidebar', $data);
        $this->load->view('home/galleri', $data);
        $this->load->view('template/home/footer', $data);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Rumah';

        $this->load->model('Rumah_model');

        $data['rumah'] = $this->Rumah_model->getRumahAdmin($id);
        $data['galleri'] = $this->db->get_where('galleri', ['list_id' => $id])->result_array();

        $this->load->view('template/home/head', $data);
        $this->load->view('template/home/header', $data);
        $this->load->view('template/home/sidebar', $data);
        $this->load->view('home/detail', $data);
        $this->load->view('template/home/footer', $data);
    }
}
