<?php

use App\Enums\VaccinationStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('nid', 10)->unique();
            $table->string('phone', 11)->unique();
            $table->string('status')->default(VaccinationStatus::NOT_VACCINATED);
            $table->foreignId('center_id')->constrained('centers')->cascadeOnDelete();
            $table->timestamp('notification_sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccinations');
    }
};
