<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Contact Page</h1>
            <p>If you have any questions, feel free to reach out!</p>
        </div>
        <?php foreach($alamat as $a): ?>
        <ul>
            <li>
                <strong>Type:</strong> <?= $a['tipe'] ?><br>
                <strong>Address:</strong> <?= $a['alamat'] ?><br>
                <strong>City:</strong> <?= $a['kota'] ?>
            </li>
            
        </ul>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection(); ?>