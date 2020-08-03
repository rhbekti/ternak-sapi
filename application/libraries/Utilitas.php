<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Utilitas
{
		protected $ci;

		function __construct()
		{
			$this->ci =& get_instance();
		}
		function PDFprint($html,$filename,$kertas,$orientasi)
		{
			$dompdf = new Dompdf\Dompdf();
			//apa yang akan di print
			$dompdf->loadHtml($html);
			//untuk mengeset kertas
			$dompdf->setPaper($kertas,$orientasi);
			//render untuk pdf
			$dompdf->render();
			//output file pdf
			$dompdf->stream($filename, array("Attachment" => false));
		}
		function user_login()
		{
			$this->ci->load->model('M_pengguna');
			$user = $this->ci->session->userdata('id');
			$user_data = $this->ci->M_pengguna->get($user)->row();
			return $user_data;
		}
}
