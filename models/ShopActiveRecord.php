<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;
//use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;


/**
 * ShopActiveRecord will be a parent class for all other models of shop DB.
 *
 * It extends the ActiveRecord class to provide common timestamp and blameable behaviors.
 * (TBA probably sluggable behavior)
 *
 * @author Alexey Sopin <alexey.sopin@gmail.com>
 */
class ShopActiveRecord extends yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_added', 'date_modified'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_added'],
                ],
                // TBU value because of the following:
                // http://stackoverflow.com/questions/30397789/use-db-expression-or-php-datetime-as-timestamp
                // One drawback with using DB Expressin in yii2 is that the model attribute is not updated after $model->save(). It still contains "new Expression('NOW()')". To get the actual value the model need to be loaded from database with "$model->refresh()". By using PHP datetime the final value is present right away. (Found that out when making a Rest API with the default Rest classes. After creating something the value echoed back still was an Expression and not a value.) – karpy47 Nov 8 at 17:19
                'value' => new Expression('NOW()'), // using new Expression('NOW()') instead of just time() because it is DB time format independent
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }
}
 ?>
