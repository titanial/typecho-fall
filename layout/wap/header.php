<!--

首页头部内容含分类

-->

<header>
	<!-- 头部 分手机端和电脑端 -->
	<div class="conter_top">
		<!-- 手机端 导航按钮 头像 -->
		<div class="flex justify-between items-center ">
			<span class="anniu_nav color-333">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
					<path d="M16 18V20H5V18H16ZM21 11V13H3V11H21ZM19 4V6H8V4H19Z"></path>
				</svg>
			</span>
			<div class="header_img">
				<?php if ($this->options->logoUrl): ?>
				<a id="logo" href="<?php $this->options->siteUrl(); ?>">
					<img src="<?php $this->options->logoUrl() ?>" width="25px" height="25px" class="rounded-lg">
				</a>
				<?php else: ?>
				<a id="logo" href="<?php $this->options->siteUrl(); ?>">
					<img src="https://q1.qlogo.cn/g?b=qq&nk=160860446&s=640" width="25px" height="25px" class="rounded-lg">
				</a>
				<?php endif;?>
			</div>
		</div>
		<!-- 问候语 - 页面导航 -->
		<?php if ($this->is('index')) : ?>
		<!-- 首页显示问候语和页面导航 -->
		<!-- 问候语 -->
		<h3 class="saying color-333 pt-5">
			<script language="javaScript">
				now = new Date(),hour = now.getHours()
								                                if (hour<6){document.write("Hi~ 早上好! ")}
								                                else if (hour<9){document.write("Hi~ 早上好! ")}
								                                else if (hour<12){document.write("Hi~ 上午好! ")}
								                                else if (hour<14){document.write("Hi~ 中午好！")}
								                                else if (hour<17){document.write("Hi~ 下午好！")}
								                                else if (hour<19){document.write("Hi~ 傍晚好！")}
								                                else if (hour<22){document.write("Hi~ 晚上好！")}
								                                else {document.write("夜深了! 注意休息哦~ ")}
			</script>
		</h3>
		<!-- 问候语 END -->
		<!-- 页面导航 -->
		<div class="wap_nav_header pt-5">
			<nav id="nav-menu" class="clearfix" role="navigation">
				<a<?php if($this->is('index')): ?> class="current"
					<?php endif; ?> href="
					<?php $this->options->siteUrl(); ?>">
					<?php _e('首页'); ?>
					</a>
					<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
					<?php while($pages->next()): ?>
					<a<?php if($this->is('page', $pages->slug)): ?> class="current"
						<?php endif; ?> href="
						<?php $pages->permalink(); ?>" title="
						<?php $pages->title(); ?>">
						<?php $pages->title(); ?>
						</a>
						<?php endwhile; ?>
			</nav>
		</div>
		<!-- 页面导航 END -->
		<?php endif; ?>
		<!-- 首页显示问候语和页面导航 END -->
	</div>
</header>

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
