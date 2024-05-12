<div class="pjax-container">
<?php if(wap()) { ?> <!-- wap底部版权 -->
    <ul class="list_style" style="font-size: .75rem;
                                    padding: 1.5rem;
                                    color: rgb(159, 159, 159);">
        <li>页面加载耗时：<?php _endCountTime(); ?></li>
        <li>&copy; <?php echo date('Y'); ?> <a style="color: rgb(159, 159, 159);" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.<?php _e('由 <a style="color: rgb(159, 159, 159);" href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>.当前使用<a style="color: rgb(159, 159, 159);" href="//ouyu.me"><?php echo _Themes();?>主题</a>.</li>
    </ul>
<?php } ?><!-- wap底部版权 END -->



<!-- 手机端导航内容 -->
<?php if ($this->is('single')) : ?> <!-- 判断是否阅读页面 -->
    <?php if(wap()) { ?> <!-- wap阅读页面显示导航 -->
        <div class="py-5 px-5 wap_fixed_nav"><!-- 加点类名装饰 -->
            <?php $this->need('layout/wap/header.php'); ?> <!-- top -->
        </div>
    <?php } ?><!-- wap阅读页面显示导航 END -->
<?php endif; ?><!-- 判断是否阅读页面 END -->
<?php $this->need('layout/wap/mobile.php'); ?> <!-- 导航弹出内容 -->
<!-- 手机端导航内容 END -->
</div>