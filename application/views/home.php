<div class=" popular_products">
    <h4>Popular movies</h4><br>
    <ul class="thumbnails">
        <?php if ($popular) : ?>
            <?php foreach ($popular as $pop) : ?>
                <li class="span2">
                    <div class="thumbnail">
                        <a href="<?php echo base_url('store/movie/' . $pop->productId); ?>">
                            <img alt="<?php echo $pop->title; ?>" width="150" height="123" src="<?php echo base_url('movies-image/' . $pop->image); ?>" />
                            <div class="caption">
                                <a href="<?php echo base_url('store/movie/' . $pop->productId); ?>"> 
                                    <h5><?php echo $pop->title; ?></h5>
                                </a>  Price: $<?php echo $pop->price; ?>
                                <br /><br />
                            </div>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>

    </ul>
</div>