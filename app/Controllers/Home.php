<?php

namespace App\Controllers;

use App\Models\MainM;
use DateTime;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends BaseController
{
    protected $mainm;
    function __construct()
    {
        helper('my_helpers');
        $this->mainm = new MainM();
    }
    public function index(): string
    {
        return view('welcome_message');
    }

    public function save()
    {
        $nama_sekolah = $this->request->getPost('nama_sekolah');
        $nama_guru = $this->request->getPost('nama_guru');
        $mata_pelajaran = $this->request->getPost('mata_pelajaran');
        $status_guru = $this->request->getPost('status_guru');
        $jjp = $this->request->getPost('jjp');
        session()->set([
            'nama_sekolah'      => $nama_sekolah,
            'nama_guru'         => $nama_guru,
            'mata_pelajaran'    => $mata_pelajaran,
            'status_guru'       => $status_guru,
            'jjp'               => $jjp,
        ]);

        $tanggal = $this->request->getPost('tanggal');
        $materi = $this->request->getPost('materi');
        $kelas = @$this->request->getPost('kelas');
        $mapel = @$this->request->getPost('mapel');
        $jumlah = $this->request->getPost('jumlah');
        $jumlah = $jumlah > 0 ? $jumlah : null;
        $hadir = $this->request->getPost('hadir');
        $hadir = $hadir > 0 ? $hadir : null;
        $tidak_hadir = $this->request->getPost('tidak_hadir');
        $tidak_hadir = $tidak_hadir > 0 ? $tidak_hadir : null;
        $alasan = $this->request->getPost('alasan');
        $dokumentasi = $this->request->getFile('dokumentasi');
        $keterangan = $this->request->getPost('keterangan');

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator("MSM")
            ->setLastModifiedBy("MSM")
            ->setTitle('JURNAL KEGIATAN HARIAN / PEMBELAJARAN BULAN MARET' . date('Y'))
            ->setSubject("Jurnal Kegiata PerTriwulan")
            ->setDescription(
                "Ini dibuat berdasarkan dari sistem dengan menggunakan aplikasi Codeiginter 4."
            )
            ->setKeywords("Codeigniter 4 Genrate Exclsx Jurnal")
            ->setCategory("Journal/Report MSM");

        $monthsheet = replaceBulan(date('M'));
        $spreadsheet->getActiveSheet()->setTitle($monthsheet);
        // $activesheet = $spreadsheet->getActiveSheet();
        $activesheet = $spreadsheet->getSheetByName($monthsheet);

        // FORMAT ================================================================>
        #WIDTH
        $activesheet->getColumnDimension('A')->setWidth(5);
        $activesheet->getColumnDimension('B')->setWidth(13.29);
        $activesheet->getColumnDimension('C')->setWidth(18.57);
        $activesheet->getColumnDimension('D')->setWidth(9.86);
        $activesheet->getColumnDimension('E')->setWidth(16.14);
        $activesheet->getColumnDimension('F')->setWidth(8);
        $activesheet->getColumnDimension('G')->setWidth(8);
        $activesheet->getColumnDimension('H')->setWidth(8);
        $activesheet->getColumnDimension('I')->setWidth(23);
        $activesheet->getColumnDimension('J')->setWidth(24.86);
        $activesheet->getColumnDimension('K')->setWidth(25.86);

        #HEIGHT
        $activesheet->getRowDimension(2)->setRowHeight(7.5); // judul
        for ($r = 3; $r <= 7; $r++) {
            $activesheet->getRowDimension($r)->setRowHeight(23.25);
        }
        for ($r = 8; $r <= 11; $r++) {
            $activesheet->getRowDimension($r)->setRowHeight(59.25);
        }
        for ($r = 12; $r <= 15; $r++) {
            $activesheet->getRowDimension($r)->setRowHeight(39.75);
        }
        $activesheet->getRowDimension(20)->setRowHeight(100);

        #MERGE
        $activesheet->mergeCells('B1:K1'); // judul
        $activesheet->mergeCells('B8:B9');
        $activesheet->mergeCells('B10:B11');
        $activesheet->mergeCells('B12:B15');
        for ($r = 8; $r <= 15; $r++) {
            $activesheet->mergeCells("E$r:K$r");
        }
        foreach (range('A', 'E') as $col) {
            $activesheet->mergeCells("{$col}17:{$col}19");
        }
        $activesheet->mergeCells('F17:H17');
        $activesheet->mergeCells('F18:F19');
        $activesheet->mergeCells('G18:H18');
        foreach (range('I', 'K') as $col) {
            $activesheet->mergeCells("{$col}17:{$col}19");
        }

        #ALIGNMENT
        $activesheet->getStyle('B1:K1')->getAlignment()->setHorizontal('center'); // judul
        $activesheet->getStyle('A:K')->getAlignment()->setVertical('center');
        $activesheet->getStyle('D8:D11')->getAlignment()->setHorizontal('center');
        $activesheet->getStyle('B8:K15')->getAlignment()->setWrapText(true);
        $activesheet->getStyle('A17:K19')->getAlignment()->setHorizontal('center');
        $activesheet->getStyle('A17:K19')->getAlignment()->setWrapText(true);
        $activesheet->getStyle('A20:K20')->getAlignment()->setHorizontal('center');
        $activesheet->getStyle('A20:K20')->getAlignment()->setWrapText(true);

        #PAPERSIZE & ORIENTATION
        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_LEGAL);

        #VIEW
        $activesheet->getSheetView()->setView('pageBreakPreview');
        $activesheet->getPageSetup()->setScale(90);

        #ZOOM
        $activesheet->getSheetView()->setZoomScale(90);

        #FONT
        $activesheet->getStyle('A:K')->getFont()->setName('Arial');
        $activesheet->getStyle('A:K')->getFont()->setSize(12);
        $activesheet->getStyle('B1')->getFont()->setBold(true);
        $activesheet->getStyle('A17:K19')->getFont()->setBold(true);

        #BORDER
        $activesheet->getStyle('B8:B9')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $activesheet->getStyle('B10:B11')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $activesheet->getStyle('B12:B15')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        for ($r = 8; $r <= 15; $r++) {
            $activesheet->getStyle("C$r")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
            $activesheet->getStyle("D$r")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
            $activesheet->getStyle("E$r:K$r")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        }
        foreach (range('A', 'E') as $col) {
            $activesheet->getStyle("{$col}17:{$col}19")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        }
        $activesheet->getStyle('F17:H17')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $activesheet->getStyle('F18:F19')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $activesheet->getStyle('G18:H18')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $activesheet->getStyle('G19')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $activesheet->getStyle('H19')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        foreach (range('I', 'K') as $col) {
            $activesheet->getStyle("{$col}17:{$col}19")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        }

        #MARGIN
        $spreadsheet->getActiveSheet()->getPageMargins()->setBottom(1);
        // END FORMAT ================================================================>

        // VALUE =========================================================================>
        #TOP
        $activesheet->setCellValue('B1', 'JURNAL KEGIATAN HARIAN / PEMBELAJARAN BULAN MARET ' . date('Y')); // judul
        $activesheet->setCellValue('B3', 'NAMA SEKOLAH');
        $activesheet->setCellValue('D3', ': ' . $nama_sekolah);
        $activesheet->setCellValue('B4', 'NAMA GURU');
        $activesheet->setCellValue('D4', ': ' . $nama_guru);
        $activesheet->setCellValue('B5', 'MATA PELAJARAN');
        $activesheet->setCellValue('D5', ': ' . $mata_pelajaran);
        $activesheet->setCellValue('B6', 'STATUS GURUsasad');
        $activesheet->setCellValue('D6', ': ' . $status_guru);
        $activesheet->setCellValue('B7', 'JJP KBM PER MINGGU');
        $activesheet->setCellValue('D7', ': ' . $jjp);

        #MID TOP
        $activesheet->setCellValue('B8', 'Kelas X');
        $activesheet->setCellValue('B10', 'Kelas XI');
        $activesheet->setCellValue('B12', 'Kelas XII');
        $activesheet->setCellValue('C8', 'Bhineka Tunggal Ika');
        $activesheet->setCellValue('C9', 'Negara Kesatuan Republik Indonesia');
        $activesheet->setCellValue('C10', 'Bhineka Tunggal Ika');
        $activesheet->setCellValue('C11', 'Negara Kesatuan Republik Indonesia');
        $activesheet->setCellValue('C12', 'KD 3.3');
        $activesheet->setCellValue('C13', 'KD 3.4');
        $activesheet->setCellValue('C14', 'KD 4.3');
        $activesheet->setCellValue('C15', 'KD 4.4');
        $activesheet->setCellValue('D8', 'CP');
        $activesheet->setCellValue('D9', 'CP');
        $activesheet->setCellValue('D10', 'CP');
        $activesheet->setCellValue('D11', 'CP');
        $activesheet->setCellValue('E8', 'Peserta didik mampu menginisiasi kegiatan bersama atau gotong royong dalam praktik hidup sehari-hari untuk membangun masyarakat sekitar dan masyarakat Indonesia');
        $activesheet->setCellValue('E9', 'Peserta didik mampu memberi contoh dan memiliki kesadaran akan hak dan kewajibannya sebagai warga sekolah, warga masyarakat dan warga negara; Peserta didik mampu memahami peran dan kedudukannya sebagai warga negara Indonesia.');
        $activesheet->setCellValue('E10', 'Peserta Didik Menganalisis, mengoreksi dan mempertanyakan pengaruh keanggotaan kelompok, lokal, regional, nasional dan global terhadap pembentukan identitas.');
        $activesheet->setCellValue('E11', 'Peserta Didik menyimpulkan, mengklarifikasikan, dan menghargai keragaman budaya yang ada, dan menanggapi secara memadai terhadap kondisi dan keadaan yang ada di lingkungan dan masyarakat untuk menghasilkan kondisi dan keadaan yang lebih baik.');
        $activesheet->setCellValue('E12', 'Mengidentifikasi pengaruh kemajuan ilmu pengetahuan dan teknologi terhadap Negara dalam bingkai Bhineka Tunggal Ika');
        $activesheet->setCellValue('E13', 'Mengevaluasi dinamika persatuan dan kesatuan bangsa sebagai upaya menjaga dan mempertahankan Negara Kesatuan Republik Indonesia.');
        $activesheet->setCellValue('E14', 'Mempresentasikan hasil identifikasi pengaruh kemajuan ilmu pengetahuan dan teknologi terhadap Negara dalam bingkai Bhineka tunggal Ika');
        $activesheet->setCellValue('E15', 'Merancang dan mengkampanyekan persatuan dan kesatuan bangsa sebagai upaya menjaga dan mempertahankan Negara Kesatuan Republik Indonesia');

        #MAIN HEADER
        $activesheet->setCellValue('A17', 'No.');
        $activesheet->setCellValue('B17', 'HARI/TANGGAL');
        $activesheet->setCellValue('C17', 'MATERI/KEGIATAN');
        $activesheet->setCellValue('D17', 'KELAS');
        $activesheet->setCellValue('E17', 'MAPEL/JP');
        $activesheet->setCellValue('F17', 'KEADAAN SISWA');
        $activesheet->setCellValue('F18', 'JLH');
        $activesheet->setCellValue('G18', 'TATAP MUKA');
        $activesheet->setCellValue('G19', 'HADIR');
        $activesheet->setCellValue('H19', 'TIDAK');
        $activesheet->setCellValue('I17', 'MASALAH/ALASAN');
        $activesheet->setCellValue('J17', 'DOKUMENTASI');
        $activesheet->setCellValue('K17', 'KET/TEMPAT KEGIATAN');

        #MAIN {DYNAMIC}
        $dokumentasiname = "image $tanggal." . $dokumentasi->getClientExtension();
        if (!$this->upload_img($dokumentasiname, $dokumentasi)) {
            return response()->setJSON(['success' => false, 'message' => session()->getFlashdata('error')]);
        }
        $timestamp = new DateTime((string)$tanggal);
        $timestamp = $timestamp->getTimestamp();
        if (!$this->mainm->insert([
            'tanggal'       => date('Y-m-d', $timestamp),
            'materi'        => $materi,
            'kelas'         => $kelas,
            'mapel'         => $mapel,
            'jumlah'        => $jumlah,
            'hadir'         => $hadir,
            'tidak_hadir'   => $tidak_hadir,
            'alasan'        => $alasan,
            'dokumentasi'   => $dokumentasiname,
            'keterangan'    => $keterangan
        ])) {
            return response()->setJSON(['success' => false, 'messages' => $this->mainm->errors()]);
        }
        $jurnals = $this->mainm->where('tanggal', date('Y-m-d', $timestamp))->findAll();
        foreach ($jurnals as $key => $data) {
            $no = $key +1;
            $row = $key + 20;
            $dokumentasi = WRITEPATH . "uploads/img/$data->dokumentasi";
            $maData[] = [
                $no,
                tanggalFormat($data->tanggal),
                $data->materi,
                $data->kelas,
                $data->mapel,
                $data->jumlah,
                $data->hadir,
                $data->tidak_hadir,
                $data->alasan,
                NULL,
                $data->keterangan,
            ];
            $drawing = new Drawing();
            $drawing->setName("Dokumentasi $row");
            $drawing->setDescription("Doc pertamasadasdsa $row");
            $drawing->setPath($dokumentasi);
            $drawing->setCoordinates("J$row");
            $drawing->setWidthAndHeight(135, 135);
            $drawing->setOffsetX(15);
            $drawing->setWorksheet($activesheet);
        }
        $activesheet->fromArray($maData, NULL, 'A20');
        // END VALUE =========================================================================>

        // CLONE WORK SHEET
        $checkBulan = new DateTime((string)$tanggal);
        $checkBulan = date('M', $checkBulan->getTimestamp());
        if (date('M') != $checkBulan) {
            $clonedWorksheet = clone $spreadsheet->getSheetByName($monthsheet);
            $clonedWorksheet->setTitle(replaceBulan($checkBulan));
            $spreadsheet->addSheet($clonedWorksheet);
            $spreadsheet->setActiveSheetIndexByName(replaceBulan($checkBulan));
        }

        $writer = new Xlsx($spreadsheet);
        if (!is_dir('laporan')) {
            mkdir('laporan');
        }
        $filename = 'laporan/laporan' . time() . '.xlsx';
        $writer->save($filename);
        if (file_exists($filename)) {
            return response()->setJSON(['success' => true, 'message' => 'Data succeed created']);
        } else {
            return response()->setJSON(['success' => false, 'message' => 'Data failed created'])->setStatusCode(400, 'Tidak bisa buat berkas!');
        }
    }

    private function upload_img($file_name, $img): bool
    {
        $max = 5;
        $filesize = $max * 1024;
        $validationRule = [
            'dokumentasi' => [
                'label' => 'IMG File',
                'rules' => 'uploaded[dokumentasi]'
                    . '|is_image[dokumentasi]'
                    . '|mime_in[dokumentasi,image/jpg,image/jpeg,image/png]'
                    . "|max_size[dokumentasi,$filesize]",
                'errors' => [
                    'uploaded'  => 'Pastikan sudah memasukan gambar',
                    'is_image'  => 'Pastikan yang di upload adalah gambar',
                    'mime_in'   => 'Extensi yang boleh [jpg,jpeg,png]',
                    'max_size'  => "Ukuran gambar terlalu besar MAX {$max}MB",
                ]
            ],
        ];
        if (!$this->validate($validationRule)) {
            session()->setFlashdata('error', $this->validator->getError('dokumentasi'));
            return false;
        }
        $filepath = WRITEPATH . 'uploads/';

        if (!$img->hasMoved()) {

            if (!is_dir($filepath . 'img')) mkdir($filepath . 'img');
            if (!is_dir($filepath . 'thumbs')) mkdir($filepath . 'thumbs');

            $image = \Config\Services::image('gd'); //Load Image Libray
            $image->withFile($img)->save($filepath . 'img/' . $file_name);
            //thumbs
            $image->withFile($img)->fit(500, 500, 'center')->save($filepath . 'thumbs/' . $file_name);
            return true;
        } else {
            session()->setFlashdata('error', $img->getErrorString() . '(' . $img->getError() . ')');
            return false;
        }
    }
}
