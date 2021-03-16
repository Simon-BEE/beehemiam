<template>
    <div class="w-full">
        <button type="button"
            class="text-lg font-bold mx-auto flex items-center justify-center rounded p-4 transition-colors duration-200 bg-primary-700 hover:bg-primary-400 focus:outline-none"
            @click="collapse"
            v-show="!isOpen"
        >
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                <path fill="currentColor" d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" />
            </svg>
            Via carte bancaire
        </button>

        <transition name="collapse">
            <article class="card-payment w-full p-4 rounded mt-2 relative" v-show="isOpen">
                <button class="absolute top-1 right-1 text-xl font-bold focus:outline-none" @click="collapse">
                    &times;
                </button>

                <form id="payment-form" class="py-8 pr-4 pl-8 border-l-2 border-kaki-800 flex flex-col">
                    <h3 class="text-2xl font-bold mb-8">Paiement par carte bancaire</h3>
                    <p class="mb-4 text-left">Veuillez indiquer vos informations bancaire ci-dessous.</p>

                    <div class="p-4 rounded bg-primary-100 mb-4">
                        <div id="card-element"><!--Stripe.js injects the Card Element--></div>
                    </div>

                    <p id="card-error" role="alert" class="text-red-500"></p>

                    <button class="px-3 py-2 rounded bg-green-200 my-8 self-end text-white font-bold hover:bg-opacity-80" id="submitButton">
                        <span class="inline-flex items-center" v-if="loading">
                            <span class="mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: transparent; display: block; shape-rendering: auto;" class="w-5 h-5" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                    <circle cx="50" cy="50" fill="none" stroke="#fff" stroke-width="7" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                                        <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                    </circle>
                                </svg>
                            </span>
                            Paiement en cours
                        </span>

                        <span class="inline-flex items-center" v-else>
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" />
                            </svg>
                            <span id="button-text">Payer {{ formatNumber(totalAmount / 100) }}€</span>
                        </span>
                    </button>
                </form>

                <p class="result-message hidden flex-col items-center justify-center">
                    <svg class="w-24 h-24 mb-6" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                    </svg>
                    <strong>Paiement réussi !</strong>
                    <span>Vous allez être redirigé sur <a :href="orderLink" class="underline">{{ orderLink !== baseUrl ? 'la page du récapitulatif de la commande' : 'la page d\'accueil' }}</a>.</span>
                    <span>Vous recevrez également un email avec le résumé de la commande dans quelques secondes.</span>
                </p>
            </article>
        </transition>
    </div>
</template>

<script>
import Loader from './LoaderIcon';

export default {
    components: { Loader },

    data() {
        return {
            isOpen: false,
            stripe: null,
            totalAmount: 0,
            loading: false,
            orderLink: '/',
            paymentIntentId: null,
            baseUrl: window.base_url,
        }
    },

    mounted() {
        this.stripe = window.Stripe('pk_test_51ITkJ4HQGTdB5i42cvWjnkNgJzRV3gd4yKIdGicQQ8w9VbcqDoX2XO40Xcxqi2VaKWT3vsR6rmIPt261vgIgYJEf001J73957U');

        this.loadStripe();
    },

    methods: {
        collapse() {
            this.isOpen = !this.isOpen;
        },

        loadStripe() {
            axios.get('/payments/stripe/payment-intent')
                .then(response => {
                    this.totalAmount = response.data.total_amount;
                    this.paymentIntentId = response.data.payment_intent;

                    const card = this.buildStripeForm();
                    const thisElement = this;

                    var form = document.getElementById("payment-form");
                    form.addEventListener("submit", function(event) {
                        event.preventDefault();

                        thisElement.processPayment(card, response.data.client_secret);
                        thisElement.loading = true;
                    });
                })
            ;
        },

        processPayment(card, clientSecret) {
            const submitBtn = document.getElementById('submitButton');

            submitBtn.disabled = true;

            this.stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card,
                },
            }).then(result => {
              if (result.error) {
                    document.querySelector("#card-error").textContent = result.error.message;
                    submitBtn.disabled = false;
              } else {
                    this.registerOrder();
              }
            }).catch(() => submitBtn.disabled = false);
        },

        registerOrder() {
            axios.post('/orders', {payment_intent: this.paymentIntentId})
            .then(response => {
                this.callAlert('Le paiement a été accepté et la commande vient d\'etre enregistré.');
                this.orderLink = response.data.order_link;
            }).catch(() => {
                this.callAlert('Le paiement a été accepté, la commande va être enregistré dans quelques secondes.');
            }).finally(() => {
                document.querySelector('#payment-form').classList.add('hidden');
                document.querySelector('.result-message').classList.replace('hidden', 'flex');
                this.loading = false;

                this.$cookies.remove('beehemiamCart');

                setTimeout(() => {
                    window.location.href = this.orderLink;
                }, 3000);
            })
        },

        buildStripeForm() {
            var elements = this.stripe.elements();

            var style = {
                base: {
                    color: "#5F5E48",
                    fontSize: "16px",
                    "::placeholder": {
                        color: "#5F5E48"
                    }
                },
                invalid: {
                    color: "#fa755a",
                    iconColor: "#fa755a"
                }
            };

            var card = elements.create("card", { style: style });

            card.mount("#card-element");

            card.on("change", function (event) {
                document.getElementById('submitButton').classList.remove('hidden');
                document.getElementById('submitButton').disabled = event.empty;
                document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
            });

            return card;
        },
    }
}
</script>

<style scoped>
    .collapse-enter-active, .collapse-leave-active {
        transition: all .2s;
        max-height: auto;
    }
    .collapse-enter, .collapse-leave-to {
        max-height: 0;
        opacity: 0;
    }
</style>
