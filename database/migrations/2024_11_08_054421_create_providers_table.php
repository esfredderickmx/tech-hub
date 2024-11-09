<?php

use App\Enums\ProviderType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('providers', function (Blueprint $table) {
      $table->id();
      $table->string('name', 75);
      $table->string('address', 100)->nullable();
      $table->string('email', 255)->nullable()->unique();
      $table->string('phone_number', 10)->nullable();
      $table->enum('type', ProviderType::valuesToArray())->default(ProviderType::NATURAL);
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('providers');
  }
};
