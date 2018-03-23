<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/1/12
 * Time: 下午7:29
 */

namespace app\modules\commands;
use app\modules\components\MockData;
use app\modules\components\SPLog;
use app\modules\constants\RedisKey;
use app\modules\library\Proxy;
use app\modules\services\daemon\process\CreateQuestionDetailService;
use app\modules\services\daemon\process\TurnMathmlToPngService;
use app\modules\services\daemon\spider\CreateQuestionService;
use app\modules\services\daemon\spider\GetProxyIPListService;
use rrxframework\util\RedisUtil;
use yii\console\Controller;

class MainController extends Controller
{

}
