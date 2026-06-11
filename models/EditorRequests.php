<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "editor_requests".
 *
 * @property int $id
 * @property int $user_id
 * @property string $request_date
 * @property string|null $status
 * @property string|null $admin_comment
 *
 * @property UserAccounts $user
 */
class EditorRequests extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'editor_requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['admin_comment'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'pending'],
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['request_date'], 'safe'],
            [['status'], 'string'],
            [['admin_comment'], 'string', 'max' => 255],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
            [['user_id', 'status'], 'unique', 'targetAttribute' => ['user_id', 'status']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccounts::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    /**
     * Słownik tłumaczeń statusów
     */
    public static function getStatusLabels()
    {
        return [
            'pending' => 'Oczekujące',
            'approved' => 'Zatwierdzone',
            'rejected' => 'Odrzucone',
        ];
    }

    /**
     * Zwraca przetłumaczony status dla konkretnego rekordu
     */
    public function getStatusLabel()
    {
        $labels = self::getStatusLabels();
        return $labels[$this->status] ?? $this->status;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Użytkownik',
            'status' => 'Status',
            'request_date' => 'Data zgłoszenia',
            'admin_comment' => 'Komentarz administratora',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserAccounts::class, ['id' => 'user_id']);
    }


    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_PENDING => 'pending',
            self::STATUS_APPROVED => 'approved',
            self::STATUS_REJECTED => 'rejected',
        ];
    }

    /**
     * @return string
     */
    public function displayStatus()
    {
        return self::optsStatus()[$this->status];
    }

    /**
     * @return bool
     */
    public function isStatusPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function setStatusToPending()
    {
        $this->status = self::STATUS_PENDING;
    }

    /**
     * @return bool
     */
    public function isStatusApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function setStatusToApproved()
    {
        $this->status = self::STATUS_APPROVED;
    }

    /**
     * @return bool
     */
    public function isStatusRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function setStatusToRejected()
    {
        $this->status = self::STATUS_REJECTED;
    }
    
}
