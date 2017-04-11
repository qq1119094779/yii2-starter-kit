<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\modules\campus\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\PhoneValidator;

/**
 * This is the base-model class for table "apply_to_play".
 *
 * @property integer $apply_to_play_id
 * @property string $username
 * @property integer $phone_number
 * @property string $email
 * @property string $city
 * @property string $province
 * @property integer $auditor_id
 * @property string $region
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $aliasModel
 */
abstract class ApplyToPlay extends \yii\db\ActiveRecord
{

     public $verifyCode;


     CONST  APPLY_TO_PLAY_STATUS_AUDIT = 1;//待审核
     CONST  APPLY_TO_PLAY_STATUS_SUCCEED = 2;//审核成功

     public static function OptsStatus(){
        return [
            self::APPLY_TO_PLAY_STATUS_AUDIT   =>'待审核',
            self::APPLY_TO_PLAY_STATUS_SUCCEED =>'审核成功'
            ];
     }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'apply_to_play';
    }

    public static function getDb(){
        //return \Yii::$app->modules['campus']->get('campus');
        return Yii::$app->get('campus');
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'phone_number', 'age'], 'required'],
            ['verifyCode','captcha','on'=>'AjaxApply'],
            [['verifyCode'],'required','on'=>'AjaxApply'],
            // ['phone_number', 'string', 'min' => 11, 'max' => 11],
            [['phone_number'], PhoneValidator::className()],
            ['status','default','value'=>ApplyToPlay::APPLY_TO_PLAY_STATUS_AUDIT],
            [['auditor_id', 'status', 'age', 'province_id', 'school_id'], 'integer'],
            [['username'], 'string', 'max' => 255],
        ];
    }
    public  function scenarios(){
        $scenarios = parent::scenarios();
        //$scenarios['AjaxApply'] = ['verifyCode'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'apply_to_play_id' => Yii::t('backend', 'Apply To Play ID'),
            'username'         => Yii::t('backend', '姓名'),
            'age'              => Yii::t('backend', '报名人年龄'),
            'phone_number'     => Yii::t('backend', '电话'),
            'province_id'      => Yii::t('backend', '地区'),
            'school_id'        => Yii::t('backend', '校区'),
            'auditor_id'       => Yii::t('backend', '审核人'),
            'status'           => Yii::t('backend', '状态'),
            'verifyCode'       => Yii::t('backend','验证码'),
            'created_at'       => Yii::t('backend', '创建时间'),
            'updated_at'       => Yii::t('backend', '更新时间'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'username'     => Yii::t('backend', '报名人姓名'),
            'age'          => Yii::t('backend', '报名人年龄'),
            'phone_number' => Yii::t('backend', '报名人电话'),
            'province_id'  => Yii::t('backend', '地区'),
            'school_id'    => Yii::t('backend', '校区'),
            'auditor_id'   => Yii::t('backend', '审核人'),
            'status'       => Yii::t('backend', '报名成功：1，报名审核： 2，已过期：3'),
        ]);
    }
    
    /**
     * @inheritdoc
     * @return \backend\modules\campus\models\query\ApplyToPlayQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\campus\models\query\ApplyToPlayQuery(get_called_class());
    }


}
