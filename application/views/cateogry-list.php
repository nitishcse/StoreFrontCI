<ul class="breadcrumb">
    <li>
        <a href="<?php echo base_url('store'); ?>">Home</a> <span class="divider">/</span>
    </li>
    <?php if ($selectedSubCatId) : ?>
        <li>
            <a href="<?php echo base_url('store/category/' . $allCategory[$selectedCatId]->id); ?>">
                <?php echo $allCategory[$selectedCatId]->name; ?>
            </a> 
            <span class="divider">/</span>
        </li>
        <li class="active">
            <span><?php echo $allCategory[$selectedSubCatId]->name; ?></span>
        </li>
    <?php else : ?>
        <li class="active">
            <span><?php echo $allCategory[$selectedCatId]->name; ?></span>
        </li>
    <?php endif; ?>

</ul>

<?php if ($movieList) : ?>
    <?php foreach ($movieList as $pro) : ?>
        <div class="row">
            <div class="span1">
                <a href="<?php echo base_url('store/movie/' . $pro->productId); ?>">
                    <img alt="<?php echo $pro->title; ?>" width="60" height="60" src="<?php echo base_url('movies-image/' . $pro->image); ?>" />
                </a>
            </div>	 

            <div class="span5">
                <a href="<?php echo base_url('store/movie/' . $pro->productId); ?>"><h5><?php echo $pro->title; ?></h5></a>
            </div>	

            <div class="span1">
                <p>$<?php echo $pro->price; ?></p>
            </div>	 

            <div class="span2">
            </div>
        </div>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>
