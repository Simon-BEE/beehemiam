@extends('layouts.app')

@section('meta-title')
    Nous contacter
@endsection

@section('meta-desc')
    Si vous avez une question, une réclamation, même un mot d'encouragement vous êtes au bon endroit !
@endsection

@section('content')

<section class="flex flex-col items-center justify-center p-4 md:p-0">
    <article class="w-full md:w-1/2 text-center mb-8 md:mb-16">
        <h1 class="text-5xl md:text-7xl font-cursive">Nous contacter</h1>
        <p class="mt-8">Si vous avez une question, une réclamation, même un mot d'encouragement vous êtes au bon endroit !</p>
    </article>

    <section class="w-full flex flex-col md:flex-row justify-between md:space-x-12">
        <section class="w-full md:w-1/3 space-y-6 p-4">
            <h2 class="font-cursive text-4xl md:text-5x">Nos moyens de contact</h2>

            <article>
                <p class="mb-2">Si vous préférez nous contacter <strong>par courrier</strong>, voici nos coordonées. Bien entendu le délai de réponse est selon la réactivité du service de La Poste.</p>
                <div class="flex items-center p-4 rounded bg-primary-200 text-primary-500">
                    <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M17,4H7A5,5 0 0,0 2,9V20H20A2,2 0 0,0 22,18V9A5,5 0 0,0 17,4M10,18H4V9A3,3 0 0,1 7,6A3,3 0 0,1 10,9V18M20,18H12V9C12,7.92 11.65,6.86 11,6H17A3,3 0 0,1 20,9V18M13,13H15V9H17V7H13V13M9,11H5V9H9V11Z" />
                    </svg>
                    <div class="">
                        <p>Beehemiam</p>
                        <p>3 route de la bergerette, 03420 Terjat, France</p>
                    </div>
                </div>
            </article>

            <article>
                <p class="mb-2">Vous pouvez également nous envoyer <strong>un email</strong> à l'adresse ci-dessous. C'est le moyen de contact que nous favorisons avec le formulaire de contact.</p>
                <p class="p-4 rounded bg-primary-200">
                    <a href="mailto:contact@beehemiam.fr" class="inline-flex items-center text-primary-500 hover:underline">
                        <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,15C12.81,15 13.5,14.7 14.11,14.11C14.7,13.5 15,12.81 15,12C15,11.19 14.7,10.5 14.11,9.89C13.5,9.3 12.81,9 12,9C11.19,9 10.5,9.3 9.89,9.89C9.3,10.5 9,11.19 9,12C9,12.81 9.3,13.5 9.89,14.11C10.5,14.7 11.19,15 12,15M12,2C14.75,2 17.1,3 19.05,4.95C21,6.9 22,9.25 22,12V13.45C22,14.45 21.65,15.3 21,16C20.3,16.67 19.5,17 18.5,17C17.3,17 16.31,16.5 15.56,15.5C14.56,16.5 13.38,17 12,17C10.63,17 9.45,16.5 8.46,15.54C7.5,14.55 7,13.38 7,12C7,10.63 7.5,9.45 8.46,8.46C9.45,7.5 10.63,7 12,7C13.38,7 14.55,7.5 15.54,8.46C16.5,9.45 17,10.63 17,12V13.45C17,13.86 17.16,14.22 17.46,14.53C17.76,14.84 18.11,15 18.5,15C18.92,15 19.27,14.84 19.57,14.53C19.87,14.22 20,13.86 20,13.45V12C20,9.81 19.23,7.93 17.65,6.35C16.07,4.77 14.19,4 12,4C9.81,4 7.93,4.77 6.35,6.35C4.77,7.93 4,9.81 4,12C4,14.19 4.77,16.07 6.35,17.65C7.93,19.23 9.81,20 12,20H17V22H12C9.25,22 6.9,21 4.95,19.05C3,17.1 2,14.75 2,12C2,9.25 3,6.9 4.95,4.95C6.9,3 9.25,2 12,2Z" />
                        </svg>
                        contact@beehemiam.fr
                    </a>
                </p>
            </article>

            <article>
                <p class="mb-2">Vous pouvez également essayer de nous joindre <strong>par téléphone</strong>, n'ayant personne dédié à ce poste, selon le nombre d'appels, nous serons pas toujours en mesure de vous répondre rapidement.</p>
                <p class="p-4 rounded bg-primary-200">
                    <a href="tel:0611984533" class="inline-flex items-center text-primary-500 hover:underline">
                        <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M17,19H7V5H17M17,1H7C5.89,1 5,1.89 5,3V21A2,2 0 0,0 7,23H17A2,2 0 0,0 19,21V3C19,1.89 18.1,1 17,1Z" />
                        </svg>
                        0611984533
                    </a>
                </p>
            </article>
        </section>

        <section class="w-full md:w-2/3 space-y-6 bg-primary-700 rounded p-4">
            <h2 class="font-cursive text-4xl md:text-5x">Formulaire de contact</h2>

            <article>
                <p class="mb-2">Le meilleur moyen de nous contacter et d'obtenir une réponse rapidement (si nécessaire). Nous consultons très régulièrement les messages envoyés depuis ce formulaire.</p>
            </article>

            <article class="">
                <x-form.form method="POST" action="" id="formContact">
                    <x-form.input
                        name="email"
                        label="Votre adresse email"
                        placeholder="Adresse email"
                        value="{{ auth()->check() ? auth()->user()->email : old('email') }}"
                        required
                    />

                    <div class="">
                        <label class="inputname" for="name"></label>
                        <input class="inputname" autocomplete="off" type="text" id="name" name="name" placeholder="Your name here" tabindex="-1">
                    </div>

                    <x-form.input
                        name="object"
                        label="Le sujet du message"
                        placeholder="Sujet du message"
                        required
                    />

                    <x-form.textarea
                        name="content"
                        label="Votre message"
                        placeholder="Le message"
                        required
                    />

                    <x-form.checkbox name="terms" required>
                        <span class="ml-2">
                            J'accepte que mon adresse email puisse être enregistrée afin de garantir un meilleur support. <br />
                            <span class="text-xs ml-2">Elle ne sera jamais utilisée dans un autre contexte ou vendue à quelconque tiers.</span>
                        </span>
                    </x-form.checkbox>

                    <p class="text-sm my-4">Tous les champs sont requis. Soyez précis, et n'hésitez pas à apporter des informations élémentaires si nécessaire (par exemple votre numéro de commande).</p>

                    <p class="text-right">
                        <x-form.button>
                            <svg class="w-5 h-5 transform -rotate-45 mr-2 -mt-1" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M2,21L23,12L2,3V10L17,12L2,14V21Z" />
                            </svg>
                            Envoyer le message
                        </x-form.button>
                    </p>
                </x-form.form>
            </article>
        </section>
    </section>
</section>

@endsection
