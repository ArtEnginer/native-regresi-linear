<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>

<div class="row">
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data['items'] as $itm) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $itm['periode_start'] ?></td>
                                    <td><?= $itm['periode_end'] ?></td>
                                    <td>
                                        <!-- Form untuk detail -->
                                        <form action="<?= base_url() ?>perhitungan/prediksi ?>" method="get">
                                            <!-- Input hidden untuk menyimpan periode -->
                                            <input type="hidden" name="periode_start" value="<?= $itm['periode_start'] ?>">
                                            <input type="hidden" name="periode_end" value="<?= $itm['periode_end'] ?>">
                                            <!-- Tombol detail -->
                                            <button type="submit" class="btn btn-sm btn-primary rounded-pill shadow text-white">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <a href="<?= base_url() ?>perhitungan/deletehasil?id=<?= $itm['id'] ?>" class="btn btn-sm btn-danger rounded-pill shadow text-white">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>