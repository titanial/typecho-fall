
<div class="postlist_abstract card_info content-<?php echo $this->cid; ?>"
            data-cid="<?php echo $this->cid; ?>">
    由<?php $this->date(); ?>发布相册《<?php $this->title() ?>》
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
                