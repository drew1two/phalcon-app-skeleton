<h2 class="content-subhead">Upload Test</h2>

<?php if (empty($result)) { ?>
    <?php echo $this->tag->form(array('dummy/upload', 'id' => 'form1', 'method' => 'POST', 'enctype' => 'multipart/form-data')); ?>
        <label>Select Files:</label> <br>
        <?php echo $this->tag->fileField(array('file1')); ?> <br>
        <?php echo $this->tag->fileField(array('file2')); ?> <br>
        <?php echo $this->tag->submitButton(array('送信')); ?> <br>
    </form>
<?php } else { ?>
    <?php echo $result; ?>
<?php } ?>