<?= $this->extend('layout/template login'); ?>

<?= $this->section('content'); ?>



<div class="container h-100">
    <div class="row h-100 align-items-center justify-content-center">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">DAFTAR</h5>

                    <form action="/auth/signup" method="POST">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input name="nama" type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" value="<?= old("nama"); ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input name="email" type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= old("email"); ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password" type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="exampleInputPassword1">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>







<?= $this->endSection(); ?>