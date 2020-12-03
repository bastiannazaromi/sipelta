<?php

function enkrip($string){
	$bumbu = md5(str_replace("=", "", base64_encode("maykomputer.com")));
	$katakata = false;
	$metodeenkrip = "AES-256-CBC";
	$kunci = hash('sha256', $bumbu);
	$kodeiv = substr(hash('sha256', $bumbu), 0, 16);
	
	$katakata = str_replace("=", "", openssl_encrypt($string, $metodeenkrip, $kunci, 0, $kodeiv));
	$katakata = str_replace("=", "", base64_encode($katakata));
	
    return $katakata;
}

function dekrip($string){
	$bumbu = md5(str_replace("=", "", base64_encode("maykomputer.com")));
	$katakata = false;
	$metodeenkrip = "AES-256-CBC";
	$kunci = hash('sha256', $bumbu);
	$kodeiv = substr(hash('sha256', $bumbu), 0, 16);
	
    $katakata = openssl_decrypt(base64_decode($string), $metodeenkrip, $kunci, 0, $kodeiv);
    return $katakata;
}

function foto($id)
{
    $CI = &get_instance();

    $CI->load->model('M_Admin', 'admin');

    $admin = $CI->admin->getOne($CI->session->userdata('id'));

    return $admin[0]['foto'];
}

function nama($id)
{
    $CI = &get_instance();

    $CI->load->model('M_Admin', 'admin');

    $admin = $CI->admin->getOne($CI->session->userdata('id'));

    return $admin[0]['nama'];
}

function level($id)
{
    $CI = &get_instance();

    $CI->load->model('M_Admin', 'admin');

    $admin = $CI->admin->getOne($CI->session->userdata('id'));

    return $admin[0]['level'];
}

function status_file($nim)
{
    $CI = &get_instance();

    if ($CI->session->userdata('semester') == 6)
    {
        $jurnal = $CI->jurnal->getOne($nim);
        $laporan_pdf = $CI->laporan_pdf->getOne($nim);
        $lembar_produk = $CI->lembar_produk->getOne($nim);
        $pengesahan = $CI->pengesahan->getOne($nim);
        $persetujuan = $CI->persetujuan->getOne($nim);
        $brosur = $CI->brosur->getOne($nim);
    
        if ($jurnal != null && $laporan_pdf != null && $lembar_produk != null && $pengesahan != null && $persetujuan != null && $brosur != null) {
    
            if ($jurnal[0]['status'] == 'ACC' && $laporan_pdf[0]['status'] == 'ACC' && $lembar_produk[0]['status'] == 'ACC' && $pengesahan[0]['status'] == 'ACC' && $persetujuan[0]['status'] == 'ACC' && $brosur[0]['status'] == 'ACC') {
                return 'Terverifikasi';
            } else {
                return 'Menunggu verifikasi';
            }
        } else {
            return 'File belum lengkap';
        }
    }
    else
    {
        $laporan_pdf = $CI->laporan_pdf->getOne($nim);
        $pengesahan = $CI->pengesahan->getOne($nim);
        $brosur = $CI->brosur->getOne($nim);
    
        if ($laporan_pdf != null && $pengesahan != null) {
    
            if ($laporan_pdf[0]['status'] == 'ACC' && $pengesahan[0]['status'] == 'ACC' ) {
                return 'Terverifikasi';
            } else {
                return 'Menunggu verifikasi';
            }
        } else {
            return 'File belum lengkap';
        }
    }
}

function cek_biodata($nim)
{
    $CI = &get_instance();

    $mahasiswa = $CI->mahasiswa->getOne($nim);

    $foto = $mahasiswa[0]['foto'];
    $no = $mahasiswa[0]['no_telepon'];
    $email = $mahasiswa[0]['email'];

    if ($foto == "default.jpg" || $no == null || $email == nulL) {
        $CI->session->set_flashdata('flash-error', 'Lengkapi profile Anda !!');
        redirect('user/dapur/profile');
    }
}

function bulan()
{
    $bulan = Date('m');
    switch ($bulan) {
        case 1:
            $bulan = "Januari";
            break;
        case 2:
            $bulan = "Februari";
            break;
        case 3:
            $bulan = "Maret";
            break;
        case 4:
            $bulan = "April";
            break;
        case 5:
            $bulan = "Mei";
            break;
        case 6:
            $bulan = "Juni";
            break;
        case 7:
            $bulan = "Juli";
            break;
        case 8:
            $bulan = "Agustus";
            break;
        case 9:
            $bulan = "September";
            break;
        case 10:
            $bulan = "Oktober";
            break;
        case 11:
            $bulan = "November";
            break;
        case 12:
            $bulan = "Desember";
            break;

        default:
            $bulan = Date('F');
            break;
    }
    return $bulan;
}


function tanggal_indo()
{
    $tanggal = Date('d') . " " . bulan() . " " . Date('Y');
    return $tanggal;
}

function semester()
{
    $CI = &get_instance();
    
    $CI->db->select('semester');
    $CI->db->from('tb_mahasiswa');
    $CI->db->group_by('semester');
    $CI->db->order_by('semester');

    return $CI->db->get()->result_array();
}