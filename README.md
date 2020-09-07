# Brief Projet Chef d'oeuvre

L'application consistera à importer les données de l'API Coronavirus COVID19 <https://api.covid19api.com/>
et de proposer une interface web sous la forme d'un tableau de bord pour afficher
les données afin de suivre l'évolution de la pandémie mais aussi l'actualité lié à la pandémie via l'API NewsAPI <https://newsapi.org/> au niveau mondial et/ou en fonction de chaque pays.

## Objectifs

- Wireframe
- Schéma de données
- Interrogation des 2 API à l'aide du lien suivant <https://api.covid19api.com/> et <https://newsapi.org/>
- Affichage des données importées via une interface web responsive

## Compétences Visées

- 1 - Maquetter
- 2 - Web statique
- 3 - Web dynamique
- 4 - Créer une BDD
- 5 - Composants d'accès à la BDD
- 6 - Partie Back-end

## Tâches

- Importer les données de l'API en fonction d'un pays et/ou globalement
- Afficher les données dans un tableau et/ou sur une carte via une interface web responsive
- Filtrage des données en fonction de chaque pays

### Ètapes du projet

1. Analyse de l'API à l'aide du lien suivant <https://documenter.getpostman.com/view/10808728/SzS8rjbc?version=latest#intro>
2. Réaliser le(s) script(s) permettant d'interroger l'API
3. Proposer une interface web responsive pour afficher les données importées

### Bonus

- Tests unitaires (PHPUnit)

### Ètapes pour utiliser ce projet en local

- git clone <https://gitlab.com/rachid_ettabaai/masterpiece-project.git/>
- cd masterpiece-project/
- mysql --user="username" -p < "files/schema.sql" when you are in masterpiece-project folder
- (avec les identifants de connexion pour la BDD comme root par ex pour le username et le mdp défini)
- composer install
- npm install
- npm run dashboard_watch
- php -S localhost:8080 -t public/
