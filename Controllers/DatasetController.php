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
            'y1' => $_POST['y1'],
            'y2' => $_POST['y2'],
            'y3' => $_POST['y3'],
            'y4' => $_POST['y4'],
            'y5' => $_POST['y5'],
            'y6' => $_POST['y6'],
            'y7' => $_POST['y7'],
            'y8' => $_POST['y8'],
            'y9' => $_POST['y9'],
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
            'y1' => $_POST['y1'],
            'y2' => $_POST['y2'],
            'y3' => $_POST['y3'],
            'y4' => $_POST['y4'],
            'y5' => $_POST['y5'],
            'y6' => $_POST['y6'],
            'y7' => $_POST['y7'],
            'y8' => $_POST['y8'],
            'y9' => $_POST['y9'],
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
                'y1' => $sheetData[$i][1],
                'y2' => $sheetData[$i][2],
                'y3' => $sheetData[$i][3],
                'y4' => $sheetData[$i][4],
                'y5' => $sheetData[$i][5],
                'y6' => $sheetData[$i][6],
                'y7' => $sheetData[$i][7],
                'y8' => $sheetData[$i][8],
                'y9' => $sheetData[$i][9],
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
        $sheet->setCellValue('B1', 'y1');
        $sheet->setCellValue('C1', 'y2');
        $sheet->setCellValue('D1', 'y3');
        $sheet->setCellValue('E1', 'y4');
        $sheet->setCellValue('F1', 'y5');
        $sheet->setCellValue('G1', 'y6');
        $sheet->setCellValue('H1', 'y7');
        $sheet->setCellValue('I1', 'y8');
        $sheet->setCellValue('J1', 'y9');


        // insert data A is date and B is number using lopping
        for ($i = 2; $i <= 10; $i++) {
            $sheet->setCellValue('A' . $i, '2021-01-' . $i);
            $sheet->setCellValue('B' . $i, rand(1, 100));
            $sheet->setCellValue('C' . $i, rand(1, 100));
            $sheet->setCellValue('D' . $i, rand(1, 100));
            $sheet->setCellValue('E' . $i, rand(1, 100));
            $sheet->setCellValue('F' . $i, rand(1, 100));
            $sheet->setCellValue('G' . $i, rand(1, 100));
            $sheet->setCellValue('H' . $i, rand(1, 100));
            $sheet->setCellValue('I' . $i, rand(1, 100));
            $sheet->setCellValue('J' . $i, rand(1, 100));
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('template.xlsx');

        header('location: ' . base_url() . 'template.xlsx');
    }
}
