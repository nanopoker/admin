<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Advice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advice-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?= $form->field($model, 'type')->dropDownList(['-1'=>'网页','0'=>'话题'], ['prompt'=>'-请选择-']) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>
    
    <?php if (!empty($model->img)) {?>
    <div class="form-group">
        <label class="col-lg-1 control-label">效果</label>
        <div class="col-lg-4"><img src="<?php echo $model->img?>" /></div>
    </div>
    <?php }?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'targetid')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
