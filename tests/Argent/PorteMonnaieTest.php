<?php

declare(strict_types=1);

namespace Tests\Argent;

use PHPUnit\Framework\TestCase;
use App\Argent\PorteMonnaie;

class PorteMonnaieTest extends TestCase
{
    
    // 1. Un nouveau porte-monnaie commence toujours avec un solde à 0.
     
    public function testNouveauPorteMonnaieCommenceAvecSoldeZero(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $this->assertSame(0, $porteMonnaie->obtenirSolde());
    }

    
    // 2. Un dépôt simple augmente le solde.

    public function testDepotAugmenteLeSolde(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $porteMonnaie->deposer(50);

        $this->assertSame(50, $porteMonnaie->obtenirSolde());
    }

    
    // 3. Un retrait simple diminue le solde.

    public function testRetraitDiminueLeSolde(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');
        $porteMonnaie->deposer(100);

        $porteMonnaie->retirer(40);

        $this->assertSame(60, $porteMonnaie->obtenirSolde());
    }


    // 4. Un retrait supérieur au solde déclenche une exception.

    public function testRetraitSuperieurAuSoldeDeclencheException(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $this->expectException(\InvalidArgumentException::class);

        $porteMonnaie->retirer(10);
    }


    // 5. L’allocation hebdomadaire est correctement appliquée au solde.

    public function testAllocationHebdomadaireEstAppliqueeAuSolde(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');
        $porteMonnaie->definirAllocationHebdo(15);

        $porteMonnaie->appliquerAllocationHebdo();

        $this->assertSame(15, $porteMonnaie->obtenirSolde());
    }


    // 6. Un dépôt avec un montant négatif déclenche une exception.

    public function testDepotMontantNegatifDeclencheException(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $this->expectException(\InvalidArgumentException::class);

        $porteMonnaie->deposer(-20);
    }


    // 7. Une allocation hebdomadaire négative déclenche une exception.

    public function testAllocationHebdomadaireNegativeDeclencheException(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $this->expectException(\InvalidArgumentException::class);

        $porteMonnaie->definirAllocationHebdo(-5);
    }


    // 8. L’application multiple de l’allocation cumule bien le solde.

    public function testApplicationMultipleDeAllocationHebdoCumuleLeSolde(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');
        $porteMonnaie->definirAllocationHebdo(10);

        $porteMonnaie->appliquerAllocationHebdo();
        $porteMonnaie->appliquerAllocationHebdo();
        $porteMonnaie->appliquerAllocationHebdo();

        $this->assertSame(30, $porteMonnaie->obtenirSolde());
    }


    // 9. Plusieurs dépôts successifs sont correctement cumulés.

    public function testPlusieursDepotsSuccessifsCumulentLeSolde(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $porteMonnaie->deposer(10);
        $porteMonnaie->deposer(5);
        $porteMonnaie->deposer(15);

        $this->assertSame(30, $porteMonnaie->obtenirSolde());
    }


    // 10. Plusieurs retraits successifs cumulent bien les déductions.

    public function testPlusieursRetraitsSuccessifsCumulentLesDeductions(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');
        $porteMonnaie->deposer(100);

        $porteMonnaie->retirer(10);
        $porteMonnaie->retirer(20);

        $this->assertSame(70, $porteMonnaie->obtenirSolde());
    }


    // 11. Retirer exactement tout le solde remet le solde à 0.

    public function testRetraitDeToutLeSoldeMetSoldeAZero(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');
        $porteMonnaie->deposer(50);

        $porteMonnaie->retirer(50);

        $this->assertSame(0, $porteMonnaie->obtenirSolde());
    }


    // 12. L’allocation appliquée deux fois après un dépôt se cumule correctement.

    public function testAllocationHebdomadaireAppliqueeDeuxFoisApresDepot(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');
        $porteMonnaie->deposer(20);
        $porteMonnaie->definirAllocationHebdo(10);

        $porteMonnaie->appliquerAllocationHebdo();
        $porteMonnaie->appliquerAllocationHebdo();

        $this->assertSame(40, $porteMonnaie->obtenirSolde());
    }


    // 13. Un dépôt, puis un retrait, puis une allocation donnent le bon solde.

    public function testDepotPuisRetraitPuisAllocationDonneSoldeCorrect(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');
        $porteMonnaie->deposer(50);
        $porteMonnaie->retirer(20);
        $porteMonnaie->definirAllocationHebdo(5);

        $porteMonnaie->appliquerAllocationHebdo();

        $this->assertSame(35, $porteMonnaie->obtenirSolde());
    }


