<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <form action="<?= base_url() ?>dataset/update" method="POST">
                    <input type="hidden" name="id" value="<?= $data['item']['id'] ?>">
                    <div class="form-group">
                        <label for="x">Tanggal (x)</label>
                        <input type="text" name="x" id="x" class="form-control" value="<?= $data['item']['x'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="y">Jumlah (y)</label>
                        <input type="number" name="y" id="y" class="form-control" value="<?= $data['item']['y'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>