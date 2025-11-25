<?php
/*
Template Name: Company Info Page
*/

get_header(); ?>

<main>
    <div class="content-wrapper" id="privacy">
        <h1 class="privacy"><?php pll_e("Інформація про компанію"); ?></h1>
        <p><?php pll_e("Даний договір адресований фізичним особам, які зацікавлені в отриманні інформаційно-консультаційних послуг, перелік яких міститься на сайті https://seafarercv.com і є офіційною пропозицією Фізичної особи – підприємця Станіслав – укласти даний договір про нижче наведене:"); ?></p>
       <h5><?php pll_e("Інформація про компанію"); ?></h5>
       <p>ФОП Станіслав, SeafarerCV</p>
       <p><?php pll_e("ЄДРПОУ:"); ?> 2121212121</p>
       <p><?php pll_e("Юридична адреса:"); ?> Київ, проспект Оболонський 20, 04214</p>
       <p><?php pll_e("Фактичний адреса:"); ?> Київ, проспект Оболонський 20, 04214</p>
       <p>+27 73 314 3406</p>
       <p>stanislav@gmail.com</p>
    </div>
    
    <section class="cta-block" id="cta-block">
        <div class="bg-image-wave"></div>
        <div class="bg-image-vector"></div>
        <div class="cta-block-wrapper">
            <div class="cta-block-text">
                <h3><?php pll_e("Зробіть перший крок до роботи мрії"); ?></h3>
                <p><?php pll_e("Ми створимо і надішлемо резюме туди, де на вас чекають."); ?></p>
            </div>
            <div class="cta-block-buttons">
                <div class="button-container">
                    <div class="buttons">
                        <a href="<?php echo home_url('/sending/'); ?>" class="sender">
                            <div class="button anchor">
                                <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/anchor-icon.svg"
                                    alt="anchor-icon"
                                />
                                <?php pll_e("Розсилка CV"); ?>
                            </div>
                        </a>

                        <a href="<?php echo home_url('/cv-writer/'); ?>" class="cv-but">
                            <div class="button cv">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cv-icon.svg" alt="cv-icon" />
                                <?php pll_e("Створення СV"); ?>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>