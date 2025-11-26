<?php

declare(strict_types=1);

namespace App\Argent;

/**
 * Porte-monnaie virtuel pour un adolescent.
 * Permet de gérer le solde, les dépôts, les retraits
 * et une allocation hebdomadaire.
 */
class PorteMonnaie
{
    private string $nomAdolescent;
    private int $solde = 0;
    private int $allocationHebdo = 0;

    public function __construct(string $nomAdolescent)
    {
        $this->nomAdolescent = $nomAdolescent;
    }

    public function obtenirSolde(): int
    {
        return $this->solde;
    }

    public function deposer(int $montant): void
    {
        if ($montant <= 0) {
            throw new \InvalidArgumentException('Le montant du dépôt doit être strictement positif.');
        }

        $this->solde += $montant;
    }

    public function retirer(int $montant): void
    {
        if ($montant <= 0) {
            throw new \InvalidArgumentException('Le montant du retrait doit être strictement positif.');
        }

        if ($montant > $this->solde) {
            throw new \InvalidArgumentException('Solde insuffisant pour ce retrait.');
        }

        $this->solde -= $montant;
    }

    public function definirAllocationHebdo(int $montant): void
    {
        if ($montant < 0) {
            throw new \InvalidArgumentException('L’allocation hebdomadaire ne peut pas être négative.');
        }

        $this->allocationHebdo = $montant;
    }

    public function appliquerAllocationHebdo(): void
    {
        $this->solde += $this->allocationHebdo;
    }
}