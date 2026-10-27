<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('admin')->after('email');
            });
        }

        // Set all existing users to 'admin'
        DB::table('users')->whereNull('role')->orWhere('role', '')->update(['role' => 'admin']);

        // Seed / ensure superadmin user exists with requested credentials
        DB::table('users')->updateOrInsert(
            ['email' => 'superadmin@borneotandayu.com'],
            [
                'name'       => 'Super Administrator',
                'role'       => 'superadmin',
                'password'   => Hash::make('123123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }

        DB::table('users')->where('email', 'superadmin@borneotandayu.com')->delete();
    }
};
