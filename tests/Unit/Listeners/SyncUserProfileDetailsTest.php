<?php

namespace Tests\Unit\Models;

use App\Listeners\SyncUserProfileDetails;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SyncUserProfileDetailsTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('providerTestDeriveGender')]
    public function testDeriveGender(string $prefix, string $expectedGender): void
    {
        $listener = new SyncUserProfileDetails();
        $result = $listener->deriveGender($prefix);

        $this->assertEquals($expectedGender, $result);
    }

    public static function providerTestDeriveGender(): array
    {
        return [
            ['Mr', 'Male'],
            ['Mrs', 'Female'],
            ['Ms', 'Female'],
            ['Miss', 'Female'],
            ['Mx', 'Non-binary'],
            ['Dr', 'Unknown'],
        ];
    }
}