    // 14. Une allocation appliquée avant un dépôt se cumule aussi correctement.

    public function testAllocationPuisDepotSeCumuleCorrectement(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');
        $porteMonnaie->definirAllocationHebdo(10);

        $porteMonnaie->appliquerAllocationHebdo();
        $porteMonnaie->deposer(5);

        $this->assertSame(15, $porteMonnaie->obtenirSolde());
    }


    // 15. Appliquer l’allocation sans définition préalable ne change pas le solde (allocation par défaut supposée à 0).

    public function testAppliquerAllocationSansDefinitionPrealableNeChangePasLeSolde(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $porteMonnaie->appliquerAllocationHebdo();

        $this->assertSame(0, $porteMonnaie->obtenirSolde());
    }


    // 16. Une séquence plus complexe d’opérations donne le solde attendu.

    public function testSequenceComplexeOperationsDonneSoldeAttendu(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

                                                    // Solde : 0
        $porteMonnaie->deposer(100);                // 100
        $porteMonnaie->retirer(30);                 // 70
        $porteMonnaie->definirAllocationHebdo(10);
        $porteMonnaie->appliquerAllocationHebdo();  // 80
        $porteMonnaie->appliquerAllocationHebdo();  // 90
        $porteMonnaie->retirer(20);                 // 70

        $this->assertSame(70, $porteMonnaie->obtenirSolde());
    }


    // 17. Un retrait après plusieurs allocations ne dépasse pas le solde.

    public function testRetraitApresPlusieursAllocationsNeDepassePasLeSolde(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $porteMonnaie->deposer(50);                 // 50
        $porteMonnaie->definirAllocationHebdo(10);
        $porteMonnaie->appliquerAllocationHebdo();  // 60
        $porteMonnaie->appliquerAllocationHebdo();  // 70
        $porteMonnaie->appliquerAllocationHebdo();  // 80

        $porteMonnaie->retirer(80);

        $this->assertSame(0, $porteMonnaie->obtenirSolde());
    }


    // 18. Redéfinir l’allocation remplace bien l’ancienne valeur.

    public function testRedefinirAllocationHebdomadaireRemplaceAncienneValeur(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $porteMonnaie->definirAllocationHebdo(5);
        $porteMonnaie->definirAllocationHebdo(12);

        $porteMonnaie->appliquerAllocationHebdo();

        $this->assertSame(12, $porteMonnaie->obtenirSolde());
    }


    // 19. Une allocation de 0 ne modifie pas le solde.

    public function testAllocationHebdomadaireZeroNeChangePasLeSolde(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $porteMonnaie->definirAllocationHebdo(0);
        $porteMonnaie->appliquerAllocationHebdo();

        $this->assertSame(0, $porteMonnaie->obtenirSolde());
    }


    // 20. Combinaison longue de dépôts, retraits et allocations.

    public function testCombinaisonDepotsRetraitsEtAllocationsSurLongueSequence(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

                                                    // 0
        $porteMonnaie->deposer(200);                // 200
        $porteMonnaie->retirer(50);                 // 150
        $porteMonnaie->definirAllocationHebdo(20);
        $porteMonnaie->appliquerAllocationHebdo();  // 170
        $porteMonnaie->appliquerAllocationHebdo();  // 190
        $porteMonnaie->appliquerAllocationHebdo();  // 210
        $porteMonnaie->retirer(30);                 // 180

        $this->assertSame(180, $porteMonnaie->obtenirSolde());
    }


    // 21. Un retrait avec un montant négatif déclenche une exception.

    public function testRetraitMontantNegatifDeclencheException(): void
    {
        $porteMonnaie = new PorteMonnaie("Raphael");

        $this->expectException(\InvalidArgumentException::class);

        $porteMonnaie->retirer(-10);
    }


    // 22. Une suite de petits dépôts et retraits garde un solde cohérent.

    public function testPetitsDepotsEtRetraitsMaintiennentSoldeCorrect(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $porteMonnaie->deposer(5);   // 5
        $porteMonnaie->deposer(5);   // 10
        $porteMonnaie->retirer(3);   // 7
        $porteMonnaie->retirer(2);   // 5

        $this->assertSame(5, $porteMonnaie->obtenirSolde());
    }


    // 23. Après dépôts et allocations, un retrait exact remet le solde à 0.

