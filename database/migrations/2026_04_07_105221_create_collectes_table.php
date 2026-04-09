<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collectes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('agent_id');
            $table->string('agent_nom');
            $table->string('nom_enquete');
            $table->string('fonction')->nullable();
            $table->string('contact');
            $table->string('zone_etude');
            $table->string('type_acteur');
            $table->string('gps');
            $table->dateTime('date_collecte');
            $table->text('chair_principale')->nullable();
            $table->text('chairs_animales')->nullable();
            $table->string('frequence')->nullable();
            $table->string('quantite')->nullable();
            $table->string('connait_fermes')->nullable();
            $table->text('quelles_fermes')->nullable();
            $table->string('souhaite_producteur')->nullable();
            $table->text('especes_preferees')->nullable();
            $table->text('criteres_achat')->nullable();
            $table->text('poids_clarias')->nullable();
            $table->text('poids_tilapia')->nullable();
            $table->text('forme_achat')->nullable();
            $table->text('prix_clarias')->nullable();
            $table->text('prix_tilapia')->nullable();
            $table->text('nb_tilapia_kg')->nullable();
            $table->text('nb_clarias_kg')->nullable();
            $table->string('frequence_appro')->nullable();
            $table->text('lieu_achat')->nullable();
            $table->text('mode_commande')->nullable();
            $table->text('mode_info')->nullable();
            $table->string('contrat_interesse')->nullable();
            $table->string('contrat_quantite')->nullable();
            $table->text('exigences')->nullable();
            $table->text('recommandations')->nullable();
            $table->string('photo_url')->nullable();
            $table->boolean('consentement')->default(false);
            $table->boolean('synchro')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collectes');
    }
};