<?php

use App\Models\Customer;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Mary\Traits\Toast;

new
#[Layout('components.layouts.simple')]
#[Title('Registro')]
class extends Component {
  use Toast;

  public string|null $first_name = null;
  public string|null $last_name = null;
  public string|null $username = null;
  public string|null $email = null;
  public string|null $phone_number = null;
  public string|null $password = null;
  public string|null $password_confirmation = null;

  public function rules(): array {
    return [
      'first_name' => 'required|string|max:75',
      'last_name' => 'required|string|max:75',
      'username' => 'required|string|max:30|unique:users',
      'email' => 'required|email:rfc,dns|unique:users',
      'phone_number' => 'nullable|string|numeric|max_digits:10',
      'password' => [
        'required',
        'string',
        'confirmed',
        PasswordRule::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(3),
      ],
      'password_confirmation' => 'required|same:password',
    ];
  }

  public function signUpAsCustomer() {
    $this->validate();

    $customer = Customer::create($this->only(['first_name', 'last_name', 'phone_number']));
    $customer->user()->create($this->only(['username', 'email', 'password']));

    return $this->success('Registro realizado correctamente.', icon: 'tabler.circle-check', redirectTo: route('login'));
  }
}; ?>

<div class="w-full max-w-sm md:max-w-md lg:max-w-2xl 2xl:max-w-4xl">
  <x-card title="Registrarse" subtitle="Completa los campos para crear una cuenta." shadow class="px-6 py-12">
    <x-form wire:submit="signUpAsCustomer()">
      @if($errors->has('form'))
        <x-errors icon="tabler.circle-x"/>
      @endif

      <div class="flex flex-col lg:grid grid-cols-2 gap-3">
        <x-input label="Nombre(s)" placeholder="Nombre(s)" icon="tabler.letter-case-upper" autofocus wire:model="first_name"/>
        <x-input label="Apellido(s)" placeholder="Apellido(s)" icon="tabler.letter-case" wire:model="last_name"/>
        <x-input label="Nombre de usuario" placeholder="Nombre de usuario" icon="tabler.at" wire:model="username"/>
        <x-input label="Número de teléfono" placeholder="Número de teléfono" icon="tabler.phone" maxlength="10" wire:model="phone_number"/>
        <div class="col-span-2">
          <x-input label="Correo electrónico" placeholder="Correo electrónico" icon="tabler.mail" wire:model="email"/>
        </div>
        <x-password label="Contraseña" placeholder="Contraseña" wire:model="password" password-icon="tabler.eye" password-visible-icon="tabler.eye-off"/>
        <x-password label="Confirmar contraseña" placeholder="Confirmar contraseña" wire:model="password_confirmation" password-icon="tabler.eye" password-visible-icon="tabler.eye-off"/>
      </div>

      <x-slot:actions>
        <div class="flex flex-col gap-2 w-full">
          <x-button label="Registrarse" type="submit" icon="tabler.user-up" spinner="signUpAsCustomer" class="btn-primary btn-block"/>
          <x-button label="¿Ya tienes cuenta? Inicia sesión ahora" :link="route('login')" class="text-primary dark:text-primary-content btn-link btn-block"/>
        </div>
      </x-slot:actions>
    </x-form>

    <x-slot:menu>
      <x-theme-toggle class="btn btn-circle btn-ghost"/>
    </x-slot:menu>
  </x-card>
</div>
