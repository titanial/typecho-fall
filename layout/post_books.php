<!-- 介绍 -->
<div class="my-2 PostBooks_bg px-5 py-5 ">
    <span class="none"><?php get_post_view($this) ?> 阅读者</span>
    <div class="flex">
        <div class="left">
            <img src="<?php $this->fields->books_photos(); ?>">
        </div>
        <div class="right">
            <span><?php $this->title() ?></span>
            <div class="desc">
                <?php echo getArticleText($this->content);?>
            </div>
        </div>
    </div>
</div>
<!-- 介绍 END -->