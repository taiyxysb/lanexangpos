<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
            $table->string('subdomain')->unique()->nullable()->after('name');
            $table->foreignId('plan_id')->nullable()->constrained('plans')->after('subdomain');
            $table->enum('status', ['trialing','active','past_due','suspended'])
                  ->default('trialing')->after('plan_id');
            $table->timestamp('trial_ends_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn(['name','subdomain','plan_id','status','trial_ends_at']);
        });
    }
};