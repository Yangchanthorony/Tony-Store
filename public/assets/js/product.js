
//     document.addEventListener('DOMContentLoaded', function () {
//     // Product Filtering
//     const filterBtns = document.querySelectorAll('.filter-btn');
//     const products = document.querySelectorAll('.product');

//     filterBtns.forEach(btn => {
//         btn.addEventListener('click', function () {
//             filterBtns.forEach(b => b.classList.remove('active'));
//             this.classList.add('active');

//             const filter = this.getAttribute('data-filter');

//             products.forEach(product => {
//                 const productCategory = product.getAttribute('data-category');
//                 product.style.display = filter === 'all' || productCategory.toLowerCase() === filter.toLowerCase() ? 'block' : 'none';
//             });
//         });
//     });

//     // Create Quick View Modal dynamically
//     const modalHTML = `
//         <div id="quickViewModal" class="modal" style="display: none;">
//             <div class="modal-content">
//                 <span class="close-modal">&times;</span>
//                 <div class="modal-image"><img src="" alt="Product Image"></div>
//                 <h3 class="modal-title"></h3>
//                 <p class="modal-category"></p>
//                 <p class="modal-price"></p>
//                 <div class="quantity-selector">
//                     <button class="minus">-</button>
//                     <input type="number" id="quantity" value="1" min="1">
//                     <button class="plus">+</button>
//                 </div>
//                 <button class="add-to-cart-modal">Add to Cart</button>
//             </div>
//         </div>
//         <div class="overlay" style="display: none;"></div>
//     `;
//     document.body.insertAdjacentHTML('beforeend', modalHTML);

//     // Quick View Modal
//     const quickViewBtns = document.querySelectorAll('.quick-view');
//     const modal = document.getElementById('quickViewModal');
//     const closeModal = document.querySelector('.close-modal');
//     const overlay = document.querySelector('.overlay');

//     quickViewBtns.forEach(btn => {
//         btn.addEventListener('click', function (e) {
//             e.preventDefault();
//             const product = this.closest('.product');
//             const productName = product.querySelector('h3').textContent;
//             const productCategory = product.querySelector('.product-category').textContent;
//             const productPrice = product.querySelector('.product-price').textContent;
//             const productImage = product.querySelector('img').getAttribute('src');

//             modal.querySelector('.modal-title').textContent = productName;
//             modal.querySelector('.modal-category').textContent = productCategory;
//             modal.querySelector('.modal-price').textContent = productPrice;
//             modal.querySelector('.modal-image img').setAttribute('src', productImage);
//             modal.querySelector('#quantity').value = 1;

//             modal.style.display = 'block';
//             overlay.style.display = 'block';
//         });
//     });

//     closeModal.addEventListener('click', function () {
//         modal.style.display = 'none';
//         overlay.style.display = 'none';
//     });

//     window.addEventListener('click', function (e) {
//         if (e.target === modal || e.target === overlay) {
//             modal.style.display = 'none';
//             overlay.style.display = 'none';
//         }
//     });

//     // Quantity selector in modal
//     const minusBtn = document.querySelector('.minus');
//     const plusBtn = document.querySelector('.plus');
//     const quantityInput = document.querySelector('#quantity');

//     minusBtn.addEventListener('click', function () {
//         let quantity = parseInt(quantityInput.value);
//         if (quantity > 1) quantityInput.value = quantity - 1;
//     });

//     plusBtn.addEventListener('click', function () {
//         let quantity = parseInt(quantityInput.value);
//         quantityInput.value = quantity + 1;
//     });

//     // Create Cart Sidebar dynamically
//     const cartSidebarHTML = `
//         <div class="cart-sidebar">
//             <div class="cart-header">
//                 <h3>Your Cart</h3>
//                 <span class="close-cart">&times;</span>
//             </div>
//             <div class="cart-items"></div>
//             <div class="cart-footer">
//                 <p>Total: <span class="total-amount">$0.00</span></p>
//                 <button class="checkout-btn">Checkout</button>
//             </div>
//         </div>
//         <span class="cart-icon">🛒 <span class="cart-count">0</span></span>
//     `;
//     document.body.insertAdjacentHTML('beforeend', cartSidebarHTML);

//     // Cart functionality
//     const cartIcon = document.querySelector('.cart-icon');
//     const cartSidebar = document.querySelector('.cart-sidebar');
//     const closeCart = document.querySelector('.close-cart');
//     const addToCartBtns = document.querySelectorAll('.add-to-cart');
//     const addToCartModal = document.querySelector('.add-to-cart-modal');
//     const cartItems = document.querySelector('.cart-items');
//     const cartCount = document.querySelector('.cart-count');
//     const totalAmount = document.querySelector('.total-amount');
//     let cart = [];

//     cartIcon.addEventListener('click', function () {
//         cartSidebar.classList.add('active');
//         overlay.style.display = 'block';
//     });

//     closeCart.addEventListener('click', function () {
//         cartSidebar.classList.remove('active');
//         overlay.style.display = 'none';
//     });

//     overlay.addEventListener('click', function () {
//         cartSidebar.classList.remove('active');
//         modal.style.display = 'none';
//         overlay.style.display = 'none';
//     });

