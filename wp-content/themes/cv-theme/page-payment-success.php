<?php
/*
Template Name: Payment Success
*/

get_header(); ?>

<div class="payment-success-page">
    <div class="container">
        <div class="success-content">
            <div class="success-icon">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" fill="#4CAF50"/>
                    <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            <h1><?php pll_e("Дякуємо за ваше замовлення!"); ?></h1>
            <p><?php pll_e("Ваш платіж успішно оброблено."); ?></p>
            
            <div class="order-info">
                <p><strong><?php pll_e("Номер замовлення:"); ?></strong> <span id="order-number"></span></p>
                <p><strong><?php pll_e("Час операції:"); ?></strong> <span id="operation-time"></span></p>
                <p>📧 <?php pll_e("Ми зв'яжемося з вами протягом 24 годин"); ?></p>
                    <p>📄 <?php pll_e("Робота над резюме розпочнеться після уточнення деталей"); ?></p>
            </div>
            
            <div class="actions">
                <a href="/" class="btn btn-primary"><?php pll_e("Повернутися на головну"); ?></a>
               
            </div>
        </div>
    </div>
</div>

<style>
.payment-success-page {
    min-height: 80vh;
    display: flex;
    align-items: center;
    padding: 40px 0;
}

.success-content {
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
    background: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.success-icon {
    margin-bottom: 30px;
}

.success-content h1 {
    color: #2c3e50;
    margin-bottom: 20px;
    font-size: 2.5rem;
}

.success-content p {
    color: #7f8c8d;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 30px;
}

.order-info {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin: 30px 0;
    text-align: left;
}

.order-info p {
    margin: 10px 0;
    color: #2c3e50;
}

.status-paid {
    color: #27ae60;
    font-weight: bold;
}

.status-failed {
    color: #c0392b;
}

.next-steps {
    text-align: left;
    margin: 30px 0;
}

.next-steps h3 {
    color: #2c3e50;
    margin-bottom: 15px;
}

.next-steps ul {
    list-style: none;
    padding: 0;
}

.next-steps li {
    padding: 8px 0;
    color: #7f8c8d;
}

.actions {
    margin-top: 40px;
}

.btn {
    display: inline-block;
    padding: 12px 24px;
    margin: 0 10px;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: #3498db;
    color: white;
}

.btn-primary:hover {
    background: #2980b9;
    color: white;
}

.btn-secondary {
    background: #ecf0f1;
    color: #2c3e50;
}

.btn-secondary:hover {
    background: #bdc3c7;
    color: #2c3e50;
}

@media (max-width: 768px) {
    .success-content {
        padding: 20px;
        margin: 20px;
    }
    
    .success-content h1 {
        font-size: 2rem;
    }
    
    .actions {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .btn {
        margin: 0;
    }
}
</style>

<script>
(function(){
  const orderNumberEl = document.getElementById('order-number');
  const operationTimeEl = document.getElementById('operation-time');

  // Получаем номер заказа из URL
  const params = new URLSearchParams(location.search);
  const orderId = params.get('order');
  
  if (orderId) {
    orderNumberEl.textContent = orderId;
  } else {
    orderNumberEl.textContent = '<?php pll_e("Не вказано"); ?>';
  }

  // Показываем время операции
  try {
    operationTimeEl.textContent = new Date().toLocaleString('uk-UA');
  } catch {
    operationTimeEl.textContent = new Date().toLocaleString();
  }

  // Загружаем информацию о заказе из бекенда для получения времени создания
  async function loadOrderInfo() {
    if (!orderId) return;
    
    try {
      const response = await fetch(`/api/orders/${orderId}/status`, { cache: 'no-store' });
      if (!response.ok) return;
      
      const data = await response.json();
      
      // Если есть время создания заказа, показываем его
      if (data.created_at) {
        try {
          const orderTime = new Date(data.created_at).toLocaleString('uk-UA');
          operationTimeEl.textContent = orderTime;
        } catch {
          // Если не удалось отформатировать, оставляем текущее время
        }
      }
    } catch (error) {
      // Тихо игнорируем ошибки
      console.log('Не удалось загрузить информацию о заказе:', error);
    }
  }

  loadOrderInfo();
})();
</script>

<?php get_footer(); ?>