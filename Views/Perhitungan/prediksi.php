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
                            <input type="number" class="form-control" id="periode" name="periode" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if ($data['prediksi'] != 0) : ?>
        <div class="col-md-6">
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
                        <code>
                            Prediksi = <?= $data['prediksi'] ?> <br>
                            Pembulatan = <?= round($data['prediksi']) ?>
                        </code>
                        <p>
                            Jadi hasil prediksi untuk periode <?= $data['periode'] ?> adalah <?= round($data['prediksi']) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>