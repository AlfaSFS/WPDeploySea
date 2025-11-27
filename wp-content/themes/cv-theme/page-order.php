<?php
/*
Template Name: Order Page
*/

get_header(); ?>

<main id="order">
    <div class="bg bg-waves"></div>
    <div class="bg bg-paska"></div>
    <div class="order-wrapper">
        <h1><?php pll_e("Оформити замовлення"); ?></h1>
        <div class="layout">
            <div class="grid-left">
                <div class="form-bkg">
                    <form id="sendOrder" enctype="multipart/form-data">
                        <div class="name-wrap">
                            <label for="name">
                                <?php pll_e("Ім'я"); ?> *
                                <input type="text" id="name" name="name" />
                            </label>
                            <span class="checkmark"></span>
                            <div class="error-message" data-for="name"></div>
                        </div>
                        <div class="surname-wrap">
                            <label for="surname">
                                <?php pll_e("Прізвище"); ?> *
                                <input type="text" id="surname" name="surname"/>
                            </label>
                            <span class="checkmark"></span>
                            <div class="error-message" data-for="surname"></div>
                        </div>
                        <div class="email-wrap">
                            <label for="email">
                                <?php pll_e("Електронна пошта"); ?> *
                                <input type="email" id="email" name="email"/>
                            </label>
                            <span class="checkmark"></span>
                            <div class="error-message" data-for="email"></div>
							<sub><?php pll_e("Сюди надійде підтвердження та звіт"); ?></sub>
                        </div>
                        <div class="phone-wrap">
                            <label for="phone">
                                <?php pll_e("Номер телефону"); ?> *
                                <input type="tel" id="phone" name="phone"/>
                            </label>
                            <span class="checkmark"></span>
                            <div class="error-message" data-for="phone"></div>
                        </div>
                        <div class="messenger-wrap">
                            <p class="messengers">
                                <?php pll_e("Оберіть зручний месенджер для зв'язку"); ?> *
                            </p>
                            <label>
                                <input
                                    type="checkbox"
                                    name="messengers"
                                    value="viber"
                                    tabindex="0"
                                />
                                Viber
                            </label>
                            <label>
                                <input
                                    type="checkbox"
                                    name="messengers"
                                    value="whatsapp"
                                    tabindex="0"
                                />
                                WhatsApp
                            </label>
                            <label>
                                <input
                                    type="checkbox"
                                    name="messengers"
                                    value="telegram"
                                    tabindex="0"
                                />
                                Telegram
                            </label>
                            <span class="checkmark"></span>
                            <div class="error-message" data-for="messengers"></div>
                        </div>
                        <div class="attach-wrap">
                            <div class="attach-title"><?php pll_e("Завантаження файлу"); ?> *</div>
                            <label for="resume" class="custom-file-label">
                                <?php pll_e("Завантажте актуальне резюме/CV"); ?>
                            </label>
                            <input
                                type="file"
                                id="resume"
                                name="resume"
                                accept=".pdf,.doc,.docx,.txt,.rtf,.xls,.xlsx"
                            />
                            <small>
                                <?php pll_e("Підтримувані формати: PDF, DOCX, XLSX (до 5 МБ)"); ?>
                            </small>
                            <span class="checkmark"></span>
                            <div class="error-message" data-for="resume"></div>
                            <span class="file-name"><?php pll_e("Файл не обрано"); ?></span>
                        </div>
                        <div class="not-wish-comment-wrap">
                           <label for="no-wish">
                              <?php pll_e("Компанії, з якими не хочу працювати"); ?>
                           </label>
                           <textarea id="no-wish" name="no-wish"></textarea>
                           <p><?php pll_e("Вкажіть назви компаній, пропозиції від яких не хочете розглядати."); ?></p>
                        </div>
                        <div class="comment-wrap">
                            <label for="comment"><?php pll_e("Комментар"); ?></label>
                            <textarea id="comment" name="comment"></textarea>
                            <p><?php pll_e("Напишіть будь-які деталі чи побажання для нашої команди."); ?></p>
                        </div>
                        <div class="info-tile-wrap">
                            <span class="tooltip">i</span>
                            <p><?php pll_e("Після підтвердження оплати ми надішлемо лист на вашу пошту з повідомленням про запуск розсилки."); ?></p>
                        </div>
                        <div class="checkbox-agr-wrap">
                            <label>
                                <input
                                    type="checkbox"
                                    name="agreement"
                                    value="agree"
                                    id="agree"
                                    tabindex="0"
                                />
                                <?php pll_e("Я погоджуюся з умовами використання"); ?>
                            </label>
                            <div class="error-message" data-for="agreement"></div>
                        </div>
                        <div class="order-button-wrap">
                            <button type="submit"><?php pll_e("Надіслати замовлення"); ?></button>
                        </div>
                        <div class="subtext-wrapper">
                            <span class="lock">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-lock.svg" alt="">
                            </span>
                            <p>
                                <?php pll_e("Ваші дані захищені та використовуються лише для
                                виконання замовлення."); ?>
                            </p>
                        </div>
                        <div id="formMessage"></div>
                    </form>
                </div>
                <div class="back-buscet-link">
                    <span class="arrow-left">
                  
                    </span>
                    <a href="<?php echo home_url('/busket/'); ?>">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"> 
                            <path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php pll_e("До кошика"); ?></a>
                </div>
            </div>
            <div class="grid-right">
                <div class="order-bkg">
                    <div class="order-title"><h6><?php pll_e("Ваше замовлення"); ?></h6></div>
                    <div class="order-body"></div>
                    <div class="order-total-amount">
                        <hr>
                        <p class="total-text"><?php pll_e("Всього:"); ?>
                            <span class="order-total-amount--value"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="success-popup">
    <div id="successPopup" class="popup">
        <div class="popup-content">
            ✅ <h1><?php pll_e("Дякуємо! Ваша заявка успішно відправлена."); ?></h1>
            <h6><?php pll_e("Наш менеджер перевірить вашу заявку та надішле реквізити для оплати на вказану електронну пошту протягом робочого дня."); ?></h6>
        </div>
    </div>
</div>

<?php get_footer(); ?>