//     addToCartBtns.forEach(btn => {
//         btn.addEventListener('click', function () {
//             const product = this.closest('.product');
//             const productName = product.querySelector('h3').textContent;
//             const productPrice = product.querySelector('.product-price').textContent;
//             const productImage = product.querySelector('img').getAttribute('src');

//             addToCart(productName, productPrice, productImage, 1);
//         });
//     });

//     addToCartModal.addEventListener('click', function () {
//         const productName = modal.querySelector('.modal-title').textContent;
//         const productPrice = modal.querySelector('.modal-price').textContent;
//         const productImage = modal.querySelector('.modal-image img').getAttribute('src');
//         const quantity = parseInt(quantityInput.value);

//         addToCart(productName, productPrice, productImage, quantity);
//         modal.style.display = 'none';
//         overlay.style.display = 'none';
//     });

//     function addToCart(name, price, image, quantity) {
//         const existingItemIndex = cart.findIndex(item => item.name === name);
//         if (existingItemIndex !== -1) {
//             cart[existingItemIndex].quantity += quantity;
//         } else {
//             cart.push({ name, price, image, quantity });
//         }
//         updateCart();
//         cartSidebar.classList.add('active');
//         overlay.style.display = 'block';
//     }

//     function updateCart() {
//         cartItems.innerHTML = cart.length === 0 ? '<div class="empty-cart-message">Your cart is empty</div>' : '';

//         let total = 0;
//         let itemCount = 0;

//         cart.forEach((item, index) => {
//             const price = parseFloat(item.price.replace('$', ''));
//             const itemTotal = price * item.quantity;
//             total += itemTotal;
//             itemCount += item.quantity;

//             const cartItemHTML = `
//                 <div class="cart-item">
//                     <div class="cart-item-image">
//                         <img src="${item.image}" alt="${item.name}">
//                     </div>
//                     <div class="cart-item-details">
//                         <h3 class="cart-item-title">${item.name}</h3>
//                         <div class="cart-item-price">${item.price} x ${item.quantity}</div>
//                         <div class="cart-item-quantity">
//                             <button class="quantity-btn cart-minus" data-index="${index}">-</button>
//                             <span>${item.quantity}</span>
//                             <button class="quantity-btn cart-plus" data-index="${index}">+</button>
//                             <span class="cart-item-remove" data-index="${index}">Remove</span>
//                         </div>
//                     </div>
//                 </div>
//             `;
//             cartItems.innerHTML += cartItemHTML;
//         });

//         cartCount.textContent = itemCount;
//         totalAmount.textContent = `$${total.toFixed(2)}`;

//         document.querySelectorAll('.cart-minus').forEach(btn => {
//             btn.addEventListener('click', function () {
//                 const index = parseInt(this.getAttribute('data-index'));
//                 if (cart[index].quantity > 1) {
//                     cart[index].quantity--;
//                     updateCart();
//                 }
//             });
//         });

//         document.querySelectorAll('.cart-plus').forEach(btn => {
//             btn.addEventListener('click', function () {
//                 const index = parseInt(this.getAttribute('data-index'));
//                 cart[index].quantity++;
//                 updateCart();
//             });
//         });

//         document.querySelectorAll('.cart-item-remove').forEach(btn => {
//             btn.addEventListener('click', function () {
//                 const index = parseInt(this.getAttribute('data-index'));
//                 cart.splice(index, 1);
//                 updateCart();
//             });
//         });
//     }

//     // Favorite icon toggle
//     const favoriteIcons = document.querySelectorAll('.favorite-icon');
//     favoriteIcons.forEach(icon => {
//         icon.addEventListener('click', (e) => {
//             e.target.classList.toggle('favorited');
//             e.target.textContent = e.target.classList.contains('favorited') ? '♥️' : '♡';
//         });
//     });

//     // Star rating functionality
//     const stars = document.querySelectorAll('.star');
//     let currentRating = 0;

//     stars.forEach(star => {
//         star.addEventListener('click', () => {
//             currentRating = parseInt(star.getAttribute('data-value'));
//             const product = star.closest('.product');
//             const productStars = product.querySelectorAll('.star');
//             const productRatingCount = product.querySelector('.rating-count');
//             updateRating(productStars, productRatingCount);
//             alert(`Rated ${currentRating} star${currentRating > 1 ? 's' : ''}!`);
//         });

//         star.addEventListener('mouseover', () => {
//             const product = star.closest('.product');
//             const productStars = product.querySelectorAll('.star');
//             productStars.forEach(s => {
//                 s.classList.remove('filled');
//                 if (parseInt(s.getAttribute('data-value')) <= parseInt(star.getAttribute('data-value'))) {
//                     s.classList.add('filled');
//                 }
//             });
//         });

//         star.addEventListener('mouseout', () => {
//             const product = star.closest('.product');
//             const productStars = product.querySelectorAll('.star');
//             const productRatingCount = product.querySelector('.rating-count');
//             updateRating(productStars, productRatingCount);
//         });
//     });

//     function updateRating(stars, ratingCount) {
//         stars.forEach(star => {
//             star.classList.toggle('filled', parseInt(star.getAttribute('data-value')) <= currentRating);
//         });
//         ratingCount.textContent = currentRating ? `( review)` : `( reviews)`;
//     }
// });
