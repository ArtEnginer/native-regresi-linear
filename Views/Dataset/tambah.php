<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <form action="<?= base_url() ?>dataset/simpan" method="POST">
                    <div class="form-group">
                        <label for="x">Tanggal (x)</label>
                        <input type="date" name="x" id="x" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="y1">Jumlah (y1)</label>
                        <input type="number" name="y1" id="y1" class="form-control">
                    </div>
                    <div class="form-group ">
                        <label for="y2">Jumlah (y2)</label>
                        <input type="number" name="y2" id="y2" class="form-control">
                    </div>
                    <div class="form-group ">
                        <label for="y3">Jumlah (y3)</label>
                        <input type="number" name="y3" id="y3" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="y4">Jumlah (y4)</label>
                        <input type="number" name="y4" id="y4" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="y5">Jumlah (y5)</label>
                        <input type="number" name="y5" id="y5" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="y6">Jumlah (y6)</label>
                        <input type="number" name="y6" id="y6" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="y7">Jumlah (y7)</label>
                        <input type="number" name="y7" id="y7" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="y8">Jumlah (y8)</label>
                        <input type="number" name="y8" id="y8" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="y9">Jumlah (y9)</label>
                        <input type="number" name="y9" id="y9" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>