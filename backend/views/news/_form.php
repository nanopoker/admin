<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->registerJsFile(yii\helpers\Url::base().'/js/jquery.ui.widget.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile(yii\helpers\Url::base().'/js/jquery.iframe-transport.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile(yii\helpers\Url::base().'/js/jquery.fileupload.js', ['depends' => [yii\web\JqueryAsset::className()]]);
/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'content')->textarea(['maxlength' => true]) ?>
    
    <div class="form-group field-news-image">
        <label class="control-label" for="news-image">图片</label>
        
            <div id="pm_container_box">
                <?php $i = 0; foreach ($newsImage as $n_i) : ?>
                    <?php if (!empty($n_i->image)) :?>

                        <div class="pm_item_box pm_exist_img">
                            <div class="pm_image">
                                <div class="pm_toolbar"><a class="pm_btn_del" href="javascript:void(0)" image_id="<?php echo $n_i->id; ?>">删除</a></div>
                                <img src="<?php echo $n_i->image; ?>" />
                                <input type="hidden" class="form-control input-sm pm_input_id" name="NewsImage[<?php echo $i; ?>][id]" value="<?php echo $n_i->id; ?>" />
                                <input type="hidden" class="form-control input-sm pm_input_image" name="NewsImage[<?php echo $i; ?>][image]" value="<?php echo $n_i->image; ?>" />
                                <input type="hidden" class="form-control input-sm pm_input_image_thumb" name="NewsImage[<?php echo $i; ?>][image_thumb]" value="<?php echo $n_i->image_thumb; ?>" />
                            </div>
                        </div>
                        <?php $i+=1; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <div class="pm_item_box pm_upload_box"><div class="pm_image pm_upload_btn"><input type="file" name="file[]" id="pm_upload_input1" multiple></div></div>
                <div style="clear: both"></div>
            </div>

        <div class="help-block"></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">


    <?php $this->beginBlock('JS_NEWLINE') ?>

    function uuid(len, radix) {
        var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.split('');
        var uuid = [], i;
        radix = radix || chars.length;

        if (len) {
          // Compact form
          for (i = 0; i < len; i++) uuid[i] = chars[0 | Math.random()*radix];
        } else {
          // rfc4122, version 4 form
          var r;

          // rfc4122 requires these characters
          uuid[8] = uuid[13] = uuid[18] = uuid[23] = '-';
          uuid[14] = '4';

          // Fill in random data.  At i==19 set the high bits of clock sequence as
          // per rfc4122, sec. 4.1.5
          for (i = 0; i < 36; i++) {
            if (!uuid[i]) {
              r = 0 | Math.random()*16;
              uuid[i] = chars[(i == 19) ? (r & 0x3) | 0x8 : r];
            }
          }
        }

        return uuid.join('');
    }

    //删除之后刷新index
    function refreshImageItemIndex() {
        var count = $(".pm_exist_img").length;

        for (var i = 0; i < count; i++) {
            var item = $(".pm_exist_img").eq(i);

            var inputId = item.find(".pm_input_id");
            if (inputId != undefined) {
                inputId.attr("name", "NewsImage[" + i.toString() + "][id]");
            }

            var inputImage = item.find(".pm_input_image");
            if (inputImage != undefined) {
                inputImage.attr("name", "NewsImage[" + i.toString() + "][image]");
            }

            var inputImageThumb = item.find(".pm_input_image_thumb");
            if (inputImageThumb != undefined) {
            	inputImageThumb.attr("name", "NewsImage[" + i.toString() + "][image_thumb]");
            }
        }
    }

    $(".pm_btn_del").click(function() {
        var image_id = $(this).attr("image_id");
        var tar = $(this);
        if (image_id != undefined) {
            var delUrl = "<?php echo Url::toRoute(['news/delete-image']); ?>";
            $.post(delUrl, {id:image_id}, function (data, textStatus){

                if (data.code == 0) {
                    tar.closest(".pm_item_box").detach();
                    refreshImageItemIndex();
                }
            }, 'json');
        }
        else {
            $(this).closest(".pm_item_box").detach();
            refreshImageItemIndex();
        }
    });

    function createNewPmBox(index) {
        /*
         <div class="pm_exist_img pm_image">
         <img style="display: none" src="">
         <input type="hidden" class="form-control input-sm" name="StoreProductImage[][image]" />
         </div>
         */

        var nHtml = "<div class=\"pm_item_box pm_exist_img\"><div class=\"pm_image\">";
        nHtml += "<div class=\"pm_toolbar\"><a class=\"pm_btn_del\" href=\"javascript:void(0)\">删除</a></div>"
        nHtml += "<img style=\"display: none\" src=\"\">";
        nHtml += "<input class=\"pm_input_image\" type=\"hidden\" class=\"form-control input-sm\" name=\"NewsImage[" +   index.toString()  +"][image]\" />";
        nHtml += "<input class=\"pm_input_image_thumb\" type=\"hidden\" class=\"form-control input-sm\" name=\"NewsImage[" +   index.toString()  +"][image_thumb]\" />";
        nHtml += "</div>";
        nHtml +=  "</div>"
        return $(nHtml);
    }


    $('#pm_upload_input1').fileupload({
        url:"<?php echo Url::toRoute(['upload/images']); ?>",
        dataType: 'json',
        //autoUpload: true,
        formData:{id:"p1",param2:"p2"},

        add: function (e, data) {
            //$('#wienjoy-form-submit').prop('disabled', true);
            //$('.commThumbnailProcessText').fadeIn();
            var fileId = uuid(8, 16);

            var index = $(".pm_exist_img").length;
            
            if (index >= 9)
            {
                alert('最多上传九张图');
                return false;
            }

            //创建对应的div
            var newBox = createNewPmBox(index);
            newBox.attr("id", "file" + fileId);
            $("#pm_container_box").find(".pm_upload_box").before(newBox);

            newBox.find(".pm_btn_del").click(function() {
                var image_id = $(this).attr("image_id");
                var tar = $(this);
                if (image_id != undefined) {
                    var delUrl = "<?php echo Url::toRoute(['news/delete-image']); ?>";
                    $.post(delUrl, {id:image_id}, function (data, textStatus){

                        if (data.code == 0) {
                            tar.closest(".pm_item_box").detach();
                            refreshImageItemIndex();
                        }
                    }, 'json');
                }
                else {
                    $(this).closest(".pm_item_box").detach();
                    refreshImageItemIndex();
                }
            });

            data.formData = {"fileId": fileId};
            data.submit();
        },
        done: function(e, result){
            if (result.result.code == 0) {
                var fileId = result.result.fileId;
                var thumbnail = result.result.thumbnail;
                var link = result.result.link;
                $("#file" + fileId).find(".pm_input_image").val(link);
                $("#file" + fileId).find(".pm_input_image_thumb").val(thumbnail);
                $("#file" + fileId).find("img").attr("src", thumbnail);
                $("#file" + fileId).find("img").fadeIn();
            }
            //$('#wienjoy-form-submit').prop('disabled', false);
            //$('.commThumbnailProcessCover').fadeOut();
            //$('.commThumbnailProcessText').fadeOut();
            //$('.commThumbnailHolder').attr('src', result.result.thumbnail);
            //$('.commThumbnailInput').attr('value', result.result.path);
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
        }
    });
    <?php $this->endBlock() ?>
</script>

<?php
$this->registerJs($this->blocks['JS_NEWLINE'],\yii\web\View::POS_READY);
?>