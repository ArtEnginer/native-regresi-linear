<?php require_once("Views/Layout/index.php"); ?>

<div class="row">
    <div class="col-md-12">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Dataset</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="badge bg-success">Langkah 1</div>
                            </div>
                        </div>
                        <p>
                            Dataset yang digunakan dalam perhitungan ini adalah sebagai berikut.
                        </p>
                    </div>
                </div>
                <div class="app-card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th width="2px">No</th>
                                    <th>Tgl/Bulan/Tahun</th>

                                    <?php
                                    // GOL 1 sampai 9
                                    for ($i = 1; $i <= 9; $i++) {
                                        echo "<th>Gol $i</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;

                                foreach ($data['items'] as $item) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $item['x'] ?></td>
                                        <td><?= $item['y1'] ?></td>
                                        <td><?= $item['y2'] ?></td>
                                        <td><?= $item['y3'] ?></td>
                                        <td><?= $item['y4'] ?></td>
                                        <td><?= $item['y5'] ?></td>
                                        <td><?= $item['y6'] ?></td>
                                        <td><?= $item['y7'] ?></td>
                                        <td><?= $item['y8'] ?></td>
                                        <td><?= $item['y9'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Dataset Preprocessing</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="badge bg-success">Langkah 2</div>
                            </div>
                        </div>
                        <p>
                            Dataset Preprocessing adalah proses persiapan data sebelum dilakukan perhitungan.
                        </p>
                    </div>
                </div>
                <div class="app-card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th width="2px">No</th>
                                    <th>Bulan/Tahun </th>
                                    <th>Periode (X)</th>
                                    <?php
                                    for ($i = 1; $i <= 9; $i++) {
                                        echo "<th>Gol $i</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data['perhitungan']['dataset'] as $bulan_tahun => $nilai) : ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $bulan_tahun ?></td>
                                        <td><?= $nilai['x'] ?></td>
                                        <td><?= $nilai['y1'] ?></td>
                                        <td><?= $nilai['y2'] ?></td>
                                        <td><?= $nilai['y3'] ?></td>
                                        <td><?= $nilai['y4'] ?></td>
                                        <td><?= $nilai['y5'] ?></td>
                                        <td><?= $nilai['y6'] ?></td>
                                        <td><?= $nilai['y7'] ?></td>
                                        <td><?= $nilai['y8'] ?></td>
                                        <td><?= $nilai['y9'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Perhitungan x^, xy</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="badge bg-success">Langkah 3</div>
                            </div>
                        </div>
                        <p>
                            Perhitungan x^, xy adalah proses perhitungan nilai x^ dan xy.
                        </p>
                        <code>
                            x^ = Σx / n <br>
                            xy = Σxy / n
                        </code>
                    </div>
                </div>
                <div class="app-card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th width="2px">No</th>
                                    <th>Bulan/Tahun</th>
                                    <th>x</th>
                                    <?php
                                    // GOL 1 sampai 9
                                    for ($i = 1; $i <= 9; $i++) {
                                        echo "<th>GOL$i</th>";
                                    }
                                    ?>
                                    <th>x^</th>
                                    <?php
                                    // GOL 1 sampai 9
                                    for ($i = 1; $i <= 9; $i++) {
                                        echo "<th>xy$i</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data['perhitungan']['dataset'] as $bulan_tahun => $nilai) : ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $bulan_tahun ?></td>
                                        <td><?= $nilai['x'] ?></td>
                                        <td><?= $nilai['y1'] ?></td>
                                        <td><?= $nilai['y2'] ?></td>
                                        <td><?= $nilai['y3'] ?></td>
                                        <td><?= $nilai['y4'] ?></td>
                                        <td><?= $nilai['y5'] ?></td>
                                        <td><?= $nilai['y6'] ?></td>
                                        <td><?= $nilai['y7'] ?></td>
                                        <td><?= $nilai['y8'] ?></td>
                                        <td><?= $nilai['y9'] ?></td>
                                        <td><?= $nilai['x_kuadrat'] ?></td>
                                        <td><?= $nilai['xy1'] ?></td>
                                        <td><?= $nilai['xy2'] ?></td>
                                        <td><?= $nilai['xy3'] ?></td>
                                        <td><?= $nilai['xy4'] ?></td>
                                        <td><?= $nilai['xy5'] ?></td>
                                        <td><?= $nilai['xy6'] ?></td>
                                        <td><?= $nilai['xy7'] ?></td>
                                        <td><?= $nilai['xy8'] ?></td>
                                        <td><?= $nilai['xy9'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="app-card shadow-sm mb-4 border-left-decoration">
                <div class="inner">
                    <div class="app-card-header p-4">
                        <div class="app-card-header-title">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="app-card-title">Perhitungan Jumlah Total</h4>
                                </div>
                                <div class="col-md-6 text-end">
                                    <div class="badge bg-success">Langkah 4</div>
                                </div>
                            </div>
                            <p>
                                Perhitungan jumlah total x, y, x^, xy.
                            </p>

                        </div>
                    </div>
                    <div class="app-card-body p-4">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>GOLONGAN</th>
                                    <th>Σx</th>
                                    <th>Σy</th>
                                    <th>Σx^2</th>
                                    <th>Σxy</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 1; $i <= 9; $i++) : ?>
                                    <tr>
                                        <td>y<?= $i ?></td>
                                        <td><?= $data['perhitungan']['y' . $i]['total_x'] ?></td>
                                        <td><?= $data['perhitungan']['y' . $i]['total_y'] ?></td>
                                        <td><?= $data['perhitungan']['y' . $i]['total_x_kuadrat'] ?></td>
                                        <td><?= $data['perhitungan']['y' . $i]['total_xy'] ?></td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="app-card shadow-sm mb-4 border-left-decoration">
                <div class="inner">
                    <div class="app-card-header p-4">
                        <div class="app-card-header-title">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="app-card-title">Perhitungan Akhir</h4>
                                </div>
                                <div class="col-md-6 text-end">
                                    <div class="badge bg-success">Langkah 5</div>
                                </div>
                            </div>
                            <p>
                                Perhitungan Akhir adalah proses perhitungan nilai a dan b.
                            </p>

                        </div>
                    </div>
                    <div class="app-card-body p-4">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>y</th>
                                    <th>a = (Σy * Σx^2 - Σx * Σxy) / (n * Σx^2 - Σx^2) =</th>
                                    <th>b = (n * Σxy - Σx * Σy) / (n * Σx^2 - Σx^2) =</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 1; $i <= 9; $i++) : ?>
                                    <tr>
                                        <td>y<?= $i ?></td>
                                        <td>
                                            <?= $data['perhitungan']['y' . $i]['a'] ?>
                                        </td>
                                        <td>
                                            <?= $data['perhitungan']['y' . $i]['b'] ?>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>