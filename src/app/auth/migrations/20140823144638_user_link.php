<?php

use Phinx\Migration\AbstractMigration;

class UserLink extends AbstractMigration
{
    /**
     * Change Method.
     */
    public function change()
    {
        if( !$this->hasTable( 'UserLinks' ) )
        {
            $table = $this->table( 'UserLinks', [ 'id' => false, 'primary_key' => [ 'uid', 'link' ] ] );
            $table->addColumn( 'link', 'string', [ 'length' => 32 ] )
                  ->addColumn( 'link_type', 'integer', [ 'length' => 2 ] )
                  ->addColumn( 'created_at', 'timestamp' )
                  ->addColumn( 'updated_at', 'timestamp', [ 'null' => true, 'default' => null ] );
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