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
                        <th>Y1</th>
                        <th>Y2</th>
                        <th>Y3</th>
                        <th>Y4</th>
                        <th>Y5</th>
                        <th>Y6</th>
                        <th>Y7</th>
                        <th>Y8</th>
                        <th>Y9</th>
                        <th>Aksi</th>
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