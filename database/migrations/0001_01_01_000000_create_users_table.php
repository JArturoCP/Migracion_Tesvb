<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb3');
            $table->collation('utf8mb3_unicode_ci');

            $table->integer('id', true, true);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->boolean('activated')->default(0);
            $table->integer('tipo_usuario');
            $table->boolean('info_ok')->default(0);
            $table->string('remember_token', 100)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->text('name')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id']);
            $table->index(['email'], 'idx_ar_users_email');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->string('email', 255);
            $table->string('token', 255);
            $table->timestamp('created_at')->nullable();

            $table->primary(['email']);
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->string('id', 255);
            $table->bigInteger('user_id', false, true)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity');

            $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
