

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Books extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
            'author_id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => FALSE
			),
            'gender_id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => FALSE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
            'publication_year' => array(
				'type' => 'INT',
				'constraint' => 4,
                'unsigned' => FALSE
			),
			'description' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			),
            
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('books');
	}

	public function down()
	{
		$this->dbforge->drop_table('books');
	}
}