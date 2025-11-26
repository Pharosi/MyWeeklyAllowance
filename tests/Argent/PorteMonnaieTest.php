<?php

declare(strict_types=1);

namespace Tests\Argent;

use PHPUnit\Framework\TestCase;
use App\Argent\PorteMonnaie;

class PorteMonnaieTest extends TestCase
{
    public function testNouveauPorteMonnaieCommenceAvecSoldeZero(): void
    {
        $porteMonnaie = new PorteMonnaie("Raphael");

        $this->assertSame(0, $porteMonnaie->obtenirSolde());
    }

    public function testDepotAugmenteLeSolde(): void
    {
        $porteMonnaie = new PorteMonnaie("Raphael");

        $porteMonnaie->deposer(50);

        $this->assertSame(50, $porteMonnaie->obtenirSolde());
    }

    public function testRetraitDiminueLeSolde(): void
    {
        $porteMonnaie = new PorteMonnaie("Raphael");
        $porteMonnaie->deposer(100);

        $porteMonnaie->retirer(40);

        $this->assertSame(60, $porteMonnaie->obtenirSolde());
    }

    public function testRetraitSuperieurAuSoldeDeclencheException(): void
    {
        $porteMonnaie = new PorteMonnaie("Raphael");

        $this->expectException(\InvalidArgumentException::class);

        $porteMonnaie->retirer(10);
    }

    public function testAllocationHebdomadaireEstAppliqueeAuSolde(): void
    {
        $porteMonnaie = new PorteMonnaie("Raphael");
        $porteMonnaie->definirAllocationHebdo(15);

        $porteMonnaie->appliquerAllocationHebdo();

        $this->assertSame(15, $porteMonnaie->obtenirSolde());
    }

    // 🔽🔽🔽 NOVOS TESTES PARA MELHORAR A COBERTURA 🔽🔽🔽

    public function testDepotMontantNegatifDeclencheException(): void
    {
        $porteMonnaie = new PorteMonnaie("Raphael");

        $this->expectException(\InvalidArgumentException::class);

        $porteMonnaie->deposer(-20);
    }

    public function testAllocationHebdomadaireNegativeDeclencheException(): void
    {
        $porteMonnaie = new PorteMonnaie("Raphael");

        $this->expectException(\InvalidArgumentException::class);

        $porteMonnaie->definirAllocationHebdo(-5);
    }

    public function testApplicationMultipleDeAllocationHebdoCumuleLeSolde(): void
    {
        $porteMonnaie = new PorteMonnaie("Raphael");
        $porteMonnaie->definirAllocationHebdo(10);

        $porteMonnaie->appliquerAllocationHebdo();
        $porteMonnaie->appliquerAllocationHebdo();
        $porteMonnaie->appliquerAllocationHebdo();

        $this->assertSame(30, $porteMonnaie->obtenirSolde());
    }

    public function testRetraitMontantNegatifDeclencheException(): void
    {
        $porteMonnaie = new PorteMonnaie("Raphael");

        $this->expectException(\InvalidArgumentException::class);

        $porteMonnaie->retirer(-10);
    }
}