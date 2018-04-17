<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/1/12
 * Time: 下午7:29
 */

namespace app\modules\commands;
use app\modules\services\daemon\QueryClassFinishDetailService;
use yii\console\Controller;

class MainController extends Controller
{
    public function actionQueryClassFinishDetail(){
        set_time_limit(0);
        QueryClassFinishDetailService::queryClassFinishDetail();
    }
}
