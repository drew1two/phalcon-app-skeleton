<h1>Dummy</h1>

<p><?php echo $t->_('hello'); ?></p>

<ul>
    <li><?php echo $this->tag->linkTo(array('admin/dummy/json', 'Json output test')); ?></li>
    <li><?php echo $this->tag->linkTo(array('admin/dummy/cache', 'Cache test')); ?></li>
    <li><?php echo $this->tag->linkTo(array('admin/dummy/session', 'Session test')); ?></li>
    <li><?php echo $this->tag->linkTo(array('admin/dummy/upload', 'Upload test')); ?></li>
</ul>