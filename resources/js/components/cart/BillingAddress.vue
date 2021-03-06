<template>
  <div>
    <section class="border border-primary-300 rounded p-4 my-6 w-full flex flex-col relative" v-if="billingOpen">

        <button class="absolute top-1 right-1 rounded px-2 py-1 focus:outline-none hover:bg-primary-300 text-2xl"
            @click="closeBillingAddress"
        >
            &times;
        </button>

        <h3 class="text-lg font-bold mb-3">Adresse de facturation</h3>
        <div
        class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-3 mb-4"
        >
            <div class="w-full">
                <label
                for="billing[firstname]"
                class="text-sm font-medium leading-relaxed tracking-tighter text-kaki-900 flex items-center"
                >
                Prénom
                </label>
                <input
                type="text"
                name="billing[firstname]"
                id="billing[firstname]"
                placeholder="Prénom"
                value=""
                required="required"
                class="w-full mt-2 px-4 py-2 block rounded text-kaki-900 border border-transparent focus:bg-white focus:outline-none focus:border-transparent focus:ring-2 focus:ring-primary-500 bg-primary-200"
                />
            </div>
            <div class="w-full">
                <label
                for="billing[lastname]"
                class="text-sm font-medium leading-relaxed tracking-tighter text-kaki-900 flex items-center"
                >
                Nom de famille
                </label>
                <input
                type="text"
                name="billing[lastname]"
                id="billing[lastname]"
                placeholder="Nom de famille"
                value=""
                required="required"
                class="w-full mt-2 px-4 py-2 block rounded text-kaki-900 border border-transparent focus:bg-white focus:outline-none focus:border-transparent focus:ring-2 focus:ring-primary-500 bg-primary-200"
                />
            </div>
        </div>

        <div
        class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-3 mb-4"
        >
            <div class="w-full">
                <label
                for="billing[email]"
                class="text-sm font-medium leading-relaxed tracking-tighter text-kaki-900 flex items-center"
                >
                Adresse email
                </label>
                <input
                type="email"
                name="billing[email]"
                id="billing[email]"
                placeholder="Adresse email"
                value=""
                required="required"
                class="w-full mt-2 px-4 py-2 block rounded text-kaki-900 border border-transparent focus:bg-white focus:outline-none focus:border-transparent focus:ring-2 focus:ring-primary-500 bg-primary-200"
                />
            </div>
            <div class="w-full">
                <label
                for="billing[phone]"
                class="text-sm font-medium leading-relaxed tracking-tighter text-kaki-900 flex items-center"
                >
                Numéro de télephone
                </label>
                <input
                type="text"
                name="billing[phone]"
                id="billing[phone]"
                placeholder="Numéro de télephone"
                value=""
                required="required"
                class="w-full mt-2 px-4 py-2 block rounded text-kaki-900 border border-transparent focus:bg-white focus:outline-none focus:border-transparent focus:ring-2 focus:ring-primary-500 bg-primary-200"
                />
            </div>
        </div>

        <div class="w-full mb-4">
            <label
                for="billing[street]"
                class="text-sm font-medium leading-relaxed tracking-tighter text-kaki-900 flex items-center"
            >
                Adresse
            </label>
            <input
                type="text"
                name="billing[street]"
                id="billing[street]"
                placeholder="Adresse"
                value=""
                required="required"
                class="w-full mt-2 px-4 py-2 block rounded text-kaki-900 border border-transparent focus:bg-white focus:outline-none focus:border-transparent focus:ring-2 focus:ring-primary-500 bg-primary-200"
            />
        </div>

        <div class="w-full mb-4">
            <label
                for="billing[additionnal]"
                class="text-sm font-medium leading-relaxed tracking-tighter text-kaki-900 flex items-center"
            >
                Complément d'adresse
                <span class="text-xs uppercase text-kaki-800 ml-1 md:ml-3"
                >Facultatif</span
                ></label
            >
            <input
                type="text"
                name="billing[additionnal]"
                id="billing[additionnal]"
                placeholder="Complément d'adresse"
                value=""
                class="w-full mt-2 px-4 py-2 block rounded text-kaki-900 border border-transparent focus:bg-white focus:outline-none focus:border-transparent focus:ring-2 focus:ring-primary-500 bg-primary-200"
            />
        </div>

        <div
        class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-3 mb-4"
        >
        <div class="w-full">
            <label
            for="billing[city]"
            class="text-sm font-medium leading-relaxed tracking-tighter text-kaki-900 flex items-center"
            >
            Ville
            </label>
            <input
            type="text"
            name="billing[city]"
            id="billing[city]"
            placeholder="Ville"
            value=""
            required="required"
            class="w-full mt-2 px-4 py-2 block rounded text-kaki-900 border border-transparent focus:bg-white focus:outline-none focus:border-transparent focus:ring-2 focus:ring-primary-500 bg-primary-200"
            />
        </div>
        <div class="w-full">
            <label
            for="billing[zipcode]"
            class="text-sm font-medium leading-relaxed tracking-tighter text-kaki-900 flex items-center"
            >
            Code postal
            </label>
            <input
            type="text"
            name="billing[zipcode]"
            id="billing[zipcode]"
            placeholder="Code postal"
            value=""
            required="required"
            class="w-full mt-2 px-4 py-2 block rounded text-kaki-900 border border-transparent focus:bg-white focus:outline-none focus:border-transparent focus:ring-2 focus:ring-primary-500 bg-primary-200"
            />
        </div>
        <div class="w-full mb-4">
            <label
            for="billing[country_id]"
            class="text-sm font-medium leading-relaxed tracking-tighter text-kaki-900 flex items-center justify-between"
            >Choisir un pays</label
            >
            <div class="relative w-full border-none mt-2">
            <select
                id="billing[country_id]"
                name="billing[country_id]"
                required="required"
                class="bg-primary-200 text-kaki-900 appearance-none border-none focus:outline-none focus:ring-2 focus:ring-primary-500 inline-block py-3 pl-3 pr-8 rounded leading-tight w-full"
            >
                <option value="1">France</option>
                <option value="2">Belgique</option>
                <option value="3">Suisse</option>
            </select>
            </div>
        </div>
        </div>
    </section>

    <p class="text-sm my-4" v-if="!billingOpen">
        <button @click.prevent="billingOpen = !billingOpen" class="text-primary-500 hover:underline inline-flex items-center">
            <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                <path fill="currentColor" d="M10.07,14.27C10.57,14.03 11.16,14.25 11.4,14.75L13.7,19.74L15.5,18.89L13.19,13.91C12.95,13.41 13.17,12.81 13.67,12.58L13.95,12.5L16.25,12.05L8,5.12V15.9L9.82,14.43L10.07,14.27M13.64,21.97C13.14,22.21 12.54,22 12.31,21.5L10.13,16.76L7.62,18.78C7.45,18.92 7.24,19 7,19A1,1 0 0,1 6,18V3A1,1 0 0,1 7,2C7.24,2 7.47,2.09 7.64,2.23L7.65,2.22L19.14,11.86C19.57,12.22 19.62,12.85 19.27,13.27C19.12,13.45 18.91,13.57 18.7,13.61L15.54,14.23L17.74,18.96C18,19.46 17.76,20.05 17.26,20.28L13.64,21.97Z" />
            </svg>
            Utiliser une adresse différente pour la facture ?
        </button>
    </p>
  </div>
</template>

<script>
export default {
    data() {
        return {
            billingOpen: false,
        }
    },

    methods: {
        closeBillingAddress() {
            this.billingOpen = false;
        },
    },
};
</script>