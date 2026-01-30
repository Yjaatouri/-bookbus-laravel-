A = DOCUMENTATION D’ANALYSE – Projet de plateforme de réservation :

1 => Booking process (user steps) :  

-Recherche 
L’utilisateur arrive sur la page d’accueil, saisit sa ville de départ,
 destination, date, nombre depassagers, puis clique Rechercher.

-Résultats disponibles
Le système montre une liste d’offres (bus/voyages) avec prix, 
horaires, compagnie, places restantes.

-Sélection de voyage
L’utilisateur clique sur une offre → direction la page de détails du voyage.

-Détails & choix
Sur la page détails : sélection de siège, récap des infos, indication du prix,
 bouton Réserver.

-Authentification (si non connecté)
L’utilisateur doit se connecter ou créer un compte pour continuer.

-Paiement
L’utilisateur remplit les infos de paiement et confirme → paiement sécurisé.

-Confirmation & Ticket
Après paiement, page de confirmation + PDF/e-ticket, email de récap envoyé.

2 => Entités principales identifiées :

I : Users (Utilisateurs)

Représente les personnes qui utilisent la plateforme.

Attributs principaux :

* id

* nom

* prenom

* email

* telephone

* password

* role (admin ou utilisateur)

* created_at, updated_at

Rôle dans le système :
Un utilisateur peut rechercher un voyage, effectuer une réservation et réaliser un paiement.

II : Voyage

Représente un voyage programmé proposé aux clients.

Attributs principaux :

* id

* date_depart

* date_arrive

* trajet_id

* prix

* places_disponibles

* statut

* bus_id

* villeDepart_id

* villeArriver_id

* created_at, updated_at

Rôle dans le système :
Un voyage est lié à :

un trajet

un bus

une ville de départ et une ville d’arrivée
Il peut être réservé par plusieurs utilisateurs.

III : Trajet

Décrit l’itinéraire entre deux villes.

Attributs principaux :

* id

* date_depart

* date_arrive

* ville_depart_id

* ville_arrive_id

* distance_km

* duree_estimee

Rôle dans le système :
Un trajet représente le parcours théorique, tandis que le voyage est une occurrence réelle de ce trajet à une date donnée.

IV :Ville

Représente les villes desservies.

Attributs principaux :

* id

* nom

* code

* region

Rôle dans le système :
Les villes sont utilisées dans :

les trajets (départ/arrivée)

les voyages (références rapides aux villes)

V : Bus

Représente les véhicules utilisés pour les voyages.

Attributs principaux :

* id

* modele

* capacite

* type

* immatriculation

Rôle dans le système :
Un bus est assigné à un ou plusieurs voyages. Sa capacité influence le nombre de places disponibles.

VI : Reservation

Représente l’action d’un utilisateur qui réserve un voyage.

Attributs principaux :

* id

* user_id

* voyage_id

* nombre_places

* prix_total

* statut

* created_at, updated_at

Rôle dans le système :
Une réservation :

appartient à un utilisateur

concerne un voyage

peut être liée à un paiement

VII : Paiement

Représente la transaction financière liée à une réservation.

Attributs principaux :

* id

* user_id

* voyage_id (ou reservation_id selon amélioration future)

* statut

* methode_paiement

Rôle dans le système :
Permet de valider financièrement une réservation (payé, en attente, échoué).

VIII : Arrets_Trajet

Représente les arrêts intermédiaires d’un trajet.

Attributs principaux :

* id

* trajet_id

* villeDepart_id

* date_arrive

Rôle dans le système :
Permet de gérer les voyages avec escales et d’afficher les arrêts entre le départ et l’arrivée finale.

3 => Flux d’administration observé :

L’admin peut :

Ajouter / modifier / supprimer des voyages

Gérer les horaires, compagnies

Visualiser les réservations

Valider ou annuler des voyages

Suivre les paiements

B = Proposition d’architecture :
Un schéma basique des tables avec relations  :

Utilisateur (1) ───< Réservation >─── (1) Voyage

Voyage (1) ───< Paiement >─── (1) Utilisateur

