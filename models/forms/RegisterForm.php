<?php

namespace app\models\forms;

use app\enums\UserRole;
use Yii;
use yii\base\Model;
use app\models\User;

/**
 *
 * @property-read User|null $user
 *
 */
class RegisterForm extends Model
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $created_at;
    public $updated_at;




    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, password, and role are required
            [['name', 'email', 'password', 'role'], 'required'],

            // email should be a valid email address
            ['email', 'email'],

            // role should be one of the specified values
            ['role', 'in', 'range' => UserRole::getArray()],

            // password should be at least 8 characters long
            ['password', 'string', 'min' => 8],
        ];
    }


    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function register()
    {
        if (!$this->validate())
            return false;
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Yii::$app->security->generatePasswordHash($this->password);
        $user->role = $this->role;
        return $user->save();
    }


}
