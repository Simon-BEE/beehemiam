@extends('layouts.app')

@section('meta-title')
    Conditions générales de Vente
@endsection

@section('meta-desc')
    Les Conditions générales de Vente ont pour objectif de fournir aux clients les conditions légales de ventes des articles proposés par Beehemiam.
@endsection

@section('content')

<section class="flex flex-col items-center justify-center p-4 md:p-0">
    <article class="w-full md:w-1/2 text-center mb-8 md:mb-16">
        <h1 class="text-5xl md:text-7xl font-cursive">Conditions générales de Vente</h1>
        <p class="mt-8">Les Conditions générales de Vente ont pour objectif de fournir aux clients les conditions légales de ventes des articles proposés par <a href="{{ url('/') }}" class="text-primary-500 hover:underline">Beehemiam.fr</a>.</p>
    </article>

    <section class="w-full flex flex-col space-y-16">

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">1. Qui sommes-nous ?</h2>

            <p class="mb-1"><strong>BEEHEMIAM</strong>, MICRO-ENTREPRISE, dont le siège social est à TERJAT (03420) 3 route de la bergerette, immatriculée au registre du commerce et des sociétés de MONTLUÇON sous le numéro <strong>893 300 632 00013</strong> représentée par <strong>Madame Elodie BAILLARIN</strong> (ci-après la " Société ”). La Société commercialise, à ses Clients via son Site Internet, les produits suivants : vêtements d'allaitement.</p>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">2. Préambule</h2>

            <p class="mb-2">La Société invite les Utilisateurs à lire attentivement les présentes Conditions Générales de Vente et d’Utilisation (ci-après les "CGV/CGU"). La passation d'une Commande implique l'acceptation des CGV/CGU. Les caractéristiques des Produits sont indiquées sur le Site Internet. Il revient au Client d'en tenir compte avant son achat. Les photographies ou graphismes présentés sur le Site Internet ne sont pas contractuels.</p>
            <p class="mb-2">Le Client reconnait en avoir pris connaissance et les avoir acceptées en cochant la case prévue pour ce faire avant la passation de sa Commande en ligne.</p>
            <p class="mb-2">Les CGV/CGU encadrent les conditions dans lesquelles la Société vend ses Produits à ses Clients Professionnels et Consommateurs via son Site Internet.</p>
            <p class="mb-2">Elles s'appliquent à toutes les ventes conclues par la Société et s'imposent à tout document contradictoire, notamment les conditions générales d'achat du Client</p>
            <p class="mb-2">Elles sont systématiquement communiquées au Client qui en fait la demande.</p>
            <p class="mb-2">En cas de modification ultérieure des CGV/CGU, le Client est soumis à la version en vigueur lors de sa Commande.</p>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">3. Définitions</h2>

            <ul class="space-y-2 list-disc list-inside">
                <li><strong>Client</strong> désigne le Professionnel ou le Consommateur ayant passé Commande d'un Produit vendu sur le Site Internet ;</li>
                <li><strong>Commande</strong> désigne toute commande passée par l’Utilisateur inscrit sur le présent Site ;</li>
                <li><strong>Conditions Générales de Vente et d'Utilisation</strong> ou <strong>CGV/CGU</strong> désignent les présentes conditions générales d'utilisation et de vente en ligne ;</li>
                <li><strong>Consommateur</strong> désigne l'acheteur personne physique qui n'agit pas pour des besoins professionnels et/ou hors de son activité professionnelle ;</li>
                <li><strong>Produits</strong> désigne les choses matérielles pouvant faire l’objet d’une appropriation et qui sont proposées en vente sur le présent Site ;</li>
                <li><strong>Professionnel</strong> désigne l'acheteur personne morale ou physique qui agit dans le cadre de son activité professionnelle ;</li>
                <li><strong>Site</strong> désigne le présent Site, c’est-à-dire beehemiam.fr ;</li>
                <li><strong>Société</strong> désigne la Société Beehemiam, plus amplement désignée à l'article I des présentes ; et</li>
                <li><strong>Utilisateur</strong> désigne toute personne qui fait utilisation du Site.</li>
            </ul>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">4. Inscription</h2>

            <p class="mb-2">L’inscription au Site est ouverte à toutes les personnes morales ou physiques majeures et jouissant de leurs pleines personnalités et capacités juridiques.</p>
            <p class="mb-2">L’utilisation du Site est conditionnée à l’inscription d’un Utilisateur. L’inscription est gratuite.</p>
            <p class="mb-2">Pour procéder à l’inscription, l’Utilisateur doit remplir tous les champs obligatoires ; à défaut l’inscription ne pourra être complétée.</p>
            <p class="mb-2">Les Utilisateurs garantissent et déclarent sur l'honneur que toutes les informations communiquées sur le Site, notamment lors de leur inscription, sont exactes et conformes. Ils s’engagent à mettre à jour leurs informations personnelles à partir de la page dédiée à ces dernières et disponible dans leur compte.</p>
            <p class="mb-2">Tout Utilisateur enregistré dispose d’un identifiant et d’un mot de passe. Ces derniers sont strictement personnels et confidentiels et ne devront en aucun cas faire l’objet d’une communication à des tiers sous peine de suppression du compte de l’Utilisateur enregistré contrevenant. Chaque Utilisateur enregistré est personnellement responsable du maintien de la confidentialité de son identifiant et mot de passe. La Société ne sera en aucun cas tenue pour responsable de l’usurpation d’identité d’un Utilisateur. Si un Utilisateur suspecte une fraude à n’importe quel moment, il devra contacter la Société dans les plus brefs délais, afin que cette dernière puisse prendre les mesures nécessaires et régulariser la situation.</p>
            <p class="mb-2">Chaque Utilisateur, qu’il soit une personne morale ou physique, ne peut être titulaire que d’un compte sur le Site.</p>
            <p class="mb-2">En cas de non-respect des CGV/CGU, notamment la création de plusieurs comptes pour une seule personne ou encore la fourniture de fausses informations, la Société se réserve le droit de procéder à la suppression temporaire ou définitive de tous les comptes créés par l’Utilisateur contrevenant.</p>
            <p class="mb-2">La suppression du compte entraîne la perte définitive de tous les avantages et services acquis sur le Site. Cependant, toute Commande réalisée et facturée par le Site avant la suppression du compte sera exécutée dans les conditions normales.</p>
            <p class="mb-2">En cas de suppression d’un compte par la Société pour manquement aux devoirs et obligations énoncés dans les CGV/CGU, il est formellement interdit à l’Utilisateur contrevenant de se réinscrire sur le Site directement, par le biais d’une autre adresse électronique ou par personne interposée sans l’autorisation expresse de la Société.</p>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">5. Commandes</h2>

            <p class="mb-2">Toute Commande peut être réalisée en tant qu'inscrit ou visteur sur le Site. Ils peuvent ajouter des Produits à leur panier virtuel. Ils peuvent ensuite accéder au récapitulatif de leur panier virtuel afin de confirmer les Produits qu’ils souhaitent commander et effectuer leur Commande en appuyant sur le bouton “Valider mon panier et passer à l'étape suivante”. </p>
            <p class="mb-2">Il devra renseigner une adresse, un mode de livraison ainsi qu’un mode de paiement valable afin de finaliser la Commande et de former efficacement le contrat de vente entre lui et la Société. La finalisation de la Commande implique l’acceptation des prix des Produits vendus, ainsi que les modalités et délais de livraison indiqués sur le Site. </p>
            <p class="mb-2">Une fois la Commande passée, l’Utilisateur en recevra confirmation par mail. Cette confirmation fera le récapitulatif de la Commande ainsi que des informations pertinentes relatives à la livraison. La passation d'une Commande constitue la conclusion d'un contrat de vente à distance entre la Société et le Client. </p>
            <p class="mb-2">La Société pourra faire bénéficier le Client de réductions de prix, remises et rabais en fonction du nombre des Produits disponibles sur le Site commandés ou en fonction de la régularité des Commandes, selon les conditions fixées par la Société. </p>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">6. Produits et prix</h2>

            <p class="mb-2">Les Produits faisant l’objet des CGV/CGU sont ceux qui figurent sur le Site et qui sont vendus et expédiés directement par la Société. </p>
            <p class="mb-2">Les Produits sont décrits sur la page correspondante au sein du Site et mention est faite de toutes leurs caractéristiques essentielles. La vente s’opère dans la limite des stocks disponibles de la Société. Cette dernière ne peut être tenue responsable des ruptures de stock ou de l’impossibilité de vendre un Produit dont le stock est inexistant. </p>
            <p class="mb-2">Lorsqu’un Utilisateur enregistré souhaite acquérir un Produit vendu par la Société à travers le Site, le prix indiqué sur la page du Produit correspond au prix en euros, toutes taxes comprise (TTC), hors frais de port et tient compte des réductions applicables et en vigueur le jour de la Commande. Le prix indiqué n’inclut pas les frais de livraison qui seront détaillés le cas échéant dans le récapitulatif avant de passer la Commande. Si le coût total des Produits n'est pas calculable à l'avance, la Société fera parvenir au Client un devis détaillé exposant la formule de calcul du prix. </p>
            <p class="mb-2">En aucun cas un Utilisateur ne pourra exiger l’application de réductions n’étant plus en vigueur le jour de la Commande. </p>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">7. Conditions de paiement</h2>

            <p class="mb-2">Sauf dispositions contraires, toutes les ventes sont payées comptant au moment de la passation de la Commande. </p>
            <p class="mb-2">En fonction de la nature ou du montant de la Commande, la Société reste libre d'exiger un acompte ou le paiement de l'intégralité du prix lors de la passation de la Commande ou lors de la réception de la facture. </p>
            <p class="mb-2">Le paiement peut être réalisé par : </p>
            <ul class="list-disc list-inside mb-2">
                <li>Carte bancaire via une connexion sécurisée</li>
            </ul>
            <p class="mb-2">En cas de défaut de paiement total ou partiel des Produits à la date convenue sur la facture, le Client Professionnel devra verser à la Société une pénalité de retard dont le taux est égal au taux pratiqué par la Banque Centrale Européenne pour son opération de refinancement majoré de 10 points de pourcentage.</p>
            <p class="mb-2">L'opération de financement retenue est la plus récente à la date de la Commande des prestations de Service.</p>
            <p class="mb-2">En sus des indemnités de retard, toute somme, y compris l’acompte, non payée à sa date d’exigibilité par le Client Professionnel produira de plein droit le paiement d’une indemnité forfaitaire de 40 euros due au titre des frais de recouvrement.</p>
            <p class="mb-2">En cas de défaut de paiement total ou partiel des Produits à la date convenue sur la facture, le Client Consommateur devra verser à la Société une pénalité de retard dont le taux est égal au taux d'intérêt légal.</p>
            <p class="mb-2">Aucune compensation ne pourra être effectuée par le Client entre des pénalités de retard dans la fourniture des Produits commandés et des sommes dues par le Client à la Société au titre de l'achat de Produits proposés sur le Site.</p>
            <p class="mb-2">La pénalité due par le Client, Professionnel ou Consommateur, est calculée sur le montant TTC de la somme restante due, et court à compter de la date d'échéance du prix sans qu'aucune mise en demeure préalable ne soit nécessaire.</p>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">8. Livraison</h2>

            <p class="text-9xl">TODO</p>
        </article>





    </section>
</section>

@endsection
