<?php require_once("Views/Layout/index.php"); ?>
<div class="row">
    <?php if ($data['form'] == 1) : ?>
        <div class="col-md-12">
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
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label for="periode_start" class="form-label">periode_start</label>
                                        <input type="month" class="form-control" id="periode_start" name="periode_start" required>
                                    </div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <!-- tanda sampai dengan -->
                                    <i class="fas fa-arrow-right" style="margin-top: 30px;"></i>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label for="periode_end" class="form-label">periode_end</label>
                                        <input type="month" class="form-control" id="periode_end" name="periode_end" required>
                                    </div>
                                </div>
                            </div>
                            <!-- full width button -->

                            <div class="mb-3 d-grid">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
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
                        <?php if (!empty($data['prediksi'])) : ?>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Periode</th>
                                            <th colspan="8"><?= $data['periode'] ?></th>
                                        </tr>
                                        <tr>
                                            <?php
                                            for ($i = 0; $i <= 8; $i++) {
                                                echo "<th>GOL " . ($i + 1) . "</th>";
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>

                                            <td><?= $data['prediksi']['y1'] ?></td>
                                            <td><?= $data['prediksi']['y2'] ?></td>
                                            <td><?= $data['prediksi']['y3'] ?></td>
                                            <td><?= $data['prediksi']['y4'] ?></td>
                                            <td><?= $data['prediksi']['y5'] ?></td>
                                            <td><?= $data['prediksi']['y6'] ?></td>
                                            <td><?= $data['prediksi']['y7'] ?></td>
                                            <td><?= $data['prediksi']['y8'] ?></td>
                                            <td><?= $data['prediksi']['y9'] ?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            <?php else : ?>
                                <tr>
                                    <td colspan="10">Tidak ada data prediksi</td>
                                </tr>
                            <?php endif; ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
</div>