<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @see http://www.codeigniter.com/userguide2/libraries/migration.html
 */
class Migration_Add_terms extends CI_Migration {

    public function up() {
        // terms
        $this->dbforge->add_field(array(
            'term_id' => array(
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true
            ),
            'name' => array(
                'type' => 'varchar',
                'constraint' => 200
            ),
            'slug' => array(
                'type' => 'varchar',
                'constraint' => 200
            )
        ));
        $this->dbforge->add_key('term_id', true);
        $this->dbforge->create_table('terms');
    }

    public function down() {
        $this->dbforge->drop_table('terms');
    }
}
