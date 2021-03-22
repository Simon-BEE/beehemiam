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

    <section class="w-full flex flex-col space-y-16 md:w-2/3 md:mx-auto">

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

            <ul class="space-y-2 list-disc px-5">
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

            <p class="mb-2">La livraison s’effectue à l’adresse indiquée par le client lors de la commande, le client a la possibilité d’indiquer une adresse de livraison différente de l’adresse de facturation. Si l’intégralité des produits de la commande ne permet pas une livraison à l’adresse ou dans le pays choisi, l’adresse ou le contenu de la commande devront impérativement être modifiés sans quoi la commande ne pourra être enregistrée.</p>
            <p class="mb-2">Les livraisons peuvent s'effectuer en France métropolitaine et hors-France. Les pays actuellement livrable sont : {{ $countries_list }}.</p>
            <p class="mb-2">Le site ne propose la livraison uniquement par Colissimo (service La Poste). C'est ce mode de livraison qui est indiqué par défaut. Nous travaillons pour rajouter plusieurs modes possibles.</p>

            <p class="mb-2 font-bold">Délais de livraison :</p>

            <p class="mb-2">Il faut compter un délai courant de 3 à 4 jours ouvrés à compter de la mise en expédition votre commande. La mise en expédition dure généralement 2 jours ouvrés selon l'afflux des commandes.</p>

            <p class="mb-2 font-bold">Réception de la livraison :</p>

            <p class="mb-2">Lorsque le client prend personnellement livraison des produits il doit, à moins que le transporteur ne lui en laisse pas la possibilité, vérifier l’état du ou des colis en présence du transporteur ou du préposé de la Poste. Il doit émettre, s’il y a lieu, toutes les réserves utiles auprès du transporteur ou du préposé des Postes en les mentionnant sur le bordereau de transport ou de livraison de manière précise et motivée.</p>

            <p class="mb-2">Le client doit également contacter <strong>Beehemiam</strong>, afin de lui permettre d’exercer un recours à l’encontre du transporteur, selon les modalités suivantes :</p>

            <p class="mb-2">Par email : <a href="mailto:contact@beehemiam.fr" class="text-primary-500 hover:underline">contact@beehemiam.fr</a></p>

            <p class="mb-2">Le client devra alors suivre les demandes de <strong>Beehemiam</strong> consistant notamment à lui transmettre par écrit toutes les réserves mentionnées sur le bordereau de transport et/ou tout élément de preuve permettant à <strong>Beehemiam</strong> de faire valoir ses droits auprès du transporteur. Lorsque, le transporteur ne laisse pas au client la possibilité de vérifier le bon état du colis, le client devra le faire dès qu’il en aura la possibilité et, le cas échéant, informer le transporteur et <strong>Beehemiam</strong> des éventuelles défauts constatés selon les modalités qui viennent d’être décrites.</p>

            <p>Vous trouverez plus d'informations au sujet des livraisons et des retours, sur la <a href="{{ route('pages.delivery-returns') }}" class="text-primary-500 hover:underline">page dédiée</a>.</p>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">9. Droit de rétractation du Consommateur</h2>

            <p class="mb-2">Le Consommateur dispose d’un droit de rétractation de 14 jours à compter de la passation de la Commande, sauf pour les produits mentionnés à l'article L.221-28 du Code de la consommation.</p>
            <p class="mb-2">Pour exercer ce droit de rétractation, le Consommateur utilise le formulaire <a href="#form-retractaction" class="text-primary-500 hover:underline">Formulaire de rétractation</a> prévu à cet effet sur le Site.
            <p class="mb-2">Les Produits doivent être retournés dans leur emballage d'origine et en parfait état dans les 14 jours à compter de la notification de la rétractation à la Société par le Consommateur. Les coûts directs de renvoi restent à la charge du Consommateur.</p>
            <p class="mb-2">Il sera remboursé de la totalité des frais versés pour la passation de la Commande dans les 14 jours suivants la prise de connaissance par la Société de sa déclaration de rétractation.</p>
            <p class="mb-2">Le remboursement sera fait par le même moyen de paiement que celui utilisé à l'achat.</p>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">10. Garantie</h2>

            <p class="mb-2">La garantie légale contre les vices cachés est de deux ans, sauf exception.</p>

            <p class="mb-2">Si l’Acheteur constate que le Produit qui lui a été livré présente un défaut, une non-conformité ou est endommagé, il doit en informer le Vendeur aux coordonnées mentionnées à l’article 2 des CGV, en lui indiquant la nature du défaut, de la non-conformité ou du dommage constaté et en lui envoyant tout justificatif utile, notamment sous la forme de photographie(s) (étant précisé que les défauts de conformité qui apparaissent dans un délai de vingt-quatre mois à partir de la délivrance du Produits sont présumés exister au moment de la délivrance, sauf preuve contraire).</p>

            <p class="mb-2">Le Vendeur conviendra, avec le transporteur de son choix, des modalités du retour, dont elle informera l’Acheteur par tout moyen utile. Le Vendeur supportera les frais de ce retour.</p>

            <p class="mb-2">Les Produits doivent impérativement être retournés au Vendeur avec la copie de la facture d’achat correspondante.</p>

            <p class="mb-2">Le Vendeur procédera aux vérifications nécessaires et proposera à l’Acheteur le remplacement du Produit dans la mesure du possible si le défaut, la non-conformité ou l’endommagement est avéré. Si le remplacement du Produit est impossible, le Vendeur remboursera à l’Acheteur l’intégralité du prix payé pour le Produit ainsi que les frais de livraison correspondants, par tout moyen utile, dans les meilleurs délais et au plus tard dans les 14 jours suivant la date à laquelle le Vendeur l’aura informé de l’impossibilité de remplacer le Produit. L’Acheteur peut également décider de garder le Produit et se faire rendre une partie du prix.</p>

            <p class="mb-2">Il est rappelé que la garantie légale de conformité s'applique indépendamment de toute garantie commerciale éventuellement consentie.</p>

            <p class="mb-2">Dans le cadre de la garantie des vices cachés, l’Acheteur a le choix de rendre le Produit et de se faire restituer le prix, ou de garder le Produit et de se faire rendre une partie du prix. </p>


            <div class="rounded p-4 bg-primary-300">
                <p class="mb-2">À toutes fins utiles, les dispositions légales suivantes sont rappelées :</p>

                <ul class="list-disc list-inside space-y-2">
                    <li>Article L217-4 du Code de la consommation : Le vendeur livre un bien conforme au contrat et répond des défauts de conformité existant lors de la délivrance. Il répond également des défauts de conformité résultant de l'emballage, des instructions de montage ou de l'installation lorsque celle-ci a été mise à sa charge par le contrat ou a été réalisée sous sa responsabilité.</li>
                    <li>
                        Article L217-5 du Code de la consommation : Le bien est conforme au contrat :
                        <ul class="list-disc list-inside p-4">
                            <li>1° S'il est propre à l'usage habituellement attendu d'un bien semblable et, le cas échéant :</li>
                            <li>- s'il correspond à la description donnée par le vendeur et possède les qualités que celui-ci a présentées à l'acheteur sous forme d'échantillon ou de modèle ;</li>
                            <li>- s'il présente les qualités qu'un acheteur peut légitimement attendre eu égard aux déclarations publiques faites par le vendeur, par le producteur ou par son représentant, notamment dans la publicité ou l'étiquetage ;</li>
                            <li>2° Ou s'il présente les caractéristiques définies d'un commun accord par les parties ou est propre à tout usage spécial recherché par l'acheteur, porté à la connaissance du vendeur et que ce dernier a accepté.</li>
                        </ul>
                    </li>
                    <li>Article L217-12 du Code de la consommation : L'action résultant du défaut de conformité se prescrit par deux ans à compter de la délivrance du bien.</li>
                    <li>Article L217-16 du Code de la consommation : Lorsque l'acheteur demande au vendeur, pendant le cours de la garantie commerciale qui lui a été consentie lors de l'acquisition ou de la réparation d'un bien meuble, une remise en état couverte par la garantie, toute période d'immobilisation d'au moins sept jours vient s'ajouter à la durée de la garantie qui restait à courir. Cette période court à compter de la demande d'intervention de l'acheteur ou de la mise à disposition pour réparation du bien en cause, si cette mise à disposition est postérieure à la demande d'intervention.</li>
                    <li>Article 1641 du Code civil : Le vendeur est tenu de la garantie à raison des défauts cachés de la chose vendue qui la rendent impropre à l'usage auquel on la destine, ou qui diminuent tellement cet usage que l'acheteur ne l'aurait pas acquise, ou n'en aurait donné qu'un moindre prix, s'il les avait connus.</li>
                    <li>Article 1648 du Code civil : L'action résultant des vices rédhibitoires doit être intentée par l'acquéreur dans un délai de deux ans à compter de la découverte du vice. Dans le cas prévu par l'article 1642-1, l'action doit être introduite, à peine de forclusion, dans l'année qui suit la date à laquelle le vendeur peut être déchargé des vices ou des défauts de conformité apparents.</li>
                </ul>
            </div>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">11. Transfert des risques et de propriété </h2>

            <p class="mb-2">La Société conserve un droit de propriété sur les Produits vendus jusqu'au complet paiement du prix par le Client. Elle peut donc reprendre possession desdits Produits en cas de non-paiement. Dans ce cas, les acomptes versés resteront acquis à la Société au titre d'indemnisation.</p>
            <p class="mb-2">Pour les Clients Professionnels, le transfert des risques au Client s’opère dès la remise des marchandises au transporteur par la Société. Pour les Clients Consommateurs, le transfert des risques s'opère à la livraison ou lors du retrait des marchandises au magasin lorsque le Client a choisi une livraison en magasin.</p>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">12. Obligations de l'Acheteur</h2>

            <p class="mb-2">La passation de Commande est accessible :</p>

            <ul class="list-disc list-inside mb-2">
                <li>À toute personne physique disposant de la pleine capacité juridique pour s’engager au titre des CGV. En conséquence, si une personne ne disposant pas de la capacité juridique commandait des Produits sur le Site, ses responsables légaux (parents, tuteurs, notamment) assumeraient l'entière responsabilité de cette Commande.</li>
                <li>À toute personne morale agissant par l’intermédiaire d’une personne physique disposant de la capacité juridique pour contracter au nom et pour le compte de la personne morale.</li>
            </ul>

            <p class="mb-2">L’Acheteur reconnaît se conformer aux dispositions du présent article.</p>
            <p class="mb-2">S’agissant en particulier de la carte cadeau proposée sur le Site, celle-ci est exclusivement réservée aux personnes physiques ci-avant mentionnées.</p>

            <p class="mb-2">L’Acheteur est seul responsable de l’usage qu’il fait des Produits. Il lui appartient de :</p>

            <ul class="list-disc list-inside mb-2">
                <li>Vérifier l’adéquation des Produits à ses besoins spécifiques préalablement à la Commande desdits Produits.</li>
                <li>Utiliser les Produits conformément aux indications données sur l’étiquette du Produit et aux instructions communiquées par le Vendeur.</li>
            </ul>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">13. Droit applicable</h2>

            <p class="mb-2">Les présentes conditions générales sont soumises au droit français.</p>

            <p class="mb-2">Conformément aux articles L.211-3, L.612-1, L.616-1 et R.616-1 du Code de la consommation, le client peut recourir, en cas de contestation, à une procédure de médiation.</p>

            <p class="mb-2">« Conformément aux dispositions du Code de la consommation concernant le règlement amiable des litiges, <strong>Beehemiam</strong> adhère au Centre de la médiation de la consommation des conciliateurs de justice (CM2C) dont les coordonnées sont les suivantes : 14 rue Saint Jean, Paris 75017.</p>

            <p class="mb-2">La Commission européenne met également à la disposition des consommateurs une plateforme européenne de règlement des litiges accessible à l’adresse URL suivante : http://ec.europa.eu/consumers/odr/.</p>
        </article>

        <article>
            <h2 class="text-3xl font-bold mb-2 uppercase">14. Acceptation des Conditions Générales de Vente</h2>

            <p class="mb-2">En cliquant sur le bouton « payer » lors du passage de commande, le client reconnaît avoir lu et accepté les conditions générales de ventes et y adhère de façon irrévocable et sans réserve. A compter de ce moment, la commande est considérée comme validée sous réserve de l’encaissement du prix total qui doit être réglé à la commande comme il est dit ci-avant. A défaut de paiement, la commande est considérée comme nulle et non avenue.</p>
        </article>

        <article id="form-retractaction">
            <h2 class="text-3xl font-bold mb-2 uppercase">15. Formulaire de rétractation</h2>

            <p class="mb-4">Afin de faire valoir vos droits de rétractation, veuillez remplir le formulaire ci dessous et nous l'envoyer par email à l'adresse suivante <a href="mailto:contact@beehemiam.fr" class="text-primary-500 hover:underline">contact@beehemiam.fr</a>, ou depuis le <a href="{{ route('contact.index') }}" class="text-primary-500 hover:underline">formulaire de contact</a> disponible sur le site.</p>

            <div class="p-4 rounded bg-primary-300">
                <p>A l'attention de : Beehemiam</p>
                <p>Adresse postale : Beehemiam</p>
                <p class="mb-2">3 route de la bergerette, 03420 Terjat, France</p>

                <p class="mb-2">Adresse électronique : contact@beehemiam.fr</p>

                <div class="rounded p-4 bg-primary-100">
                    <p>Je vous notifie par la présente ma rétractation du contrat portant sur la vente du bien ci-dessous :</p>
                    <p>Numéro de commande : <span class="italic text-xs text-gray-500">--VOTRE NUMÉRO DE COMMANDE--</span></p>
                    <p>Commandé le <span class="italic text-xs text-gray-500">--DATE DE CREATION DE LA COMMANDE--</span> / reçu le <span class="italic text-xs text-gray-500">--DATE DE RÉCEPTION DE LA COMMANDE--</span> remboursé le <span class="italic text-xs text-gray-500">--DATE DE REMBROUSEMENT DE LA COMMANDE--</span></p>
                    <p>Nom de l’acheteur : <span class="italic text-xs text-gray-500">--VOTRE NOM--</span></p>
                    <p>Adresse de l’acheteur : <span class="italic text-xs text-gray-500">--VOTRE ADRESSE--</span></p>
                    <p>Signature de l’acheteur (en cas de notification du présent formulaire sur papier) :</p>

                    <p>Date : <span class="italic text-xs text-gray-500">--DATE DU JOUR OÙ VOUS AVEZ REMPLI LE FORMULAIRE--</span></p>
                </div>
            </div>

        </article>

        <article>
            <p class="mb-2">&mdash; Dernière modification des Conditions Générales de Vente effectuée le 22 Mars 2021.</p>
        </article>

    </section>
</section>

@endsection
