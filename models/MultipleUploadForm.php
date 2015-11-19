<?php

namespace app\models;

use yii\web\Model;
use yii\web\UploadedFile;

class MultipleUploadForm extends Model
{
    /**
     * @var UploadedFile[] files uploaded
     */
    public $files;

    /**
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [['files'], 'file', 'extensions' => 'jpg', 'mimeTypes' => 'image/jpeg', 'maxFiles' => 10, 'skipOnEmpty' => false],
        ];
    }
}
 ?>
