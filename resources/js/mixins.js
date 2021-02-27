export default {
    methods: {
      toggleOverlay(modal = false) {
        const overlay = document.querySelector('.clickable-overlay');
  
        overlay.classList.toggle('hidden');
        overlay.classList.toggle('z-20');
        if (modal) {
            overlay.classList.add('bg-black', 'bg-opacity-25');
        }else{
            overlay.classList.remove('bg-black', 'bg-opacity-25');
        }
      },
  
      togglePopover(popover) {
          popover.classList.toggle('md:opacity-0');
          popover.classList.toggle('-z-1');
          popover.classList.toggle('z-30');
      },
  
      toggleModal(modal) {
          modal.classList.toggle('opacity-0');
          modal.classList.toggle('-z-1');
          modal.classList.toggle('z-40');
      },
  
      addItemToCart(itemKey, itemValue) {
        let cartItems = [];
        if(this.$cookies.isKey('beehemiamCart')){
            cartItems = JSON.parse(this.$cookies.get('beehemiamCart'));
        }
        cartItems.push({'productOptionSizeId' : itemValue});
        
        cartItems = [...new Map(cartItems.map(item => [item['productOptionSizeId'], item])).values()];
        
        this.$cookies.set('beehemiamCart', JSON.stringify(cartItems));

        window.dispatchEvent(new CustomEvent('cart-change-event', {
            detail: {
                storage: cartItems.length,
            }
        }));
      },
    }
  }