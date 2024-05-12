<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * Author: 林厌
 * CreateTime: 2024/5/07
 * 评论功能
 */
class comments {
    //评论头像
    public static function getAvator($email,$size){
        
            $str = explode('@', $email);
            $avatorSrc = comments::getGravator($email,$cdnUrl,$size);
        return $avatorSrc;
    }
    public static function avatarHtml($obj){
        $email = $obj->mail;
        $avatorSrc = comments::getAvator($email,65);
        return ''.$avatorSrc.'';
    }
    public static function getGravator($email,$host,$size){
        $default = '';
        if (strlen($options->defaultAvator) > 0){
            $default = $options->defaultAvator;
        }
        $url = '/';
        $rating = Helper::options()->commentsAvatarRating;
        $hash = md5(strtolower($email));
        $avatar = '//cravatar.cn/avatar/' . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=mm';
        return $avatar;
    }
    //评论加@
    public static function reply($parent) {
        if ($parent == 0) {
            return '';
        }
        $db = Typecho_Db::get();
        $commentInfo = $db->fetchRow($db->select('author,status,mail')->from('table.comments')->where('coid = ?', $parent));
        $link = '<a class="parent" href="#comment-' . $parent . '">@' . $commentInfo['author'] .  '</a>';
        return $link;
    }
    //隐私评论
    public static function get_comment_at($_var_108)
    {
        $_var_109 = Typecho_Db::get();
        $_var_110 = $_var_109->fetchRow($_var_109->select('parent,status')->from('table.comments')->where('coid = ?', $_var_108));
        $_var_111 = '';
        $_var_112 = @$_var_110['parent'];
        if ($_var_112 != '0') {
            $_var_113 = $_var_109->fetchRow($_var_109->select('author,status,mail')->from('table.comments')->where('coid = ?', $_var_112));
            @($_var_114 = @$_var_113['author']);
            $_var_111 = @$_var_113['mail'];
            if (@$_var_114 && $_var_113['status'] == 'approved') {
                if (@$_var_110['status'] == 'waiting') {}
            } else {
                if (@$_var_110['status'] == 'waiting') {
                } else {
                    echo '';
                }
            }
        } else {
            if (@$_var_110['status'] == 'waiting') {
            } else {
                echo '';
            }
        }
        return $_var_111;
    }
        /**
     * 解析文章页面的评论内容
     * @param $content
     * @param boolean $isLogin 是否登录
     * @param $rememberEmail
     * @param $currentEmail
     * @param $parentEmail
     * @param bool $isTime
     * @return mixed
     */
    public static function postCommentContent($content, $isLogin, $rememberEmail, $currentEmail, $parentEmail, $isTime = false)
    {
        $flag = true;
        if (strpos($content, '[secret]') !== false) {
            $pattern = self::get_shortcode_regex(array('secret'));
            $content = preg_replace_callback("/$pattern/", array('comments', 'secretContentParseCallback'), $content);
            if ($isLogin || ($currentEmail == $rememberEmail && $currentEmail != "") || ($parentEmail == $rememberEmail && $rememberEmail != "")) {
                $flag = true;
            } else {
                $flag = false;
            }
        }
        if ($flag) {
            $content = comments::parseContentPublic($content);
            
            return $content;
        } else {
            if ($isTime) {
                return '<div class="hideContent"><div class="hideContent_box">哎呦喂，瞧给你聪明的！</div><div class="hideContent_text">此条为私密说说，仅发布者可见</div></div>';
            } else {
                return '<div class="hideContent"><div class="hideContent_box">哎呦喂，瞧给你聪明的！</div><div class="hideContent_text">此条为私密评论，仅评论双方可见</div></div>';
            }
        }
        
    }

    /**
     * 私密内容正则替换回调函数
     * @param $matches
     * @return bool|string
     */
    public static function secretContentParseCallback($matches)
    {
        if ($matches[1] == '[' && $matches[6] == ']') {
            return substr($matches[0], 1, -1);
        }
        return '<div class="hideContent">' . $matches[5] . '</div>';
    }
    public static function parseContentPublic($content)
    {
        return $content;
    }
    
     //友好时间化
    public static function formatTime($time){
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
    
}
/**
 * 根据文章id获取评论数量
 */
function getCommentCountByCid($cid)
{

    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();

    $list = $db->fetchAll($db->select('cid')->from('table.comments')->where('cid = ?', $cid)->where('status = ?', 'approved'));
    $count = count($list);
    
    return $count;
}
/**
 * 根据文章id获取最新评论列表
 */
function getCommentByCid($cid, $parent = 0, $len = 5): array
{
    $db = Typecho_Db::get();
    $select = $db->select('coid,author,authorId,ownerId,mail,text,created,parent,url,cid')
        ->from('table.comments')
        ->where('cid = ?', $cid)
        ->where('parent = ?', $parent)
        ->where('type = ?', 'comment')
        ->where('status = ?', 'approved')
        ->order('created', Typecho_Db::SORT_DESC)
        ->limit($len);
    return $db->fetchAll($select);
}
/**
 * 根据文章id获取最新子评论列表
 */
function getChildCommentByCid($cid, $len = 5): array
{
    $db = Typecho_Db::get();
    $select = $db->select('c1.coid,c1.author,c1.authorId,c1.ownerId,c1.mail,c1.text,c1.created,c1.parent,c1.url,c1.cid,c2.author as toAuthor,c2.authorId as toAuthorId')
        ->from('table.comments as c1')
        ->join('table.comments as c2', 'c1.parent = c2.coid', Typecho_Db::LEFT_JOIN)
        ->where('c1.cid = ?', $cid)
        ->where('c1.type = ?', 'comment')
        ->where('c1.status = ?', 'approved')
        ->order('c1.created', Typecho_Db::SORT_ASC)
        ->limit($len);
    return $db->fetchAll($select);
}
/**
 * 获取评论列表（包含子级）
 */
function getChildComments($coid, $list)
{
    $result = [];
    $newList = array_filter($list, function ($li) use ($coid) {
        return $li['parent'] == $coid;
    });

    foreach ($newList as $item) {
        array_push($result, $item);
        $childs = getChildCommentByCidOfComplete($item['coid'], $list);

    }
    return $result;
}
/**
 * 获取下级评论
 */
function getChildCommentByCidOfComplete($parent, $list)
{
    $result = [];
    $newList = array_filter($list, function ($li) use ($parent) {
        return $li['parent'] == $parent;
    });
    foreach ($newList as $item) {
        array_push($result, $item);

        $result = array_merge($result, getChildCommentByCidOfComplete($item['coid'], $list));
    }
}
