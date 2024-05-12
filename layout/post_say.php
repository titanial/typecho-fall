<div class="article_header">
	<span class="none">
		<?php get_post_view($this) ?> 阅读者</span>
	<div class="say_mian">
		<span>这是一条动态,可以敞开的聊~</span>
	</div>
</div>
<div class="post-content say">
	<?php _article_changetext($this, $this->user->hasLogin()) ?>
</div>