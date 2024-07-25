<?php

use app\constants\DbTable;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%projects}}`.
 */
class m240724_091438_create_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(DbTable::PROJECTS, [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->unique(),
            'description' => $this->text(),
            'created_by' => $this->integer()->notNull(), // foreign key field
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
        ]);

        // Add foreign key constraint
        $this->addForeignKey(
            'fk-projects-created_by', // Foreign key name
            DbTable::PROJECTS,          // Table name
            'created_by',             // Column name
            DbTable::USERS,             // Referenced table
            'id',                     // Referenced column
            'CASCADE',                // On delete
            'CASCADE'                 // On update
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign key constraint
        $this->dropForeignKey(
            'fk-projects-created_by',
            DbTable::PROJECTS
        );

        $this->dropTable(DbTable::PROJECTS);
    }
}
