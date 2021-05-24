<?= $this->extend('base_view.php'); ?>
<?= $this->section('title') ?>Registration<?= $this->endSection(); ?>


<?= $this->section('content'); ?>

<section class="uk-section">
    <div class="uk-container uk-container-small">
        
        <div class="uk-card uk-card-default">
            <div class="uk-card-body">
                <p class="uk-text-lead">Create account</p>
                
                <?php if (session()->getFlashdata('error')): ?>
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p><?= session()->getFlashdata('error'); ?></p>
                </div>
                <?php endif; ?>

                <form enctype="multipart/form-data" id="alter-login-form" class="alter-login-form uk-grid-medium uk-child-width-1-1k" uk-grid action="<?= base_url("users/register") ?>" method="POST" accept-charset="utf-8">
                    <?= csrf_field() ?>
                    <div>
                        <label for="name" class="uk-form-label">Name</label>
                        <input id="name" type="text" name="name" class="uk-input" value="<?= set_value('name') ?>">
                        <p class="uk-text-xsmall uk-margin-remove uk-padding-remove uk-text-danger"><?= session()->getFlashdata('errors')['name'] ?? '' ?></p>
                    </div>
                    
                    <div>
                        <label for="username" class="uk-form-label">Username</label>
                        <input id="username" type="text" name="username" class="uk-input" value="<?= set_value('username') ?>">
                        <p class="uk-text-xsmall uk-margin-remove uk-padding-remove uk-text-danger"><?= session()->getFlashdata('errors')['username'] ?? '' ?></p>
                    </div>
                    
                    <div>
                        <label for="email" class="uk-form-label">eMail</label>
                        <input id="email" type="email" name="email" class="uk-input" value="<?= set_value('email') ?>">
                        <p class="uk-text-xsmall uk-margin-remove uk-padding-remove uk-text-danger"><?= session()->getFlashdata('errors')['email'] ?? '' ?></p>
                    </div>
                    
                    <div>
                        <label for="" class="uk-form-label">Profile image</label>
                        <div class="uk-placeholder uk-margin-remove uk-text-center">
                            <span uk-icon="icon: cloud-upload"></span>
                            <span class="uk-text-middle">Set profile image -</span>
                            <div uk-form-custom>
                                <input name="avatar" type="file">
                                <span class="uk-link">Select avatar</span>
                            </div>
                        </div>
                        <p class="uk-text-xsmall uk-margin-remove uk-padding-remove uk-text-danger"><?= session()->getFlashdata('errors')['avatar'] ?? '' ?></p>
                    </div>
                   
                    <div>
                        <label for="password" class="uk-form-label">Password</label>
                        <input id="password" type="password" name="password" class="uk-input" value="<?= set_value('password') ?>">
                        <p class="uk-text-xsmall uk-margin-remove uk-padding-remove uk-text-danger"><?= session()->getFlashdata('errors')['password'] ?? '' ?></p>
                    </div>
                    
                    <div>
                        <label for="password" class="uk-form-label">Password repeat</label>
                        <input id="password" type="password" name="password_repeat" class="uk-input" value="<?= set_value('password_repeat') ?>">
                        <p class="uk-text-xsmall uk-margin-remove uk-padding-remove uk-text-danger"><?= session()->getFlashdata('errors')['password_repeat'] ?? '' ?></p>
                    </div>
                    
                    <div class="uk-flex uk-flex-between uk-flex-middle">
                        <button class="uk-button uk-button-primary" type="submit">Register</button>
                        
                        <div>
                            <a class="uk-link" href="<?= base_url("users/login") ?>">I have an account</a>
                            <span>-</span>
                            <a class="uk-link" href="<?= base_url("users/reset") ?>">Reset password</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</section>

<?= $this->endSection(); ?>