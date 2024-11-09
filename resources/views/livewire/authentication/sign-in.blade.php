<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.simple')]
#[Title('Inicio de sesión')]
class extends Component {
  public string|null $username = null;
  public string|null $password = null;
  public bool $remember_me = false;

  public function rules(): array {
    return [
      'username' => 'required|string',
      'password' => 'required|string',
      'remember_me' => 'nullable|bool',
    ];
  }

  public function signInWithCredentials() {
    $this->validate();

    if (Auth::attempt($this->except('remember_me'), $this->remember_me)) {
      Session::regenerate();
      Session::put('toast_message', ['type' => 'success', 'message' => 'Sesión iniciada correctamente.']);

      return Redirect::intended();
    }

    return $this->addError('form', __('auth.failed'));
  }
}; ?>

<div class="w-full max-w-sm md:max-w-md">
  <x-card title="Iniciar sesión" subtitle="Ingresa tus credenciales para acceder a tu cuenta." shadow class="px-6 py-12">
    <x-form wire:submit="signInWithCredentials()">
      @if($errors->has('form'))
        <x-errors icon="tabler.circle-x"/>
      @endif

      <x-input label="Nombre de usuario" placeholder="Nombre de usuario" icon="tabler.at" autofocus wire:model="username"/>
      <x-password label="Contraseña" placeholder="Contraseña" wire:model="password" password-icon="tabler.eye" password-visible-icon="tabler.eye-off"/>
      <x-checkbox label="Recordarme en este navegador" wire:model="remember_me"/>

      <x-slot:actions>
        <div class="flex flex-col gap-2 w-full">
          <x-button label="Iniciar sesión" type="submit" icon="tabler.door" spinner="signInWithCredentials" class="btn-primary btn-block"/>
          <x-button label="¿Aún sin una cuenta? Regístrate ahora" :link="route('auth.sign-up')" class="text-primary dark:text-primary-content btn-link btn-block"/>
        </div>
      </x-slot:actions>
    </x-form>

    <x-slot:menu>
      <x-theme-toggle class="btn btn-circle btn-ghost"/>
    </x-slot:menu>
  </x-card>
</div>
