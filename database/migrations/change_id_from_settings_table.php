<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', static function (Blueprint $table) {
            $table->renameColumn('id', 'key');
            $table->dropPrimary('key');
        });

        Schema::table('settings', static function (Blueprint $table) {
            $table->string('key')->unique()->change();
            $table->uuid('id')->nullable()->first();
        });

        DB::table('settings')->update([
            'id' => DB::raw('UUID()'),
        ]);

        Schema::table('settings', static function (Blueprint $table) {
            $table->uuid('id')->nullable(false)->primary()->change();
        });
    }

    public function down(): void
    {
        Schema::table('settings', static function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropUnique(['key']);
        });

        Schema::table('settings', static function (Blueprint $table) {
            $table->renameColumn('key', 'id');
        });

        Schema::table('settings', static function (Blueprint $table) {
            $table->string('id')->primary()->change();
        });
    }
};
