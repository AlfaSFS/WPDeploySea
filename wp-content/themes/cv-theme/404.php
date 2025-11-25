<?php
/*
Template Name: 404 Error Page
*/

get_header(); ?>

<main class="content">
         <div class="wrapper">
            <div class="image-404">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/wave-loading.gif" alt="Loader image" />
            </div>
            <div class="title-404"><h3><?php pll_e('Шторм у мережі!'); ?></h3></div>
            <div class="subtitle-404">
               <p>
                  <?php pll_e('Хвилі інтернету занесли вас у невідомі води. Давайте разом повернемось на правильний курс.'); ?>
               </p>
            </div>
            <div class="button-404">
               <a href="<?php echo home_url('/'); ?>" class="btn back"><?php pll_e('Так, повернутися'); ?></a>
            </div>
            <div class="bkg-404"></div>
         </div>
      </main>





<?php get_footer(); ?>