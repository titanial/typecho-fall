<!-- 右侧 手机端768px不显示 -->
<aside class="right_container px-5 py-5">
    
        <?php if ($this->is('post')) : ?> <!-- 先判断是不是post页面 是的话实现下面内容 -->
        <?php if($this->category == "photos"): ?> <!-- 判断分类是不是为相册样式 是的话实现下面内容 -->
        <div class="img_title">
            <span>图库表</span>
        </div>
        <div class="img_list">
            <?php echo getArticleImage($this,'single');?>
        </div>
        <style>
        /* 去掉旧侧栏 */
            section{
                display: none;
            }
        </style>
        <?php endif; ?><!-- 先判断是不是相册分类 END -->
        <?php endif; ?><!-- 先判断是不是post页面 END -->
    
    
    <!-- 关于 -->
    <section class="right_Tabs">
        <div class="pb-5 flex justify-between items-center">
            <span>Tabs</span>
            <div class="Tabs_top flex items-center">
                <ul id="nav_menu" class="list_style flex ">
                    <li class="list_style Tabs_title">About</li>
                    <li class="list_style">Statistics</li>
                </ul>
            </div>
        </div>
        
        <div class="Tabs_center">
            <p class="Tabs-center_title">About Me</p>
            <div class="Tabs_About">
                <div class="Tabs_About_svg flex items-center">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M17.0839 15.812C19.6827 13.0691 19.6379 8.73845 16.9497 6.05025C14.2161 3.31658 9.78392 3.31658 7.05025 6.05025C4.36205 8.73845 4.31734 13.0691 6.91612 15.812C7.97763 14.1228 9.8577 13 12 13C14.1423 13 16.0224 14.1228 17.0839 15.812ZM8.38535 17.2848L12 20.8995L15.6147 17.2848C14.9725 15.9339 13.5953 15 12 15C10.4047 15 9.0275 15.9339 8.38535 17.2848ZM12 23.7279L5.63604 17.364C2.12132 13.8492 2.12132 8.15076 5.63604 4.63604C9.15076 1.12132 14.8492 1.12132 18.364 4.63604C21.8787 8.15076 21.8787 13.8492 18.364 17.364L12 23.7279ZM12 10C12.5523 10 13 9.55228 13 9C13 8.44772 12.5523 8 12 8C11.4477 8 11 8.44772 11 9C11 9.55228 11.4477 10 12 10ZM12 12C10.3431 12 9 10.6569 9 9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9C15 10.6569 13.6569 12 12 12Z"></path></svg>
                    </span>
                    <p>Xian You Xian</p>
                </div>
                <div class="Tabs_About_svg flex items-center">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M11.9996 0.5L16.2256 6.68342L23.4123 8.7918L18.8374 14.7217L19.053 22.2082L11.9996 19.6897L4.94617 22.2082L5.16179 14.7217L0.586914 8.7918L7.7736 6.68342L11.9996 0.5ZM11.9996 4.044L9.02186 8.40151L3.95659 9.887L7.18152 14.0655L7.02859 19.34L11.9996 17.566L16.9696 19.34L16.8177 14.0655L20.0416 9.887L14.9773 8.40151L11.9996 4.044ZM9.99959 12C9.99959 13.1046 10.895 14 11.9996 14C13.1042 14 13.9996 13.1046 13.9996 12H15.9996C15.9996 14.2091 14.2087 16 11.9996 16C9.79045 16 7.99959 14.2091 7.99959 12H9.99959Z"></path></svg>
                    </span>
                    <p>Fall当前版本:<?php echo _getVersion();?></p>
                </div>
            </div>
            
            <div class="Statistics" style="display: none;">
                <!-- 使用页面来发布公告 -->
               <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
                <li class="flex items-center">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M20 22H4C3.44772 22 3 21.5523 3 21V3C3 2.44772 3.44772 2 4 2H20C20.5523 2 21 2.44772 21 3V21C21 21.5523 20.5523 22 20 22ZM19 20V4H5V20H19ZM7 6H11V10H7V6ZM7 12H17V14H7V12ZM7 16H17V18H7V16ZM13 7H17V9H13V7Z"></path></svg>
                    </span>
                    <span>文章总数：<?php $stat->publishedPostsNum() ?>篇</span>
                </li>
                <li class="flex items-center">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M6 7V4C6 3.44772 6.44772 3 7 3H13.4142L15.4142 5H21C21.5523 5 22 5.44772 22 6V16C22 16.5523 21.5523 17 21 17H18V20C18 20.5523 17.5523 21 17 21H3C2.44772 21 2 20.5523 2 20V8C2 7.44772 2.44772 7 3 7H6ZM6 9H4V19H16V17H6V9ZM8 5V15H20V7H14.5858L12.5858 5H8Z"></path></svg>
                    </span>
                    <span>分类总数：<?php $stat->categoriesNum() ?>个</span>
                </li>
                <li class="flex items-center">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M6.45455 19L2 22.5V4C2 3.44772 2.44772 3 3 3H21C21.5523 3 22 3.44772 22 4V18C22 18.5523 21.5523 19 21 19H6.45455ZM5.76282 17H20V5H4V18.3851L5.76282 17ZM11 10H13V12H11V10ZM7 10H9V12H7V10ZM15 10H17V12H15V10Z"></path></svg>
                    </span>
                    <span>评论总数：<?php $stat->publishedCommentsNum() ?>条</span>
                </li>
                <li class="flex items-center">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M21 8V20.9932C21 21.5501 20.5552 22 20.0066 22H3.9934C3.44495 22 3 21.556 3 21.0082V2.9918C3 2.45531 3.4487 2 4.00221 2H14.9968L21 8ZM19 9H14V4H5V20H19V9ZM8 7H11V9H8V7ZM8 11H16V13H8V11ZM8 15H16V17H8V15Z"></path></svg>
                    </span>
                    <span>页面总数：<?php $stat->publishedPagesNum() ?>个</span>
                </li>
            </div>
        </div>
    </section>
    
    <!-- 文章热门 -->
    <!-- 最新评论 -->
    <section class="reply_aside__item">
        <h6 class="reply_widget-title"><?php _e('Latest Reply'); ?></h6>
        <ul class="reply_widget-list wid_comment">
            <?php if ($this->have()): ?>
            <?php $this->widget('Widget_Comments_Recent','ignoreAuthor=true&pageSize=5')->to($comments); ?>
            <?php while ($comments->next()): ?>
        	<li class="wid_comment_item">
        		<div class="left">
        			<a href="<?php $comments->permalink(); ?>">
        				<img src="<?php _getAvatarByMail($comments->mail) ?>" class="avatar photo" height="100" width="100">
        			</a>
        		</div>
        		<div class="right">
        			<a class="name"><?php $comments->author(false); ?></a>
        			<div class="body"><?php $comments->excerpt(35, '...'); ?></div>
        			<div class="meta"><?php $comments->date('Y-m-d'); ?></div>
        		</div>
        	</li>
            <?php endwhile; ?>
            <?php else: ?>这人真孤独<?php endif; ?>
        </ul>
    </section>
    
    <!-- 博客信息 -->
    <section class="Info_aside__item">
        <h6 class="Info_widget-title"><?php _e('Blog Info'); ?></h6>
        <ul class="list_style">
            <li>页面加载耗时：<?php _endCountTime(); ?></li>
            <li>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.<?php _e('由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>.当前使用<a href="//ouyu.me"><?php echo _Themes();?>主题</a>.</li>
        </ul>
    </section>
    
</aside>