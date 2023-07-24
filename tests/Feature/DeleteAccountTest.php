<?php

use App\Models\User;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Livewire\DeleteUserForm;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseMissing;

test('user accounts can be deleted', function () {
    $this->actingAs($user = User::factory()->create());

    $component = Livewire::test(DeleteUserForm::class)
        ->set('password', 'password')
        ->call('deleteUser');

    $user->fresh();

    assertDatabaseMissing('users', [
        'id' => $user->id,
        'deleted_at' => null
    ]);
})->skip(function () {
    return ! Features::hasAccountDeletionFeatures();
}, 'Account deletion is not enabled.');

test('correct password must be provided before account can be deleted', function () {
    $this->actingAs($user = User::factory()->create());

    Livewire::test(DeleteUserForm::class)
        ->set('password', 'wrong-password')
        ->call('deleteUser')
        ->assertHasErrors(['password']);

    expect($user->fresh())->not->toBeNull();
})->skip(function () {
    return ! Features::hasAccountDeletionFeatures();
}, 'Account deletion is not enabled.');
