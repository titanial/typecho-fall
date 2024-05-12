<!--

相册

-->
<div class="post-content_title">
    <span class="none"><?php get_post_view($this) ?> 阅读者</span>
        <span>文表</span>
    </div>
<div class="post-content photos">
	<?php echo getArticleText($this->content);?>
</div>

<!--

pc端的相册代码显示在sidebar.php里

-->

<!--

这里是wap端相册代码 原因手机端会去除左侧栏

-->

<?php if(wap()) { ?> <!-- wap端显示 -->
    <div class="img_title">
        <span>图表</span>
    </div>
    <div class="img_list">
        <?php echo getArticleImage($this,'single');?>
    </div>
    <style>
        .img_title , .post-content_title {
            color: var(--Color_A);
            font-size: 0.75rem;
            margin-bottom: 10px;
        }
    </style>
<?php } else {?><!-- PC端显示 -->
    <style>
        .img_list {
            display: grid;
            grid-template-columns: repeat(2,1fr);
            gap: 0.5rem;
        }
        .img_list .post-content{
            margin: inherit;
        }
        .img_list .post-content img {
            width: auto;
            display: block;
            border-radius: 0.5rem;
            max-width: 100%;
            margin: auto;
            cursor: zoom-in;
            -webkit-transition: 0.2s;
            transition: 0.2s;
            height: 100%;
        }
    </style>
<?php } ?><!-- wap端显示 END -->
