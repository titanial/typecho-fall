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
                    <article class="px-5 py-5 article_post_main"> <!-- 文章内容 -->
                    <?php if($this->category == "photos"): ?> <!-- 相册样式 -->
                    <?php $this->need('layout/post_photos.php'); ?> <!-- photos 电脑端的在sidebar里 -->
                    <?php elseif($this->category == "books"): ?><!-- 书单样式 -->
                    <!-- 笔记评论 -->
                    <?php $this->need('layout/comments_books.php'); ?>
                    <!-- 笔记评论 END -->
                    <?php elseif($this->category == "say"): ?><!-- 书单样式 -->
                    <?php $this->need('layout/post_say.php'); ?> <!-- say 同用 -->
                    <?php else: ?><!-- 默认样式 -->
                    <?php $this->need('layout/wap/post.php'); ?> <!-- article -->
                    <?php endif; ?>
                    </article> <!-- 文章内容 END-->
                    
                    
                    <?php if($this->category == "books"): ?> <!-- 书单样式不使用评论 -->
                    <?php else: ?><!-- 其他样式都添加评论 -->
                    <div class="px-5 py-5 comment-bg">
                        <?php $this->need('comments.php'); ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($this->category == "books"): ?> <!-- 书单样式 -->
                    <?php $this->need('layout/post_books.php'); ?> <!-- books 同用 -->
                    <!-- 其他样式都不显示 -->
                    <?php endif; ?>
                    
                    
                    
                </div>
                
                <!-- 右侧 手机端768px不显示 -->
                <?php $this->need('layout/sidebar.php'); ?>
                
                
            </main><!-- 全局 手机端768px去除类名main END -->
            <?php $this->need('footer.php'); ?>
        </div>
    </body>
</html>