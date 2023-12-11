<?php

use App\Enum\TargetIdentifiedEnum;
use App\Enum\TargetTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->enum('search_type', [
                TargetTypeEnum::TAG->value,
                TargetTypeEnum::ID->value,
                TargetTypeEnum::CLASSE->value,
                TargetTypeEnum::URL->value,
                TargetTypeEnum::TEXT->value,
            ]);
            $table->enum('identified',[
                TargetIdentifiedEnum::CONTAINS->value,
                TargetIdentifiedEnum::NOT_CONTAINS->value,
                TargetIdentifiedEnum::EQUALS->value,
                TargetIdentifiedEnum::STARTS_WITH->value,
            ]);
            $table->string('search_value');
            $table->foreignId('site_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('targets');
    }
}
