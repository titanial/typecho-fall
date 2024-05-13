<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * Author: 林厌
 * CreateTime: 2024/5/7
 * 主题功能
 */
/* 
 * 随机文章调用
 */
class Widget_Post_rand extends Widget_Abstract_Contents
{
    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);
        $this->parameter->setDefault(array('pageSize' => $this->options->commentsListSize, 'parentId' => 0, 'ignoreAuthor' => false));
    }
    public function execute()
    {
        $select  = $this->select()->from('table.contents')
            ->where("table.contents.password IS NULL OR table.contents.password = ''")
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.created <= ?', time())
            ->where('table.contents.type = ?', 'post')
            ->limit($this->parameter->pageSize)
            ->order('RAND()');
        $this->db->fetchAll($select, array($this, 'push'));
    }
}
/* 获取主题当前版本号 */
function _getVersion()
{
  return "1.1.0";
};
/* 获取主题当前名字 */
function _Themes()
{
  return "Fall";
};
function themeInit($archive)
{
  //解决访问加密文章会被 pjax 刷新页面的问题
  if($archive->is('single')&&$archive->hidden&&$archive->request->isAjax()){$archive->response->setStatus(200);}
  //评论回复楼层最高999层.这个正常设置最高只有7层
  Helper::options()->commentsMaxNestingLevels = 999;
  //强制评论关闭反垃圾保护
  Helper::options()->commentsAntiSpam = false;
  //将最新的评论展示在前
  Helper::options()->commentsOrder = 'DESC';
  //关闭检查评论来源URL与文章链接是否一致判断
  Helper::options()->commentsCheckReferer = false;
  // 强制开启评论markdown
  Helper::options()->commentsMarkdown = '1';
  Helper::options()->commentsHTMLTagAllowed .= '<img class src alt><div class>';
  //评论显示列表
  Helper::options()->commentsListSize = 5;
}
/* 页面结束计时 */
function _endCountTime($precision = 3)
{
  global $timeStart, $timeEnd;
  $mTime     = explode(' ', microtime());
  $timeEnd   = $mTime[1] + $mTime[0];
  $timeTotal = number_format($timeEnd - $timeStart, $precision);
  echo $timeTotal < 1 ? $timeTotal * 1000 . 'ms' : $timeTotal . 's';
}
/* 获取资源路径 */
function _getAssets($assets, $type = true)
{
  $assetsURL = "";
  // 是否本地化资源
  if (Helper::options()->AssetsURL) {
    $assetsURL = Helper::options()->AssetsURL . '/' . $assets;
  } else {
    $assetsURL = Helper::options()->themeUrl . '/' . $assets;
  }
  if ($type) echo $assetsURL;
  else return  $assetsURL;
}
//总访问量
function theAllViews()
{
    $db = Typecho_Db::get();
    $row = $db->fetchAll('SELECT SUM(VIEWS) FROM `typecho_contents`');
    echo number_format($row[0]['SUM(VIEWS)']);
}
/* wap客户端判断 */
function wap(){
    if(@stristr($_SERVER['HTTP_VIA'],"wap")){
    return true;
    }elseif(strpos(strtoupper($_SERVER['HTTP_ACCEPT']),"VND.WAP.WML") > 0){
    return true;
    }elseif(preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])){
    return true;
    }else{
    return false;
    }
}
/* 博主 <?php get_last_login(1); ?> 在线 */
function get_last_login($user){
    $user   = '1';
    $now = time();
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    $row = $db->fetchRow($db->select('activated')->from('table.users')->where('uid = ?', $user));
    echo Typecho_I18n::dateWord($row['activated'], $now);
}
/*加下边的代码<?php get_post_view($this) ?>
post和page里必须加否则阅读次数不会增加 */
function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')->page(1,1)))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
 $views = Typecho_Cookie::get('extend_contents_views');
        if(empty($views)){
            $views = array();
        }else{
            $views = explode(',', $views);
        }
if(!in_array($cid,$views)){
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
        }
    }
    echo $row['views'];
}
//提取图片相关数据
function extract_img($img) {
    preg_match_all('/(id|alt|title|src)=("[^"]*")/i', $img, $matches);
    $ret = array();
    foreach($matches[1] as $i => $v) {
        $ret[$v] = $matches[2][$i];
    } 
    echo $ret;
}

