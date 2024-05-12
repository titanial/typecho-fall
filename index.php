<?php

/**
 * “ 坠落 ” <br /> “ 环境要求：PHP 5.4 ~ 7.4 ”
 * @package Fall
 * @author 林厌
 * @link https://
 */

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
                
                <main class="conter_container px-5 py-5" itemscope itemtype="http://schema.org/BlogPosting"><!-- 中间 -->
                    <?php if(wap()) { ?> <!-- wap -->
                    <?php $this->need('layout/wap/header.php'); ?> <!-- top -->
                    <?php $this->need('layout/wap/article.php'); ?> <!-- article -->
                    <?php } else { ?> <!-- pc -->
                    <?php $this->need('layout/pc/header.php'); ?> <!-- top -->
                    <?php $this->need('layout/pc/article.php'); ?> <!-- article -->
                    <?php } ?>
                    
                    <!-- 翻页 -->
                    <div class="pageNav py-5">
                        <ul class="list_style">
                            <li style="float: left;"><?php $this->pageLink('下一页','next'); ?></li>
                            <li style="float: right;"><?php $this->pageLink('上一页'); ?></li>
                        </ul>
                    </div>
                    
                </main><!-- 中间 END -->
                
                <!-- 右侧 手机端768px不显示 -->
                <?php $this->need('layout/sidebar.php'); ?>
                
            </main><!-- 全局 手机端768px去除类名main END -->
            
            <?php $this->need('footer.php'); ?>
        </div>
    </body>
    
        
</html>

