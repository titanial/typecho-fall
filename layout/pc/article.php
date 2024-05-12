<!--

这是首页文章

-->

<div class="footer_post">
	<?php if ($this->have()): ?>
	<?php while($this->next()): ?>
	<div class="post_card">
		<div class="card_author flex items-center">
			<?php if ($this->options->logoUrl): ?>
			<img src="<?php $this->options->logoUrl() ?>" class="card_avatar rounded-full">
			<?php else: ?>
			<a id="logo" href="<?php $this->options->siteUrl(); ?>">
				<img src="https://q1.qlogo.cn/g?b=qq&nk=160860446&s=640" class="card_avatar rounded-full">
			</a>
			<?php endif;?>
			<div class="flex flex-col">
    			<span style="padding-left:8px;">
    				<?php $this->author(); ?>
    			</span>
    			<span style="padding-top:3px;padding-left:8px;font-size: 12px;">
    			    <?php echo formatTime($this->created); ?>
    			</span>
			</div>
		</div>
        
        <?php if($this->fields->article_type == "photos") { ?><!-- 相册样式 -->
		<?php $this->need('layout/index_photos.php'); ?>
		<?php } elseif ($this->fields->article_type == "books") { ?><!-- 书单样式 -->
		<?php $this->need('layout/index_books.php'); ?>
		<?php } elseif ($this->fields->article_type == "say") { ?><!-- 说说样式 -->
		<?php $this->need('layout/index_say.php'); ?>
		<?php } else {?><!-- 默认样式 -->
		<div class="card_info">
			<h3># <a class="decoration-none color-333" href="<?php $this->permalink() ?>">
					<?php $this->title() ?>
				</a>
			</h3>
			<p>
				<?php $this->excerpt(140, '...'); ?>
			</p>
		</div>
		<?php }?><!-- 文章样式 END -->
		<div class="card_tags flex justify-between items-center">
			<div style="color:rgb(159, 159, 159);" class="flex">
				<?php if($this->fields->article_type == "0") { ?>
				<!-- 默认文章添加tags -->
				<div class="flex items-center mr-1.5 fz-12">
					<svg xmlns="http://www.w3.org/2000/svg" class="mr-1.5" viewBox="0 0 24 24" width="12" height="12" fill="rgb(159, 159, 159)">
						<path d="M10.9042 2.10025L20.8037 3.51446L22.2179 13.414L13.0255 22.6063C12.635 22.9969 12.0019 22.9969 11.6113 22.6063L1.71184 12.7069C1.32131 12.3163 1.32131 11.6832 1.71184 11.2926L10.9042 2.10025ZM11.6113 4.22157L3.83316 11.9997L12.3184 20.485L20.0966 12.7069L19.036 5.28223L11.6113 4.22157ZM13.7327 10.5855C12.9516 9.80448 12.9516 8.53815 13.7327 7.7571C14.5137 6.97606 15.78 6.97606 16.5611 7.7571C17.3421 8.53815 17.3421 9.80448 16.5611 10.5855C15.78 11.3666 14.5137 11.3666 13.7327 10.5855Z"></path>
					</svg>
					<span>
						<?php $this->tags(' ', true, 'none'); ?>
					</span>
				</div>
				<?php }?>
				<a href="<?php $this->permalink() ?>" style="color:rgb(159, 159, 159);" class="flex items-center">
					<svg xmlns="http://www.w3.org/2000/svg" class="mr-1.5" viewBox="0 0 24 24" width="12" height="12" fill="currentColor">
						<path d="M18.0004 17V22H16.0004V17C16.0004 12.5487 18.6444 8.71498 22.4475 6.98352L23.2753 8.8047C20.1637 10.2213 18.0004 13.3581 18.0004 17ZM8.00045 17V22H6.00045V17C6.00045 13.3581 3.83723 10.2213 0.725586 8.8047L1.55339 6.98352C5.35651 8.71498 8.00045 12.5487 8.00045 17ZM12.0004 12C9.23902 12 7.00045 9.76142 7.00045 7C7.00045 4.23858 9.23902 2 12.0004 2C14.7619 2 17.0004 4.23858 17.0004 7C17.0004 9.76142 14.7619 12 12.0004 12ZM12.0004 10C13.6573 10 15.0004 8.65685 15.0004 7C15.0004 5.34315 13.6573 4 12.0004 4C10.3436 4 9.00045 5.34315 9.00045 7C9.00045 8.65685 10.3436 10 12.0004 10Z"></path>
					</svg>
					<span>阅读此文</span>
				</a>

			</div>
			<div class="flex items-center">
				<svg xmlns="http://www.w3.org/2000/svg" class="mr-1.5" viewBox="0 0 24 24" width="12" height="12" fill="rgb(159, 159, 159)">
					<path d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4ZM12 7C14.7614 7 17 9.23858 17 12C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12C7 11.4872 7.07719 10.9925 7.22057 10.5268C7.61175 11.3954 8.48527 12 9.5 12C10.8807 12 12 10.8807 12 9.5C12 8.48527 11.3954 7.61175 10.5269 7.21995C10.9925 7.07719 11.4872 7 12 7Z"></path>
				</svg>
				<a class="decoration-none">
					<?php get_post_view($this) ?> 位</a>
				<svg xmlns="http://www.w3.org/2000/svg" class="mr-1.5" viewBox="0 0 24 24" width="12" height="12" fill="rgb(159, 159, 159)">
					<path d="M2 8.99374C2 5.68349 4.67654 3 8.00066 3H15.9993C19.3134 3 22 5.69478 22 8.99374V21H8.00066C4.68659 21 2 18.3052 2 15.0063V8.99374ZM20 19V8.99374C20 6.79539 18.2049 5 15.9993 5H8.00066C5.78458 5 4 6.78458 4 8.99374V15.0063C4 17.2046 5.79512 19 8.00066 19H20ZM14 11H16V13H14V11ZM8 11H10V13H8V11Z"></path>
				</svg>
				<a class="decoration-none" href="<?php $this->permalink() ?>#comments">
					<?php $this->commentsNum('0 条', '1 条', '%d 条'); ?>
				</a>
			</div>
		</div>
	</div>

	<?php endwhile; ?>
	<?php else: ?>暂无文章
	<?php endif; ?>
</div>