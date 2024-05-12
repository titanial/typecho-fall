<!-- 出全局内容 隔开方便操作 这里全是手机端导航-->
<?php if(wap()) { ?>
<!-- 手机端的左侧导航弹出内容 -->
<div class="wap_sidebar">
	<div class="wap_left_nav" unselectable="on" style="margin-left: -100%;">
		<div class="wap_left_widht">
			<div class="mobile-sidebar-header">
				<div class="Fall_action_item mode">
					<a class="color-333">
						<svg class="icon-1 active" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor">
							<path d="M587.264 104.96c33.28 57.856 52.224 124.928 52.224 196.608 0 218.112-176.128 394.752-393.728 394.752-29.696 0-58.368-3.584-86.528-9.728C223.744 832.512 369.152 934.4 538.624 934.4c229.376 0 414.72-186.368 414.72-416.256 1.024-212.992-159.744-389.12-366.08-413.184z"></path>
							<path d="M340.48 567.808l-23.552-70.144-70.144-23.552 70.144-23.552 23.552-70.144 23.552 70.144 70.144 23.552-70.144 23.552-23.552 70.144zM168.96 361.472l-30.208-91.136-91.648-30.208 91.136-30.208 30.72-91.648 30.208 91.136 91.136 30.208-91.136 30.208-30.208 91.648z"></path>
						</svg>
					</a>
					<a class="color-333">
						<svg class="icon-2" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor">
							<path d="M234.24 512a277.76 277.76 0 1 0 555.52 0 277.76 277.76 0 1 0-555.52 0zM512 187.733a42.667 42.667 0 0 1-42.667-42.666v-102.4a42.667 42.667 0 0 1 85.334 0v102.826A42.667 42.667 0 0 1 512 187.733zm-258.987 107.52a42.667 42.667 0 0 1-29.866-12.373l-72.96-73.387a42.667 42.667 0 0 1 59.306-59.306l73.387 72.96a42.667 42.667 0 0 1 0 59.733 42.667 42.667 0 0 1-29.867 12.373zm-107.52 259.414H42.667a42.667 42.667 0 0 1 0-85.334h102.826a42.667 42.667 0 0 1 0 85.334zm34.134 331.946a42.667 42.667 0 0 1-29.44-72.106l72.96-73.387a42.667 42.667 0 0 1 59.733 59.733l-73.387 73.387a42.667 42.667 0 0 1-29.866 12.373zM512 1024a42.667 42.667 0 0 1-42.667-42.667V878.507a42.667 42.667 0 0 1 85.334 0v102.826A42.667 42.667 0 0 1 512 1024zm332.373-137.387a42.667 42.667 0 0 1-29.866-12.373l-73.387-73.387a42.667 42.667 0 0 1 0-59.733 42.667 42.667 0 0 1 59.733 0l72.96 73.387a42.667 42.667 0 0 1-29.44 72.106zm136.96-331.946H878.507a42.667 42.667 0 1 1 0-85.334h102.826a42.667 42.667 0 0 1 0 85.334zM770.987 295.253a42.667 42.667 0 0 1-29.867-12.373 42.667 42.667 0 0 1 0-59.733l73.387-72.96a42.667 42.667 0 1 1 59.306 59.306l-72.96 73.387a42.667 42.667 0 0 1-29.866 12.373z"></path>
						</svg>
					</a>
				</div>
			</div>
			<!--导航-->
			<div class="wap_mian_nav">
				<div class="wap_title_nav">
					<ul id="wap_content_nav">
						<li>
							<div>
								<span>页面</span>
								<strong class="navsrg">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
										<path d="M16 12L10 18V6L16 12Z"></path>
									</svg>
								</strong>
							</div>
							<ul style="display: none;">
							    <li><a<?php if($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>
								<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
								<?php while($pages->next()): ?>
								<li>
									<a<?php if($this->is('page', $pages->slug)): ?> class="current"
										<?php endif; ?> href="
										<?php $pages->permalink(); ?>" title="
										<?php $pages->title(); ?>">
										<?php $pages->title(); ?>
										</a>
								</li>
								<?php endwhile; ?>
							</ul>
						</li>
					</ul>
				</div>
				<div class="wap_title_nav">
					<ul id="wap_content_nav">
						<li>
							<div>
								<span>分类</span>
								<strong class="navsrg">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
										<path d="M16 12L10 18V6L16 12Z"></path>
									</svg>
								</strong>
							</div>
							<ul style="display: none;">
								<?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
								<?php while($category->next()): ?>
								<li>
									<a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>">
										<?php $category->name(); ?>
									</a>
								</li>
								<?php endwhile; ?>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- 手机端的左侧导航弹出内容 end -->
<?php } ?>