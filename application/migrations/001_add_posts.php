<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @see http://www.codeigniter.com/userguide2/libraries/migration.html
 */
class Migration_Add_posts extends CI_Migration {

    public function up() {
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'content' => array(
                'type' => 'TEXT',
                'null' => true,
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => true
            )
        ));

        $this->dbforge->create_table('posts');
    }

    public function down() {
        $this->dbforge->drop_table('posts');
    }
}
