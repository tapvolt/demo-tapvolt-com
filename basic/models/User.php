<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\helpers\Password;
use app\models\helpers\Mailer;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\web\Application as WebApplication;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $lock_version
 * @property integer $updated_at
 * @property integer $updated_by
 * @property integer $enabled
 * @property string $name
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $last_seen
 * @property string $last_ip
 * @property string $unconfirmed_email
 * @property integer $confirmed_at
 * @property integer $roles
 */
class User extends ActiveRecord implements IdentityInterface
{
    /** @var  string plain password */
    public $password;

    /** @var   */
    protected $mailer;


    public function init()
    {
        $this->mailer = Yii::$container->get(Mailer::className());
        parent::init();
    }

    /*
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                ['created_at', 'created_by', 'enabled', 'name', 'email', 'password_hash', 'auth_key'],
                'required'
            ],
            [
                ['created_at', 'created_by', 'lock_version', 'updated_at', 'updated_by', 'enabled', 'last_seen', 'confirmed_at', 'roles'],
                'integer'
            ],
            [
                ['name', 'email', 'unconfirmed_email'],
                'string',
                'max' => 255
            ],
            [
                ['password_hash'],
                'string',
                'max' => 60
            ],
            [
                ['auth_key'],
                'string',
                'max' => 32
            ],
            [
                ['last_ip'],
                'string',
                'max' => 45
            ],
            [
                ['email'],
                'unique'
            ]
        ];
    }

    /** @inheritdoc */
    public function scenarios()
    {
        return [
            'create'   => ['name', 'email', 'password'],
            'update'   => ['name', 'email', 'password'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'lock_version' => 'Lock Version',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'enabled' => 'Enabled',
            'name' => 'Name',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'last_seen' => 'Last Seen',
            'last_ip' => 'Last Ip',
            'unconfirmed_email' => 'Unconfirmed Email',
            'confirmed_at' => 'Confirmed At',
            'roles' => 'Roles',
        ];
    }

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    /** @inheritdoc */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /** @inheritdoc */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /** @inheritdoc */
    public function getId()
    {
        return $this->getAttribute('id');
    }

    /** @inheritdoc */
    public function getAuthKey()
    {
        return $this->getAttribute('auth_key');
    }

    public function getIsEnabled()
    {
        return $this->getAttribute('enabled') == true;
    }

    public function getIsConfirmed()
    {
//        return $this->getAttribute('auth_key');
        return true;
    }

    /** @inheritdoc */
    public function validateAuthKey($authKey)
    {
        return $this->getAttribute('auth_key') === $authKey;
    }

    /** @inheritdoc */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('Method "' . __CLASS__ . '::' . __METHOD__ . '" is not implemented.');
    }

    /** @inheritdoc */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->setAttribute('auth_key', Yii::$app->security->generateRandomString());
            if (Yii::$app instanceof WebApplication) {
                $this->setAttribute('last_ip', Yii::$app->request->userIP);
            }
        }
        if (empty($this->password)) {
            $this->setAttribute('password_hash', Password::hash(Password::generate()));
        }
        return parent::beforeSave($insert);
    }

    public function validatePassword($password)
    {

    }
}
