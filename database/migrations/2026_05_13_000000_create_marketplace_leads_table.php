<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('marketplace_leads', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // waitlist or contact
            $table->string('role')->nullable(); // advertiser, publisher, agency, other
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            $table->text('message')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('internal_notified_at')->nullable();
            $table->timestamp('confirmation_sent_at')->nullable();
            $table->timestamps();

            $table->index(['type', 'role']);
            $table->index('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marketplace_leads');
    }
};
