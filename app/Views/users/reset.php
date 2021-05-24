<?= $this->extend('base_view.php'); ?>
<?= $this->section('title') ?>Password reset<?= $this->endSection(); ?>


<?= $this->section('content'); ?>

<section class="uk-section">
    <div class="uk-container uk-container-small">
        
        <div class="uk-card uk-card-default">
            <div class="uk-card-body">
                <p class="uk-text-lead">Password reset</p>
                
                <?php if (session()->getFlashdata('message')): ?>
                <div class="uk-alert-primary" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p><?= session()->getFlashdata('message'); ?></p>
                </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('error')): ?>
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p><?= session()->getFlashdata('error'); ?></p>
                </div>
                <?php endif; ?>
                
                <form id="alter-login-form" class="alter-login-form uk-grid-medium uk-child-width-1-1k" uk-grid action="<?= base_url("users/reset") ?>" method="POST" accept-charset="utf-8">
                    <?= csrf_field() ?>
                    <div>
                        <label for="email" class="uk-form-label">Existing eMail</label>
                        <input id="email" type="email" name="email" class="uk-input" value="<?= set_value('email') ?>">
                        <p class="uk-text-xsmall uk-margin-remove uk-padding-remove uk-text-danger"><?= session()->getFlashdata('errors')['email'] ?? '' ?></p>
                    </div>
                   
                    <div>
                        <label for="password" class="uk-form-label">New password</label>
                        <input id="password" type="password" name="password" class="uk-input" value="<?= set_value('password') ?>">
                        <p class="uk-text-xsmall uk-margin-remove uk-padding-remove uk-text-danger"><?= session()->getFlashdata('errors')['password'] ?? '' ?></p>
                    </div>
                    
                    <div class="uk-flex uk-flex-between uk-flex-middle">
                        <button class="uk-button uk-button-primary" type="submit">Reset password</button>
                        
                        <div>
                            <a class="uk-link" href="<?= base_url("users/register") ?>">Register new account</a>
                            <span>-</span>
                            <a class="uk-link" href="<?= base_url("users/login") ?>">Login to existing account</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</section>

<?= $this->endSection(); ?>