<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pimpinan extends CI_Controller
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
        $this->load->view('pimpinan/index', $data);
        $this->load->view('template/footer', $data);
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
        $this->load->view('pimpinan/pelanggan', $data);
        $this->load->view('template/footer', $data);
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
            $this->load->view('pimpinan/bank', $data);
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
            redirect('pimpinan/bank');
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
            $this->load->view('pimpinan/edit_bank', $data);
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
            redirect('pimpinan/bank');
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
        redirect('pimpinan/bank');
    }

    public function rumah()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rumah'] = $this->db->get_where('list_rumah', [$id => 'id'])->result_array();

        $data['title'] = 'List Rumah';

        $data['tipe'] = $this->db->get('tipe_rumah')->result_array();
        $data['lokasi'] = $this->db->get('lokasi_rumah')->result_array();

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pimpinan/rumah', $data);
        $this->load->view('template/footer', $data);
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
        $this->load->view('pimpinan/list_rumah', $data);
        $this->load->view('template/footer', $data);
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
        $this->load->view('pimpinan/detail', $data);
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
        $this->load->view('pimpinan/transaksi', $data);
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
        $this->load->view('pimpinan/custom-pesanan', $data);
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
        $this->load->view('pimpinan/cetak', $data);
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
        redirect('pimpinan/transaksi');
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

        redirect('pimpinan/karyawan');
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
        redirect('pimpinan/karyawan');
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
        redirect('pimpinan/karyawan');
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
        $this->load->view('pimpinan/karyawan', $data);
        $this->load->view('template/footer', $data);
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

        redirect('pimpinan/karyawan');
    }
}
