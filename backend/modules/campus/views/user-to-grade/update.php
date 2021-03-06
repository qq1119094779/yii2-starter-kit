<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var backend\modules\campus\models\UserToGrade $model
*/
    
$this->title = Yii::t('backend', '学员管理') . " " . $model->user_to_grade_id . ', ' . Yii::t('backend', '更新');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', '学员管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->user_to_grade_id, 'url' => ['view', 'user_to_grade_id' => $model->user_to_grade_id]];
$this->params['breadcrumbs'][] = Yii::t('backend', '更新');
?>
<div class="giiant-crud user-to-grade-update">

    <h1>
        <?= Yii::t('backend', '学员管理') ?>
        <small>
                        <?= $model->user_to_grade_id ?>
        </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-file"></span> ' . Yii::t('backend', '查看'), ['view', 'user_to_grade_id' => $model->user_to_grade_id], ['class' => 'btn btn-default']) ?>
    </div>

    <hr />

    <?php echo $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
