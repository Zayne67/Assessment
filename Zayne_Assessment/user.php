<div class="carousel-cell">
    <?php 
        $image = "";
        if(file_exists($FRIEND_ROW['profile_image']))
        {
        $image = $FRIEND_ROW['profile_image'];
        }
    ?><img src="<?php echo $image ?>" width="50rem" height="50rem">
</div>