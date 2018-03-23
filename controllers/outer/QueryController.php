<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/2/26
 * Time: 下午9:07
 */

namespace app\modules\controllers\outer;
use yii\web\Controller;

class QueryController extends Controller
{
    public function actions(){
        return [
            "getRandomQuestionByCondition"  => 'app\modules\actions\outer\query\GetRandomQuestionByConditionAction',
        ];
    }
}