<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');

		$this->load->model('Company_model');
		$this->load->model('Kontak_model');
		$this->load->model('Ion_auth_model');
		$this->load->model('Wilayah_model');

		$this->data['module'] = 'Customer';
		$this->data['company_data'] 			= $this->Company_model->get_by_company();
		$this->data['kontak'] 						= $this->Kontak_model->get_all();
	}

	public function register()
	{
		$this->data['title'] 							= 'Register/ Login';

		// Cek sudah/ belum login
		if ($this->ion_auth->logged_in()){redirect(base_url());}

		/* setting bawaan ionauth */
		$tables 					= $this->config->item('tables','ion_auth');
		$identity_column 	= $this->config->item('identity','ion_auth');

		$this->data['identity_column'] = $identity_column;

		// validasi form input
		$this->form_validation->set_rules('name', 'Nama', 'required|trim|is_unique[users.name]');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('phone', 'No. HP', 'trim|numeric');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required');

		// set pesan
		$this->form_validation->set_message('required', '{field} mohon diisi');
		$this->form_validation->set_message('valid_email', 'Format email tidak benar');
		$this->form_validation->set_message('numeric', 'No. HP harus angka');
		$this->form_validation->set_message('matches', 'Password baru dan konfirmasi harus sama');
		$this->form_validation->set_message('is_unique', '%s telah terpakai, silahkan ganti dengan yang lain');

		// cek form_validation dan register ke db
		if ($this->form_validation->run() == true)
		{
			$email    = strtolower($this->input->post('email'));
			$identity = ($identity_column==='email') ? $email : $this->input->post('identity');
			$password = $this->input->post('password');

			// data tambahan yang untuk dimasukkan pada tabel
			$additional_data = array(
				'name' 				=> $this->input->post('name'),
				'username'  	=> $this->input->post('username'),
				'phone'      	=> $this->input->post('phone'),
				'address'    	=> $this->input->post('alamat'),
				'provinsi' 		=> $this->input->post('provinsi_id'),
				'kota'   			=> $this->input->post('kota_id'),
				'usertype'    => '4',
			);

			// mengirimkan data yang sudah disediakan diatas $additional_data $email, $identity $password
			$this->ion_auth->register($identity, $password, $email, $additional_data);

			// check to see if we are creating the user | redirect them back to the admin page
			$this->session->set_flashdata('message', '<div class="alert alert-success alert">Registrasi Berhasil, silahkan login untuk mulai booking lapangan.</div>');
			redirect(base_url());
		}
			else
			{
				// display the create user form | set the flash data error message if there is one
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

				$this->data['name'] = array(
					'name'  => 'name',
					'id'    => 'name',
					'type'  => 'text',
					'class'  => 'form-control',
					'value' => $this->form_validation->set_value('name'),
				);
				$this->data['username'] = array(
					'name'  => 'username',
					'id'    => 'username',
					'class'  => 'form-control',
					'value' => $this->form_validation->set_value('username'),
				);
				$this->data['email'] = array(
					'name'  => 'email',
					'id'    => 'email',
					'class'  => 'form-control',
					'value' => $this->form_validation->set_value('email'),
				);
				$this->data['phone'] = array(
					'name'  => 'phone',
					'id'    => 'phone',
					'class'  => 'form-control',
					'value' => $this->form_validation->set_value('phone'),
				);
				$this->data['password'] = array(
					'name'  => 'password',
					'id'    => 'password',
					'class'  => 'form-control',
					'value' => $this->form_validation->set_value('password'),
				);
				$this->data['password_confirm'] = array(
					'name'  => 'password_confirm',
					'id'    => 'password_confirm',
					'class'  => 'form-control',
					'value' => $this->form_validation->set_value('password_confirm'),
				);
				$this->data['alamat'] = array(
					'name'  => 'alamat',
					'id'    => 'alamat',
					'class'  => 'form-control',
					'cols'  => '2',
					'rows'  => '2',
					'value' => $this->form_validation->set_value('alamat'),
				);
				$this->data['provinsi_id'] = array(
		      'name'        => 'provinsi_id',
		      'id'          => 'provinsi_id',
		      'class'       => 'form-control',
		      'onChange'    => 'tampilKota()',
		      'required'    => '',
		    );
		    $this->data['kota_id'] = array(
		      'name'        => 'kota_id',
		      'id'          => 'kota_id',
		      'class'       => 'form-control',
		      'required'    => '',
		    );

				$this->data['ambil_provinsi'] = $this->Wilayah_model->get_provinsi();

				$this->load->view('front/auth/register', $this->data);
			}
	}

	public function pilih_kota()
	{
		$this->data['kota']=$this->Wilayah_model->get_kota($this->uri->segment(3));
		$this->load->view('front/auth/kota',$this->data);
	}

	public function login()
	{
		$this->data['title'] 							= 'Login';

		// cek sudah login/belum
		if($this->ion_auth->logged_in()){redirect(base_url());}


		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'callback_identity_check');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');
		// $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required');
		$this->form_validation->set_message('required', '{field} mohon diisi');

	
		if ($this->form_validation->run() == FALSE )
		{
			// set pesan error dari ion_auth
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			// email atau username yang diatur pada config ion_auth
			$this->data['identity'] = array(
				'name' 	=> 'identity',
				'id'    => 'identity',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array(
				'name' 	=> 'password',
				'id'   	=> 'password',
				'class' => 'form-control',
			);

			// _render_page == view
			$this->_render_page('front/auth/login', $this->data);
		}
			else
			{
				// cek user login dan menekan tombol remember me
				$remember = (bool) $this->input->post('remember');

				// cek keberhasilan login dengan function login_front
				if ($this->ion_auth->login_front($this->input->post('identity'), $this->input->post('password'), $remember))
				{
					//set message dan redirect ke home apabila berhasil login
					$this->session->set_flashdata('message', '<div class="alert alert-block alert-success"><i class="ace-icon fa fa-bullhorn green"></i> Login Berhasil</div>');
					redirect(base_url(), 'refresh');
				}
					else
					{
						//set message dan redirect ke form login apabila gagal login
						$this->session->set_flashdata('message', $this->ion_auth->errors(''));
						redirect('auth/login', 'refresh');
					}

			}
	}

	public function logout()
	{
		$logout = $this->ion_auth->logout();
		redirect(base_url(), 'refresh');
	}

	// cek identity
	public function identity_check($str){
		$this->load->model('Ion_auth_model');
		if ($this->ion_auth_model->identity_check($str)){
			return TRUE;
		}
		else{
			$this->form_validation->set_message('identity_check','Username tidak ditemukan');
			return FALSE;
		}
	}

	public function profil()
	{
		$this->data['title'] 			= 'Profil Saya';

		$this->data['profil'] = $this->Ion_auth_model->profil();

		$this->load->view('front/auth/profil', $this->data);
	}


	// Aktivasi user
	public function activate($id, $code=false){
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		if($activation)
		{
			// jika berhasil aktivasi akun
			$this->session->set_flashdata('message', '
			<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
				<i class="ace-icon fa fa-bullhorn green"></i> Akun berhasil diaktifkan
			</div>');
			redirect("auth/login", 'refresh');
		}
		else
		{
			$this->session->set_flashdata('message', '
			<div class="alert alert-block alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
				<i class="ace-icon fa fa-bullhorn green"></i> Akun gagal diaktifkan
			</div>');
			redirect("auth/login", 'refresh');
		}
	}

	public function _get_csrf_nonce(){
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	public function _valid_csrf_nonce(){
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
		$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	// sama seperti view
	public function _render_page($view, $data=null, $returnhtml=false){

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}

}
