<?php

use App\Enums\UserStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public const TABLE_NAME = 'client_users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name', 128);
            $table->string('phone_number', 13);
            $table->enum('status', UserStatus::values())->default(UserStatus::PENDING->value);
            $table->timestamps();

            $table->index('client_id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
