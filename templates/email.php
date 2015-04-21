<?php $this->layout('base-layout', ['title' => 'Email']) ?>

<form class="" method="POST">
    <div class="form-group">
      <label>To</label>
      <input class="form-control" type="text" name="to" placeholder="to" value="<?= $this->e($to) ?>" />
    </div>

    <div class="form-group">
      <label>Subject</label>
      <input class="form-control" type="text" name="subject" placeholder="subject" value="<?= $this->e($subject) ?>" />
    </div>

    <div class="form-group">
      <textarea class="form-control" name="message" rows="20" autofocus="autofocus"><?= $this->e($message) ?></textarea>
    </div>

    <div class="form-group text-right">
      <button type="submit" class="btn btn-primary">Send</button>
    </div>
</form>
