<?php
/*
Template Name: Busket Page
*/

get_header(); ?>

<main class="content busket" id="busket">

    <div class="wrapper">
        <div class="title-busket"><h3><?php pll_e("Послуга в кошику"); ?></h3></div>
        
  

        <div class="busket-wrap">
            <div class="layout">
                <div class="grid-left">
                    <div class="busket-items" id="busket-items">
                        <!-- <div class="busket-items-item">
                           <div class="busket-items-item-title">
                              <h5>Розсилка CV по регіону (1)</h5>
                           </div>

                           <div class="busket-items-item-wrapper">
                              <div class="grid-image">
                                 <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-gasoline.svg" alt="" />
                              </div>
                              <div class="grid-subtitle">Торговий флот</div>
                              <div class="grid-price">
                                 <span class="curncy">€</span
                                 ><span class="mount">10</span>
                              </div>
                           </div>
                           <button class="delete">delete</button>
                        </div> -->
                    </div>
                    <div class="back-link">
            <a href="javascript:window.dispatchEvent(new CustomEvent('cartUpdated', {detail: {cartLength: (JSON.parse(localStorage.getItem('cart')) || []).length}})); history.back();" class="back-button">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <?php pll_e("Назад"); ?>
            </a>
        </div>
                </div>
                <div class="grid-right">
                    <div class="bkg-payment">
                        <div class="title-payment">
                            <h5><?php pll_e("Разом до сплати"); ?></h5>
                        </div>
                        <div class="items-payment"></div>
                        <hr />
                        <div class="total-payment-wrap">
                            <span><?php pll_e("Всього:"); ?></span>
                        <div class="total-payment"></div>
                        </div>
                        <div class="payment-button">
                            <button id="goOrder"><?php pll_e("Оформити замовлення"); ?></button>
                        </div>
                        <div class="payment">
                            <div class="payment-card">
                                <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/paypal-icon.svg"
                                    alt="PayPal"
                                />
                            </div>
                            <div class="payment-card">
                                <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/master-icon.svg"
                                    alt="MasterCard"
                                />
                            </div>
                            <div class="payment-card">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/visa-icon.svg" alt="Visa" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="bkg-busket">
        <div class="bg bg-waves"></div>
        <div class="bg bg-paska"></div>
        </div>
    </div>
</main>

<?php get_footer(); ?>