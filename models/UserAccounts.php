<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_accounts".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $role
 * @property string $security_question
 * @property string $security_answer
 * @property string|null $registration_date
 *
 * @property EditorRequests[] $editorRequests
 */
class UserAccounts extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    /**
     * ENUM field values
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_EDITOR = 'editor';
    const ROLE_VIEWER = 'viewer';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_accounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role'], 'default', 'value' => 'viewer'],
            
            [['username', 'password', 'security_question', 'security_answer'], 'required', 'message' => '{attribute} nie może być puste.'],
            [['role'], 'string'],
            [['registration_date'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['password', 'security_question', 'security_answer'], 'string', 'max' => 255],
            ['role', 'in', 'range' => array_keys(self::optsRole())],
            [['username'], 'unique', 'message' => 'Taka nazwa użytkownika jest już zajęta.'],
        ];
    }
    /**
     * Akcje wykonywane automatycznie przed zapisem do bazy
     */
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
           
            if (!empty($this->password) && !str_starts_with($this->password, '$2y$')) {
                $this->password = password_hash($this->password, PASSWORD_DEFAULT);
            }

            if (!empty($this->security_answer) && !str_starts_with($this->security_answer, '$2y$')) {
                $this->security_answer = password_hash($this->security_answer, PASSWORD_DEFAULT);
            }
            
            
            if ($insert) {
                $this->registration_date = date('Y-m-d H:i:s');
            }
            
            return true;
        }
        return false;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Nazwa użytkownika',
            'password' => 'Hasło',
            'role' => 'Rola',
            'security_question' => 'Pytanie pomocnicze',
            'security_answer' => 'Odpowiedź na pytanie',
            'registration_date' => 'Data rejestracji',
        ];
    }

    /**
     * Gets query for [[EditorRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEditorRequests()
    {
        return $this->hasMany(EditorRequests::class, ['user_id' => 'id']);
    }


    public static function optsRole()
    {
        return [
            self::ROLE_ADMIN => 'Administrator',
            self::ROLE_EDITOR => 'Edytor',
            self::ROLE_VIEWER => 'Widz',
        ];
    }

    /**
     * @return string
     */
    public function displayRole()
    {
        return self::optsRole()[$this->role];
    }

    /**
     * @return bool
     */
    public function isRoleAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function setRoleToAdmin()
    {
        $this->role = self::ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isRoleEditor()
    {
        return $this->role === self::ROLE_EDITOR;
    }

    public function setRoleToEditor()
    {
        $this->role = self::ROLE_EDITOR;
    }

    /**
     * @return bool
     */
    public function isRoleViewer()
    {
        return $this->role === self::ROLE_VIEWER;
    }

    public function setRoleToViewer()
    {
        $this->role = self::ROLE_VIEWER;
    }
    

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    // Szukanie użytkownika po loginie
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return password_verify($password, $this->password);
    }
}