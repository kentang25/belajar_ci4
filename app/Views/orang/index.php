<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>


<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>Daftar Orang</h1>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search" name="keyword"
                        aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                        name="submit">Search</button>
                </div>
            </form>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 + (6 * ($currentPage - 1)) ?>
                <?php foreach($orang as $k): ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $k['nama'] ?></td>
                    <td><?= $k['alamat'] ?></td>
                    <td>
                        <a href="" class="btn btn-success">Detail</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links('orang', 'orang_pagination') ?>
    </div>
</div>

<?= $this->endSection(); ?>