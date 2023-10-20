// JavaScript
document.addEventListener("DOMContentLoaded", function () {
  const addToCartButtons = document.querySelectorAll(".add-to-cart");
  const cartCount = document.getElementById("cart-count");
  const shoppingCart = document.querySelector(".shopping-cart");
  const closeCartButton = document.getElementById("close-cart-button");
  const cartItemsList = document.getElementById("cart-items");
  const checkoutButton = document.getElementById("checkout-button");
  const totalCartPrice = document.getElementById("total-cart-price"); // Add this line

  // Load items from local storage and update the cart display
  let cart = getCartFromLocalStorage();
  updateCartDisplay(cart);

  addToCartButtons.forEach((button) => {
    button.addEventListener("click", function (event) {
      event.preventDefault();

      const pizzaId = button.getAttribute("data-pizza-id");
      const selectedPizza = getPizzaById(pizzaId);

      if (selectedPizza) {
        // Check if the pizza is already in the cart
        const existingPizza = cart.find((item) => item.pizzaId === pizzaId);

        if (existingPizza) {
          // If it exists, increase its quantity
          existingPizza.quantity++;
        } else {
          // If not, add it with a quantity of 1
          selectedPizza.quantity = 1;
          cart.push(selectedPizza);
        }

        saveCartToLocalStorage(cart);
        updateCartDisplay(cart);
      }
    });
  });

  // Add an event listener to the shopping cart icon to toggle the cart visibility
  const cartIcon = document.querySelector(".navbar-cart-icon");

  cartIcon.addEventListener("click", function (event) {
    event.preventDefault();
    shoppingCart.classList.toggle("show-cart");
  });

  // Add an event listener to the close button in the shopping cart
  closeCartButton.addEventListener("click", function () {
    shoppingCart.classList.remove("show-cart");
  });

  // Event delegation for showing/hiding details and removing items from the cart
  cartItemsList.addEventListener("click", function (event) {
    if (event.target.classList.contains("details-button")) {
      // Find the parent cart item element
      const cartItem = event.target.closest(".cart-item");
      if (cartItem) {
        const detailsList = cartItem.querySelector(".details");
        detailsList.classList.toggle("hidden");
      }
    }

    if (event.target.classList.contains("remove-button")) {
      const pizzaId = event.target.getAttribute("data-pizza-id");
      const existingPizza = cart.find((item) => item.pizzaId === pizzaId);

      if (existingPizza) {
        if (existingPizza.quantity > 1) {
          existingPizza.quantity--;
        } else {
          cart = cart.filter((item) => item.pizzaId !== pizzaId);
        }
        saveCartToLocalStorage(cart);
        updateCartDisplay(cart);
      }
    }
  });

  // Function to get pizza details by ID
  function getPizzaById(pizzaId) {
    return pizzaData.find((pizza) => pizza.pizzaId === pizzaId);
  }

  // Function to save cart to local storage
  function saveCartToLocalStorage(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
  }

  // Function to get cart from local storage
  function getCartFromLocalStorage() {
    const cartJson = localStorage.getItem("cart");
    return cartJson ? JSON.parse(cartJson) : [];
  }

  // Function to calculate the total price
  function calculateTotalPrice(cart) {
    let totalPrice = 0;
    cart.forEach((item) => {
      totalPrice +=
        item.quantity * parseFloat(item.pizzaPrice.replace("$", ""));
    });
    return totalPrice.toFixed(2); // Format to two decimal places
  }

  // Function to update the cart display including the total price
  function updateCartDisplay(cart) {
    cartCount.innerText = cart.reduce(
      (total, item) => total + item.quantity,
      0
    );

    cartItemsList.innerHTML = ""; // Clear the cart items

    if (cart.length === 0) {
      shoppingCart.classList.remove("show-cart");
      checkoutButton.style.display = "none"; // Hide the "Checkout" button
      totalCartPrice.innerText = "Total Price: $0.00";
    } else {
      cart.forEach((item) => {
        const li = document.createElement("li");
        li.innerHTML = `
          <div class="cart-item">
              <span class="item-name">${item.pizzaName} (x${item.quantity})</span>
              <button class="details-button" data-pizza-id="${item.pizzaId}">&#9660;</button>
              <ul class="details hidden">
                  <li>Description: ${item.pizzaDescription}</li>
                  <li>Price: ${item.pizzaPrice}</li>
              </ul>
              <button class="remove-button" data-pizza-id="${item.pizzaId}">Remove</button>
          </div>
        `;
        cartItemsList.appendChild(li);
      });

      shoppingCart.style.maxHeight = "70vh";
      shoppingCart.style.height = "auto";
      checkoutButton.style.display = "block"; // Show the "Checkout" button
      totalCartPrice.innerText = "Total Price: $" + calculateTotalPrice(cart);
    }
  }
});

function clearFilters() {
  // Uncheck all checkboxes
  var checkboxes = document.querySelectorAll(
    'input[name="selectedIngredients[]"]'
  );
  checkboxes.forEach(function (checkbox) {
    checkbox.checked = false;
  });
  // Submit the form to show all pizzas
  document.querySelector("form").submit();
}
