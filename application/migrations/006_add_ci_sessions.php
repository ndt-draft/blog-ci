<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @see http://www.codeigniter.com/userguide2/libraries/migration.html
 */
class Migration_Add_ci_sessions extends CI_Migration {

    public function up() {
        // ci_sessions
        $this->dbforge->add_field(array(
            'session_id' => array(
                'type' => 'varchar',
                'constraint' => '40',
                'default' => '0'
            ),
            'ip_address' => array(
                'type' => 'varchar',
                'constraint' => '16',
                'default' => '0'
            ),
            'user_agent' => array(
                'type' => 'varchar',
                'constraint' => '120',
                'default' => null
            ),
            'last_activity' => array(
                'type' => 'int',
                'constraint' => '10',
                'unsigned' => true,
                'default' => '0'
            ),
            'user_data' => array(
                'type' => 'text',
            )
        ));
        $this->dbforge->add_key('session_id', true);
        $this->dbforge->add_key('last_activity');
        $this->dbforge->create_table('ci_sessions');
    }

    public function down() {
        $this->dbforge->drop_table('ci_sessions');
    }
}
