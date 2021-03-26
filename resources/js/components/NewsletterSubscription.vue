<template>
    <div class="">
        <div class="w-full flex items-center justify-center my-6" v-if="loading">
            <loader />
        </div>

        <div class="w-full flex flex-col items-center justify-center my-6" v-else-if="!loading && success">
            <svg class="w-20 h-20 text-green-400" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19,19H5V5H15V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V11H19M7.91,10.08L6.5,11.5L11,16L21,6L19.59,4.58L11,13.17L7.91,10.08Z" />
            </svg>
            <p>Vous êtes bien inscrit à la newsletter de Beehemiam !</p>
            <p>Merci, nous vous enverrons des nouvelles très vite.</p>
        </div>

        <form action="#" class="flex flex-col md:flex-row items-center justify-between mx-auto w-full md:w-2/3" @submit.prevent="subscribeToNewsletter" v-else>
            <div class="mb-4 flex flex-col space-y-2 w-full md:w-2/3 text-left">
                <label for="email_newsletter">Votre adresse email</label>
                <input type="email" name="email" id="email_newsletter" placeholder="Adresse email" required
                    v-model="email"
                    class="px-3 py-2 rounded-lg border border-primary-300 ring-2 ring-transparent focus:ring-primary-500 focus:outline-none">

                <span class="text-sm text-red-400 inline-flex items-center" v-if="error">
                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M13 14H11V9H13M13 18H11V16H13M1 21H23L12 2L1 21Z" />
                    </svg>
                    {{ error }}
                </span>
            </div>
            <button
                class="px-3 py-2 rounded bg-primary-500 text-white mt-3 transition-colors duration-200 hover:bg-primary-400">M'inscrire
                à la Newsletter</button>
        </form>
    </div>
</template>

<script>
import Loader from './LoaderIcon';

export default {
    components: { Loader },

    data() {
        return {
            email: null,
            error: null,
            loading: false,
            success: false,
        }
    },

    methods: {
        subscribeToNewsletter() {
            this.loading = true;
            this.resetError();

            if (!this.validateEmail()) {
                this.error = "L'adresse email est invalide";

                return;
            }

            axios.post('/newsletter', {email: this.email})
                .then((response) => {
                    console.log(response.data.message);
                    this.success = true;
                    this.email = null;

                    this.callAlert(response.data.message)
                }).catch(error => {
                    console.error(error.response.data.message);
                    this.error = error.response.data.message;

                    this.callAlert(error.response.data.message, "error");
                }).finally(() => {
                    this.loading = false;

                    if (this.success) {
                        setTimeout(() => {
                            this.success = false;
                        }, 10000);
                    }
                })
        },

        validateEmail() {
            var re = /\S+@\S+\.\S+/;

            return re.test(this.email);
        },

        resetError() {
            this.error = null;
        },
    }
}
</script>
