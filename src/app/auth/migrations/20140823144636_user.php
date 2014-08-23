<?php

use Phinx\Migration\AbstractMigration;

class User extends AbstractMigration
{
    /**
     * Change Method.
     */
    public function change()
    {
        if( !$this->hasTable( 'Users' ) )
        {
            $table = $this->table( 'Users', [ 'id' => 'uid' ] );
            $table->addColumn( 'uid', 'integer' )
                  ->addColumn( 'user_email', 'string' )
                  ->addColumn( 'user_password', 'string', [ 'length' => 128 ] )
                  ->addColumn( 'first_name', 'string' )
                  ->addColumn( 'last_name', 'string' )
                  ->addColumn( 'ip', 'string', [ 'length' => 16 ] )
                  ->addColumn( 'enabled', 'boolean', [ 'default' => true ] )
                  ->addColumn( 'created_at', 'timestamp' )
                  ->addColumn( 'updated_at', 'timestamp', [ 'null' => true, 'default' => null ] )
                  ->addIndex( 'user_email', [ 'unique' => true ] );
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