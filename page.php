<?php

?>
<!DOCTYPE html>
<html lang="zh-CN">
    <head> 
        <?php $this->need('layout/include.php'); ?>
    </head>
    
    <body>
        <div id="Fall">
            <main class="lg_container main bg"><!-- 全局 手机端768px去除类名main -->
            
                <!-- 左侧 手机端768px不显示 -->
                <?php $this->need('layout/aside.php'); ?>
                
                <div class="conter_container article_post">
                    <div class="article_top_img" style="background:url(<?php echo _getThumbnails($this)[0] ?>) center;background-repeat:no-repeat;"> <!-- 文章头图 -->
                    </div>
                    <article class="px-5 py-5 article_post_main">
                        <div class="article_header">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3><?php $this->title() ?></h3>
                                    <span><?php $this->date('Y'); ?></span>
                                    <span>丨</span>
                                    <span><?php get_post_view($this) ?> 阅读者</span>
                                </div>
                                <div class="time">
                                    <span><?php $this->date('m / d'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="post-content">
                            <?php _article_changetext($this, $this->user->hasLogin()) ?>
                        </div>
                    </article>
                    
                    <div class="px-5 py-5 comment-bg">
                        <?php $this->need('comments.php'); ?>
                    </div>
                </div>
                
                <!-- 右侧 手机端768px不显示 -->
                <?php $this->need('layout/sidebar.php'); ?>
                
            </main><!-- 全局 手机端768px去除类名main END -->
            <?php $this->need('footer.php'); ?>
        </div>
    </body>
</html>