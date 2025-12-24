<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update role enum to remove 'pengurus'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'panitia', 'dkm', 'jemaah') NOT NULL DEFAULT 'jemaah'");
        
        // Update any existing pengurus users to dkm role
        DB::table('users')->where('role', 'pengurus')->update(['role' => 'dkm']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore pengurus in enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'pengurus', 'panitia', 'dkm', 'jemaah') NOT NULL DEFAULT 'jemaah'");
    }
};
