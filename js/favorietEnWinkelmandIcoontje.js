document.querySelectorAll('.favoriet').forEach(function(button) {
    button.addEventListener('click', function(event) {
      event.preventDefault(); //gaat ervoor zorgen dat er ni naar de volgende pagina wordt gegaan in plaats van het hartje aan te klikken
      let favorite_img = this.querySelector('img');
      if (favorite_img.src.endsWith('heart-regular.svg')) {
        favorite_img.src = 'images/svg/heart-solid.svg';
      } else {
        favorite_img.src = 'images/svg/heart-regular.svg';
      }
    });
  });
  document.querySelectorAll('.winkelmand').forEach(function(button) {
    button.addEventListener('click', function(event) {
      event.preventDefault(); //gaat ervoor zorgen dat er ni naar de volgende pagina wordt gegaan in plaats van het winkelmandje aan te klikken
      let cart_img = this.querySelector('img');
      if (cart_img.src.endsWith('cart-shopping-solid.svg')) {
        cart_img.src = 'images/svg/shopping-cart-regular.svg';
      } else {
        cart_img.src = 'images/svg/cart-shopping-solid.svg';
      }
    });
  });