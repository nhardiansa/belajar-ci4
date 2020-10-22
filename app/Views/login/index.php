<?= $this->extend('layout/template login'); ?>

<?= $this->section('content'); ?>



<div class="container h-100">
    <div class="row h-100 align-items-center justify-content-center">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">LOGIN</h5>

                    <form action="/login/verify" method="POST">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input name="email" type="email" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : ''; ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password" type="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : ''; ?>" id="exampleInputPassword1">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>







<?= $this->endSection(); ?>