<?php
include_once 'Models\DatasetModel.php';
include_once 'Models\RiwayatPrediksiModel.php';
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
        $this->riwayatPrediksiModel = new RiwayatPrediksiModel($koneksi);
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
            'form' => 1,
            'items' => $this->datasetModel->all(),
            'content' => 'Views/Perhitungan/prediksi.php',
        ];

        $data['perhitungan'] = $this->perhitungan($data['items']);
        $data['prediksi'] = [];
        $data['periode'] = '';

        // if get
        if (isset($_GET['periode_start']) && isset($_GET['periode_end'])) {
            $periode_start = $_GET['periode_start'];
            $periode_end = $_GET['periode_end'];
            $data['form'] = 0;
        }

        if (isset($_POST['submit'])) {
            $periode_start = $_POST['periode_start'];
            $periode_end = $_POST['periode_end'];
        }

        if (isset($_POST['submit']) || isset($_GET['periode_start']) && isset($_GET['periode_end'])) {

            // cek apakah periode sudah pernah di prediksi jik iya jangan simpan kembali
            $riwayat = $this->riwayatPrediksiModel->all();
            foreach ($riwayat as $item) {
                if ($item['periode_start'] == $periode_start && $item['periode_end'] == $periode_end) {
                    $data['prediksi'] = 'Periode ' . $periode_start . ' sampai ' . $periode_end . ' sudah pernah di prediksi sebelumnya';
                    break;
                }
            }
            if ($data['prediksi'] == []) {
                $this->riwayatPrediksiModel->add([
                    'periode_start' => $periode_start,
                    'periode_end' => $periode_end
                ]);
            }
            // Convert the periods to timestamps
            $start_date = strtotime($periode_start);
            $end_date = strtotime($periode_end);

            // Initialize total prediction array
            $total_prediksi = [];

            // Loop through each month in the period range
            while ($start_date <= $end_date) {
                // Format the current month/year as x
                $x = date("m/Y", $start_date);

                // Prediksi untuk y1 sampai y9
                $prediksi_bulan = [];
                for ($i = 1; $i <= 9; $i++) {
                    $a = $data['perhitungan']['y' . $i]['a'];
                    $b = $data['perhitungan']['y' . $i]['b'];
                    if (isset($data['perhitungan']['dataset'][$x])) {
                        $prediksi_bulan['y' . $i] = $a + $b * $data['perhitungan']['dataset'][$x]['x'];
                    } else {
                        $prediksi_bulan['y' . $i] = 0; // or handle as needed if dataset for $x is missing
                    }
                }

                // Add monthly prediction to total prediction
                foreach ($prediksi_bulan as $key => $value) {
                    if (!isset($total_prediksi[$key])) {
                        $total_prediksi[$key] = 0;
                    }
                    $total_prediksi[$key] += $value;
                }

                // Move to the next month
                $start_date = strtotime("+1 month", $start_date);
            }

            $data['prediksi'] = $total_prediksi;
            $data['periode'] = $periode_start . ' sampai ' . $periode_end;

            // die(var_dump($data['prediksi']));
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
                    'y1' => $item['y1'],
                    'y2' => $item['y2'],
                    'y3' => $item['y3'],
                    'y4' => $item['y4'],
                    'y5' => $item['y5'],
                    'y6' => $item['y6'],
                    'y7' => $item['y7'],
                    'y8' => $item['y8'],
                    'y9' => $item['y9'],
                    'x' => $index,
                    'x_kuadrat' => pow($index, 2),
                    'xy1' => $index * $item['y1'],
                    'xy2' => $index * $item['y2'],
                    'xy3' => $index * $item['y3'],
                    'xy4' => $index * $item['y4'],
                    'xy5' => $index * $item['y5'],
                    'xy6' => $index * $item['y6'],
                    'xy7' => $index * $item['y7'],
                    'xy8' => $index * $item['y8'],
                    'xy9' => $index * $item['y9']
                );
                $index++;
            } else {
                for ($i = 1; $i <= 9; $i++) {
                    $dataset[$bulan_tahun]['y' . $i] += $item['y' . $i];
                    $dataset[$bulan_tahun]['xy' . $i] = $dataset[$bulan_tahun]['x'] * $dataset[$bulan_tahun]['y' . $i];
                }
            }
        }

        // Linear regression calculation for each y
        $n = count($dataset);
        $results = array();
        $total_x = 0;
        $total_x_kuadrat = 0;

        foreach ($dataset as $item) {
            $total_x += $item['periode'];
            $total_x_kuadrat += $item['x_kuadrat'];
        }

        for ($i = 1; $i <= 9; $i++) {
            $total_y = 0;
            $total_xy = 0;

            foreach ($dataset as $item) {
                $total_y += $item['y' . $i];
                $total_xy += $item['xy' . $i];
            }

            $denominator = $n * $total_x_kuadrat - $total_x * $total_x;

            if ($denominator == 0) {
                // Handle the error
                throw new Exception("Error: Division by zero. Please check your input values.");
            }

            $b = ($n * $total_xy - $total_x * $total_y) / $denominator;
            $a = ($total_y - $b * $total_x) / $n;

            $results['y' . $i] = array(
                'n' => $n,
                'total_x' => $total_x,
                'total_y' => $total_y,
                'total_xy' => $total_xy,
                'total_x_kuadrat' => $total_x_kuadrat,
                'a' => $a,
                'b' => $b
            );
        }

        $results['dataset'] = $dataset;


        return $results;
    }


    public function ProsesPengujian($percentageTest)
    {
        $perhitungan = $this->perhitungan($this->datasetModel->all());
        $dataset = $perhitungan['dataset'];

        // Initialize arrays for dataTrain, dataTest, predictions, actuals, and results for each y
        $dataTest = [];
        $dataTrain = [];
        $predictions = [];
        $actuals = [];
        $results = [];

        $totalData = count($dataset);
        $totalDataTest = round($totalData * $percentageTest / 100);
        $totalDataTrain = $totalData - $totalDataTest;

        // Split dataset into training and testing
        $index = 0;
        foreach ($dataset as $item) {
            if ($index < $totalDataTrain) {
                $dataTrain[] = $item;
            } else {
                $dataTest[] = $item;
            }
            $index++;
        }

        // Perform predictions for each y
        for ($i = 1; $i <= 9; $i++) {
            $a = $perhitungan['y' . $i]['a'];
            $b = $perhitungan['y' . $i]['b'];

            $predictions['y' . $i] = [];
            $actuals['y' . $i] = [];
            $results['y' . $i] = [];

            foreach ($dataTest as $item) {
                $prediction = $a + $b * $item['periode'];
                $actual = $item['y' . $i];

                $predictions['y' . $i][] = $prediction;
                $actuals['y' . $i][] = $actual;

                // Store prediction and actual in results array
                $results['y' . $i][] = [
                    'periode' => $item['periode'],
                    'prediction' => $prediction,
                    'actual' => $actual
                ];
            }
        }

        // Calculate RMSE for each y
        $rmse = [];
        for ($i = 1; $i <= 9; $i++) {
            $rmse['y' . $i] = $this->calculateRMSE($predictions['y' . $i], $actuals['y' . $i]);
        }

        // Prepare HTML table to display results
        $html = '<table class="table table-striped table-bordered datatable">';
        $html .= '<thead><tr><th>Golongan</th><th>Periode</th><th>Prediction</th><th>Actual</th></tr></thead>';
        $html .= '<tbody>';

        foreach ($results as $y => $result) {
            foreach ($result as $data) {
                $html .= '<tr>';
                $html .= '<td>' . $y . '</td>';
                $html .= '<td>' . $data['periode'] . '</td>';
                $html .= '<td>' . $data['prediction'] . '</td>';
                $html .= '<td>' . $data['actual'] . '</td>';
                $html .= '</tr>';
            }
        }

        $html .= '</tbody>';
        $html .= '</table>';

        return [
            'dataTrain' => $dataTrain,
            'dataTest' => $dataTest,
            'prediksi' => $html,  // Return HTML table of predictions and actuals
            'rmse' => $rmse
        ];
    }

    // Function to calculate RMSE remains unchanged
    private function calculateRMSE($predictions, $actuals)
    {
        $sumSquaredError = 0;
        $count = count($predictions);

        if ($count !== count($actuals)) {
            throw new Exception("Number of predictions does not match number of actuals.");
        }

        for ($i = 0; $i < $count; $i++) {
            $sumSquaredError += pow($predictions[$i] - $actuals[$i], 2);
        }

        if ($count === 0) {
            throw new Exception("Division by zero error in calculateRMSE method.");
        }

        $meanSquaredError = $sumSquaredError / $count;
        return sqrt($meanSquaredError);
    }

    public function hasil()
    {
        $data = [
            'title' => 'Hasil Prediksi',
            'active' => 'hasil',
            'items' => $this->riwayatPrediksiModel->all(),
            'content' => 'Views/Hasil/index.php',
        ];

        include_once('Views/Layout/index.php');
    }

    // detail
    public function detail($id)
    {
        $data = [
            'title' => 'Detail Prediksi',
            'active' => 'hasil',
            'item' => $this->riwayatPrediksiModel->find($id),
            'content' => 'Views/Hasil/detail.php',
        ];

        include_once('Views/Layout/index.php');
    }

    /* DELETE */
    public function deletehasil()
    {
        $id = $_GET['id'];
        $this->riwayatPrediksiModel->delete($id);
        header('Location: ' . base_url() . 'perhitungan/hasil');
    }
}
