<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mb-3 mt-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $komik['sampul'] ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $komik['judul'] ?></h5>
                            <p class="card-text"><?= $komik['penulis'] ?></p>
                            <p class="card-text"><?= $komik['slug'] ?></p>
                            <p class="card-text"><small class="text-body-secondary"><?= $komik['penerbit'] ?></small></p>

                            <a href="/komik/edit/<?= $komik['slug'] ?>" class="btn btn-sm btn-info">Edit</a>

                            <form action="/komik/delete/<?= $komik['id'] ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                            <br><br>
                            <a href="/komik" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>