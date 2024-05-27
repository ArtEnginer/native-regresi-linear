<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="card">
    <div class="card-header">
        <a href="<?= base_url() ?>dataset/tambah" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i></a>

        <a href="<?= base_url() ?>dataset/import" class="btn btn-success btn-sm">
            <i class="fa fa-file-excel"></i></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th width="2px">No</th>
                        <th>X</th>
                        <th>Y</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['items'] as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item['x'] ?></td>
                            <td><?= $item['y'] ?></td>
                            <td>
                                <a href="<?= base_url() ?>dataset/edit?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm text-white">
                                    <i class="fa fa-edit"></i></a>
                                </a>
                                <a href="<?= base_url() ?>dataset/delete?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm text-white">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>