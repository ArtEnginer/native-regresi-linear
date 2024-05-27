<?php
include_once 'Models\DatasetModel.php';
require_once 'vendor/autoload.php';

class DatasetController
{
    private $datasetModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header('Location: ' . base_url() . 'auth/login');
            exit();
        }
        $koneksi = new Koneksi();
        $this->datasetModel = new DatasetModel($koneksi);
        $this->active = 'dataset';
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Dataset',
            'active' => $this->active,
            'items' => $this->datasetModel->all(), // Use $this->DatasetModel
            'content' => 'Views/Dataset/index.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Daftar Dataset',
            'active' => $this->active,
            'content' => 'Views/Dataset/tambah.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function simpan()
    {
        $data = [
            'x' => $_POST['x'],
            'y' => $_POST['y'],
        ];

        $this->datasetModel->add($data);

        header('location: ' . base_url() . 'dataset/index');
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->datasetModel->delete($id);

        header('location: ' . base_url() . 'dataset/index');
    }

    public function edit()
    {
        $id = $_GET['id'];
        $data = [
            'title' => 'Edit Daftar dataset',
            'active' => $this->active,
            'item' => $this->datasetModel->show($id),
            'content' => 'Views/Dataset/edit.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function update()
    {
        $data = [
            'id' => $_POST['id'],
            'x' => $_POST['x'],
            'y' => $_POST['y'],
        ];

        $this->datasetModel->update($data);

        header('location: ' . base_url() . 'dataset/index');
    }

    public function import()
    {
        $data = [
            'title' => 'Import Data Dataset',
            'active' => $this->active,
            'content' => 'Views/Dataset/import.php',
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
                'x' => $sheetData[$i][0],
                'y' => $sheetData[$i][1],
            ];
        }

        $this->datasetModel->import($data);

        header('location: ' . base_url() . 'dataset/index');
    }

    public function downloadTemplate()
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'x');
        $sheet->setCellValue('B1', 'y');

        // insert data A is date and B is number using lopping
        for ($i = 2; $i <= 10; $i++) {
            $sheet->setCellValue('A' . $i, '2021-01-' . $i);
            $sheet->setCellValue('B' . $i, rand(1, 100));
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('template.xlsx');

        header('location: ' . base_url() . 'template.xlsx');
    }
}
