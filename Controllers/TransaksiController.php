<?php
include_once 'Models\TransaksiModel.php';
require_once 'vendor/autoload.php';

class TransaksiController
{
    private $transaksiModel;

    public function __construct()
    {
        $koneksi = new Koneksi();
        $this->transaksiModel = new TransaksiModel($koneksi);
        $this->active = 'transaksi';
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Transaksi',
            'active' => $this->active,
            'items' => $this->transaksiModel->index(), // Use $this->transaksiModel
            'content' => 'Views/Transaksi/index.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Daftar Transaksi',
            'active' => $this->active,
            'content' => 'Views/Transaksi/tambah.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function simpan()
    {
        $data = [
            'nama' => $_POST['nama'],
            'jumlah' => $_POST['jumlah'],
        ];

        $this->transaksiModel->add($data);

        header('location: ' . base_url() . 'transaksi/index');
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->transaksiModel->delete($id);

        header('location: ' . base_url() . 'transaksi/index');
    }

    public function edit()
    {
        $id = $_GET['id'];
        $data = [
            'title' => 'Edit Daftar Transaksi',
            'active' => $this->active,
            'item' => $this->transaksiModel->show($id),
            'content' => 'Views/Transaksi/edit.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function update()
    {
        $data = [
            'id' => $_POST['id'],
            'nama' => $_POST['nama'],
            'jumlah' => $_POST['jumlah'],
        ];

        $this->transaksiModel->update($data);

        header('location: ' . base_url() . 'transaksi/index');
    }

    public function import()
    {
        $data = [
            'title' => 'Import Data Transaksi',
            'active' => $this->active,
            'content' => 'Views/Transaksi/import.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function importStore()
    {
        // read file excel
        $file = $_FILES['file']['tmp_name'];
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $data = [];
        for ($i = 1; $i < count($sheetData); $i++) {
            $data[] = [
                'nama' => $sheetData[$i][0],
                'jumlah' => $sheetData[$i][1],
            ];
        }

        $this->transaksiModel->import($data);

        header('location: ' . base_url() . 'transaksi/index');
    }

    public function downloadTemplate()
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'Jumlah');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('template.xlsx');

        header('location: ' . base_url() . 'template.xlsx');
    }
}