//获取除了文章图片外的文字内容
function getArticleText($content){
        $pattern = '/<\s*img[\s\S]+?(?:src=[\'"]([\S\s]*?)[\'"]\s*|alt=[\'"]([\S\s]*?)[\'"]\s*|[a-z]+=[\'"][\S\s]*?[\'"]\s*)+[\s\S]*?>/i';
        $content = preg_replace($pattern, '', $content);
        return $content;
}
//获取文章图片
function getArticleImage($obj,$place){
        $content = $obj->content;
        $pattern = '/<\s*img[\s\S]+?(?:src=[\'"]([\S\s]*?)[\'"]\s*|alt=[\'"]([\S\s]*?)[\'"]\s*|[a-z]+=[\'"][\S\s]*?[\'"]\s*)+[\s\S]*?>/i';

 $replacement = '
 <img class="lazy" src="'.get_Lazyload().'" data-original="${1}" alt="${2}">'; 
    $content = preg_replace($pattern, $replacement, $content);
        preg_match_all('/<img[^>]+>/i', $content, $matches);
$images = $matches[0];
 
// 遍历所有图片并输出
if (!empty($images)) {
    if($place == 'nosingle'){
    $i = 1;
    foreach ($images as $image) {
        if($i <= 3){
        echo '<li>'.$image.'</li>';
        }
        $i++;
    }
    }
     elseif($place == 'single'){
       foreach ($images as $image) {
       preg_match_all('/<img[^>]+src="([^"]+)"[^>]*>/i', $image, $matches);
        $srcs = $matches[1];
        echo '<div class="post-content">
				'.$image.'
			</div>';
       
    }  
     }
     
}
    }
/* 获取文章摘要 */
function get_Abstract($item, $type = true)
{
	$abstract = "";
	if ($item->password) {
		$abstract = "⚠️此文章已加密";
	} else {
		if ($item->fields->abstract) {
			$abstract = $item->fields->abstract;
		} else {
			$abstract = strip_tags($item->excerpt);
			$abstract = preg_replace('/\-o\-/', '', $abstract);
            $abstract = preg_replace('/{[^{]+}/', '', $abstract);
		}
	}
	if ($abstract === '') $abstract = "⚠️此文章暂无简介";
	return mb_substr($abstract, 0, $num);
}
function check_XSS($text)
{
    $isXss = false;
    $list = array(
        '/onabort/is',
        '/onblur/is',
        '/onchange/is',
        '/onclick/is',
        '/ondblclick/is',
        '/onerror/is',
        '/onfocus/is',
        '/onkeydown/is',
        '/onkeypress/is',
        '/onkeyup/is',
        '/onload/is',
        '/onmousedown/is',
        '/onmousemove/is',
        '/onmouseout/is',
        '/onmouseover/is',
        '/onmouseup/is',
        '/onreset/is',
        '/onresize/is',
        '/onselect/is',
        '/onsubmit/is',
        '/onunload/is',
        '/eval/is',
        '/ascript:/is',
        '/style=/is',
        '/width=/is',
        '/width:/is',
        '/height=/is',
        '/height:/is',
        '/src=/is',  
    );
    if (strip_tags($text)) {
        for ($i = 0; $i < count($list); $i++) {
            if (preg_match($list[$i], $text) > 0) {
                $isXss = true;
                break;
            }
        }
    } else {
        $isXss = true;
    };
    return $isXss;
}

function reply($text,$word = true)
{
    if (check_XSS($text)) {
        $text = "该回复疑似异常，已被系统拦截！";
    }
    if($word == true){
        $text = strip_tags($text, "<img>");
    }else{
        $text = rtrim(strip_tags($text), "\n");
    }
    return $text;
}
//友好时间化
// <?php echo formatTime($this->created); 
function formatTime($time){
        $text = '';
        $time = intval($time);
        $ctime = time();
        $t = $ctime - $time; //时间差
        if ($t < 0) {
            return date('Y-m-d', $time);
        }
        $y = date('Y', $ctime) - date('Y', $time);//是否跨年
        switch ($t) {
            case $t == 0:
                $text = '刚刚';
                break;
            case $t < 60://一分钟内
                $text = $t . '秒前';
                break;
            case $t < 3600://一小时内
                $text = floor($t / 60) . '分钟前';
                break;
            case $t < 86400://一天内
                $text = floor($t / 3600) . '小时前'; // 一天内
                break;
            case $t < 2592000://30天内
                if($time > strtotime(date('Ymd',strtotime("-1 day")))) {
                    $text = '昨天';
                } elseif($time > strtotime(date('Ymd',strtotime("-2 days")))) {
                    $text = '前天';
                } else {
                    $text = floor($t / 86400) . '天前';
                }
                break;
            case $t < 31536000 && $y == 0://一年内 不跨年
                $m = date('m', $ctime) - date('m', $time) -1;
                if($m == 0) {
                    $text = floor($t / 86400) . '天前';
                } else {
                    $text = $m . '个月前';
                }
                break;
            case $t < 31536000 && $y > 0://一年内 跨年
                $text = (11 - date('m', $time) + date('m', $ctime)) . '个月前';
                break;
            default:
                $text = (date('Y', $ctime) - date('Y', $time)) . '年前';
                break;
        }
        return $text;
}

