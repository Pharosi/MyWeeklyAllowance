# 📘 README – MyWeeklyAllowance

🎯 Présentation du projet

MyWeeklyAllowance est un mini-module PHP permettant de gérer l’argent de poche d’un adolescent.
Le projet applique strictement la méthode TDD (Test Driven Development) : les tests unitaires ont été écrits avant le code, puis le code minimum nécessaire a été développé pour faire passer les tests.

L’objectif principal est d’obtenir un module simple, fiable et entièrement testé, avec une couverture supérieure à 85 % via PHPUnit.

⸻

⚙️ Fonctionnalités

Le module gère un compte d’argent de poche avec les opérations suivantes :
	•	création d’un compte adolescent
	•	dépôt d’argent
	•	enregistrement de dépenses
	•	consultation du solde
	•	définition d’une allocation hebdomadaire
	•	application automatique de l’allocation à la semaine

Chaque méthode est testée individuellement selon la logique TDD.

⸻

🧪 Méthodologie : TDD

Le développement a suivi les trois étapes classiques :

1️⃣ RED

Rédaction des tests unitaires avant toute implémentation.
Les tests échouent volontairement au début.

2️⃣ GREEN

Implémentation du code minimal jusqu’à ce que tous les tests passent.

3️⃣ REFACTOR

Nettoyage du code :
	•	clarification des noms
	•	simplification des méthodes
	•	meilleure organisation des fichiers
	•	conformité à la norme SR4

Ce cycle a été répété plusieurs fois pour stabiliser la logique métier.

⸻

🗂️ Structure du projet

MyWeeklyAllowance/
├── src/
│   └── Allowance/
│       └── Account.php
├── tests/
│   └── Allowance/
│       └── AccountTest.php
├── composer.json
├── phpunit.xml
└── README.md

	•	src/ contient le code métier
	•	tests/ contient les tests unitaires PHPUnit
	•	phpunit.xml configure la suite de tests
	•	composer.json gère l’autoload PSR-4

⸻

🚀 Installation

1. Cloner le projet

git clone https://github.com/<votre-utilisateur>/myWeeklyAllowance.git
cd myWeeklyAllowance

2. Installer les dépendances

composer install

3. Lancer les tests

vendor/bin/phpunit

⸻

📊 Couverture de tests

Pour générer un rapport HTML :

vendor/bin/phpunit --coverage-html coverage

Un dossier coverage/ sera créé avec le rapport de couverture consultable dans un navigateur.

⸻

🧠 Choix techniques
	•	PHP 8+ avec typage strict
	•	PSR-4 pour l’autoload
	•	Tests unitaires avec PHPUnit
	•	Méthodes courtes et explicites
	•	Logique métier centralisée dans la classe Account

Aucun framework externe n’a été utilisé afin d’isoler parfaitement la logique métier et faciliter les tests.

⸻

✍️ Auteurs

Projet réalisé dans le cadre du module Web3 – HETIC
Développeur : Raphael PAES RODRIGUES DA SILVA

⸻
