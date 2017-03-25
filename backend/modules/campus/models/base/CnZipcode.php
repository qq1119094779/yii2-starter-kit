<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\modules\campus\models\base;

use Yii;

/**
 * This is the base-model class for table "cn_zipcode".
 *
 * @property integer $zip_id
 * @property integer $region_id
 * @property string $zip_number
 * @property string $code
 * @property string $aliasModel
 */
abstract class CnZipcode extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cn_zipcode';
    }

    public static function getDb()
    {
        return Yii::$app->get('campus');
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'zip_number', 'code'], 'required'],
            [['region_id'], 'integer'],
            [['zip_number', 'code'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'zip_id' => Yii::t('common', 'Zip ID'),
            'region_id' => Yii::t('common', 'Region ID'),
            'zip_number' => Yii::t('common', 'Zip Number'),
            'code' => Yii::t('common', 'Code'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \backend\modules\campus\models\query\CnZipcode the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\campus\models\query\CnZipcode(get_called_class());
    }


}