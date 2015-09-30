<?php

/**
 * @author Jared King <j@jaredtking.com>
 *
 * @link http://jaredtking.com
 *
 * @copyright 2015 Jared King
 * @license MIT
 */
use Phinx\Migration\AbstractMigration;

class PersistentSession extends AbstractMigration
{
    /**
     * Change Method.
     */
    public function change()
    {
        if (!$this->hasTable('PersistentSessions')) {
            $table = $this->table('PersistentSessions', ['id' => false, 'primary_key' => 'token']);
            $table->addColumn('token', 'string', ['length' => 128])
                  ->addColumn('user_email', 'string')
                  ->addColumn('series', 'string', ['length' => 128])
                  ->addColumn('uid', 'integer')
                  ->addColumn('created_at', 'timestamp', ['default' => 0])
                  ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
                  ->create();
        }
    }

    /**
     * Migrate Up.
     */
    public function up()
    {
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
    }
}
