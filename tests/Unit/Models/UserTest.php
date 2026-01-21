<?php

namespace Tests\Unit\Models;

use App\Actions\UpdateUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class UserTest extends TestCase {
    use RefreshDatabase;

    /**
     * @param string $firstname Value of `firstname` on model.
     * @param string $middlename Value of `middlename` on model.
     * @param string $lastname Value of `lastname` on model.
     * @param string $expected Expected value returned from fullname().
     */
    #[DataProvider('providerTestFullnameAccessor')]
    public function testFullnameAccessor(string $firstname, string $middlename, string $lastname, string $expected): void {
        $user = User::factory()->create();
        $updated = (new UpdateUser())->execute($user, [
            'firstname' => $firstname,
            'middlename' => $middlename,
            'lastname' => $lastname,
        ]);

        $this->assertEquals($expected, $updated->fullname());
    }

    public static function providerTestFullnameAccessor(): array {
        return [
            ['Test', 'User', 'A', 'Test User A'],
            ['Test User', '', 'B', 'Test User B'],
            ['', 'Test User', 'C', 'Test User C'],
        ];
    }

    /**
     * @param string $firstname Value of `firstname` on model.
     * @param string $middlename Value of `middlename` on model.
     * @param string $lastname Value of `lastname` on model.
     * @param string $expected Expected value returned from middleinitial().
     */
    #[DataProvider('providerTestMiddleinitialAccessor')]
    public function testMiddleinitialAccessor(string $firstname, string $middlename, string $lastname, string $expected): void {
        $user = User::factory()->create();
        $updated = (new UpdateUser())->execute($user, [
            'firstname' => $firstname,
            'middlename' => $middlename,
            'lastname' => $lastname,
        ]);

        $this->assertEquals($expected, $updated->middleinitial());
    }

    public static function providerTestMiddleinitialAccessor(): array {
        return [
            ['Test', 'User', 'A', 'U'],
            ['Test', '', 'User B', ''],
            ['', 'Test User', 'C', 'T'],
        ];
    }

    /**
     * @param string $photo Value of `photo` on model.
     * @param string|null $expected Expected value returned from avatar().
     */
    #[DataProvider('providerTestAvatarAccessor')]
    public function testAvatarAccessor(string $photo, ?string $expected = null): void {
        $user = User::factory()->create();
        $updated = (new UpdateUser())->execute($user, [
            'photo' => $photo,
        ]);

        $this->assertEquals($expected ? url($expected) : $expected, $updated->avatar());
    }

    public static function providerTestAvatarAccessor(): array {
        return [
            ['testuser.png', '/storage/avatars/testuser.png'],
            ['', null],     //  An empty string will return null from the accessor.
        ];
    }
}
