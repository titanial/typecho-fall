<!-- 组件 -->
<?php $this->need('layout/plugins.php'); ?>

<script src="//instant.page/5.2.0" type="module" integrity="sha384-jnZyxPjiipYXnSU0ygqeac2q7CVYMbh84q0uHVRRxEtvFPiQYbXWUorga2aqZJ0z"></script>

<script type="text/javascript" src="<?php _getAssets('assets/js/jquery.lazyload.min.js'); ?>"></script>
<script>
    //js出始化lazyload并设置图片显示方式
    $(function() {$("img.lazy").lazyload({effect: "fadeIn", threshold: 200});});
</script>
<script>
    <?php $this->options->CustomScript() ?>
</script>


<?php $this->footer(); ?>