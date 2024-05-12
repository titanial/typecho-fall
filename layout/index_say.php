<?php
$commentCount = 1;
if ($this->is('single')) {
    $commentCount = 999;
}
?>
<div class="postlist_abstract card_info content-<?php echo $this->cid; ?>"
            data-cid="<?php echo $this->cid; ?>">
    <?php echo get_Abstract($this); ?>
<?php
                        $content = $this->content;
                        $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
                        preg_match_all($pattern, $content, $matches);
                        
                        $imageCount = count($matches[1]);
                        $maxImages = min($imageCount, 9);
                    ?>
                    
                    
                     <!-- 图集/摘要 -->
                        <?php if($imageCount == 0):?>
                        <?php else:?>
                            <div class="postlist_album" num="<?php echo $imageCount;?>">
                                <?php
                                    for ($i = 0; $i < $maxImages; $i++) {
                                        echo '<span data-fancybox="gallery'.$this->cid.'" class="postlist_gallery" href="'.$matches[1][$i].'"><img class="lazy postlist_img" src="'.get_Lazyload().'" data-original="'.$matches[1][$i].'" alt="'.$this->title.'">';
                                        if ($imageCount > 9 && $i == 8) {
                                            echo '<span class="mask"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path></svg>'.($imageCount - 9).'</span>';
                                        }
                                        echo '</span>';
                                    }
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                
<div class="index-comments">
    <ul class="list_style comment-ul-cid-<?php echo $this->cid; ?> comment-ul">
        <?php
        $count = getCommentCountByCid($this->cid);
        $comments = getCommentByCid($this->cid, 0, $commentCount);
        if ($comments) {
            foreach ($comments as $comment): ?>
            <div class="index-comments_list">
            <div class="flex">
            <span class="mr-1.5"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M14 3V5H4V18.3851L5.76282 17H20V10H22V18C22 18.5523 21.5523 19 21 19H6.45455L2 22.5V4C2 3.44772 2.44772 3 3 3H14ZM19 3V0H21V3H24V5H21V8H19V5H16V3H19Z"></path></svg></span> <span>最新评</span>
            </div>
                <li class=" comment-li-coid-<?php echo $comment['coid'] ?>">
                    <div class="comment-body">
                        <span class="">
                            <a href="<?php echo $comment['url'] ?>"
                                class="decoration-none color-333 fz-14">
                                <?php echo $comment['author']; ?>
                            </a>:
                        </span>
                        <span data-separator=":"
                            class=""
                            data-coid="<?php echo $comment['coid'] ?>" data-cid="<?php echo $comment['cid'] ?>"
                            data-name="<?php echo $comment['author'] ?>">
                            <?php echo strip_tags(preg_replace("/<br>|<p>|<\/p>/", ' ', $comment['text'])) ?>
                        </span>
                    </div>
                </li>

                <?php
                $childComments = getChildCommentByCid($this->cid, 999);
                $allChildComments = getChildComments($comment['coid'], $childComments);

                if ($allChildComments) {
                    foreach ($allChildComments as $childComment): ?>

                        <li class="comment-li-coid-<?php echo $childComment['coid'] ?>">
                            <div class="comment-body">
                                <span class="">
                                    <a href="<?php echo $childComment['url'] ?>"
                                        class="decoration-none color-333 fz-14">
                                        <?php echo $childComment['author'] ?>
                                    </a>:
                                </span>
                                <span data-separator=":"
                                    class=""
                                    data-coid="<?php echo $childComment['coid'] ?>" data-cid="<?php echo $childComment['cid'] ?>"
                                    data-name="<?php echo $childComment['author'] ?>">
                                    <?php echo strip_tags(preg_replace("/<br>|<p>|<\/p>/", ' ', $childComment['text'])) ?>
                                </span>

                            </div>
                        </li>
                    <?php endforeach;
                }
                ?>
        
                <?php ?>
            <?php endforeach; ?>
            <?php
            if ($count > 1 & $commentCount == 1) {
                ?>
                <li>
                    <a href="<?php $this->permalink() ?>"
                        class="decoration-none fz-14" style="color:rgb(159, 159, 159)">查看更多...</a>
                </li>

                <?php
            }
            ?>
        </div>
            <?php
        }
        ?>
    </ul>
</div>