/*
/* 获取列表缩略图 
https://bing.img.run/rand_uhd.php
<?php echo _getThumbnails($this)[0] ?>
*/
function _getThumbnails($item)
{
  $result = [];
  $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
  $patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
  $patternMDfoot = '/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
  /* 如果填写了自定义缩略图，则优先显示填写的缩略图 */
  if ($item->fields->thumb) {
    $fields_thumb_arr = explode("\r\n", $item->fields->thumb);
    foreach ($fields_thumb_arr as $list) $result[] = $list;
  }
  /* 如果匹配到正则，则继续补充匹配到的图片 */
  if (preg_match_all($pattern, $item->content, $thumbUrl)) {
    foreach ($thumbUrl[1] as $list) $result[] = $list;
  }
  if (preg_match_all($patternMD, $item->content, $thumbUrl)) {
    foreach ($thumbUrl[1] as $list) $result[] = $list;
  }
  if (preg_match_all($patternMDfoot, $item->content, $thumbUrl)) {
    foreach ($thumbUrl[1] as $list) $result[] = $list;
  }
  /* 如果上面的数量不足3个，则直接补充3个随即图进去 */
  if (sizeof($result) < 3) {
    $custom_thumbnail = Helper::options()->Thumbnail;
    /* 将for循环放里面，减少一次if判断 */
    if ($custom_thumbnail) {
      $custom_thumbnail_arr = explode("\r\n", $custom_thumbnail);
      for ($i = 0; $i < 3; $i++) {
        $result[] = $custom_thumbnail_arr[array_rand($custom_thumbnail_arr, 1)] . "?key=" . mt_rand(0, 1000000);
      }
    } else {
      for ($i = 0; $i < 3; $i++) {
        $result[] = _getAssets('assets/thumb/' . rand(1, 5) . '.png', false);
      }
    }
  }
  return $result;
}
/* 通过邮箱生成头像地址 */
function _getAvatarByMail($mail)
{
  $gravatarsUrl = Helper::options()->JCustomAvatarSource ? Helper::options()->JCustomAvatarSource : 'https://gravatar.helingqi.com/wavatar/';
  $mailLower = strtolower($mail);
  $md5MailLower = md5($mailLower);
  $qqMail = str_replace('@qq.com', '', $mailLower);
  if (strstr($mailLower, "qq.com") && is_numeric($qqMail) && strlen($qqMail) < 11 && strlen($qqMail) > 4) {
    echo 'https://thirdqq.qlogo.cn/g?b=qq&nk=' . $qqMail . '&s=100';
  } else {
    echo $gravatarsUrl . $md5MailLower . '?d=mm';
  }
};

