@extends('layouts.app')

@section('meta-title')
    Livraisons et Retours
@endsection

@section('meta-desc')
    Résumé sur nos pratiques de livraisons et de retours des commandes passées sur beehemiam.fr
@endsection

@section('content')

<section class="flex flex-col items-center justify-center p-4 md:p-0">
    <article class="w-full md:w-1/2 text-center mb-8 md:mb-16">
        <h1 class="text-5xl md:text-7xl font-cursive">Livraisons et Retours</h1>
        <p class="mt-8">Résumé sur nos pratiques de livraisons et de retours des commandes passées sur <a href="{{ url('/') }}" class="text-primary-500 hover:underline">Beehemiam.fr</a>.</p>
    </article>

    <section class="w-full flex flex-col space-y-16 md:w-2/3 md:mx-auto">

        <article>
            <h2 class="text-3xl font-bold mb-4 uppercase">1. Livraisons</h2>

            <h2 class="text-xl font-semibold mb-2">Délais de préparation</h2>
            <p class="mb-2">Pour toute commande d'articles en stock, il faut compter une à deux journées ouvrées de préparation. Pour les commandes comportant des articles en précommandes, pas encore disponible en stock, la préparation débutera dès la fin de la précommande et la reception des stocks de ces articles. Une précommande dure généralement un mois.</p>

            <h2 class="text-xl font-semibold mb-2">Délais d'expédition</h2>
            <p class="mb-2">Si une commande est prête avant 12h (heure française), elle sera mise à disposition de l'organisme expéditeur dans la journée, dans le cas contraire elle sera expédiée le jour ouvré suivant.</p>
            <p class="mb-2">Une fois mise à disposition de l'organisme de livraison, il faut compter entre 2 et 5 jours ouvrés avant réception de la commande.</p>

            <h2 class="text-xl font-semibold mb-2">Frais de livraison</h2>
            <p class="mb-2">Les tarifs proposés sont ceux indiqués par les services de livraison.</p>
            <ul class="list-inside list-disc">
                <li>
                    <strong>Colissimo</strong> : https://www.laposte.fr/tarif-colissimo
                </li>
            </ul>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-4 uppercase">2. Retours</h2>

            <x-info>
                <p>Avant de procéder à tout retour, veiller à insérer dans le colis le <strong class="mx-1">bon de retour</strong> fourni à la suite de votre demande de retour.</p>
            </x-info>

            <h2 class="text-xl font-semibold my-2">Frais de retours</h2>
            <p class="mb-2">Tous les retours sont gérés au cas par cas, afin de consacrer le meilleur soin possible à chacun de nos clients.</p>
            <p class="mb-2">Nous ne sommes malheureusement pas encore en mesure de vous proposer des frais d'affranchissements gratuits pour vos retours. Cependant ces derniers devront être envoyé par voie postale à l'adresse suivante :</p>
            <div class="p-4 mb-2 bg-primary-300 rounded">
                <p>Beehemiam</p>
                <p>3 route de la bergertte</p>
                <p>Terjat, 03420</p>
                <p>France</p>
            </div>
            <p class="mb-2">Il est de votre responsabilité de payer ces frais lorsque vous désirez nous retourner un article. Bien entendu si le ou les articles retournés sont acceptés, vous serez remboursé de ce montant. Veillez à conserver la facture reçue lors de l'envoi.</p>

            <h2 class="text-xl font-semibold my-2">Conditions de retours</h2>
            <p class="mb-2">Pour être éligible à un retour ou un échange, veuillez vous assurer que les conditions suivantes soient réunies :</p>

            <ul class="list-disc list-inside mb-2 pl-1">
                <li>Votre demande s’inscrit dans la période de 14 jours à compter de la date de réception des produits commandés (ou, lorsque la commande porte sur plusieurs produits livrés séparément, à compter de la réception du dernier produit).</li>
                <li>Le vêtement est dans son état d’origine et n’a pas été lavé.</li>
                <li>Le vêtement n’a jamais été porté – hors essayage pour l’ajustement.</li>
            </ul>

            <x-info>
                <p class="">Si vous n’êtes pas sûr que votre article soit admissible à un échange, veuillez d’abord nous contacter à l’adresse email <a href="mailto:contact@beehemiam.fr" class="text-primary-500 hover:underline">contact@beehemiam.fr</a> ou depuis le <a href="{{ route('contact.index') }}" class="text-primary-500 hover:underline">formulaire de contact</a> disponible sur le site.</p>
            </x-info>

            <p class="my-2">Veuillez prendre en compte les points suivants également :</p>

            <ul class="list-disc list-inside">
                <li>Seuls les vêtements qui sont dans leur état d’origine seront acceptés – toutes les étiquettes attachées.</li>
                <li>Le vêtement n’a jamais été lavé ou porté – hors essayage.</li>
                <li>Si le vêtement retourné a été lavé, est marqué (maquillage, tâches de déodorant, traces de sueur, etc.) ou si le vêtement a une odeur forte (par exemple, parfum ou cuisine), nous nous réservons le droit de refuser un retour sur cet article et nous ne pourrons pas assurer un remboursement des frais d’affranchissement.</li>
            </ul>

            <p class="my-2">Vous comprendrez que ces articles ne pourraient être mis en vente de nouveau.</p>
        </article>



    </section>
</section>

@endsection
