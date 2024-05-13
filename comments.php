<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php

 $GLOBALS['isLogin'] = $this->user->hasLogin();
 $GLOBALS['rememberEmail'] = $this->remember('mail',true);
function threadedComments($comments, $options)
{
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    if ($comments->url) {
        $author = '<a href="' . $comments->url . '"' . '" target="_blank"' . ' rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }
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
                <div class="comment_list_avatar"><img class="avatar" src="<?php echo comments::avatarHtml($comments); ?>" /></div>

                <div class="comment_main">
                 <div class="comment_author">
                    <?php echo $author ?> 
                    <?php echo comments::reply($comments->parent); ?>
                 <?php
					if ($comments->authorId) {
						if ($comments->authorId == $comments->ownerId) {
							_e(' <span class="comment_admin"><i class="iconfont icon-safetycertificate-f"></i></span> ');
						}
					}
					?></div>
                 <div class="comment_excerpt">
                 <?php $parentMail = comments::get_comment_at($comments->coid)?><?php echo comments::postCommentContent($comments->content,$GLOBALS['isLogin'],$GLOBALS['rememberEmail'],$comments->mail,$parentMail);?>
                </div>
                <div class="comment_meta">
                    <span class="comment_time"><?php echo comments::formatTime($comments->created); ?></span> <span class="comment-reply cp-<?php $comments->theId(); ?> text-muted comment-reply-link"><?php $comments->reply('回复'); ?></span><span id="cancel-comment-reply" class="cancel-comment-reply cl-<?php $comments->theId(); ?> text-muted comment-reply-link" style="display:none" ><?php $comments->cancelReply('取消'); ?></span>
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
                <div class="comment_box_avatar">
                    <?php if ($this->user->hasLogin()) : ?>
                    <img class="avatars" src="<?php echo comments::avatarHtml($this->author); ?>">
                    <?php else : ?>
                    <img class="avatars" src="<?php _getAssets('assets/img/1.png'); ?>">
                    <?php endif; ?>
                </div>
                <div class="comment_right">
                    <?php if ($this->user->hasLogin()) : ?>
                    <div class="comment_admin"><?php _e('尊敬的站长：'); ?><a class="decoration-none color-333 admin_name" href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a> . <a class="decoration-none color-333 "  href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></div>
                    <?php else : ?>
                    <div class="comment-inputs">
                        <div class="comment_xin_name"><input type="text" name="author" id="comment-name" class="text" placeholder="<?php _e('名字'); ?>" value="<?php $this->remember('author'); ?>" required /></div>
                        <div class="comment_xin"><input type="email" name="mail" id="comment-mail" class="text" placeholder="<?php _e('邮箱'); ?>" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail) : ?> required<?php endif; ?> /></div>
                        <div class="comment_xin"><input type="url" name="url" id="comment-url" class="text" placeholder="<?php _e('网址'); ?>" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL) : ?> required<?php endif; ?> /></div>
                    </div>
                    <?php endif; ?>
                

                <div class="comment_editor">
                    <div class="comment-editor_box">
                        <textarea name="text" id="textarea" placeholder="撰写评论" class="textarea textarea_box OwO-textarea" required onkeydown="if((event.ctrlKey||event.metaKey)&&event.keyCode==13){document.getElementById('submitComment').click();return false};"><?php $this->remember('text'); ?></textarea>
                    </div>
                
                <div class="comment-buttons">
                    <button id="submitComment" type="submit" class="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M4.96488 5.09625L8.5107 17.5066L11.5514 11.4253L17.188 9.17062L4.96488 5.09625ZM2.89945 2.29958L21.7052 8.56818C21.9672 8.6555 22.1088 8.93866 22.0215 9.20063C21.975 9.34016 21.8694 9.45214 21.7328 9.50676L13.0002 12.9998L8.57501 21.8501C8.45151 22.0971 8.15118 22.1972 7.90419 22.0737C7.77883 22.011 7.68553 21.8986 7.64703 21.7639L2.26058 2.91129C2.18472 2.64577 2.33846 2.36903 2.60398 2.29316C2.70087 2.26548 2.80386 2.26772 2.89945 2.29958Z"></path></svg></button>
                </div>
                
                </div>
                <!--<div class="comment-huifu">-->
                <!--        <div class="rko"><div class="OwO">OωO</div></div>-->
                <!--        <div class="privacy">-->
                <!--            <div class="privacy_btn">-->
                <!--                <input type="checkbox" id="inset_3" name="secret" />-->
                <!--                <label for="inset_3" class="green"></label>-->
                <!--            </div>-->
                <!--            <div class="privacy_text">隐私评论</div>-->
                <!--        </div>-->
                
                <!--</div>-->


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
            <?php $comments->pageNav('上页', '下页', '5', '……'); ?>
    </div>
    <?php endif; ?>
    </div>
</div>

<script type="text/javascript">
function showhidediv(id){var sbtitle=document.getElementById(id);if(sbtitle){if(sbtitle.style.display=='flex'){sbtitle.style.display='none';}else{sbtitle.style.display='flex';}}}
(function(){window.TypechoComment={dom:function(id){return document.getElementById(id)},pom:function(id){return document.getElementsByClassName(id)[0]},iom:function(id,dis){var alist=document.getElementsByClassName(id);if(alist){for(var idx=0;idx<alist.length;idx++){var mya=alist[idx];mya.style.display=dis}}},create:function(tag,attr){var el=document.createElement(tag);for(var key in attr){el.setAttribute(key,attr[key])}return el},reply:function(cid,coid){var comment=this.dom(cid),parent=comment.parentNode,response=this.dom("<?php echo $this->respondId(); ?>"),input=this.dom("comment-parent"),form="form"==response.tagName?response:response.getElementsByTagName("form")[0],textarea=response.getElementsByTagName("textarea")[0];if(null==input){input=this.create("input",{"type":"hidden","name":"parent","id":"comment-parent"});form.appendChild(input)}input.setAttribute("value",coid);if(null==this.dom("comment-form-place-holder")){var holder=this.create("div",{"id":"comment-form-place-holder"});response.parentNode.insertBefore(holder,response)}comment.appendChild(response);this.iom("comment-reply","");this.pom("cp-"+cid).style.display="none";this.iom("cancel-comment-reply","none");this.pom("cl-"+cid).style.display="";if(null!=textarea&&"text"==textarea.name){textarea.focus()}return false},cancelReply:function(){var response=this.dom("<?php echo $this->respondId(); ?>"),holder=this.dom("comment-form-place-holder"),input=this.dom("comment-parent");if(null!=input){input.parentNode.removeChild(input)}if(null==holder){return true}this.iom("comment-reply","");this.iom("cancel-comment-reply","none");holder.parentNode.insertBefore(response,holder);return false}}})();
</script>
<?php if ($this->allow('comment')) : ?>
<?php endif; ?>

