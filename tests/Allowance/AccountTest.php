<?php

declare(strict_types=1);

namespace Tests\Allowance;

use PHPUnit\Framework\TestCase;
use App\Allowance\Account;

class AccountTest extends TestCase
{
    public function testNewAccountStartsWithZero()
    {
        $account = new Account("Alice");

        $this->assertSame(0, $account->getBalance());
    }

    public function testDepositAddsMoney()
    {
        $account = new Account("Alice");

        $account->deposit(50);

        $this->assertSame(50, $account->getBalance());
    }

    public function testWithdrawalSubtractsMoney()
    {
        $account = new Account("Alice");
        $account->deposit(100);

        $account->withdraw(40);

        $this->assertSame(60, $account->getBalance());
    }

    public function testCantWithdrawMoreThanBalance()
    {
        $account = new Account("Alice");

        $this->expectException(\InvalidArgumentException::class);

        $account->withdraw(10);
    }

    public function testWeeklyAllowanceIsApplied()
    {
        $account = new Account("Alice");
        $account->setWeeklyAllowance(15);

        $account->applyWeeklyAllowance();

        $this->assertSame(15, $account->getBalance());
    }
}