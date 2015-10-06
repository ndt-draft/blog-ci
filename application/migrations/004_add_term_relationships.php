<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @see http://www.codeigniter.com/userguide2/libraries/migration.html
 */
class Migration_Add_term_relationships extends CI_Migration {

    public function up() {
        // term_relationships
        $this->dbforge->add_field(array(
            'object_id' => array(
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => true
            ),
            'term_id' => array(
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => true
            )
        ));
        $this->dbforge->add_key('object_id', true);
        $this->dbforge->add_key('term_id', true);
        $this->dbforge->create_table('term_relationships');
    }

    public function down() {
        $this->dbforge->drop_table('term_relationships');
    }
}
