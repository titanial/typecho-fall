<div class="books_bg flex justify-between my-2">
    <div class="books_desc flex flex-col justify-between">
        <p><?php $this->excerpt(80, '...'); ?></p>
        <p><?php echo formatTime($this->created); ?></p>
    </div>
    <div class="books_img">
        <img src="<?php $this->fields->books_photos(); ?>">
    </div>
</div>