<h2 class="content-subhead">User Sign Up</h2>

<?php echo $this->tag->form(array('dummy/signup', 'id' => 'form1', 'method' => 'POST')); ?>
    
    <label>name: </label><?php echo $this->tag->textField(array('user_name')); ?> <br>
    <label>email: </label><?php echo $this->tag->textField(array('user_email')); ?> <br>
    <label>password: </label><?php echo $this->tag->passwordField(array('password')); ?> <br>
    <?php echo $this->tag->submitButton(array('送信')); ?> <br>
</form>