    public function testRetraitExactApresAllocationsRemetSoldeAZero(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $porteMonnaie->deposer(40);                 // 40
        $porteMonnaie->definirAllocationHebdo(10);
        $porteMonnaie->appliquerAllocationHebdo();  // 50
        $porteMonnaie->appliquerAllocationHebdo();  // 60

        $porteMonnaie->retirer(60);                 // 0

        $this->assertSame(0, $porteMonnaie->obtenirSolde());
    }


    // 24. Sans aucune opération, le solde reste à 0 même après plusieurs lectures.

    public function testSoldeResteZeroSansOperation(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $this->assertSame(0, $porteMonnaie->obtenirSolde());
        $this->assertSame(0, $porteMonnaie->obtenirSolde());
    }


    // 25. Deux porte-monnaie différents sont totalement indépendants.

    public function testDeuxPorteMonnaieSontIndependants(): void
    {
        $porteMonnaie1 = new PorteMonnaie('Raphael');
        $porteMonnaie2 = new PorteMonnaie('Beatrice');

        $porteMonnaie1->deposer(50);  // 50
        $porteMonnaie2->deposer(20);  // 20

        $this->assertSame(50, $porteMonnaie1->obtenirSolde());
        $this->assertSame(20, $porteMonnaie2->obtenirSolde());
    }


    // 26. Redéfinir plusieurs fois l’allocation et l’appliquer plusieurs fois cumule correctement.

    public function testRedefinitionMultipleAllocationEtApplicationMultiple(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $porteMonnaie->definirAllocationHebdo(5);
        $porteMonnaie->appliquerAllocationHebdo();   // 5

        $porteMonnaie->definirAllocationHebdo(8);
        $porteMonnaie->appliquerAllocationHebdo();   // 13
        $porteMonnaie->appliquerAllocationHebdo();   // 21

        $this->assertSame(21, $porteMonnaie->obtenirSolde());
    }


    // 27. Après avoir vidé le solde, seule l’allocation remonte le solde.

    public function testAllocationApresVidageDuSolde(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $porteMonnaie->deposer(50);                 // 50
        $porteMonnaie->retirer(50);                 // 0

        $porteMonnaie->definirAllocationHebdo(15);
        $porteMonnaie->appliquerAllocationHebdo();  // 15
        $porteMonnaie->appliquerAllocationHebdo();  // 30
        $porteMonnaie->appliquerAllocationHebdo();  // 45

        $this->assertSame(45, $porteMonnaie->obtenirSolde());
    }


    // 28. Plusieurs allocations successives sans dépôt fonctionnent correctement.

    public function testPlusieursAllocationsSansDepot(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $porteMonnaie->definirAllocationHebdo(7);
        $porteMonnaie->appliquerAllocationHebdo(); // 7
        $porteMonnaie->appliquerAllocationHebdo(); // 14
        $porteMonnaie->appliquerAllocationHebdo(); // 21
        $porteMonnaie->appliquerAllocationHebdo(); // 28
        $porteMonnaie->appliquerAllocationHebdo(); // 35

        $this->assertSame(35, $porteMonnaie->obtenirSolde());
    }


    // 29. Une autre séquence longue mélangeant dépôts, retraits et allocations.

    public function testAutreSequenceComplexeDepotsRetraitsAllocations(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

                                                    // 0
        $porteMonnaie->deposer(100);                // 100
        $porteMonnaie->retirer(10);                 // 90
        $porteMonnaie->retirer(15);                 // 75
        $porteMonnaie->definirAllocationHebdo(20);
        $porteMonnaie->appliquerAllocationHebdo();  // 95
        $porteMonnaie->retirer(30);                 // 65
        $porteMonnaie->appliquerAllocationHebdo();  // 85

        $this->assertSame(85, $porteMonnaie->obtenirSolde());
    }


    // 30. Gestion correcte de montants importants sur dépôts et retraits.

    public function testMontantsImportantsDepotsRetraitsEtAllocation(): void
    {
        $porteMonnaie = new PorteMonnaie('Raphael');

        $porteMonnaie->deposer(1_000_000);              // 1 000 000
        $porteMonnaie->retirer(250_000);                // 750 000
        $porteMonnaie->definirAllocationHebdo(50_000);
        $porteMonnaie->appliquerAllocationHebdo();      // 800 000

        $this->assertSame(800_000, $porteMonnaie->obtenirSolde());
    }
}