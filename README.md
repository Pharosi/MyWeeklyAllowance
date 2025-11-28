📘 MyWeeklyAllowance — README

🧭 1. Présentation du projet

MyWeeklyAllowance est un module simple de gestion d’argent de poche permettant à un parent de suivre les opérations financières du porte-monnaie virtuel d’un adolescent :
	•	création du compte,
	•	dépôts,
	•	retraits,
	•	allocation hebdomadaire automatique.

Le projet a été entièrement développé en TDD (Test Driven Development) et atteint une couverture de code de 100 %, dépassant largement l’objectif minimal de 85 %.

⸻

🧪 2. Méthodologie TDD

Le projet suit rigoureusement le cycle TDD :
	1.	RED — écrire le test avant toute implémentation
	2.	GREEN — coder le minimum pour faire réussir le test
	3.	REFACTOR — nettoyer et améliorer le code en gardant les tests au vert

L’historique Git reflète ces trois étapes fondamentales.

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
├── coverage/         # Généré automatiquement
├── composer.json
└── phpunit.xml

	•	src/ : logique métier
	•	tests/ : ensemble des tests unitaires
	•	coverage/ : rapport HTML de couverture (Xdebug + PHPUnit)

⸻

🛠 4. Fonctionnalités de PorteMonnaie

🔹 Gestion du solde
	•	solde initial = 0
	•	deposer() : ajout d’argent
	•	retirer() : retrait avec contrôles :
	•	montant positif
	•	solde suffisant

🔹 Allocation hebdomadaire
	•	definirAllocationHebdo()
	•	appliquerAllocationHebdo()
	•	allocations cumulatives si appliquées plusieurs fois

🔹 Sécurité des opérations

Cas gérés par exceptions :
	•	montants négatifs (dépôt / retrait / allocation)
	•	tentative de retrait supérieur au solde

⸻

🧪 5. Tests unitaires (30 tests)

Tous les tests se trouvent dans :

tests/Argent/PorteMonnaieTest.php

Les scénarios vérifient :

✔ Cas simples
	•	solde initial
	•	dépôts simples
	•	retraits simples

✔ Cas d’erreur
	•	dépôt négatif
	•	retrait négatif
	•	allocation négative
	•	retrait supérieur au solde

✔ Allocations
	•	allocation simple
	•	allocation multiple
	•	allocation redéfinie
	•	allocation appliquée avant/après un dépôt
	•	allocation nulle

✔ Séquences complexes
	•	5 à 10 opérations successives
	•	mélanges dépôt/retrait/allocation
	•	séquences longues avec cumul

Total : 30 tests unitaires — tous au vert.

⸻

📊 6. Couverture de code

Commandes :

vendor/bin/phpunit --coverage-html coverage

Résultat :
	•	100 % lignes couvertes
	•	100 % méthodes couvertes
	•	100 % classe couverte

Rapport consultable dans :

coverage/index.html

⸻

📝 7. Rapport de développement (résumé)

1. Contexte

Objectif : développer un porte-monnaie virtuel en appliquant strictement le TDD, avec ≥ 85 % de couverture.

2. Cycle TDD appliqué
	•	écriture des tests avant la classe
	•	implémentation progressive jusqu’à succès complet
	•	refactorisation finale
	•	maintien permanent des tests au vert

3. Couverture & cas limites

Ajout de tests dédiés pour couvrir :
	•	exceptions,
	•	validations,
	•	branches conditionnelles,
	•	séquences complexes.

4. Difficultés techniques
	•	PHP 8.5 n’était pas compatible avec Xdebug
	•	installation de PHP 8.4 avec Homebrew
	•	installation et activation de Xdebug
	•	configuration du filtre coverage dans phpunit.xml

5. Compétences acquises
	•	TDD complet (RED/GREEN/REFACTOR)
	•	écriture de tests avancés
	•	autoload PSR-4
	•	configuration PHPUnit + Xdebug
	•	gestion multi-versions du PHP
	•	analyse d’un rapport de couverture

⸻

👤 8. Auteur

Projet réalisé par Raphael PAES RODRIGUES DA SILVA,
dans le cadre du Bachelor Développeur Web — 3ᵉ année (Web3) — HETIC.

⸻