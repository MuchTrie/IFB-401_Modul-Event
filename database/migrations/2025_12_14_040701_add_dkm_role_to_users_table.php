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
        // Update role enum to include 'dkm'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'pengurus', 'panitia', 'dkm', 'jemaah') DEFAULT 'jemaah'");
        
        // Update existing 'pengurus' users who should be 'dkm'
        // Assuming user 'dkm' should have role 'dkm'
        DB::table('users')
            ->where('username', 'dkm')
            ->update(['role' => 'dkm']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert dkm users back to pengurus
        DB::table('users')
            ->where('role', 'dkm')
            ->update(['role' => 'pengurus']);
            
        // Revert role enum back to original
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'pengurus', 'panitia', 'jemaah') DEFAULT 'jemaah'");
    }
};
