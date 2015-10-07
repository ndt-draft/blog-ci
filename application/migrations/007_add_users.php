<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @see http://www.codeigniter.com/userguide2/libraries/migration.html
 */
class Migration_Add_users extends CI_Migration {

    public function up() {
        // users
        $this->dbforge->add_field(array(
            'usr_id' => array(
                'type' => 'int',
                'constraint' => '11',
                'auto_increment' => true
            ),
            // account id
            'acc_id' => array(
                'type' => 'int',
                'constraint' => '11'
            ),
            'usr_fname' => array(
                'type' => 'varchar',
                'constraint' => '125'
            ),
            'usr_lname' => array(
                'type' => 'varchar',
                'constraint' => '125'
            ),
            'usr_uname' => array(
                'type' => 'varchar',
                'constraint' => '50'
            ),
            'usr_email' => array(
                'type' => 'varchar',
                'constraint' => '255'
            ),
            'usr_hash' => array(
                'type' => 'varchar',
                'constraint' => '255'
            ),
            'usr_add1' => array(
                'type' => 'varchar',
                'constraint' => '255'
            ),
            'usr_add2' => array(
                'type' => 'varchar',
                'constraint' => '255'
            ),
            'usr_add3' => array(
                'type' => 'varchar',
                'constraint' => '255'
            ),
            'usr_town_city' => array(
                'type' => 'varchar',
                'constraint' => '255'
            ),
            'usr_zip_pcode' => array(
                'type' => 'varchar',
                'constraint' => '10'
            ),
            'usr_access_level' => array(
                'type' => 'int',
                'constraint' => '2' // up to 99
            ),
            'usr_is_active' => array(
                'type' => 'int',
                'constraint' => '1' // 1 active or 0 inactive
            ),
        ));

        $this->dbforge->add_field('usr_created_at timestamp not null default current_timestamp');

        $this->dbforge->add_field(array(
            'usr_pwd_change_code' => array(
                'type' => 'varchar',
                'constraint' => '50'
            )
        ));
        $this->dbforge->add_key('usr_id', true);
        $this->dbforge->create_table('users');
    }

    public function down() {
        $this->dbforge->drop_table('users');
    }
}
