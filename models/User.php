<?php

namespace app\models;

use app\constants\DbTable;
use app\enums\UserRole;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;


class User extends ActiveRecord implements IdentityInterface
{


    public function getId()
    {
        return $this->id;
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne(['id' => $id]);
    }



    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function tableName(): string
    {
        return DbTable::USERS;
    }


    public static function findByEmail(string $email): self|null
    {
        return self::findOne(['email' => $email]);
    }


    public function validatePassword(string $plainPassword): bool
    {
        return Yii::$app->security->validatePassword($plainPassword, $this->password);
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return 'auth';
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return User::findOne(['access_token' => $token]);
    }





    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }
    public function isUser(): bool
    {
        return $this->role === UserRole::User;
    }
    public function isManager(): bool
    {
        return $this->role === UserRole::MANAGER;
    }
    public function hasRole(...$roles): bool
    {
        foreach ($roles as $role)
            if ($this->role === $role)
                return true;
        return false;
    }

    public function __get($name)
    {
        if ($name === 'username')
            return $this->emai;
        return parent::__get($name);
    }
}
