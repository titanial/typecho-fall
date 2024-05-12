<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php

 $GLOBALS['isLogin'] = $this->user->hasLogin();
 $GLOBALS['rememberEmail'] = $this->remember('mail',true);
function threadedComments($comments, $options)
{
    ?>
    <li id="li-<?php $comments->theId(); ?>" class="comment-body<?php
                                                                if ($comments->levels > 0) {
                                                                    echo ' comment-child';
                                                                    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
                                                                } else {
                                                                    echo ' comment-parent';
                                                                }
                                                                $comments->alt(' comment-odd', ' comment-even');
                                                                echo $commentClass;
                                                                ?>">
        <div id="<?php $comments->theId(); ?>">
            <div class="comment_list_box">
                <div class="comment_main">
                 <div class="comment_excerpt">
                 <?php $parentMail = comments::get_comment_at($comments->coid)?><?php echo comments::postCommentContent($comments->content,$GLOBALS['isLogin'],$GLOBALS['rememberEmail'],$comments->mail,$parentMail);?>
                </div>
            </div>
            </div>
            

        </div>
        <?php if ($comments->children) { ?><div class="comment-children"><?php $comments->threadedComments($options); ?></div><?php } ?>
    </li>
<?php } ?>

<div id="comments" class="jia">
    <?php $this->comments()->to($comments); ?>
    <?php if ($this->allow('comment')) : ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form" class="new_comment_form">
            <div class="comment_box">
                <div class="comment_right">
                    <?php if ($this->user->hasLogin()) : ?>
                    <div class="comment_admin"><?php _e('尊敬的站长：'); ?><a class="decoration-none color-333 admin_name" href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a> . <a class="decoration-none color-333 "  href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></div>
                    <div class="comment_editor">
                    <div class="comment-editor_box">
                        <textarea name="text" id="textarea" placeholder="撰写笔记" class="textarea textarea_box OwO-textarea" required onkeydown="if((event.ctrlKey||event.metaKey)&&event.keyCode==13){document.getElementById('submitComment').click();return false};"><?php $this->remember('text'); ?></textarea>
                    </div>
                
                    <div class="comment-buttons">
                        <button id="submitComment" type="submit" class="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M4.96488 5.09625L8.5107 17.5066L11.5514 11.4253L17.188 9.17062L4.96488 5.09625ZM2.89945 2.29958L21.7052 8.56818C21.9672 8.6555 22.1088 8.93866 22.0215 9.20063C21.975 9.34016 21.8694 9.45214 21.7328 9.50676L13.0002 12.9998L8.57501 21.8501C8.45151 22.0971 8.15118 22.1972 7.90419 22.0737C7.77883 22.011 7.68553 21.8986 7.64703 21.7639L2.26058 2.91129C2.18472 2.64577 2.33846 2.36903 2.60398 2.29316C2.70087 2.26548 2.80386 2.26772 2.89945 2.29958Z"></path></svg></button>
                    </div>
                    
                    </div>
                    <?php endif; ?>
                </div>
            </div>



            </form>
        </div>
    <?php else : ?>
            <div class="comments_off"><?php _e('评论已关闭'); ?></div>
    <?php endif; ?>
    <div class="comments_lie">
    <?php if ($comments->have()) : ?>
        <?php $comments->listComments(); ?>
        <div class="paging">
    <?php $comments->pageNav('<i class="iconfont icon-icon-test"></i>', '<i class="iconfont icon-icon-test1"></i>', 3, '...', array('wrapTag' => 'ol', 'wrapClass' => 'page-navigator', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'current', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
    </div>
    <?php endif; ?>
    </div>
</div>
<?php if ($this->allow('comment')) : ?>
<?php endif; ?>
<style>
    .article_post_main #comments .comment_excerpt{
    display: block;
    margin: 0;
    padding: 10px 10px 10px 30px;
    position: relative;
    }
    .article_post_main #comments .comment_excerpt:before {
    background-color: transparent;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' fill='rgb(159, 159, 159)'%3E%3Cpath d='M4.58341 17.3211C3.55316 16.2274 3 15 3 13.0103C3 9.51086 5.45651 6.37366 9.03059 4.82318L9.92328 6.20079C6.58804 8.00539 5.93618 10.346 5.67564 11.822C6.21263 11.5443 6.91558 11.4466 7.60471 11.5105C9.40908 11.6778 10.8312 13.159 10.8312 15C10.8312 16.933 9.26416 18.5 7.33116 18.5C6.2581 18.5 5.23196 18.0095 4.58341 17.3211ZM14.5834 17.3211C13.5532 16.2274 13 15 13 13.0103C13 9.51086 15.4565 6.37366 19.0306 4.82318L19.9233 6.20079C16.588 8.00539 15.9362 10.346 15.6756 11.822C16.2126 11.5443 16.9156 11.4466 17.6047 11.5105C19.4091 11.6778 20.8312 13.159 20.8312 15C20.8312 16.933 19.2642 18.5 17.3312 18.5C16.2581 18.5 15.232 18.0095 14.5834 17.3211Z'%3E%3C/path%3E%3C/svg%3E");
    background-position: 50% 50%;
    background-repeat: no-repeat;
    background-size: contain;
    content: "";
    height: 20px;
    left: 0;
    position: absolute;
    top: 5px;
    vertical-align: middle;
    width: 20px;
    margin-left: 5px;
}
</style>
