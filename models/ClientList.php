<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
/**
 * This is the model class for table "client_list".
 *
 * @property int $id
 * @property string $email
 * @property string|null $first_name
 * @property string|null $last_name
 */
class ClientList extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_list';
    }
    /**
     * Automatyczna obsługa dat i autora wpisu
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    /**
     * Relacja pobierająca dane użytkownika, który dodał klienta
     */
    public function getCreator()
    {
        return $this->hasOne(UserAccounts::class, ['id' => 'created_by']);
    }

    /**
     * Relacja pobierająca dane użytkownika, który edytował klienta
     */
    public function getUpdater()
    {
        return $this->hasOne(UserAccounts::class, ['id' => 'updated_by']);
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'E-mail',
            'first_name' => 'Imię',
            'last_name' => 'Nazwisko',
            'created_at' => 'Data dodania',
            'updated_at' => 'Ostatnia edycja',
            'created_by' => 'Dodał (ID)',
            'updated_by' => 'Edytował (ID)',
        ];
    }
    public function rules()
    {
        return [
            
            [['email', 'first_name', 'last_name'], 'required', 'message' => 'To pole nie może być puste.'],
            
            [['email'], 'email', 'message' => 'Wpisz poprawny adres e-mail (np. jan@kowalski.pl).'],
            [['email'], 'string', 'max' => 100],
            [['first_name', 'last_name'], 'string', 'max' => 255],
            
        ];
    }
 
}