Voyage (1) ───< utilise >─── (1) Bus

Voyage (1) ───< suit >─── (1) Trajet

Trajet (1) ───< relie >─── (1) Ville (Départ)

Trajet (1) ───< relie >─── (1) Ville (Arrivée)

Trajet (1) ───< contient >─── (N) Arrêts_Trajet

Ville (1) ───< est arrêt dans >─── (N) Arrêts_Trajet

4 => Liste des fonctionnalités MVP :

Le MVP (Minimum Viable Product) représente la version minimale fonctionnelle du système permettant aux utilisateurs de rechercher et réserver des voyages, et aux administrateurs de gérer la plateforme.

Fonctionnalités côté Utilisateur

* Rechercher un voyage
Saisir ville de départ, ville d’arrivée et date.

* Voir la liste des voyages disponibles
Affichage des horaires, prix, bus et places restantes.

* Consulter les détails d’un voyage
Informations complètes : trajet, durée, prix, villes, etc.

* Créer un compte / Se connecter
Authentification nécessaire pour réserver.

* Réserver un voyage
Choisir le nombre de places et confirmer la réservation.

* Effectuer un paiement
Paiement en ligne pour valider la réservation.

* Voir mes réservations
Historique des réservations effectuées.

 Fonctionnalités côté Administrateur

* Ajouter un voyage

* Modifier un voyage

* Supprimer un voyage

* Gérer les bus
Ajouter et modifier les bus disponibles.

* Gérer les trajets
Définir les itinéraires entre les villes.

* Gérer les villes
Ajouter les villes desservies.

* Consulter les réservations
Voir les réservations effectuées par les utilisateurs.

* Suivre les paiements
Vérifier le statut des paiements (payé, en attente, échoué).

Ce MVP permet d’avoir une plateforme fonctionnelle de réservation de voyages avec gestion complète côté utilisateur et administration basique côté back-office.


5 => Diagramme de cas d'utilisation :

            [Utilisateur]
                 |
   ---------------------------------
   |        |         |            |
Rechercher  Consulter  Réserver   Payer
un voyage   détails    voyage     réservation


            [Administrateur]
                 |
   ---------------------------------
   |        |            |           |
 Gérer     Gérer      Consulter    Suivre
voyages    trajets    réservations paiements


6 => Diagramme de classes :
Classe Utilisateur

Attributs :

* id : int

* nom : string

* prenom : string

* email : string

* password : string

* telephone : string

* role : string

Méthodes :

* login()

* register()

* logout()

* reserverVoyage()

 Classe Voyage

Attributs :

* id : int

* dateDepart : datetime

* dateArrivee : datetime

* prix : float

* placesDisponibles : int

* statut : string

Méthodes :

* getDetails()

* verifierDisponibilite()

* mettreAJourStatut()

 Classe Reservation

Attributs :

* id : int

* dateReservation : datetime

* nombrePlaces : int

* prixTotal : float

* statut : string

Méthodes :

* confirmer()

* annuler()

* calculerPrixTotal()

 Classe Paiement

Attributs :

* id : int

* montant : float

* datePaiement : datetime

* methode : string

* statut : string

Méthodes :

* effectuerPaiement();

* verifierStatut();

* rembourser();

 Classe Trajet

Attributs :

* id : int

* distanceKm : float

* dureeEstimee : time

Méthodes :

* calculerDuree();

* getVilles();

Justification du choix de Laravel pour ce projet :

Le framework Laravel a été choisi pour le développement de la plateforme de réservation en raison de ses nombreux avantages techniques et pratiques.

1. Rapidité de développement
2. Sécurité intégrée
3. Gestion simplifiée de la base de données
4. Système d’authentification prêt à l’emploi
5. Écosystème riche
6. Maintenabilité et évolutivité
7. Large communauté et documentation

Laravel est un choix adapté pour ce projet car il permet de développer rapidement une application web sécurisée, structurée et évolutive, tout en offrant des outils puissants pour gérer les réservations, les utilisateurs et les paiements.
