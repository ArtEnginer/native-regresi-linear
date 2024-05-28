<?php
include_once 'Models\DatasetModel.php';
require_once 'vendor/autoload.php';

class PerhitunganController
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
    }

    public function index()
    {
        $data = [
            'title' => 'Perhitungan',
            'active' => 'perhitungan',
            'items' => $this->datasetModel->all(),
            'content' => 'Views/Perhitungan/index.php',
        ];

        $data['perhitungan'] = $this->perhitungan($data['items']);

        include_once('Views/Layout/index.php');
    }

    public function prediksi()
    {
        $data = [
            'title' => 'Prediksi',
            'active' => 'Prediksi',
            'items' => $this->datasetModel->all(),
            'content' => 'Views/Perhitungan/prediksi.php',
        ];

        $data['perhitungan'] = $this->perhitungan($data['items']);
        $data['prediksi'] = 0;
        if (isset($_POST['submit'])) {
            $periode = $_POST['periode'];
            // CONVERT DATE TO PERIODE
            // $periode = date("m/Y", strtotime($periode));
            // $periode = explode("/", $periode);
            // $periode = $data['perhitungan']['n'] + 1;
            $prediksi = $data['perhitungan']['a'] + $data['perhitungan']['b'] * $periode;
            $data['prediksi'] = $prediksi;
            $data['periode'] = $periode;
        }
        include_once('Views/Layout/index.php');
    }

    public function pengujian()
    {
        $data = [
            'title' => 'Pengujian',
            'active' => 'pengujian',
            'items' => $this->datasetModel->all(),
            'content' => 'Views/Perhitungan/pengujian.php',
        ];

        $data['perhitungan'] = $this->perhitungan($data['items']);
        $data['pengujian'] = 0;
        if (isset($_POST['submit'])) {
            $percentageTest = $_POST['percentageTest'];
            $dataTrain = $data['perhitungan']['dataset'];
            $data['pengujian'] = $this->ProsesPengujian($_POST['percentageTest']);
        }
        include_once('Views/Layout/index.php');
    }

    public function perhitungan($data)
    {
        $dataset = array();
        $index = 1;

        usort($data, function ($a, $b) {
            return strtotime($a['x']) - strtotime($b['x']);
        });

        foreach ($data as $item) {
            $bulan_tahun = date("m/Y", strtotime($item['x']));
            if (!isset($dataset[$bulan_tahun])) {
                $dataset[$bulan_tahun] = array(
                    'bulan_tahun' => $bulan_tahun,
                    'periode' => $index,
                    'y' => $item['y'],
                    'x' => $index,
                    'x_kuadrat' => pow($index, 2),
                    'xy' => $index * $item['y']

                );
                $index++;
            } else {
                $dataset[$bulan_tahun]['y'] += $item['y'];
                $dataset[$bulan_tahun]['xy'] = $dataset[$bulan_tahun]['x'] * $dataset[$bulan_tahun]['y'];
            }
        }


        // Linear regression calculation
        $n = count($dataset);
        $total_x = 0;
        $total_y = 0;
        $total_xy = 0;
        $total_x_kuadrat = 0;

        foreach ($dataset as $item) {
            $total_x += $item['periode'];
            $total_y += $item['y'];
            $total_xy += $item['xy'];
            $total_x_kuadrat += $item['x_kuadrat'];
        }

        $denominator = $n * $total_x_kuadrat - $total_x * $total_x;

        if ($denominator == 0) {
            // Handle the error
            throw new Exception("Error: Division by zero. Please check your input values.");
        }

        $b = ($n * $total_xy - $total_x * $total_y) / $denominator;
        $a = ($total_y - $b * $total_x) / $n;

        return array(
            'n' => $n,
            'total_x' => $total_x,
            'total_y' => $total_y,
            'total_xy' => $total_xy,
            'total_x_kuadrat' => $total_x_kuadrat,
            'a' => $a,
            'b' => $b,
            'dataset' => $dataset
        );
    }

    public function ProsesPengujian($percentageTest)
    {
        $perhitungan = $this->perhitungan($this->datasetModel->all());
        $dataset = $perhitungan['dataset'];
        $a = $perhitungan['a'];
        $b = $perhitungan['b'];

        $dataTest = array();
        $dataTrain = array();

        $totalData = count($dataset);
        $totalDataTest = round($totalData * $percentageTest / 100);
        $totalDataTrain = $totalData - $totalDataTest;

        $index = 0;
        foreach ($dataset as $item) {
            if ($index < $totalDataTrain) {
                $dataTrain[] = $item;
            } else {
                $dataTest[] = $item;
            }
            $index++;
        }

        // Pengujian Model
        $predictions = array();
        $actuals = array();
        $results = array();

        foreach ($dataTest as $item) {
            $prediction = $a + $b * $item['periode'];
            $actual = $item['y'];

            $predictions[] = $prediction;
            $actuals[] = $actual;

            // Menyimpan prediksi dan actual dalam array results
            $results[] = array(
                'periode' => $item['periode'],
                'prediction' => $prediction,
                'actual' => $actual
            );
        }

        $rmse = $this->calculateRMSE($predictions, $actuals);

        return array(
            'dataTrain' => $dataTrain,
            'dataTest' => $dataTest,
            'results' => $results,  // Mengembalikan hasil prediksi dan actual
            'rmse' => $rmse
        );
    }

    // Fungsi untuk menghitung RMSE
    private function calculateRMSE($predictions, $actuals)
    {
        $sumSquaredError = 0;
        $count = count($predictions);

        for ($i = 0; $i < $count; $i++) {
            $sumSquaredError += pow($predictions[$i] - $actuals[$i], 2);
        }

        if ($count == 0) {
            throw new Exception("Division by zero error in calculateRMSE method.");
        }

        $meanSquaredError = $sumSquaredError / $count;
        return sqrt($meanSquaredError);
    }
}
