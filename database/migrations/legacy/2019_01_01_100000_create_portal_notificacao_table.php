<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreatePortalNotificacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            '
                SET default_with_oids = true;

                CREATE SEQUENCE portal.notificacao_cod_notificacao_seq
                    START WITH 1
                    INCREMENT BY 1
                    MINVALUE 0
                    NO MAXVALUE
                    CACHE 1;

                CREATE TABLE portal.notificacao (
                    cod_notificacao integer DEFAULT nextval(\'portal.notificacao_cod_notificacao_seq\'::regclass) NOT NULL,
                    ref_cod_funcionario integer NOT NULL,
                    titulo character varying,
                    conteudo text,
                    data_hora_ativa timestamp without time zone,
                    url character varying,
                    visualizacoes smallint DEFAULT 0 NOT NULL
                );
                
                SELECT pg_catalog.setval(\'portal.notificacao_cod_notificacao_seq\', 1, false);
            '
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portal.notificacao');

        DB::unprepared('DROP SEQUENCE portal.notificacao_cod_notificacao_seq;');
    }
}