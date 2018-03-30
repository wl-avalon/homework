<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/30
 * Time: 下午6:09
 */

namespace app\modules\services\outer\commit;


use app\modules\models\beans\HomeworkScheduleBean;
use app\modules\models\HomeworkScheduleModel;
use sp_framework\apis\IdAllocApi;
use sp_framework\components\Assert;

class FinishHomeworkService
{
    public static function finishHomework($parentUuid, $childUuid, $homeworkUuid, $minutes){
        $scheduleUuid = IdAllocApi::batch(1)->toArray();
        Assert::isTrue(!empty($scheduleUuid), "网络繁忙,请稍后再试", "获取记录ID失败");

        $scheduleBeanData = [
            'uuid'                  => $scheduleUuid,
            'homework_item_uuid'    => $homeworkUuid,
            'student_uuid'          => $childUuid,
            'recorder_uuid'         => $parentUuid,
            'cost_time'             => $minutes,
            'create_time'           => date('Y-m-d H:i:s'),
        ];
        $scheduleBean = new HomeworkScheduleBean($scheduleBeanData);
        try{
            HomeworkScheduleModel::insertOneRecord($scheduleBean);
        }catch(\Exception $e){
            self::checkFinishRetry($childUuid, $homeworkUuid);
        }
        return [];
    }

    public static function checkFinishRetry($childUuid, $homeworkUuid){
        $scheduleBean = HomeworkScheduleModel::queryScheduleByChildAndItemUuid($childUuid, $homeworkUuid);
        Assert::isTrue(!empty($scheduleBean->getUuid()), "网络繁忙,请稍后再试");
    }
}