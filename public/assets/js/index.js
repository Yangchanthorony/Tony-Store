

    let cart = [];
    let currentItem = '';
    let currentPrice = 0;
    let currentImage = '';
    let cartModal = null;

    function showModal(itemName, price, imageUrl) {
      currentItem = itemName;
      currentPrice = price;
      currentImage = imageUrl;
      document.getElementById('modalItemName').textContent = itemName;
      document.getElementById('modalItemImage').src = imageUrl;
      document.getElementById('modalTotalPrice').textContent = price.toFixed(2);
      document.getElementById('modalQuantity').textContent = '1';
      var modal = new bootstrap.Modal(document.getElementById('orderModal'));
      modal.show();
    }

    function updateQuantity(change) {
      let quantityElement = document.getElementById('modalQuantity');
      let quantity = parseInt(quantityElement.textContent);
      quantity += change;

      if (quantity < 1) quantity = 1;
      quantityElement.textContent = quantity;

      let total = currentPrice * quantity;
      document.getElementById('modalTotalPrice').textContent = total.toFixed(2);
    }

    function addToCart() {
      let quantity = parseInt(document.getElementById('modalQuantity').textContent);
      let total = currentPrice * quantity;
      let timestamp = new Date().toLocaleString('en-US', { timeZone: 'Asia/Bangkok', hour12: true });
      cart.push({ item: currentItem, quantity: quantity, price: currentPrice, total: total, image: currentImage, addedAt: timestamp, description: 'High-quality product' });
      updateCartCount();
      alert(`Added ${quantity} x ${currentItem} to cart! Total: $${total.toFixed(2)}`);
      var modal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
      modal.hide();
    }

    function updateCartCount() {
      let totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
      let cartCount = document.getElementById('cartCount');
      cartCount.textContent = totalItems;
      cartCount.classList.toggle('d-none', totalItems === 0);
    }

    function updateCartItemQuantity(event, index, change) {
      event.preventDefault();
      let item = cart[index];
      let newQuantity = item.quantity + change;
      if (newQuantity < 1) newQuantity = 1;
      item.quantity = newQuantity;
      item.total = item.price * newQuantity;
      updateCartDisplay();
      updateCartCount();
    }

    function updateCartDisplay() {
      let cartBody = document.getElementById('cartModalBody');
      let totalAmount = cart.reduce((sum, item) => sum + item.total, 0);
      cartBody.innerHTML = `
        <h6>Cart Items:</h6>
        ${cart.map((item, index) => `
          <div class="cart-item">
            <img src="${item.image}" alt="${item.item}" class="cart-item-img">
            <div class="cart-item-details">
              <p><strong>Item:</strong> ${item.item}</p>
              <p><strong>Price per Unit:</strong> $${item.price.toFixed(2)}</p>
              <p><strong>Quantity:</strong> ${item.quantity}</p>
              <p><strong>Subtotal:</strong> $${item.total.toFixed(2)}</p>
              <p><strong>Added At:</strong> ${item.addedAt}</p>
              <p><strong>Description:</strong> ${item.description}</p>
              <div class="quantity-controls">
                <button class="quantity-btn" onclick="updateCartItemQuantity(event, ${index}, -1)">-</button>
                <span>${item.quantity}</span>
                <button class="quantity-btn" onclick="updateCartItemQuantity(event, ${index}, 1)">+</button>
              </div>
            </div>
          </div>
        `).join('')}
        <div class="cart-summary">
          Total Amount: $${totalAmount.toFixed(2)}
        </div>
      `;
    }

    function viewCart() {
      if (cart.length === 0) {
        alert('Cart is empty!');
      } else {
        updateCartDisplay();
        if (!cartModal) {
          cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
        }
        cartModal.show();
      }
    }

    function checkout() {
      alert(`Proceeding to checkout with total: $${cart.reduce((sum, item) => sum + item.total, 0).toFixed(2)}`);
      cart = [];
      updateCartCount();
      if (cartModal) cartModal.hide();
    }

    function searchItems() {
      let searchTerm = document.getElementById('searchInput').value.toLowerCase();
      let cards = document.querySelectorAll('.product');

      cards.forEach(card => {
        let itemName = card.querySelector('.card-title').textContent.toLowerCase();
        card.style.display = itemName.includes(searchTerm) ? 'block' : 'none';
      });
    }

    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('searchInput').addEventListener('input', searchItems);

      document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function () {
          document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
          this.classList.add('active');
          const filter = this.dataset.filter;
          document.querySelectorAll('.product').forEach(card => {
            const category = card.dataset.category.toLowerCase();
            card.style.display = (filter === 'all' || category === filter) ? 'block' : 'none';
          });
        });
      });
    });
