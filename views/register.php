<h1>Create an account</h1>
<form action="/register" method="post">
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label class="form-label">Firstname</label>
                <input value="<?php echo $model->firstname;?>" name="firstname"
                       class="form-control<?php echo $model->hasError('firstname') ? ' is-invalid' : ''?>">
                <div class="invalid-feedback">
                    <?php echo $model->getFirstError('firstname')?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label class="form-label">Lastname</label>
                <input value="<?php echo $model->lastname;?>" name="lastname"
                       class="form-control<?php echo $model->hasError('lastname') ? ' is-invalid' : ''?>">
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" value="<?php echo $model->email;?>" name="email"
               class="form-control<?php echo $model->hasError('email') ? ' is-invalid' : ''?>">
        <div class="invalid-feedback">
            <?php echo $model->getFirstError('email')?>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password"
               class="form-control<?php echo $model->hasError('password') ? ' is-invalid' : ''?>">
        <div class="invalid-feedback">
            <?php echo $model->getFirstError('password')?>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Password Confirmation</label>
        <input type="password" name="confirmPassword"
               class="form-control<?php echo $model->hasError('confirmPassword') ? ' is-invalid' : ''?>">
        <div class="invalid-feedback">
            <?php echo $model->getFirstError('confirmPassword')?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>