<?php
/**
 * /Users/bruceniu/Documents/GitHub/yii2-starter-kit/backend/runtime/giiant/4b7e79a8340461fe629a6ac612644d03
 *
 * @package default
 */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;
use backend\modules\campus\models\CoursewareToFile;
/**
 *
 * @var yii\web\View $this
 * @var backend\modules\campus\models\CoursewareToFile $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="courseware-to-file-form">

    <?php $form = ActiveForm::begin([
		'id' => 'CoursewareToFile',
		'layout' => 'horizontal',
		'enableClientValidation' => true,
		'errorSummaryCssClass' => 'error-summary alert alert-error'
	]
);
?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>


<!-- attribute file_storage_item_id -->
			<?php echo $form->field($model, 'file_storage_item_id')->textInput() ?>

<!-- attribute courseware_id -->
			<?php echo $form->field($model, 'courseware_id')->textInput() ?>

<!-- attribute status -->
			<?php echo $form->field($model, 'status')->dropDownList(backend\modules\campus\models\CoursewareToFile::optsStatus()) ?>

<!-- attribute sort -->
			<?php echo $form->field($model, 'sort')->textInput() ?>
        </p>
        <?php $this->endBlock(); ?>

        <?php echo
Tabs::widget(
	[
		'encodeLabels' => false,
		'items' => [
			[
				'label'   => Yii::t('backend', 'CoursewareToFile'),
				'content' => $this->blocks['main'],
				'active'  => true,
			],
		]
	]
);
?>
        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <?php echo Html::submitButton(
	'<span class="glyphicon glyphicon-check"></span> ' .
	($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Save')),
	[
		'id' => 'save-' . $model->formName(),
		'class' => 'btn btn-success'
	]
);
?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
