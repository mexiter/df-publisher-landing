<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('marketplace_leads', function (Blueprint $table) {
            $table->string('ip_address', 45)->nullable()->after('message');
            $table->text('user_agent')->nullable()->after('ip_address');
            $table->string('device')->nullable()->after('user_agent');
            $table->string('operating_system')->nullable()->after('device');
            $table->string('country_code', 2)->nullable()->after('operating_system');
            $table->string('country')->nullable()->after('country_code');
            $table->string('city')->nullable()->after('country');
            $table->string('region', 120)->nullable()->after('city');
            $table->decimal('latitude', 10, 7)->nullable()->after('region');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
        });
    }

    public function down(): void
    {
        Schema::table('marketplace_leads', function (Blueprint $table) {
            $table->dropColumn([
                'ip_address',
                'user_agent',
                'device',
                'operating_system',
                'country_code',
                'country',
                'city',
                'region',
                'latitude',
                'longitude',
            ]);
        });
    }
};
