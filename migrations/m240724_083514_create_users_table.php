<?php

use app\constants\DbTable;
use app\enums\UserRole;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m240724_083514_create_users_table extends Migration
{

    private array $userRoles;


    public function __construct()
    {
        parent::__construct();
        $this->userRoles = UserRole::getArray();
    }


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $rolesString = "'" . implode(separator: "', '", array: $this->userRoles) . "'";

        $this->createTable(DbTable::USERS, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'role' => "ENUM($rolesString) NOT NULL",
            'access_token' => $this->string(255)->null(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(DbTable::USERS);
    }
}
