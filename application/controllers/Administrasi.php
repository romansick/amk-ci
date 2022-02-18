<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Count_model');
        $data['konsumen'] = $this->Count_model->konsumen();
        $data['karyawan'] = $this->Count_model->karyawan();
        $data['transaksi'] = $this->Count_model->transaksi();
        $data['title'] = 'Dashboard';
        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('administrasi/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function add_pesanan_custom($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Tambah Custom Pesanan';

        $this->load->model('Rumah_model');

        $data['transaksi'] = $this->Rumah_model->getAllInvoiceById($id);
        $data['custom'] = $this->db->get_where('custom', ['id' => $id])->result_array();

        $this->form_validation->set_rules('data_custom', 'data_custom', 'required|trim');
        $this->form_validation->set_rules('qty', 'qty', 'required|trim');
        $this->form_validation->set_rules('harga_custom', 'harga', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/head', $data);
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('administrasi/add-custom-pesanan', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data = [
                'data_custom' => $this->input->post('data_custom'),
                'qty' => $this->input->post('qty'),
                'harga_custom' => $this->input->post('harga_custom'),
                'transaksi_id' => $id
            ];

            $this->db->insert('data_custom', $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Custom Pesanan Ditambahkan.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
            );
            redirect('administrasi/custom_pesanan/' . $id);
        }
    }

    public function edit_lokasi($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['lokasi'] = $this->db->get('lokasi_rumah')->result_array();
        $data['title'] = 'Edit Lokasi';

        $data['lokasi'] = $this->db->get_where('lokasi_rumah', ['id' => $id])->row_array();

        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/head', $data);
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('administrasi/edit_lokasi', $data);
            $this->load->view('template/footer', $data);
        } else {
            $lokasi = $this->input->post('lokasi');

            $this->db->set('lokasi', $lokasi);
            $this->db->where('id', $id);
            $this->db->update('lokasi_rumah');

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                  <strong>Success!</strong> Data lokasi berhasil diubah.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
            );
            redirect('administrasi/rumah');
        }
    }

    public function nonactive($id)
    {

        $this->db->set('is_active', 0);
        $this->db->where('id', $id);
        $this->db->update('user');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> User status has been change.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('administrasi/pelanggan');
    }

    public function edittipe($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rumah'] = $this->db->get_where('list_rumah', [$id => 'id'])->result_array();

        $data['title'] = 'Edit Tipe Rumah';

        $data['tipe'] = $this->db->get_where('tipe_rumah', ['id' => $id])->row_array();

        $this->form_validation->set_rules('nama_tipe', 'nama_tipe', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/head', $data);
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('administrasi/edit_tipe', $data);
            $this->load->view('template/footer', $data);
        } else {
            $nama_tipe = $this->input->post('nama_tipe');

            $this->db->set('nama_tipe', $nama_tipe);
            $this->db->where('id', $id);
            $this->db->update('tipe_rumah');
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Data berhasil diubah.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
            );
            redirect('administrasi/tipe');
        }
    }

    public function rumah()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['lokasi'] = $this->db->get('lokasi_rumah')->result_array();
        $data['title'] = 'Data Rumah';

        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/head', $data);
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('administrasi/lokasi', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data = [
                'lokasi'    => $this->input->post('lokasi')
            ];

            $this->db->insert('lokasi_rumah', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Location has been added.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
            );
            redirect('administrasi/rumah');
        }
    }
    public function delete_lokasi($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('lokasi_rumah');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Location has been deleted.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('administrasi/rumah');
    }

    public function listrumah($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rumah'] = $this->db->get_where('list_rumah', [$id => 'id'])->result_array();

        $data['title'] = 'List Rumah';


        $this->load->model('Rumah_model');
        $data['total'] = $this->Rumah_model->getLokasi($id);
        $data['list'] = $this->Rumah_model->getRumah($id);
        $data['rumah'] = $this->Rumah_model->getRumah($id);
        $data['lokasi'] = $this->db->get_where('lokasi_rumah', ['id' => $id])->row_array();

        $data['tersedia'] = $this->Rumah_model->tersedia($id);
        $data['terjual'] = $this->Rumah_model->terjual($id);


        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('administrasi/list_rumah', $data);
        $this->load->view('template/footer', $data);
    }

    public function galleri($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Galleri Rumah';

        $data['rumah'] = $this->db->get_where('list_rumah', ['id' => $id])->row_array();

        $data['galleri'] = $this->db->get_where('galleri', ['list_id' => $id])->result_array();

        $this->form_validation->set_rules('list_id', 'List', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/head', $data);
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('administrasi/galleri', $data);
            $this->load->view('template/footer', $data);
        } else {
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '5048';
                $config['upload_path'] = './rumah/';
                $config['overwrite'] = true;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $ktp = $this->upload->data('file_name');
                    // $this->input->post('image', $ktp);
                }
            }
            $list_id = $this->input->post('list_id');
            $image = $upload_image;

            $this->db->set('list_id', $list_id);
            $this->db->set('image', $image);
            $this->db->insert('galleri');
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Gambar berhasil ditambahkan.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
            );
            redirect('administrasi/galleri/' . $id);
        }
    }

    public function detail($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Detail Rumah';

        $this->load->model('Rumah_model');

        $data['rumah'] = $this->Rumah_model->getRumahAdmin($id);
        $data['galleri'] = $this->db->get_where('galleri', ['list_id' => $id])->result_array();

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('administrasi/detail', $data);
        $this->load->view('template/footer', $data);
    }

    public function tipe()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['tipe'] = $this->db->get('tipe_rumah')->result_array();

        $data['title'] = 'Tipe Rumah';


        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('administrasi/tipe', $data);
        $this->load->view('template/footer', $data);
    }

    public function save_tipe()
    {
        $this->form_validation->set_rules('nama_tipe', 'Tipe', 'required|trim');
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '5048';
            $config['upload_path'] = './rumah/';
            $config['overwrite'] = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $ktp = $this->upload->data('file_name');
                // $this->input->post('image', $ktp);
            }
        }
        $tipe = $this->input->post('nama_tipe');
        $image = $upload_image;

        $this->db->set('nama_tipe', $tipe);
        $this->db->set('image', $image);
        $this->db->insert('tipe_rumah');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Data has been added.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('administrasi/tipe');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tipe_rumah');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Data has been added.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('administrasi/tipe');
    }

    public function pelanggan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['konsumen'] = $this->db->get_where('user', ['role_id' => 2])->result_array();

        $data['title'] = 'Data Pelanggan';
        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('administrasi/pelanggan', $data);
        $this->load->view('template/footer', $data);
    }

    public function transaksi()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Data Transaksi';

        $this->load->model('Rumah_model');

        $data['transaksi'] = $this->Rumah_model->getAllInvoice();


        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('administrasi/transaksi', $data);
        $this->load->view('template/footer', $data);
    }

    public function custom_pesanan($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Custom Pesanan';

        $this->load->model('Rumah_model');

        $data['transaksi'] = $this->Rumah_model->getAllInvoiceById($id);
        $data['custom'] = $this->db->get_where('data_custom', ['transaksi_id' => $id])->result_array();

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('administrasi/custom-pesanan', $data);
        $this->load->view('template/footer', $data);
    }

    public function cetak($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Bayar Pesanan';

        $this->load->model('Rumah_model');

        $data['transaksi'] = $this->Rumah_model->getAllInvoiceById($id);
        $data['custom'] = $this->db->get_where('data_custom', ['transaksi_id' => $id])->result_array();

        $this->load->view('template/head', $data);
        // $this->load->view('template/header', $data);
        // $this->load->view('template/topbar', $data);
        // $this->load->view('template/sidebar', $data);
        $this->load->view('administrasi/cetak', $data);
        // $this->load->view('template/footer', $data);;
    }
}
