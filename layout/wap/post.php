<!--

默认文章样式

-->
	<!-- 文章内容 -->
	<div class="article_header">
		<!-- 文章信息 -->
		<div class="flex justify-between items-center">
			<div>
				<h3>
					<?php $this->title() ?>
				</h3>
				<span>
					<?php $this->author(); ?>
				</span>
				<span>丨</span>
				<span>
					<?php $this->date('Y'); ?>
				</span>
				<span>丨</span>
				<span>
					<?php get_post_view($this) ?> 阅读者</span>
				<span>丨</span>
				<span>
					<?php $this->commentsNum('0 ', '1 ', '%d '); ?>评论者</span>
				<?php if($this->fields->article_type == "0") { ?>
				<!-- 默认文章添加tags -->
				<p>
					<?php $this->tags(' ', true, 'none'); ?>
				</p>
				<?php }?>
			</div>
			<div class="time">
				<span>
					<?php $this->date('m / d'); ?>
				</span>
			</div>
		</div>
	</div><!-- 文章信息 END -->
	<div class="post-content">
		<!-- 文章内容输出 -->
		<?php _article_changetext($this, $this->user->hasLogin()) ?>
	</div><!-- 文章内容输出 END -->