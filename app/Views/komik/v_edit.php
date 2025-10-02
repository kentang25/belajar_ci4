<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3><?= $title; ?></h3>
            
            <form method="post" action="/komik/update/<?= $komik['id'] ?>" enctype="multipart/form-data">
                
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $komik['slug'] ?>">
                <input type="hidden" name="sampulLama" value="<?= $komik['sampul'] ?>">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control <?= $validation->hasError('judul') ? 'is-invalid' : '' ?>" id="judul" name="judul" value="<?= $komik['judul'] ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('judul'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control <?= $validation->hasError('penulis') ? 'is-invalid' : '' ?>" id="penulis" name="penulis" value="<?= $komik['penulis'] ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('penulis'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" class="form-control <?= $validation->hasError('penerbit') ? 'is-invalid' : '' ?>" id="penerbit" name="penerbit" value="<?= $komik['penerbit'] ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('penerbit'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="sampul" class="form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $komik['sampul'] ?>" class="img-thumbnail img-preview mb-3">
                    </div>
                    <input type="file" class="form-control <?= $validation->hasError('sampul') ? 'is-invalid' : '' ?>" id="sampul" name="sampul" onchange="previewImg()">
                    <div class="invalid-feedback">
                        <?= $validation->getError('sampul'); ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>

    <?= $this->endSection() ?>