<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
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
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function rumah()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Data Rumah';
        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/rumah', $data);
        $this->load->view('template/footer', $data);
    }

    public function lokasi()
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
            $this->load->view('admin/lokasi', $data);
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
            redirect('administrator/lokasi');
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
            $this->load->view('admin/edit_lokasi', $data);
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
            redirect('administrator/lokasi');
        }
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
        $this->load->view('admin/pelanggan', $data);
        $this->load->view('template/footer', $data);
    }


    public function active($id)
    {
        $this->db->set('is_active', 1);
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
        redirect('administrator/pelanggan');
    }

    public function karyawan_nonactive($id)
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
        redirect('administrator/karyawan');
    }
    public function karyawan_active($id)
    {
        $this->db->set('is_active', 1);
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
        redirect('administrator/karyawan');
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
        redirect('administrator/pelanggan');
    }

    public function role()
    {
        $data['title'] = 'Role User Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/head', $data);
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data = [
                'role' => $this->input->post('role')
            ];
            $this->db->insert('user_role', $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Role user has been added.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
            );
            redirect('administrator/role');
        }
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role User Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('template/footer', $data);
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                <strong>Success!</strong> Role user has been changed.
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
            </div>'
        );
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
        $this->load->view('admin/tipe', $data);
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
        redirect('administrator/tipe');
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
        $this->load->view('admin/list_rumah', $data);
        $this->load->view('template/footer', $data);
    }

    public function deleterumah($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('list_rumah');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                  <strong>Success!</strong> Rumah berhasil dihapus.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );

        redirect('administrator/lokasi');
    }
    public function deletetipe($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tipe_rumah');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                  <strong>Success!</strong> Tipe rumah berhasil dihapus.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );

        redirect('administrator/tipe');
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
            $this->load->view('admin/edit_tipe', $data);
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
            redirect('administrator/tipe');
        }
    }

    public function editrumah($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rumah'] = $this->db->get_where('list_rumah', [$id => 'id'])->result_array();

        $data['title'] = 'List Rumah';

        $this->load->model('Rumah_model');
        $data['rumah'] = $this->Rumah_model->getRumahById($id);

        $data['tipe'] = $this->db->get('tipe_rumah')->result_array();
        $data['lokasi'] = $this->db->get('lokasi_rumah')->result_array();

        $this->form_validation->set_rules('tipe_id', 'tipe_id', 'required');
        $this->form_validation->set_rules('lokasi_id', 'lokasi_id', 'required');
        $this->form_validation->set_rules('blok', 'blok', 'required');
        $this->form_validation->set_rules('nomor', 'nomor', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/head', $data);
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/edit_rumah', $data);
            $this->load->view('template/footer', $data);
        } else {
            $tipe_id = $this->input->post('tipe_id');
            $lokasi_id = $this->input->post('lokasi_id');
            $blok = $this->input->post('blok');
            $nomor = $this->input->post('nomor');
            $harga = $this->input->post('harga');

            $this->db->set('tipe_id', $tipe_id);
            $this->db->set('lokasi_id', $lokasi_id);
            $this->db->set('blok', $blok);
            $this->db->set('nomor', $nomor);
            $this->db->set('harga', $harga);
            $this->db->where('id', $id);
            $this->db->update('list_rumah');
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Data berhasil diubah.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
            );
            redirect('administrator/listrumah/' . $id);
        }
    }

    public function bank()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bank'] = $this->db->get('bank')->result_array();

        $this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required|trim');
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
        $this->form_validation->set_rules('pemilik', 'Pemilik', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Bank';

            $this->load->view('template/head', $data);
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/bank', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data = [
                'no_rek' => $this->input->post('no_rek'),
                'nama_bank' => $this->input->post('nama_bank'),
                'pemilik' => $this->input->post('pemilik'),
            ];

            $this->db->insert('bank', $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Bank has been added.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
            );
            redirect('administrator/bank');
        }
    }

    public function editbank($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Edit Bank';
        $this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required|trim');
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
        $this->form_validation->set_rules('pemilik', 'Pemilik', 'required|trim');
        $data['bank'] = $this->db->get_where('bank', ['id' => $id])->row_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('template/head', $data);
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/edit_bank', $data);
            $this->load->view('template/footer', $data);
        } else {

            $no_rek = $this->input->post('no_rek');
            $nama_bank = $this->input->post('nama_bank');
            $pemilik = $this->input->post('pemilik');

            $this->db->set('no_rek', $no_rek);
            $this->db->set('nama_bank', $nama_bank);
            $this->db->set('pemilik', $pemilik);
            $this->db->where('id', $id);
            $this->db->update('bank');

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                  <strong>Success!</strong> Data bank berhasil diubah.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
            );
            redirect('administrator/bank');
        }
    }
    public function deletebank($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('bank');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                  <strong>Success!</strong> Bank has been delete.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('administrator/bank');
    }

    public function addhouse($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Tambah Rumah';
        $data['lokasi'] = $this->db->get_where('lokasi_rumah', ['id' => $id])->row_array();
        $data['tipe'] = $this->db->get('tipe_rumah')->result_array();

        $this->form_validation->set_rules('tipe_id', 'Tipe id', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required|trim');
        $this->form_validation->set_rules('blok', 'blok', 'required|trim');
        $this->form_validation->set_rules('nomor', 'nomor', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/head', $data);
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/addhouse', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data = [
                'tipe_id' => $this->input->post('tipe_id'),
                'lokasi_id' => $id,
                'status' => 'AVAILABLE',
                'harga' => $this->input->post('harga'),
                'blok' => $this->input->post('blok'),
                'nomor' => $this->input->post('nomor'),
            ];

            $this->db->insert('list_rumah', $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Data rumah berhasil ditambahkan.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
            );
            redirect('administrator/listrumah/' . $id);
        }
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
            $this->load->view('admin/galleri', $data);
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
            redirect('administrator/galleri/' . $id);
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
        $this->load->view('admin/detail', $data);
        $this->load->view('template/footer', $data);
    }

    public function custom()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Data Custom';

        $data['custom'] = $this->db->get('custom')->result_array();

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/custom', $data);
        $this->load->view('template/footer', $data);
    }

    public function addcustom()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Add Custom';

        $data['custom'] = $this->db->get('custom')->result_array();

        $this->form_validation->set_rules('custom', 'Custom', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/head', $data);
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/add_custom', $data);
            $this->load->view('template/footer', $data);
        } else {

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '5048';
                $config['upload_path'] = './custom/';
                $config['overwrite'] = true;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $ktp = $this->upload->data('file_name');
                    // $this->input->post('image', $ktp);
                }
            }
            $custom = $this->input->post('custom');
            $deskripsi = $this->input->post('deskripsi');
            $image = $upload_image;
            $harga = $this->input->post('harga');
            $is_active = 1;

            $this->db->set('custom', $custom);
            $this->db->set('deskripsi', $deskripsi);
            $this->db->set('image', $image);
            $this->db->set('harga', $harga);
            $this->db->set('is_active', $is_active);
            $this->db->insert('custom');
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Data custom berhasil ditambahkan.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
            );
            redirect('administrator/custom');
        }
    }

    public function editcustom($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Edit Data Custom';

        $data['custom'] = $this->db->get_where('custom', ['id' => $id])->row_array();


        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/edit_custom', $data);
        $this->load->view('template/footer', $data);
    }

    public function save_editcustom($id)
    {
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '5048';
            $config['upload_path'] = './custom/';
            $config['overwrite'] = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $ktp = $this->upload->data('file_name');
                // $this->input->post('image', $ktp);
            }
        }

        $custom = $this->input->post('custom');
        $deskripsi = $this->input->post('deskripsi');
        $image = $upload_image;
        $harga = $this->input->post('harga');

        $this->db->set('custom', $custom);
        $this->db->set('deskripsi', $deskripsi);
        $this->db->set('image', $image);
        $this->db->set('harga', $harga);
        $this->db->where('id', $id);
        $this->db->update('custom');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Data custom berhasil diperbaharui.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('administrator/custom');
    }

    public function deletecustom($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('custom');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Data custom berhasil dihapus.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('administrator/custom');
    }

    public function active_custom($id)
    {
        $this->db->set('is_active', 1);
        $this->db->where('id', $id);
        $this->db->update('custom');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Data custom berhasil diaktifkan.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('administrator/custom');
    }
    public function inactive_custom($id)
    {
        $this->db->set('is_active', 0);
        $this->db->where('id', $id);
        $this->db->update('custom');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Data custom berhasil dinonaktifkan.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('administrator/custom');
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
        $this->load->view('admin/transaksi', $data);
        $this->load->view('template/footer', $data);
    }

    public function bayar($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Invoice Pesanan';

        $this->load->model('Rumah_model');

        $data['transaksi'] = $this->Rumah_model->getAllInvoiceById($id);

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/bayar', $data);
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
        $this->load->view('admin/cetak', $data);
        // $this->load->view('template/footer', $data);;
    }

    public function konfirmasi($id)
    {
        $status = 1;

        $this->db->set('status', $status);
        $this->db->where('id', $id);
        $this->db->update('transaksi');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Pembayaran Dikonfirmasi.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('administrator/transaksi');
    }
    public function terima($id)
    {
        $status = 1;

        $this->db->set('status', $status);
        $this->db->where('id', $id);
        $this->db->update('transaksi');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Pembayaran Dikonfirmasi.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('administrator/transaksi');
    }
    public function tolak($id)
    {
        $status = 2;

        $this->db->set('status', $status);
        $this->db->where('id', $id);
        $this->db->update('transaksi');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Pembayaran Dikonfirmasi.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('administrator/transaksi');
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
        $this->load->view('admin/custom-pesanan', $data);
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
            $this->load->view('admin/add-custom-pesanan', $data);
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
            redirect('administrator/custom_pesanan/' . $id);
        }
    }

    public function karyawan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('User_model');
        $data['karyawan'] = $this->User_model->getKaryawan();
        $data['role'] = $this->db->get('user_role')->result_array();

        $data['title'] = "Data Karyawan";

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/karyawan', $data);
        $this->load->view('template/footer', $data);
    }
    public function register()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email Sudah Terdaftar!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No Hp', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
            'min_length' => 'Password terlalu pendek. Minimal 6 karakter!'
        ]);

        $data = [
            'email'        => htmlspecialchars($this->input->post('email', true)),
            'username'        => htmlspecialchars($this->input->post('username', true)),
            'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'image'        => 'default.png',
            'no_hp'        => htmlspecialchars($this->input->post('no_hp', true)),
            'role_id'      => $this->input->post('role_id'),
            'is_active'    => 1,
        ];

        $this->db->insert('user', $data);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
									<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
									<strong>Success!</strong> Karyawan berhasil ditambahkan.
									<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                </div>'
        );

        redirect('administrator/karyawan');
    }

    public function karyawan_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
									<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
									<strong>Success!</strong> Karyawan berhasil dihapus.
									<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                </div>'
        );

        redirect('administrator/karyawan');
    }
}
