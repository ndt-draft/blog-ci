<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @see http://www.codeigniter.com/userguide2/libraries/migration.html
 */
class Migration_Add_options extends CI_Migration {

    public function up()
    {
        // options
        $this->dbforge->add_field(array(
            'option_id' => array(
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true
            ),
            'option_name' => array(
                'type' => 'varchar',
                'constraint' => 191,
            ),
            'option_value' => array(
                'type' => 'longtext'
            )
        ));
        $this->dbforge->add_key('option_id', true);
        $this->dbforge->create_table('options');
    }

    public function down()
    {
        $this->dbforge->drop_table('options');
    }

}
