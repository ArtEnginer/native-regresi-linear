<?php require_once("Views/Layout/index.php"); ?>

<div class="row">
    <div class="col-md-6">
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
                                    <th>Jumlah Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;

                                foreach ($data['items'] as $item) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $item['x'] ?></td>
                                        <td><?= $item['y'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
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
                                    <th>Nilai (Y)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data['perhitungan']['dataset'] as $bulan_tahun => $nilai) : ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $bulan_tahun ?></td>
                                        <td><?= $nilai['periode'] ?></td>
                                        <td><?= $nilai['total'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
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
                                    <th>y</th>
                                    <th>x^</th>
                                    <th>xy</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data['perhitungan']['dataset'] as $bulan_tahun => $nilai) : ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $bulan_tahun ?></td>
                                        <td><?= $nilai['x'] ?></td>
                                        <td><?= $nilai['y'] ?></td>
                                        <td><?= $nilai['x_kuadrat'] ?></td>
                                        <td><?= $nilai['xy'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
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
                            <code>
                                Σx = <?= $data['perhitungan']['total_x'] ?> <br>
                                Σy = <?= $data['perhitungan']['total_y'] ?> <br>
                                Σx^ = <?= $data['perhitungan']['total_x_kuadrat'] ?> <br>
                                Σxy = <?= $data['perhitungan']['total_xy'] ?>
                            </code>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
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
                            <code>
                                a = (Σy * Σx^ - Σx * Σxy) / (n * Σx^ - Σx^2) = <?= $data['perhitungan']['a'] ?> <br>
                                b = (n * Σxy - Σx * Σy) / (n * Σx^ - Σx^2) = <?= $data['perhitungan']['b'] ?>

                            </code>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>