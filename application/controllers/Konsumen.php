<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsumen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Dashboard';
        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('konsumen/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function listrumah()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'List Rumah';

        $data['lokasi'] = $this->db->get('lokasi_rumah')->result_array();

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('konsumen/list-rumah', $data);
        $this->load->view('template/footer', $data);
    }

    public function datalist($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rumah'] = $this->db->get_where('list_rumah', [$id => 'id'])->result_array();

        $data['title'] = 'List Rumah';


        $this->load->model('Rumah_model');
        $data['total'] = $this->Rumah_model->getLokasi($id);
        $data['list'] = $this->Rumah_model->getRumah($id);

        $data['tersedia'] = $this->Rumah_model->tersedia($id);

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('konsumen/data-list', $data);
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
        $this->load->view('konsumen/detail', $data);
        $this->load->view('template/footer', $data);
    }

    public function pesanrumah($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Buat Pesanan';

        $this->load->model('Rumah_model');

        $data['rumah'] = $this->Rumah_model->getRumahById($id);

        $data['custom'] = $this->db->get('custom')->result_array();

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('konsumen/pesan-rumah', $data);
        $this->load->view('template/footer', $data);
    }

    public function checkout($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Checkout Pesanan';

        $this->load->model('Rumah_model');

        $data['rumah'] = $this->Rumah_model->getRumahById($id);

        $data['custom'] = $this->db->get('custom')->result_array();

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('konsumen/checkout', $data);
        $this->load->view('template/footer', $data);
    }

    public function makeinvoice()
    {
        $this->form_validation->set_rules('rumah_id', 'Rumah ID', 'required|trim');
        $this->form_validation->set_rules('user_id', 'User ID', 'required|trim');

        $data = [
            'rumah_id' => $this->input->post('rumah_id'),
            'user_id' => $this->input->post('user_id'),
            'tanggal_pemesanan' => date('Y-m-d'),
            'status' => 0,
        ];

        $user_id = $this->input->post('user_id');
        $status = "NOT AVAILABLE";
        $rumah_id = $this->input->post('rumah_id');

        $this->db->set('user_id', $user_id);
        $this->db->set('status', $status);
        $this->db->where('id', $rumah_id);
        $this->db->update('list_rumah');

        $this->db->insert('transaksi', $data);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Invoice berhasil dibuat.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('konsumen/invoice');
    }

    public function invoice()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Invoice Pesanan';

        $this->load->model('Rumah_model');

        $data['transaksi'] = $this->Rumah_model->getInvoiceByUser();

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('konsumen/invoice', $data);
        $this->load->view('template/footer', $data);
    }

    public function bayar($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Bayar Pesanan';

        $this->load->model('Rumah_model');

        $data['transaksi'] = $this->Rumah_model->getInvoiceByUserById($id);

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('konsumen/bayar', $data);
        $this->load->view('template/footer', $data);
    }

    public function tunai($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Bayar Pesanan';

        $this->load->model('Rumah_model');

        $data['transaksi'] = $this->Rumah_model->getInvoiceByUserById($id);
        $data['custom'] = $this->db->get_where('data_custom', ['transaksi_id' => $id])->result_array();

        $data['bank'] = $this->db->get('bank')->result_array();

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('konsumen/tunai', $data);
        $this->load->view('template/footer', $data);
    }

    public function kpr($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Bayar Pesanan';

        $this->load->model('Rumah_model');

        $data['transaksi'] = $this->Rumah_model->getInvoiceByUserById($id);

        $data['custom'] = $this->db->get_where('data_custom', ['transaksi_id' => $id])->result_array();

        $data['bank'] = $this->db->get('bank')->result_array();

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('konsumen/kpr', $data);
        $this->load->view('template/footer', $data);
    }

    public function save_dp_tunai($id)
    {
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '5048';
            $config['upload_path'] = './tunai/';
            $config['overwrite'] = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $ktp = $this->upload->data('file_name');
                // $this->input->post('image', $ktp);
            }
        }

        $metode_bayar = 'TUNAI';
        $tanggal_pembayaran = date('Y-m-d');
        $image = $upload_image;
        $status_pembayaran = 1;


        $this->db->set('metode_bayar', $metode_bayar);
        $this->db->set('tanggal_pembayaran', $tanggal_pembayaran);
        $this->db->set('image', $image);
        $this->db->set('status_pembayaran', $status_pembayaran);
        $this->db->where('id', $id);
        $this->db->update('transaksi');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Data pembayaran ditambahkan. Silahkan hubungi Customer Service jika dalam 10 menit pembayaran belum dikonfirmasi.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('konsumen/invoice');
    }

    public function save_dp_kpr($id)
    {
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '5048';
            $config['upload_path'] = './tunai/';
            $config['overwrite'] = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $ktp = $this->upload->data('file_name');
                // $this->input->post('image', $ktp);
            }
        }

        $metode_bayar = 'KPR';
        $tanggal_pembayaran = date('Y-m-d');
        $image = $upload_image;
        $status_pembayaran = 1;


        $this->db->set('metode_bayar', $metode_bayar);
        $this->db->set('tanggal_pembayaran', $tanggal_pembayaran);
        $this->db->set('image', $image);
        $this->db->set('status_pembayaran', $status_pembayaran);
        $this->db->where('id', $id);
        $this->db->update('transaksi');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success solid alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                <strong>Success!</strong> Data pembayaran ditambahkan. Silahkan hubungi Customer Service jika dalam 10 menit pembayaran belum dikonfirmasi.
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>'
        );
        redirect('konsumen/invoice');
    }

    public function cetak($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Cetak Invoice Pesanan';

        $this->load->model('Rumah_model');

        $data['transaksi'] = $this->Rumah_model->getInvoiceByUserById($id);
        $data['custom'] = $this->db->get_where('data_custom', ['transaksi_id' => $id])->result_array();

        $this->load->view('template/head', $data);
        // $this->load->view('template/header', $data);
        // $this->load->view('template/topbar', $data);
        // $this->load->view('template/sidebar', $data);
        $this->load->view('konsumen/cetak', $data);
        // $this->load->view('template/footer', $data);
    }
}
