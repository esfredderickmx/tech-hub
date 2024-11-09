<?php

use App\Models\Provider;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Provider::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
      $table->string('name', 100);
      $table->text('description');
      $table->decimal('price', 10);
      $table->integer('stock')->default(0);
      $table->string('image');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('products');
  }
};
