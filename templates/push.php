<?php $this->layout('base-layout', ['title' => 'Push']) ?>

<form class="" method="POST">
    <div class="form-group">
      <label>Channel</label>
      <input class="form-control" type="text" name="channel" placeholder="channel" value="<?= $this->e($channel) ?>" />
    </div>

    <div class="form-group">
      <label>Event</label>
      <input class="form-control" type="text" name="event" placeholder="event" value="<?= $this->e($event) ?>" />
    </div>

    <div class="form-group">
      <textarea class="form-control" name="message" rows="20" autofocus="autofocus"><?= $this->e($message) ?></textarea>
    </div>

    <div class="form-group text-right">
      <button type="submit" class="btn btn-primary">Send</button>
    </div>
</form>
