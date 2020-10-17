<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3"> Daftar User </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input name="keyword" type="text" class="form-control" placeholder="Masukkan input pencarian..." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2" name="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col ">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $numb = (int)$currentPage['page_user']; ?>
                    <?php $i = ($numb * 10) - 9; ?>
                    <?php foreach ($user as $u) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $u["nama"]; ?></td>
                            <td><?= $u["alamat"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row my-3">
        <div class="col">
            <?= $pager->links('user', 'user_page'); ?>
        </div>
    </div>

    <?= $this->endSection(); ?>