<?php
/*----- Header -----*/
include('template/front_panel/header.php');
/*----- Header -----*/
?>

<div class="slider-area">
   <div class="slider-active owl-dot-style owl-carousel">
      <?php foreach (frontBannerLists() as $frontBannerList){ ?>
         <div class="single-slider pt-210 pb-220 bg-img" style="background-image:url(<?php echo SITE_BANNER_IMAGE.$frontBannerList['image']?>);">
            <div class="container">
               <div class="slider-content slider-animated-1">
                  <h1 class="animated"><?php echo $frontBannerList['heading']?></h1>
                  <h3 class="animated"><?php echo $frontBannerList['sub_heading']?></h3>
                  <div class="slider-btn mt-60">
                     <a class="animated" href="<?php echo $frontBannerList['link']?>"><?php echo $frontBannerList['link_txt']?></a>
                  </div>
               </div>
            </div>
         </div>
      <?php } ?>
   </div>
</div>


<?php include('template/front_panel/footer.php'); ?>