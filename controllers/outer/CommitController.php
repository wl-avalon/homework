<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/12
 * Time: 下午12:04
 */

namespace app\modules\controllers\outer;
use yii\web\Controller;

class CommitController extends Controller
{
    public function actions(){
        return [
            "commitHomework" => 'app\modules\actions\outer\commit\CommitHomeworkAction',
        ];
    }
}