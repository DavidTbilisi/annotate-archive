<?= $this->extend('base_view.php'); ?>
<?= $this->section('title') ?>User profile<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<section class="uk-section uk-padding-remove-top">
    
    <div id="alter-profile-banner" class="uk-background-secondary uk-height-medium uk-overflow-hidden">
        <img class="uk-object-cover uk-display-block uk-width-1-1" src="https://picsum.photos/1920/500" alt="Profile banner"/>
    </div>
    
    <div class="uk-container">
        
        <div class="uk-grid" uk-grid>
            
            <div style="top: -100px" class="uk-width-1-3@m uk-background-default uk-position-relative uk-position-z-index uk-margin-auto uk-border-rounded uk-flex uk-flex-column uk-flex-middle uk-card uk-card-body uk-card-hover uk-box-shadow-medium">
                <div class="uk-margin-bottom uk-flex-1">
                    <?php if ($user->avatar): ?>
                    <img width="120" height="120" class="uk-object-cover uk-border-circle" src="<?= base_url("images/avatars/{$user->avatar}") ?>" alt="<?= $user->username ?> avatar"/>
                    <?php else: ?>
                    <img width="120" height="120" class="uk-object-cover" src="<?= base_url("images/avatar_default/default_avatar_". random_int(1, 10) .".svg") ?>" alt="<?= $user->username ?> avatar"/>
                    <?php endif; ?>
                </div>
                
                <?php if ($user->id == session()->get('userid')): ?>
                <div class="uk-flex uk-flex-center uk-margin-bottom uk-flex-1">
                    <div>
                        <a uk-tooltip="Edit profile" class="uk-button uk-button-group uk-button-default uk-padding-small uk-button-small uk-margin-remove" href="<?= base_url("users/account/" . session()->get('userid')) ?>" uk-icon="icon: pencil; ratio: .8;"></a>
                        <a uk-tooltip="Logout" class="uk-button uk-button-group uk-button-default uk-padding-small uk-button-small uk-margin-remove" href="<?= base_url("users/logout") ?>" uk-icon="icon: sign-out; ratio: .8;"></a>
                        <!-- <a uk-tooltip="Disable profile" class="uk-button uk-button-group uk-button-default uk-padding-small uk-button-small uk-margin-remove" href="#" uk-icon="icon: trash; ratio: .8;"></a> -->
                    </div>
                </div>
                <?php endif; ?>
                
                <ul class="uk-margin-remove uk-padding-remove uk-list uk-list-divider uk-list-hyphen uk-flex-1 uk-width-1-1">
                    <li>
                        <b>Name</b>: 
                        <i><?= $user->name ?></i>
                    </li>
                    <li>
                        <b>Username</b>: 
                        <i><?= $user->username ?></i>
                    </li>
                    <li>
                        <b>eMail</b>: 
                        <i><?= $user->email ?></i>
                    </li>
                    <li>
                        <b>Group</b>: 
                        <i><?= $user->group_title ?></i>
                    </li>
                </ul>
            </div>
            
        </div>
        
    </div>
</section>
<?= $this->endSection(); ?>