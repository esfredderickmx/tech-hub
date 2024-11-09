<?php

use App\Enums\EmployeePosition;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('employees', function (Blueprint $table) {
      $table->id();
      $table->string('first_name', 75);
      $table->string('last_name', 75);
      $table->string('phone_number', 10)->nullable();
      $table->enum('position', EmployeePosition::valuesToArray())->default(EmployeePosition::SALESMAN->value);
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('employees');
  }
};
