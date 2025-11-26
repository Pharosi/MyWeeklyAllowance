📘 README — MyWeeklyAllowance

🧭 1. Présentation du projet

MyWeeklyAllowance est un module de gestion d’argent de poche.

Il permet à un parent de gérer un porte-monnaie virtuel pour un adolescent :
	•	création du compte,
	•	dépôts,
	•	retraits,
	•	allocation hebdomadaire automatique.

Le projet a été réalisé entièrement en TDD (Test Driven Development), avec un objectif minimal de 85 % de couverture, largement dépassé (100 %).

⸻

🧪 2. Méthodologie TDD

Le développement suit les trois phases du TDD :
	1.	RED — Écriture des tests avant tout code
	2.	GREEN — Implémentation minimale pour faire passer les tests
	3.	REFACTOR — Nettoyage du code avec tests au vert

Les commits du dépôt reflètent clairement ces trois étapes.

⸻

📂 3. Structure du projet

MyWeeklyAllowance/
│
├── src/
│   └── Argent/
│       └── PorteMonnaie.php
│
├── tests/
│   └── Argent/
│       └── PorteMonnaieTest.php
│
├── vendor/
├── coverage/   (généré automatiquement)
├── composer.json
└── phpunit.xml


⸻

🛠 4. Fonctionnalités

La classe PorteMonnaie gère :

🔹 Gestion du solde
	•	solde initial = 0
	•	dépôt (deposer)
	•	retrait (retirer) avec vérifications :
	•	montant > 0
	•	solde suffisant

🔹 Allocation hebdomadaire
	•	définition (definirAllocationHebdo)
	•	application (appliquerAllocationHebdo)
	•	application multiple cumulative

⸻

🧪 5. Tests unitaires

Tous les tests se trouvent dans :

tests/Argent/PorteMonnaieTest.php

Scénarios couverts :
	•	solde initial
	•	dépôt et retrait
	•	retrait impossible si solde insuffisant
	•	montant négatif (dépôt/retrait/allocation)
	•	allocation hebdomadaire (simple et multiple)

⸻

📊 6. Couverture de code

Générée via :

vendor/bin/phpunit --coverage-html coverage

Résultat final :
	•	100 % lignes couvertes
	•	100 % méthodes couvertes
	•	100 % classe couverte

Rapport HTML disponible dans :

coverage/index.html


⸻

📝 7. Rapport détaillé du développement

1. Contexte du projet

Le but était d’implémenter un porte-monnaie virtuel pour adolescents en appliquant strictement la méthode TDD, tout en visant ≥ 85 % de couverture de code. Le projet a également servi d’exercice pour configurer correctement un environnement de tests PHP moderne.

⸻

2. Approche TDD (RED → GREEN → REFACTOR)

2.1. Mise en place

J’ai configuré le projet avec autoload PSR-4, un dossier src/, un dossier tests/, et un fichier phpunit.xml. Cela a permis de travailler avec des namespaces propres (App\Argent / Tests\Argent).

2.2. Phase RED

J’ai commencé en écrivant des tests avant d’écrire la classe :
	•	solde initial,
	•	dépôt,
	•	retrait,
	•	retrait impossible,
	•	allocation hebdomadaire.

Tous les tests échouaient (classe inexistante), ce qui est conforme au TDD.

2.3. Phase GREEN

J’ai ensuite créé la classe PorteMonnaie avec les méthodes minimales pour satisfaire les tests.
Des validations métier ont été ajoutées :
	•	montants strictement positifs,
	•	allocation non négative,
	•	impossibilité de retirer au-delà du solde.

Quand tous les tests sont passés au vert, je suis passé à la phase suivante.

2.4. Phase REFACTOR

J’ai simplifié le code, clarifié certaines exceptions, et nettoyé l’implémentation pour qu’elle reste cohérente tout en gardant tous les tests au vert.

⸻

3. Amélioration de la couverture

Pour dépasser largement 85 %, j’ai ajouté des tests pour :
	•	dépôt négatif,
	•	retrait négatif,
	•	allocation négative,
	•	application multiple de l’allocation.

Ces tests couvrent toutes les branches conditionnelles de la classe.

Résultat : 100 % de couverture.

⸻

4. Couverture de code : difficultés techniques rencontrées

4.1. Aucun driver de couverture disponible

Lors de la génération du rapport, PHPUnit indiquait :

No code coverage driver available

J’utilisais PHP 8.5, incompatible avec Xdebug via PECL à ce moment-là.

4.2. Solution
	•	Installation d’une version parallèle : PHP 8.4
	•	Installation et activation de Xdebug
	•	Configuration du filtre de couverture dans phpunit.xml :

<source>
    <include>
        <directory>src</directory>
    </include>
</source>

Après cela, la couverture a fonctionné correctement.

⸻

5. Compétences acquises

Grâce à ce projet, j’ai renforcé :
	•	ma maîtrise du TDD (vrai cycle RED/GREEN/REFACTOR),
	•	l’écriture de tests robustes incluant les cas limites,
	•	la compréhension profonde de l’autoload PSR-4,
	•	la configuration de PHPUnit et Xdebug,
	•	l’analyse de rapports de couverture,
	•	la gestion multi-versions de PHP via Homebrew.

⸻

👤 8. Auteur

Projet réalisé par Raphael Paes Rodrigues da Silva,
dans le cadre du module Web3 – HETIC.

⸻