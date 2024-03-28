<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function save()
    {
        $spreadsheet = new Spreadsheet();
        $activesheet = $spreadsheet->getActiveSheet();

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

        $spreadsheet->getActiveSheet()->setTitle(date('F'));

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

        // VALUE
        #TOP
        $activesheet->setCellValue('B1', 'JURNAL KEGIATAN HARIAN / PEMBELAJARAN BULAN MARET ' . date('Y')); // judul
        $activesheet->setCellValue('B3', 'NAMA SEKOLAH');
        $activesheet->setCellValue('D3', ': ' . $this->request->getPost('nama_sekolah'));
        $activesheet->setCellValue('B4', 'NAMA GURU');
        $activesheet->setCellValue('D4', ': ' . $this->request->getPost('nama_guru'));
        $activesheet->setCellValue('B5', 'MATA PELAJARAN');
        $activesheet->setCellValue('D5', ': ' . $this->request->getPost('mata_pelajaran'));
        $activesheet->setCellValue('B6', 'STATUS GURUsasad');
        $activesheet->setCellValue('D6', ': ' . $this->request->getPost('status_guru'));
        $activesheet->setCellValue('B7', 'JJP KBM PER MINGGU');
        $activesheet->setCellValue('D7', ': ' . $this->request->getPost('jjp'));

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
        // END VALUE

        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan' . time() . '.xlsx';
        $writer->save($filename);
        if (file_exists($filename)) {
            return response()->setJSON(['success' => true, 'message' => 'Data succeed created']);
        } else {
            return response()->setJSON(['success' => false, 'message' => 'Data failed created'])->setStatusCode(400, 'Tidak bisa buat berkas!');
        }
    }
}
