@extends('layouts.app')

@section('meta-title')
    Politique de Confidentialité
@endsection

@section('meta-desc')
    La présente Politique de Confidentialité a pour objet la définition et le traitement de vos données personnelles réalisé au travers de beehemiam.fr.
@endsection

@section('content')

<section class="flex flex-col items-center justify-center p-4 md:p-0">
    <article class="w-full md:w-1/2 text-center mb-8 md:mb-16">
        <h1 class="text-5xl md:text-7xl font-cursive">Politique de Confidentialité</h1>
        <p class="mt-8">La présente Politique de Confidentialité a pour objet la définition et le traitement de vos données personnelles réalisé au travers de <a href="{{ url('/') }}" class="text-primary-500 hover:underline">beehemiam.fr</a>.</p>
    </article>

    <section class="w-full flex flex-col space-y-16 md:w-2/3 md:mx-auto">

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">1. Qui sommes-nous ?</h2>

            <p class="mb-1">L’adresse de notre site Web est : <a href="{{ url('/') }}" class="text-primary-500 hover:underline">https://www.beehemiam.fr</a>.</p>
            <p class="mb-1"><strong>Beehemiam</strong> est une marque de vêtements destinée aux mères allaitantes, vous retrouverez plus d'informations à notre sujet sur <a href="{{ url('/') }}" class="text-primary-500 hover:underline">la page dédiée</a>.</p>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">2. Utilisation des données personnelles collectées</h2>

            <h3 class="text-xl font-semibold mb-2">2.1 Statistiques et mesures d’audience</h3>

            <p class="mb-1">Le site est exempt de tout traqueur tiers, et l’outil de suivi des visiteurs utilisé est Matomo (anciennement Piwik). Réputé pour être un des seuls à avoir reçu l’aval de la CNIL. Vous trouverez plus d'informations au sujet de Matomo sur <a href="https://fr.matomo.org/gdpr/" class="text-primary-500 hover:underline">leur site internet</a>.</p>

            <p class="mb-5">Matomo est exécuté sur le même hébergement que le site principal, aucune information d’audience ou de visite n’est partagée avec des services tiers. Les adresses IP sont anonymisées, et vous pouvez désactiver le suivi Matomo en réglant votre navigateur pour ne pas l’être. La mesure d’audience ne me sert qu’à mieux identifier les sujets qui vous intéressent et à améliorer le site.</p>

            <h3 class="text-xl font-semibold mb-2">2.2 État du suivi de votre navigation</h3>

            <div class="bg-primary-300 p-3 h-24 mb-5">
                <iframe
                style="border: 0; width: 100%;"
                src="https://analytics.beehemiam.fr/index.php?module=CoreAdminHome&action=optOut&language=fr&backgroundColor=&fontColor=5F5E48&fontSize=&fontFamily=Nunito"
                ></iframe>
            </div>


            <h3 class="text-xl font-semibold mb-2">2.3 Formulaires de contact</h3>

            <p class="mb-5">Les données transmises par le formulaire de contact seront utilisées exclusivement pour vous répondre, et vous apporter le support suite à vos commandes.</p>

            <h3 class="text-xl font-semibold mb-2">2.4 Contenu embarqué depuis d’autres sites</h3>

            <p class="mb-1">Les articles de ce site peuvent inclure des contenus intégrés (par exemple des vidéos, ou des posts de réseaux sociaux). Le contenu intégré depuis d’autres sites se comporte de la même manière que si le visiteur se rendait sur cet autre site.</p>

            <p class="mb-5">Ces sites Web pourraient collecter des données sur vous, utiliser des cookies, embarquer des outils de suivis tiers, suivre vos interactions avec ces contenus embarqués si vous disposez d’un compte connecté sur leur site web.</p>

            <h3 class="text-xl font-semibold mb-2">2.5 Publicité</h3>

            <p class="mb-1"><a href="{{ url('/') }}" class="text-primary-500 hover:underline">Beehemiam.fr</a> n'intègre aucune publicité au sein de son site internet.</p>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">3. Cookies</h2>

            <p class="mb-1">Des cookies purement fonctionnels sont suceptibles d'être déposés sur le site. Il ne s'agit que de cookies techniques dont l'objectif de vous fournir un service de bonne qualité durant votre navigation. Par exemple : "se souvenir de votre connexion au site", "les articles dans le panier restent même après avoir quitté le site", ...</p>

            <p class="mb-1">Voici la liste des cookies suceptibles d'être déposés dans votre votre navigateur par le site <a href="{{ url('/') }}" class="text-primary-500 hover:underline">beehemiam.fr</a> :</p>

            <ul class="">
                <li class="p-4 rounded bg-primary-300 flex flex-col md:flex-row items-center justify-between mb-2">
                    <span class="font-bold md:mr-6">XSRF-TOKEN</span>
                    <span class="text-sm md:text-xs">Protection contre les requêtes venant d'autres sites (<a href="https://fr.wikipedia.org/wiki/Cross-site_request_forgery" class="underline">plus d'informations...</a>)</span>
                </li>
                <li class="p-4 rounded bg-primary-300 flex flex-col md:flex-row items-center justify-between mb-2">
                    <span class="font-bold md:mr-6">_sp_id.*</span>
                    <span class="text-sm md:text-xs">Bibliothèque d'images libre de droits (<a href="https://unsplash.com/" class="underline">plus d'informations...</a>)</span>
                </li>
                <li class="p-4 rounded bg-primary-300 flex flex-col md:flex-row items-center justify-between mb-2">
                    <span class="font-bold md:mr-6">_sp_ses.*</span>
                    <span class="text-sm md:text-xs">Bibliothèque d'images libre de droits (<a href="https://unsplash.com/" class="underline">plus d'informations...</a>)</span>
                </li>
                <li class="p-4 rounded bg-primary-300 flex flex-col md:flex-row items-center justify-between mb-2">
                    <span class="font-bold md:mr-6">ugid</span>
                    <span class="text-sm md:text-xs">Bibliothèque d'images libre de droits (<a href="https://unsplash.com/" class="underline">plus d'informations...</a>)</span>
                </li>
                <li class="p-4 rounded bg-primary-300 flex flex-col md:flex-row items-center justify-between mb-2">
                    <span class="font-bold md:mr-6">__stripe_mid</span>
                    <span class="text-sm md:text-xs">Librairie de paiement qui permet de traiter des paiements sans stocker d’informations de carte de crédit sur nos propres serveurs (<a href="https://stripe.com/fr" class="underline">plus d'informations...</a>)</span>
                </li>
                <li class="p-4 rounded bg-primary-300 flex flex-col md:flex-row items-center justify-between mb-2">
                    <span class="font-bold md:mr-6">__stripe_sid</span>
                    <span class="text-sm md:text-xs">Librairie de paiement qui permet de traiter des paiements sans stocker d’informations de carte de crédit sur nos propres serveurs (<a href="https://stripe.com/fr" class="underline">plus d'informations...</a>)</span>
                </li>
                <li class="p-4 rounded bg-primary-300 flex flex-col md:flex-row items-center justify-between mb-2">
                    <span class="font-bold md:mr-6">beehemiam_session</span>
                    <span class="text-sm md:text-xs">Gestion de l'authentification</span>
                </li>
                <li class="p-4 rounded bg-primary-300 flex flex-col md:flex-row items-center justify-between mb-2">
                    <span class="font-bold md:mr-6">remember_web_*</span>
                    <span class="text-sm md:text-xs">Pour se souvenir de votre authentification</span>
                </li>
                <li class="p-4 rounded bg-primary-300 flex flex-col md:flex-row items-center justify-between mb-2">
                    <span class="font-bold md:mr-6">beehemiamCart</span>
                    <span class="text-sm md:text-xs">Gestion du panier</span>
                </li>
                <li class="p-4 rounded bg-primary-300 flex flex-col md:flex-row items-center justify-between mb-2">
                    <span class="font-bold md:mr-6">beehemiamCookieBanner</span>
                    <span class="text-sm md:text-xs">Enregistrement de votre lecture sur la bannière RGPD présente lors de votre première visite</span>
                </li>
            </ul>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">4. Les droits que vous avez sur vos données</h2>

            <p class="mb-1">Si vous avez un compte, vous pouvez demander à recevoir un fichier contenant toutes les données personnelles que nous possédons à votre sujet, incluant celles que vous nous avez fournies. Pour cela, rendez sur votre espace <span class="py-1 px-2 rounded bg-primary-300 font-bold">personnel / paramètres / puis cliquer sur "Je souhaite accéder à mes données enregistrées sur Beehemiam.fr"</span>.</p>

            @auth
                <p class="mb-1"><a href="{{ route('user.settings.index') }}" class="text-primary-500 hover:underline">Accéder à la page directement</a>.</p>
            @endauth
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">5. Consentement</h2>

            <p class="mb-1">En utilisant ce site, vous consentez à notre politique de confidentialité.</p>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">6. Informations de contact</h2>

            <p class="mb-1">Si vous souhaitez avoir plus d'informations à ce sujet, veuillez nous écrire à l'adresse email suivante <a href="mailto:contact@beehemiam.fr" class="text-primary-500 hover:underline">contact@beehemiam.fr</a> ou depuis le <a href="{{ route('contact.index') }}" class="text-primary-500 hover:underline">formulaire de contact</a> disponible sur le site, en précisant votre demande.</p>
        </article>

    </section>
</section>

@endsection
