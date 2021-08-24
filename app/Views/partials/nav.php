
<?php function nav_item($text, $url="#") {
    $uri = service('uri');
    $u = explode("/", $url);
    $return  = "";

    if($uri->getSegment(1) == $u[count($u)-1]):
        $return .= "<li class=\"uk-active\"><a  href=\"{$url}\">{$text}</a></li>";
    else:
        $return .= "<li><a href=\"{$url}\">{$text}</a></li>";
    endif;
    return $return;
}




?>


<nav class="uk-navbar-container uk-margin" uk-navbar>
    <div class="uk-navbar-left">

        <a class="uk-navbar-item uk-logo" href="<?=base_url('/')?>">Annotate Archive</a>

        <ul class="uk-navbar-nav">
            <li>
                <?= nav_item('Book Separation Sheet', base_url('book'))?>
                <?= nav_item('Document Annotation Sheet', base_url('document'))?>
                <?= nav_item('Technical Separation Sheet', base_url('technical'))?>
            </li>
        </ul>

    </div>


    <div class="uk-navbar-right">

        <ul class="uk-navbar-nav">
            <li><a href="<?=base_url('config')?>"  uk-icon="icon: cog"></a></li>


            <li>
                <a href="#"  uk-icon="icon: user"></a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li class="uk-active"><a href="<?=base_url('users')?>">Login</a></li>
                        <li><a href="#">Item</a></li>
                        <li class="uk-nav-header">Header</li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                        <li class="uk-nav-divider"></li>
                        <li><a href="#">Item</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
