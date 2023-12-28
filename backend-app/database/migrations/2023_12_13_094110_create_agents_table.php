<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('post_agent_matricule',50)->nullable();
            $table->string('agent_matricule',50);
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('cin',50)->nullable();
            $table->string('sexe',10)->nullable();
            $table->string('status',50)->nullable();
            $table->string('code_corps',50)->nullable();// foreignID
            $table->string('code_grade',50)->nullable();// foreignID
            $table->string('code_hee',50)->nullable();// foreignID
            $table->string('code_section',50)->nullable();// foreignID
            $table->string('code_fiv',50)->nullable();// foreignID
            $table->string('code_sanction',50)->nullable();// foreignID
            $table->string('code_uadm',50)->nullable();// foreignID
            $table->date('debut_contrat')->nullable();
            $table->date('avance_date')->nullable();
            $table->string('code_ministere',50)->nullable();// foreignID

            // foreignID dans table agents
            $table->foreign('code_corps')->references('corps_code')->on('corps');
            $table->foreign('code_grade')->references('grade_code')->on('grades');
            $table->foreign('code_hee')->references('hee_code')->on('hees');
            $table->foreign('code_section')->references('section_code')->on('sections');
            $table->foreign('code_fiv')->references('districte_code')->on('districtes');
            $table->foreign('code_sanction')->references('sanction_code')->on('sanctions');
            $table->foreign('code_uadm')->references('uadm_code')->on('uadms');
            $table->foreign('code_ministere')->references('ministere_code')->on('ministeres');

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
        Schema::dropIfExists('agents');
    }
}
