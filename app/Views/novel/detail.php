<?= $this->extend("layout/template"); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3"> Detail Novel </h2>

            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/img/<?= $detail['sampul']; ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $detail['judul']; ?></h5>
                            <p class="card-text"><b>Penulis: </b><?= $detail['penulis']; ?></p>
                            <p class="card-text"><b>Penerbit: </b><?= $detail['penerbit']; ?></p>
                            <a href="/novel/edit/<?= $detail['slug']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/novel/<?= $detail['id']; ?>" class="d-inline" method="POST">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah kamu mau menghapus novel ini');">Delete</button>
                            </form>
                            <div class="row mt-3">
                                <a href="/novel" class="btn btn-link">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>