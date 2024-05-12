<!--

首页头部内容含分类

-->


<?php if ($this->is('index')) : ?>
<!-- 首页显示 首页头部内容 -->
<header>
	<!-- 头部 分手机端和电脑端 -->
	<div class="conter_top">
		<!-- 电脑端 头像 站名 描述 -->
		<div class="flex items-center">
			<div class="top_img">
			    <?php if ($this->options->logoUrl): ?>
                    <a id="logo" href="<?php $this->options->siteUrl(); ?>">
                        <img src="<?php $this->options->logoUrl() ?>" width="60px" height="60px" class="rounded-lg">
                    </a>
                <?php else: ?>
                    <a id="logo" href="<?php $this->options->siteUrl(); ?>">
                        <img src="https://q1.qlogo.cn/g?b=qq&nk=160860446&s=640" width="60px" height="60px" class="rounded-lg">
                    </a>
                <?php endif;?>
			</div>
			<div class="top_info px-5">
			    <?php if ($this->options->title): ?>
                   <h1><?php $this->options->title() ?></h1>
                <?php else: ?>
                    <h1><?php $this->options->title() ?></h1>
                <?php endif;?>
                <?php if ($this->options->title): ?>
                   <p><?php $this->options->description() ?></p>
                <?php else: ?>
                    <p><?php $this->options->description() ?></p>
                <?php endif;?>
			</div>
			<div class="top_siteUrl rounded-lg flex items-center">
				<span class="pr-1.5">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
						<path d="M13.0607 8.11097L14.4749 9.52518C17.2086 12.2589 17.2086 16.691 14.4749 19.4247L14.1214 19.7782C11.3877 22.5119 6.95555 22.5119 4.22188 19.7782C1.48821 17.0446 1.48821 12.6124 4.22188 9.87874L5.6361 11.293C3.68348 13.2456 3.68348 16.4114 5.6361 18.364C7.58872 20.3166 10.7545 20.3166 12.7072 18.364L13.0607 18.0105C15.0133 16.0578 15.0133 12.892 13.0607 10.9394L11.6465 9.52518L13.0607 8.11097ZM19.7782 14.1214L18.364 12.7072C20.3166 10.7545 20.3166 7.58872 18.364 5.6361C16.4114 3.68348 13.2456 3.68348 11.293 5.6361L10.9394 5.98965C8.98678 7.94227 8.98678 11.1081 10.9394 13.0607L12.3536 14.4749L10.9394 15.8891L9.52518 14.4749C6.79151 11.7413 6.79151 7.30911 9.52518 4.57544L9.87874 4.22188C12.6124 1.48821 17.0446 1.48821 19.7782 4.22188C22.5119 6.95555 22.5119 11.3877 19.7782 14.1214Z"></path>
					</svg>
				</span>
				<span><?php $this->options->siteUrl(); ?></span>
			</div>
		</div>
	</div>

	<div class="conter_category">
		<!-- 电脑端 分类导航 -->
		<div class="conter_containers">
			<div class="flex items-center justify-between">
				<div class="flex items-center container_title">
					<span class="pr-1.5">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="rgba(159,159,159,1)">
							<path d="M6 7V4C6 3.44772 6.44772 3 7 3H13.4142L15.4142 5H21C21.5523 5 22 5.44772 22 6V16C22 16.5523 21.5523 17 21 17H18V20C18 20.5523 17.5523 21 17 21H3C2.44772 21 2 20.5523 2 20V8C2 7.44772 2.44772 7 3 7H6ZM6 9H4V19H16V17H6V9ZM8 5V15H20V7H14.5858L12.5858 5H8Z"></path>
						</svg>
					</span>
					<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
					<span class="text" style="font-size:12px;">
						category
					</span>
					<span class="info">
						<?php $stat->categoriesNum() ?>
					</span>
				</div>
				<div class="container_category">
					<ul id="nav_menu" class="list_style flex ">
						<?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
						<?php while($category->next()): ?>
						<li<?php if ($this->is('post')): ?>
							<?php if ($this->category == $category->slug): ?> class="current"
							<?php endif; ?>
							<?php else: ?>
							<?php if ($this->is('category', $category->slug)): ?> class="current"
							<?php endif; ?>
							<?php endif; ?>>
							<a class="decoration-none color-333" href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>">
								<?php $category->name(); ?>
							</a>
							</li>
							<?php endwhile; ?>

					</ul>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- 首页显示 首页头部内容 end -->
<?php endif; ?>
<!-- 分类 -->
<?php if ($this->is('category')) : ?>
<!-- 如果是分类显示 -->
<div class="category_top">
    <div class="wap_category_top">
		<div class="top flex items-center">
            <img class="mr-5 rounded-lg" width="50px" height="45px" src="<?php $this->options->themeUrl('assets/category/'); ?><?php echo $this->categories[0]['slug'] . '.png'; ?>" alt="分类图片">
    		<div class="flex w-full justify-between items-end">
        	    <div class="color-333 flex flex-col">
        	        <h3><?php echo $this->categories[0]['name']; ?></h3>
        	        <?php if($this->fields->article_type == "photos") { ?><!-- 相册样式 -->
                    <?php } elseif ($this->fields->article_type == "books") { ?><!-- 书单样式 -->
                    <?php } elseif ($this->fields->article_type == "say") { ?><!-- 说说样式 -->
                    <span><?php $this->commentsNum(); ?> 条讨论 · <?php echo $this->getTotal(); ?> 条动态</span>
                    <?php } else {?><!-- 默认样式 -->
                    <span><?php $this->commentsNum(); ?> 条评论 · <?php echo $this->getTotal(); ?> 篇文章</span>
                    <?php }?>
        	    </div>
        	    <span class="anniu_top">
        	        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M17.5858 5H14V3H21V10H19V6.41421L14.7071 10.7071L13.2929 9.29289L17.5858 5ZM3 14H5V17.5858L9.29289 13.2929L10.7071 14.7071L6.41421 19H10V21H3V14Z"></path></svg>
    		    </span>
	        </div>
		</div>
		<div class="description">
		    <?php echo $this->getDescription(); ?>
		</div>
    </div>
</div>

<!-- 如果是分类显示 end -->
<?php endif; ?>
