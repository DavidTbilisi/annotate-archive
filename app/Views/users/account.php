<?= $this->extend('base_view.php'); ?>
<?= $this->section('title') ?>Update account information<?= $this->endSection(); ?>


<?= $this->section('content'); ?>

<section class="uk-section">
    <div class="uk-container uk-container-small">
        
        <div class="uk-card uk-card-default">
            <div class="uk-card-body">
                
                <div class="uk-flex uk-flex-between uk-flex-middle">
                    <p class="uk-text-lead">Update account</p>
                    <a href="<?= base_url("users/profile/" . session()->get('userid')) ?>"><span uk-icon="icon: arrow-left; ratio: 1"></span> Go to profile page</a>
                </div>
                
                <?php if (session()->getFlashdata('error')): ?>
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p><?= session()->getFlashdata('error'); ?></p>
                </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('message')): ?>
                <div class="uk-alert-info" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p><?= session()->getFlashdata('message'); ?></p>
                </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('success')): ?>
                <div class="uk-alert-success" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p><?= session()->getFlashdata('success'); ?></p>
                </div>
                <?php endif; ?>

                <form enctype="multipart/form-data" id="alter-login-form" class="alter-login-form uk-grid-medium uk-child-width-1-1k" uk-grid action="<?= base_url("users/account/" . session()->get('userid')) ?>" method="POST" accept-charset="utf-8">
                    
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT" />
                    
                    <div>
                        <label for="name" class="uk-form-label">Name</label>
                        <input id="name" type="text" name="name" class="uk-input" value="<?= $user->name ?>">
                        <p class="uk-text-xsmall uk-margin-remove uk-padding-remove uk-text-danger"><?= session()->getFlashdata('errors')['name'] ?? '' ?></p>
                    </div>
                    
                    <div>
                        <label for="username" class="uk-form-label">Username</label>
                        <input id="username" type="text" name="username" class="uk-input" value="<?= $user->username ?>">
                        <p class="uk-text-xsmall uk-margin-remove uk-padding-remove uk-text-danger"><?= session()->getFlashdata('errors')['username'] ?? '' ?></p>
                    </div>
                    
                    <div>
                        <label for="email" class="uk-form-label">eMail</label>
                        <input id="email" type="email" name="email" class="uk-input" value="<?= $user->email ?>">
                        <p class="uk-text-xsmall uk-margin-remove uk-padding-remove uk-text-danger"><?= session()->getFlashdata('errors')['email'] ?? '' ?></p>
                    </div>
                    
                    <div>
                        <input type="hidden" name="avatar_hidden" value="<?= $user->avatar ?>">
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
                        <button class="uk-button uk-button-primary" type="submit">Update account</button>
                        
                        <a href="<?= base_url("users/profile/" . session()->get('userid')) ?>"><span uk-icon="icon: arrow-left; ratio: 1"></span> Go to profile page</a>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</section>

<?= $this->endSection(); ?>