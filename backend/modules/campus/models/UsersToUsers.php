<?php

namespace backend\modules\campus\models;

use Yii;
use \backend\modules\campus\models\base\UsersToUsers as BaseUsersToUsers;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "users_to_users".
 */
class UsersToUsers extends BaseUsersToUsers
{

public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
             parent::rules(),
             [
                  # custom validation rules
             ]
        );
    }
}
