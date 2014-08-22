<h2 class="content-subhead">Menu</h2>

<p><?php echo $t->_('hello'); ?></p>

<ul>
    <li><?php echo $this->tag->linkTo(array('dummy/json', 'Json output test')); ?></li>
    <li><?php echo $this->tag->linkTo(array('dummy/cache', 'Cache test')); ?></li>
    <li><?php echo $this->tag->linkTo(array('dummy/session', 'Session test')); ?></li>
    <li><?php echo $this->tag->linkTo(array('dummy/upload', 'Upload test')); ?></li>
    <li><?php echo $this->tag->linkTo(array('dummy/find', 'Find test')); ?></li>
    <li><?php echo $this->tag->linkTo(array('dummy/update', 'Update test')); ?></li>
    <li><?php echo $this->tag->linkTo(array('dummy/log', 'Log test')); ?></li>
    <li><?php echo $this->tag->linkTo(array('dummy/mail', 'Mail test')); ?></li>
    <li><?php echo $this->tag->linkTo(array('dummy/signup', 'Sign Up test')); ?></li>
    <li><a href="<?php echo $secureUrl; ?>">Secure Url Test</a></li>
</ul>