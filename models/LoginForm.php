<?php

declare(strict_types=1);

namespace app\models;

use app\models\UserAccounts as User;
use Yii;
use yii\base\Model;
use yii\base\Security;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 */
class LoginForm extends Model
{
    public ?string $username = null;
    public ?string $password = null;
    
    private User|null $_user = null;
    private bool $_userLoaded = false;

    public function __construct(private readonly Security $security, $config = [])
    {
        parent::__construct($config);
    }

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            
            [['username', 'password'], 'required', 'message' => '{attribute} nie może być puste.'],
            
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Polskie nazwy etykiet
     */
    public function attributeLabels(): array
    {
        return [
            'username' => 'Nazwa użytkownika',
            'password' => 'Hasło',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword(string $attribute, array|null $params): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                
                $this->addError($attribute, 'Nieprawidłowa nazwa użytkownika lub hasło.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser(): User|null
    {
        if (!$this->_userLoaded) {
            $this->_user = User::findByUsername($this->username);
            $this->_userLoaded = true;
        }

        return $this->_user;
    }
}