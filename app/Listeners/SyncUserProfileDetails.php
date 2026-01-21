<?php

namespace App\Listeners;

use App\Events\UserSaved;
use App\Models\Detail;

class SyncUserProfileDetails {
    /**
     * Handle the event.
     */
    public function handle(UserSaved $event): void {
        $user = $event->user;

        $keyMap = [
            'Full name' => $user->fullname(),
            'Middle Initial' => $user->middleinitial(),
            'Avatar' => $user->avatar(),
            'Gender' => $this->deriveGender($user->prefixname)
        ];

        foreach ($keyMap as $key => $value) {
            $user->details()->updateOrCreate([
                'key' => $key,
                'user_id' => $user->id,
            ], 
            [
                'value' => $value,
                'type' => Detail::TYPE_PROFILE,
            ]);
        }
    }

    /**
     * Derive the gender of the user based on name prefix, e.g.
     * "Mr" > "Male", "Mrs" > "Female", etc.
     *
     * @param string $prefixname The title prefix of the user.
     * @return string Returns one of "Male", "Female", "Non-binary" or "Unknown".
     */
    public function deriveGender(string $prefixname): string {
        $prefixname = strtolower($prefixname);

        return match ($prefixname) {
            'mr' => 'Male',
            'mrs', 'ms', 'miss' => 'Female',
            'mx' => 'Non-binary',
            default => 'Unknown',
        };
    }
}