/* 获取全局懒加载图 ok */
function get_Lazyload($type = true)
{
    return 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
}
function _article_changetext($post, $login){
    $content = $post->content;
    $cid = $post->cid;
    $content = strtr($content, array(
        "{x}" => '✅',
        "{ }" => '☑️'
    ));
    
    $content = preg_replace('/{{([\s\S]*?)}{([\s\S]*?)}}/', '<span class="e" title="${2}">${1}</span>' , $content);
    
    $content = preg_replace('/{localmusic name="([\s\S]*?)" url="([\s\S]*?)"}/', '<music><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 3V17C20 19.2091 18.2091 21 16 21C13.7909 21 12 19.2091 12 17C12 14.7909 13.7909 13 16 13C16.7286 13 17.4117 13.1948 18 13.5351V5H9V17C9 19.2091 7.20914 21 5 21C2.79086 21 1 19.2091 1 17C1 14.7909 2.79086 13 5 13C5.72857 13 6.41165 13.1948 7 13.5351V3H20ZM5 19C6.10457 19 7 18.1046 7 17C7 15.8954 6.10457 15 5 15C3.89543 15 3 15.8954 3 17C3 18.1046 3.89543 19 5 19ZM16 19C17.1046 19 18 18.1046 18 17C18 15.8954 17.1046 15 16 15C14.8954 15 14 15.8954 14 17C14 18.1046 14.8954 19 16 19Z"></path></svg>${1}</span><audio style="width:100%;" src="${2}" controls>浏览器不支持音频播放。</audio></music> ', $content);
    
    $content = preg_replace('/{webmusic name="([\s\S]*?)" id="([\s\S]*?)"}/', '<music><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10.4222 11.375C10.1278 12.4026 10.4341 13.4395 11.2058 14.0282C12.267 14.8376 13.7712 14.3289 14.0796 13.0331C14.1599 12.6958 14.1833 12.311 14.1067 11.9767C13.8775 10.9756 13.586 9.98862 13.3147 8.98094C11.9843 9.13543 10.7722 10.1533 10.4222 11.375ZM15.9698 11.0879C16.2427 12.1002 16.2553 13.1053 15.8435 14.0875C14.7148 16.7784 11.1215 17.2286 9.26951 14.9136C7.96829 13.2869 7.99065 10.953 9.32982 9.18031C10.1096 8.14796 11.1339 7.47322 12.3776 7.12595C12.5007 7.09159 12.6241 7.058 12.7566 7.02157C12.6731 6.60736 12.569 6.20612 12.5143 5.79828C12.3375 4.48137 13.026 3.29477 14.2582 2.7574C15.4836 2.22294 16.9661 2.54204 17.7889 3.51738C18.1936 3.99703 18.183 4.59854 17.7631 4.98218C17.3507 5.359 16.7665 5.32761 16.3276 4.89118C16.0809 4.64585 15.8185 4.45112 15.451 4.45569C14.9264 4.46223 14.4642 4.87382 14.5058 5.39329C14.5432 5.86105 14.6785 6.32376 14.8058 6.77892C14.8276 6.85679 15.0218 6.91415 15.1436 6.9321C16.4775 7.12862 17.6476 7.66332 18.6165 8.60769C21.1739 11.1006 21.4772 15.1394 19.2882 18.0482C17.7593 20.0797 15.6785 21.2165 13.1609 21.4567C8.53953 21.8977 4.49683 18.9278 3.46188 14.3992C2.5147 10.2551 4.8397 5.83074 8.79509 4.25032C9.38067 4.01635 9.93787 4.21869 10.1664 4.74827C10.3982 5.28546 10.147 5.83389 9.55552 6.09847C7.18759 7.15787 5.73935 8.9527 5.34076 11.5215C4.80806 14.9546 6.99662 18.2982 10.3416 19.2428C13.0644 20.0117 15.9994 19.0758 17.6494 16.9123C19.2354 14.8328 19.0484 11.8131 17.2221 10.0389C16.7172 9.54838 16.1246 9.21455 15.3988 9.02564C15.5974 9.74151 15.7879 10.4136 15.9698 11.0879Z"></path></svg>${1}</span><audio style="width:100%;" src="https://music.163.com/song/media/outer/url?id=${2}.mp3" controls>浏览器不支持音频播放。</audio></music>', $content);
    
    $content = preg_replace('/{video key="([\s\S]*?)"}/','<article_video><video width="100%" controls="controls"><source src="${1}" type="video/mp4"></video></article_video>',$content);
    
    $content = preg_replace('/{bili p="([\s\S]*?)" key="([\s\S]*?)"}/', '<article_video><iframe src="https://www.bilibili.com/blackboard/html5mobileplayer.html?bvid=${2}&amp;page=${1}&amp;as_wide=1&amp;danmaku=0&amp;hasMuteButton=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe></article_video>', $content);
    
    $content = preg_replace('/<p><article_video([\s\S]*?)<\/article_video><\/p>/', '<article_video${1}</article_video>', $content);
    
    $content = preg_replace('/<img src([\s\S]*?)title="([\s\S]*?)">/', '<img src="' . get_Lazyload() . '" class="postimg postlist_gallery lazy" data-original${1}>', $content);
    
    $content = preg_replace('/<p><img src="(.*?)" class="(.*?)" data-original="(.*?)" alt="(.*?)"(.*?)><\/p>/', '<span class="postlist_gallery" data-fancybox="gallery" data-caption="${4}" href="${3}"><img src="${1}" class="${2}" data-original="${3}" alt="${4}"></span>', $content);
    
    $content = preg_replace('/{postlist_album num="([\s\S]*?)"}([\s\S]*?){\/postlist_album}/', '<postlist_album><div class="postlist_album" num="${1}">${2}</div><postlist_album>', $content);
    
    $content = preg_replace('/<p><postlist_album([\s\S]*?)<\/postlist_album><\/p>/', '<postlist_album{1}</postlist_album>', $content);
    
    echo $content;
}