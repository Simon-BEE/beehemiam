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

            let cartItem = {};

            cartItem[itemKey] = itemValue;

            cartItems.push(cartItem);

            const uniqueArray = a => [...new Set(a.map(o => JSON.stringify(o)))].map(s => JSON.parse(s))
            cartItems = uniqueArray(cartItems);
            
            this.$cookies.set('beehemiamCart', JSON.stringify(cartItems));

            window.dispatchEvent(new CustomEvent('cart-change-event', {
                detail: {
                    storage: cartItems.length,
                }
            }));
        },

        callAlert(message, type = 'success') {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert-box relative p-6 pr-9 mb-4 rounded-lg shadow-xl z-40 transition-opacity duration-500 bg-primary-100 border border-b-8 border-primary-200 w-full`;

            const buttonClose = document.createElement('button');
            buttonClose.className = "close-alert absolute top-1 right-1 text-2xl px-1 py-0.5 rounded hover:bg-gray-200 focus:outline-none";
            buttonClose.innerHTML = "&times;";
            buttonClose.addEventListener('click', () => this.hideAlertBox(alertDiv));

            alertDiv.innerHTML = `
                <p>
                    <strong class="${type === 'success' ? 'text-green-200' : 'text-red-500' }">${type === 'success' ? 'Succès' : 'Erreur'}.</strong> 
                    ${message}
                </p>
            `;

            alertDiv.append(buttonClose);

            document.querySelector('.alert-container').append(alertDiv);

            setTimeout(() => {
                this.hideAlertBox(alertDiv);
            }, 5500);
        },

        hideAlertBox(box) {
            box.classList.add('opacity-0');
    
            setTimeout(() => box.remove(), 1500);
        },
    }
  }