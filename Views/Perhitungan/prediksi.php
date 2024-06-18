<?php require_once("Views/Layout/index.php"); ?>

<div class="row">
    <div class="col-md-6">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Prediksi</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-card-body p-4">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="periode" class="form-label">Periode</label>
                            <!-- <input type="month" class="form-control" id="periode" name="periode" required> -->
                            <input type="date" class="form-control" id="periode" name="periode" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if ($data['prediksi'] != 0) : ?>
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
                                        <th>Bulan/Tahun</th>
                                        <?php for ($i = 1; $i <= 9; $i++) : ?>
                                            <th>GOL <?= $i ?></th>
                                        <?php endfor; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><?= $data['periode'] ?></td>
                                        <?php for ($i = 1; $i <= 9; $i++) : ?>
                                            <td><?= $data['prediksi']['y' . $i] ?></td>
                                        <?php endfor; ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>