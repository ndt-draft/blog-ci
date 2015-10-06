<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @see http://www.codeigniter.com/userguide2/libraries/migration.html
 */
class Migration_Add_menus extends CI_Migration {

    public function up() {
        // menus
        $this->dbforge->add_field(array(
            'menu_id' => array(
                'type' => 'bigint',
                'constraint' => '20',
                'unsigned' => true,
                'auto_increment' => true
            ),
            'menu_title' => array(
                'type' => 'text'
            ),
            'menu_url' => array(
                'type' => 'varchar',
                'constraint' => '255'
            ),
            'menu_weight' => array(
                'type' => 'int',
                'constraint' => 11
            ),
            'menu_parent' => array(
                'type' => 'longtext'
            )
        ));
        $this->dbforge->add_key('menu_id', true);
        $this->dbforge->create_table('menus');
    }

    public function down() {
        $this->dbforge->drop_table('menus');
    }
}
