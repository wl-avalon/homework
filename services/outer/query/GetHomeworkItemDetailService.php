<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/4/3
 * Time: 下午9:45
 */

namespace app\modules\services\outer\query;


use app\modules\apis\SchoolAdminApi;
use app\modules\models\HomeworkScheduleModel;

class GetHomeworkItemDetailService
{
    public static function getHomeworkItemDetail($classUuid, $homeworkItemUuid){
        $studentInfoList    = SchoolAdminApi::getStudentOfClass($classUuid)->toArray()['studentList'];
        $studentInfoMap     = [];
        foreach($studentInfoList as $studentInfo){
            $studentInfoMap[$studentInfo['studentUuid']] = $studentInfo;
        }

        $scheduleBeanList   = HomeworkScheduleModel::queryScheduleByHomeworkItemUuidList($homeworkItemUuid);

        $hasDone        = [];
        $notDone        = [];
        $count          = 0;
        $sumCostTime    = 0;
        foreach($scheduleBeanList as $scheduleBean){
            $hasDone[] = [
                'studentUuid'   => $scheduleBean->getStudentUuid(),
                'studentName'   => $studentInfoMap[$scheduleBean->getStudentUuid()]['studentName'],
                'costTime'      => $scheduleBean->getCostTime(),
            ];
            $count++;
            $sumCostTime += $scheduleBean->getCostTime();
            unset($studentInfoMap[$scheduleBean->getStudentUuid()]);
        }
        foreach($studentInfoMap as $studentInfo){
            $notDone[] = [
                'studentUuid'   => $studentInfo['studentUuid'],
                'studentName'   => $studentInfo['studentName'],
                'costTime'      => 0,
            ];
        }
        return [
            'hasDone'       => $hasDone,
            'notDone'       => $notDone,
            'averageTime'   => $count > 0 ? intval($sumCostTime / $count) : 0,
        ];
    }
}