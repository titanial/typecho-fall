<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
require_once 'core/comments.php';
require_once 'core/feature.php';
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('Editor', 'edit');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('Editor', 'edit');
class Editor
{
    public static function edit()
    {
        echo "<link rel='stylesheet' href='" . Helper::options()->themeUrl . '/assets/css/option.css' . "'>";
        echo "<script src='" . Helper::options()->themeUrl . '/assets/js/editor.js' . "'></script>";

    }
}
function themeConfig($form)
{
    $logoUrl = new \Typecho\Widget\Helper\Form\Element\Text(
        'logoUrl',
        null,
        null,
        _t('站点 LOGO 地址'),
        _t('在这里填入一个图片 URL 地址，作者图片，这里包括文章作者图片显示。')
    );
    $title = new \Typecho\Widget\Helper\Form\Element\Text(
        'title',
        null,
        null,
        _t('站点称呼'),
        _t('在这里填入一个自定义名称，不填写则默认网站设置名称。')
    );
    $description = new \Typecho\Widget\Helper\Form\Element\Text(
        'description',
        null,
        null,
        _t('站点描述'),
        _t('在这里填入一个自定义描述，这个描述的存在方便使用API，不填写则默认网站设置的描述')
    );
    $themes = new \Typecho\Widget\Helper\Form\Element\Text(
        'themes',
        null,
        null,
        _t('主题色自定义'),
        _t('在这里填入一个主题自定义主色，<br>格式是rgb颜色代码数字，<br>例如：rgb(228 231 236) 只需要括号里的<b>228 231 236</b>')
    );
    $Thumbnail = new Typecho_Widget_Helper_Form_Element_Textarea(
    'Thumbnail',
    NULL,
    'https://bing.img.run/rand_uhd.php',
    '自定义缩略图',
    '介绍：用于修改主题默认缩略图 <br/>
         格式：图片地址，一行一个 <br />
         注意：不填写时，请在主题文件assets-thumb里添加1-5张为png的图片
         '
    );
    $About = new Typecho_Widget_Helper_Form_Element_Textarea(
    'About',
    NULL,
    NULL,
    '自定义右侧栏About Me',
    '介绍：用于修改主题默认About Me<br/>
         格式：内容 || Icon（中间使用两个竖杠分隔）<br />
         '
    );
    $自定义版权 = new Typecho_Widget_Helper_Form_Element_Textarea(
    '自定义版权',
    NULL,
    NULL,
    '自定义添加Blog Info',
    '介绍：用于添加主题默认Blog Info内容<br/>
         注意：pc端显示在左侧栏 wap端显示在底下，支持使用HTML<br />
         '
    );
    $自定义广告 = new Typecho_Widget_Helper_Form_Element_Textarea(
    '自定义广告',
    NULL,
    NULL,
    '自定义添加Custom',
    '介绍：用于添加主题Custom内容<br/>
         注意：pc端显示在左侧栏 wap端不显示，支持使用HTML<br />
         '
    );
    $CustomCSS = new Typecho_Widget_Helper_Form_Element_Textarea(
    'CustomCSS',
    NULL,
    NULL,
    '自定义CSS（非必填）',
    '介绍：请填写自定义CSS内容，填写时无需填写style标签。<br />
         其他：如果想修改主题色、卡片透明度等，都可以通过这个实现 <br />
         例如：body { --theme: #ff6800; --background: rgba(255,255,255,0.85) }'
  );
    $CustomScript = new Typecho_Widget_Helper_Form_Element_Textarea(
    'CustomScript',
    NULL,
    NULL,
    '自定义JS（非必填）',
    '介绍：请填写自定义JS内容，例如网站统计等，填写时无需填写script标签。'
  );
    $CustomHeadEnd = new Typecho_Widget_Helper_Form_Element_Textarea(
    'CustomHeadEnd',
    NULL,
    NULL,
    '自定义增加&lt;head&gt;&lt;/head&gt;里内容（非必填）',
    '介绍：此处用于在&lt;head&gt;&lt;/head&gt;标签里增加自定义内容 <br />
         例如：可以填写引入第三方css、js等等'
  );
    $CustomBodyEnd = new Typecho_Widget_Helper_Form_Element_Textarea(
    'CustomBodyEnd',
    NULL,
    NULL,
    '自定义&lt;body&gt;&lt;/body&gt;末尾位置内容（非必填）',
    '介绍：此处用于填写在&lt;body&gt;&lt;/body&gt;标签末尾位置的内容 <br>
         例如：可以填写引入第三方js脚本等等'
  );
    $AssetsURL = new Typecho_Widget_Helper_Form_Element_Text(
    'AssetsURL',
    NULL,
    NULL,
    '自定义静态资源CDN地址（非必填）',
    '介绍：自定义静态资源CDN地址，不填则走本地资源 <br />
     教程：<br />
     1. 将整个assets目录上传至你的CDN <br />
     2. 填写静态资源地址访问的前缀 <br />
     3. 例如：https://npm.elemecdn.com/typecho'
    );
    $form->addInput($title);
    $form->addInput($logoUrl);
    $form->addInput($description);
    $form->addInput($themes);
    $form->addInput($Thumbnail);
    $form->addInput($About);
    $form->addInput($自定义广告);
    $form->addInput($自定义版权);
    $form->addInput($CustomCSS);
    $form->addInput($CustomScript);
    $form->addInput($CustomHeadEnd);
    $form->addInput($CustomBodyEnd);
    $form->addInput($AssetsURL);

    // $sidebarBlock = new \Typecho\Widget\Helper\Form\Element\Checkbox(
    //     'sidebarBlock',
    //     [
    //         'ShowRecentPosts'    => _t('显示最新文章'),
    //         'ShowRecentComments' => _t('显示最近回复'),
    //         'ShowCategory'       => _t('显示分类'),
    //         'ShowArchive'        => _t('显示归档'),
    //         'ShowOther'          => _t('显示其它杂项')
    //     ],
    //     ['ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'],
    //     _t('侧边栏显示')
    // );

    // $form->addInput($sidebarBlock->multiMode());
}
/**
 * 独立页面与文章设置
 * @param Layout $layout
 */
function themeFields($layout) {
/*  报错 500 语法错误
    ?>
    <style>
        Textarea{
            width: 100%;
            height: 150px;
        }
    </style>
<?
*/
    $uri = $_SERVER['REQUEST_URI'];
    // 文章
    if (strstr($uri, "write-post")) {
        $article_type= new Typecho_Widget_Helper_Form_Element_Radio(
            'article_type',
            array(
                '0' => _t('文章'),
                'photos' => _t('相册'),
                'books' => _t('书单'),
                'say' => _t('说说')),
                '0',
                _t('文章类型'),
                _t("选择文章类型首页输出"));
        $layout->addItem($article_type);
        
        $books_photos = new Typecho_Widget_Helper_Form_Element_Text('books_photos', NULL, NULL, _t('书的图片'), _t('输入书图片链接'));
        $layout->addItem($books_photos);/** 输出书的图片 */
        
        $thumb = new Typecho_Widget_Helper_Form_Element_Textarea(
        'thumb',
        NULL,
        NULL,
        '自定义缩略图（非必填）',
        '填写时：将会显示填写的文章缩略图 <br>
             不填写时：<br>
                1、若文章有图片则取文章内图片 <br>
                2、若文章无图片，并且外观设置里未填写·自定义缩略图·选项，则取模板自带图片 <br>
                3、若文章无图片，并且外观设置里填写了·自定义缩略图·选项，则取自定义缩略图图片 <br>
             注意：多个缩略图时换行填写，一行一个（仅在三图模式下生效）'
      );
      $layout->addItem($thumb);

    // 页面
    }elseif(strstr($uri, "write-page")){
        $Page_Icon = new Typecho_Widget_Helper_Form_Element_Textarea(
            'Page_Icon',
            null,
            null,
            '图标标识',
            '介绍：此处填写喜爱的图标代码或<a href="https://www.emojidaquan.com/" target="_blank"> Emoji </a>符号<br>
             说明：默认使用<a href="https://remixicon.com/" target="_blank"> Remixicon </a>图标库<br>
             示例：SVG File 或 📚 <br>
             <span style="color:#E53333;">重要：*如果是新建的页面（page）类型，此项为必填，会影响页面侧栏的图标显示<br>
             　　　如果不填写，则会以 ? 代替 , SVG File 宽度和长度为24</span>'
        );
        $layout->addItem($Page_Icon);
        
        }
        // 通用
    $keywords = new Typecho_Widget_Helper_Form_Element_Text(
    'keywords',
    NULL,
    NULL,
    'SEO关键词（非常重要！）',
    '介绍：用于设置当前页SEO关键词 <br />
         注意：多个关键词使用英文逗号进行隔开 <br />
         例如：Typecho,Typecho主题,Typecho模板 <br />
         其他：如果不填写此项，则默认取文章标签'
    );
    $layout->addItem($keywords);
    
    }
?>
