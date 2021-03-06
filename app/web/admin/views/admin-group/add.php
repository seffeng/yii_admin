<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zxf\models\entities\AdminGroup;

$this->params['breadcrumb'] = isset($breadcrumb) ? $breadcrumb : [];
?>
<div class="box-primary">
    <div class="box-header"></div>
        <?php $form = ActiveForm::begin([
            'id'    => 'add-form',
            'options' => ['class' => 'form-horizontal box-body'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]); ?>
        <?php
        echo $form->field($model, 'adg_name');
        ?>
        <div class="form-group field-admingroup-adg_status">
            <label class="col-lg-2 control-label" for="admingroup-adg_status">状态</label>
            <div class="col-lg-4">
            <?php echo Html::checkbox('AdminGroup[adg_status]', TRUE, ['id' => 'admingroup-adg_status']); ?></div>
            <div class="col-lg-6"><div class="help-block"></div></div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-4">
                <?php echo Html::button('确&nbsp;&nbsp;定', ['adm' => 'submit', 'class' => 'btn btn-primary', 'data-loading-text' => 'Loading...']); ?>
            </div>
        </div>
        <?php $form->end(); ?>
    <div class="box-footer"></div>
</div>
<script>
$(document).ready(function(){
    /* 初始化 */
    CLS_FORM.init({url: "<?php echo Url::to(['admin-group/index']); ?>", url_add: "<?php echo Url::to(['admin-group/add']); ?>", url_edit: "<?php echo Url::to(['admin-group/edit']); ?>", url_del: "<?php echo Url::to(['admin-group/del']); ?>"});

    /* 状态 */
    $('input[name="AdminGroup[adg_status]"]').bootstrapSwitch({onText: '启用', offText: '停用', onColor: 'success', offColor: 'warning'});

    /**
     * 添加
     * @date   2016-11-8
     */
    $('button[adm="submit"]').on('click', function(){
        var _adg_name = $('#admingroup-adg_name').val();
        var _adg_status   = $('#admingroup-adg_status:checked').val() == '1' ? "<?php echo AdminGroup::STATUS_ON; ?>" : "<?php echo AdminGroup::STATUS_OFF; ?>";
        if (!checkForm()) {
            return false;
        }
        var _data = {'AdminGroup[adg_name]': _adg_name, 'AdminGroup[adg_status]': _adg_status};
        CLS_FORM.submit(CLS_FORM._url_add, _data);
    });

    /* input失去焦点检测 */
    $('#add-form input').on('blur', function(){
        checkForm();
    });
});

/**
 * 输入数据检查
 */
function checkForm() {
    var _adg_name = $('#admingroup-adg_name').val();
    if (_adg_name == '') {
        $('.field-admingroup-adg_name').removeClass('has-success').addClass('has-error').find('.help-block').text('名称 不能为空！');
        return false;
    }
    $('.field-admingroup-adg_name').removeClass('has-error').addClass('has-success').find('.help-block').text('');
    return true;
}
</script>