<?php require_once("Views/Layout/index.php"); ?>

<div class="row">
    <div class="col-md-3">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Pengujian</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-card-body p-4">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="percentageTest" class="form-label">Presentase Test <code>%</code></label>
                            <br> <small>*masukan nilai presentase dari dataset preprocessing</small>
                            <input type="number" class="form-control" id="percentageTest" name="percentageTest" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if ($data['pengujian'] != 0) : ?>
        <div class="col-md-12">
            <div class="app-card shadow-sm mb-4 border-left-decoration">
                <div class="inner">
                    <div class="app-card-header p-4">
                        <div class="app-card-header-title">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="app-card-title">Data Test</h4>
                                </div>
                            </div>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($data['pengujian']['dataTest'] as $bulan_tahun => $nilai) : ?>

                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $nilai['bulan_tahun'] ?></td>
                                            <td><?= $nilai['x'] ?></td>
                                            <td><?= $nilai['y'] ?></td>
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
                                    <h4 class="app-card-title">Hasil Prediksi</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="app-card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th width="2px">No</th>
                                        <th>Periode</th>
                                        <th>Actual</th>
                                        <th>Prediction</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($data['pengujian']['results'] as $bulan_tahun => $nilai) : ?>

                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $nilai['periode'] ?></td>
                                            <td><?= $nilai['actual'] ?></td>
                                            <td><?= $nilai['prediction'] ?></td>
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
            <div class="app-card shadow-sm mb-4 border-left-decoration bg-success">
                <div class="inner">
                    <div class="app-card-header p-4">
                        <div class="app-card-header-title">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="app-card-title">RMSE</h1>
                                    <h1> <code><?= $data['pengujian']['rmse'] ?></code></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>