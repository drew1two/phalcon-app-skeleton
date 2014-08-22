<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My awesom site">
    
        <?php echo $this->tag->getTitle(); ?>
    
    
        <?php echo $this->tag->stylesheetLink('http://yui.yahooapis.com/pure/0.5.0/pure-min.css', false); ?>
        <?php echo $this->tag->stylesheetLink('assets/css/layouts/side-menu.css'); ?>
    
    
        <?php echo $this->tag->javascriptInclude('http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js', false); ?>
        <?php echo $this->tag->javascriptInclude('assets/js/ui.js'); ?>
    
</head>
<body>
    <div id="layout">
        <!-- Menu toggle -->
        <a href="#menu" id="menuLink" class="menu-link">
            <!-- Hamburger icon -->
            <span></span>
        </a>
        <div id="menu">
            <div class="pure-menu pure-menu-open">
                <?php echo $this->tag->linkTo(array('', 'Site Top', 'class' => 'pure-menu-heading')); ?>
                <ul>
                    <li><?php echo $this->tag->linkTo(array('dummy/', 'Dummy')); ?></li>
                    <li class="menu-item-divided"><?php echo $this->tag->linkTo(array('admin/', 'Admin')); ?></li>
                </ul>
            </div>
        </div>
        <div id="main">
            <?php echo $this->getContent(); ?>
        </div>
    </div>
</body>
</html>

