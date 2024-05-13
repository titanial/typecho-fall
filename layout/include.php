<meta charset="utf-8" />
<meta name="renderer" content="webkit" />
<meta name="format-detection" content="email=no" />
<meta name="format-detection" content="telephone=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, shrink-to-fit=no, viewport-fit=cover">
<link rel="shortcut icon" href="<?php $this->options->JFavicon() ?>" />
<title><?php $this->archiveTitle(array('category' => '分类 %s 下的文章', 'search' => '包含关键字 %s 的文章', 'tag' => '标签 %s 下的文章', 'author' => '%s 发布的文章'), '', ' - '); ?><?php $this->options->title(); ?></title>
<?php if ($this->is('single')) : ?>
  <meta name="keywords" content="<?php echo $this->fields->keywords ? $this->fields->keywords : htmlspecialchars($this->_keywords); ?>" />
  <meta name="description" content="<?php echo $this->fields->description ? $this->fields->description : htmlspecialchars($this->_description); ?>" />
  <?php $this->header('keywords=&description='); ?>
<?php else : ?>
  <?php $this->header(); ?>
<?php endif; ?>
<canvas id="universe"></canvas>
<link rel="stylesheet" type="text/css" media="all"  href="<?php _getAssets('assets/css/grid.css'); ?>" rel="stylesheet" />
<link rel="stylesheet" type="text/css" media="all"  href="<?php _getAssets('assets/css/comments.css'); ?>" rel="stylesheet" />
<link rel="stylesheet" type="text/css" media="all" href="<?php _getAssets('assets/css/say.css'); ?>"/>
<?php if(wap()) { ?>
<!-- 手机端 -->
<link rel="stylesheet" type="text/css" media="all" href="<?php _getAssets('assets/css/wap.css'); ?>" />
<?php } else { ?>
<!-- 电脑端 -->
<link rel="stylesheet" type="text/css" media="all" href="<?php _getAssets('assets/css/style.css'); ?>"/>
<?php } ?>
<?php $this->options->CustomHeadEnd() ?>
<style>
    <?php if ($this->options->themes): ?>
    :root{
        --public_A:<?php $this->options->themes() ?>;
    }
    <?php else: ?>
    :root{
        --public_A:170 171 211;
    }
    <?php endif;?>
    @font-face {
        font-display: swap;
        font-family: wodeziti;
        src: url('https://dsfs.oppo.com/store/public/font/OPPOSans-Medium.woff2') format("truetype");
    }
    <?php $this->options->CustomCSS() ?>
</style>
<script>
    localStorage.getItem("data-night") && document.querySelector("html").setAttribute("data-night", "night");
</script>
<script type="text/javascript" src="<?php _getAssets('assets/js/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php _getAssets('assets/js/global.js'); ?>"></script>
<script type="text/javascript" src="<?php _getAssets('assets/js/night.js'); ?>"></script>
<script type="text/javascript" src="<?php _getAssets('assets/js/universe.min.js'); ?>"></script>
<script type="text/javascript" src="<?php _getAssets('assets/js/view-image.min.js'); ?>"></script>
<script>
    window.ViewImage && ViewImage.init('.postlist_album img , .post-content img');
</script>
