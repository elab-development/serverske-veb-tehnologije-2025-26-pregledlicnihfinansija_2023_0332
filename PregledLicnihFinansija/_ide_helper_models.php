<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator whereUserId($value)
 */
	class Administrator extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property float $net_worth
 * @property bool $premium_klijent
 * @property string $preferred_currency
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Klijent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Klijent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Klijent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Klijent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Klijent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Klijent whereNetWorth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Klijent wherePreferredCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Klijent wherePremiumKlijent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Klijent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Klijent whereUserId($value)
 */
	class Klijent extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Carbon\CarbonImmutable|null $email_verified_at
 * @property string $password
 * @property string $type
 * @property string|null $remember_token
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\Administrator|null $administrator
 * @property-read \App\Models\Klijent|null $klijent
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

