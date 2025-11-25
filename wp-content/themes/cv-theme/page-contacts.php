<?php
/*
Template Name: Contacts Page
*/

get_header(); ?>
<style>
    .content-wrapper{
        max-width: 800px;
        margin: 0 auto;
        padding: 0 16px;
    }.privacy{
        margin-top: 80px;
        text-align: center;
        margin-bottom: 32px;
    }
    .contact-item{
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .contact-item a{
        text-decoration: none;
        color: #001224;
        font-weight: 400;
        line-height: 19px;

    }
    .contact-item a:hover{
        color: #0841e2;
    }
    .contact-item p{
        margin-bottom: 32px;
    }
    .contact-item.ipn{
        display: flex;
        gap: 8px;
    }
</style>
<main>
    <div class="content-wrapper" id="contacts">
        <h1 class="privacy"><?php pll_e('SEAFARER КОНТАКТНА ІНФОРМАЦІЯ'); ?></h1>
        
        <div class="contacts-content name">
            <div class="contact-item">
                <h5><?php pll_e('ФОП Патлачук Станіслав Русланович'); ?></h5>
            </div>
            
            <div class="contact-item ipn">
                <h5><?php pll_e('ІПН:'); ?></h5>
                <p>3541600632</p>
            </div>
            
            <div class="contact-item address" >
                <h5><?php pll_e('ЮРИДИЧНА ТА ФАКТИЧНА АДРЕСА:'); ?></h5>
                <p><?php pll_e('Вінницька область'); ?><br>
                <?php pll_e('Тульчинський район'); ?><br>
                <?php pll_e('с. Болган'); ?><br>
                <?php pll_e('вул. Миру, 5'); ?></p>
            </div>
            
            <div class="contact-item phone" >
                <h5><?php pll_e('ТЕЛЕФОН:'); ?></h5>
                <p><a href="tel:+380635045456">+380635045456</a></p>
            </div>
            
            <div class="contact-item email" >
                <h5><?php pll_e('ЕЛЕКТРОННА АДРЕСА:'); ?></h5>
                <p><a href="mailto:seafarercvsender@gmail.com">seafarercvsender@gmail.com</a></p>
            </div>
        </div>
    </div>
    
    <section class="cta-block" id="cta-block">
        <div class="bg-image-wave"></div>
        <div class="bg-image-vector"></div>
        <div class="cta-block-wrapper">
            <div class="cta-block-text">
                <h3><?php pll_e('Зробіть перший крок до роботи мрії'); ?></h3>
                <p><?php pll_e('Ми створимо і надішлемо резюме туди, де на вас чекають.'); ?></p>
            </div>
            <div class="cta-block-buttons">
                <div class="button-container">
                    <div class="buttons">
                        <a href="<?php echo function_exists('pll_get_post') && get_page_by_path('sending') ? get_permalink(pll_get_post(get_page_by_path('sending')->ID)) : home_url('/sending/'); ?>" class="sender">
                            <div class="button anchor">
                                <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/anchor-icon.svg"
                                    alt="anchor-icon"
                                />
                                <?php pll_e('Розсилка CV'); ?>
                            </div>
                        </a>

                        <a href="<?php echo function_exists('pll_get_post') && get_page_by_path('cv-writer') ? get_permalink(pll_get_post(get_page_by_path('cv-writer')->ID)) : home_url('/cv-writer/'); ?>" class="cv-but">
                            <div class="button cv">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                              <path d="M16.8624 13.5487C17.3471 15.2778 18.7 16.6306 20.4362 17.1226M17.6799 12.7312L11.9791 18.432C11.762 18.649 11.545 19.0759 11.5016 19.387L11.1905 21.5646C11.0748 22.3531 11.6318 22.9029 12.4204 22.7944L14.598 22.4833C14.9018 22.4399 15.3287 22.2229 15.5529 22.0059L21.2537 16.3051C22.2376 15.3212 22.7007 14.1781 21.2537 12.7312C19.8068 11.2843 18.6638 11.7473 17.6799 12.7312Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M20.528 11.5445C20.528 10.6226 20.3946 9.73192 20.1461 8.89059C19.9548 8.24273 19.6951 7.62417 19.3755 7.04322C19.2623 6.83744 19.1416 6.63638 19.0138 6.44041M11.1754 20.8972C10.0269 20.8972 8.92672 20.6901 7.9102 20.3114M12.8593 8.20309C13.1447 8.34719 13.4091 8.52679 13.6468 8.73607M12.8593 8.20309C12.7688 8.15741 12.6763 8.1153 12.5818 8.07694M12.8593 8.20309L14.6058 2.84105M13.6468 8.73607L12.5818 8.07694M13.6468 8.73607C13.7886 8.861 13.9209 8.99651 14.0425 9.14136M14.322 13.5689C14.6982 12.9854 14.9164 12.2905 14.9164 11.5446C14.9164 11.0132 14.8056 10.5076 14.6058 10.0498C14.4617 9.7194 14.2711 9.41384 14.0425 9.14136M14.322 13.5689C14.1339 13.8607 13.9063 14.1247 13.6468 14.3532C13.4958 14.4861 13.3341 14.6071 13.163 14.7146C12.8968 14.8818 12.608 15.0165 12.3023 15.113C11.9467 15.2252 11.5681 15.2857 11.1754 15.2857C10.6515 15.2857 10.1528 15.178 9.70022 14.9836C9.5218 14.907 9.35054 14.8169 9.18772 14.7146M14.322 13.5689L16.0048 14.3532M9.18772 14.7146C8.95252 14.5668 8.73493 14.3935 8.53881 14.1987C8.293 13.9545 8.08093 13.6764 7.9102 13.372M9.18772 14.7146L7.9102 20.3114M7.9102 20.3114C6.49019 19.7823 5.23338 18.9181 4.23593 17.8149C3.63656 17.1519 3.13085 16.4027 2.73966 15.5881M7.9102 13.372C7.69746 12.9926 7.54891 12.5725 7.47925 12.1262C7.44968 11.9367 7.43433 11.7424 7.43433 11.5446C7.43433 10.7605 7.67558 10.0327 8.08792 9.43141M7.9102 13.372L2.73966 15.5881M2.73966 15.5881C2.23123 14.5294 1.91626 13.3601 1.84055 12.1262C1.82874 11.9338 1.82275 11.7399 1.82275 11.5445C1.82275 9.76814 2.318 8.10742 3.17794 6.69291M8.08792 9.43141C8.22115 9.23714 8.37223 9.05608 8.53881 8.89059C8.81687 8.61436 9.13809 8.38152 9.49147 8.20309M8.08792 9.43141L3.17794 6.69291M3.17794 6.69291C3.36291 6.38866 3.56474 6.09581 3.78215 5.81565C4.67215 4.66875 5.82313 3.7345 7.14598 3.102M9.49147 8.20309C9.67712 8.10935 9.87165 8.03063 10.0735 7.96852C10.4218 7.8613 10.7919 7.80359 11.1754 7.80359C11.6728 7.80359 12.1476 7.90068 12.5818 8.07694M9.49147 8.20309L7.14598 3.102M7.14598 3.102C7.59186 2.88881 8.05728 2.7099 8.53881 2.56868C9.37503 2.32345 10.2598 2.19189 11.1754 2.19189C12.3864 2.19189 13.5437 2.42207 14.6058 2.84105M14.6058 2.84105C14.8091 2.92122 15.0088 3.0083 15.2048 3.102C16.0164 3.49005 16.7633 3.99167 17.4249 4.5863C18.0315 5.13146 18.5664 5.75478 19.0138 6.44041M14.0425 9.14136L19.0138 6.44041" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>  
                                <?php pll_e('Створення СV'); ?>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>