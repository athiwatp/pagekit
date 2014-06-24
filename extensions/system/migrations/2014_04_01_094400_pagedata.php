<?php

namespace Pagekit\System\Migration;

class PageData extends Migration
{
    public function up()
    {
        $util = $this->getUtility();
        $schema = $util->createSchema();

        if ($util->tableExists('@page_page') !== false) {

            $table = $schema->getTable($this->getConnection()->replacePrefix('@page_page'));
            if (!$table->hasColumn('data')) {
                $table->addColumn('data', 'json_array', array('notnull' => false));
            }

            if ($queries = $schema->getMigrateFromSql($util->createSchema(), $util->getDatabasePlatform())) {
                foreach ($queries as $query) {
                    $this->getConnection()->executeQuery($query);
                }
            }
        }
    }

    public function down()
    {
    }
}
