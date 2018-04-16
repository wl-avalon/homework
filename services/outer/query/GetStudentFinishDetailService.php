<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/4/16
 * Time: 上午11:44
 */

namespace app\modules\services\outer\query;


use app\modules\apis\SchoolAdminApi;
use app\modules\models\beans\HomeworkRecordBean;
use app\modules\models\HomeworkItemModel;
use app\modules\models\HomeworkRecordModel;
use app\modules\models\HomeworkScheduleModel;

class GetStudentFinishDetailService
{
    public static function getStudentFinishDetail($studentUuid, $weekIndex, $subject){
        $baseTime = strtotime("-{$weekIndex} week");
        $week = date('w', $baseTime);
        if($week == 0){
            $startDate  = date('Y-m-d 00:00:00', $baseTime - 86400 * 7);
            $endDate    = date('Y-m-d 23:59:59', $baseTime);
        }else{
            $week       = $week - 1;
            $startDate  = date('Y-m-d 00:00:00', $baseTime - 86400 * $week);
            $endDate    = date('Y-m-d 23:59:59', $baseTime + (6 - $week) * 86400);
        }

        $childInfo  = SchoolAdminApi::getStudentByStudentUuid($studentUuid)->toArray();
        $classUuid  = $childInfo['classUuid'];

        /** @var HomeworkRecordBean[] $homeworkRecordMap*/
        $homeworkRecordList     = HomeworkRecordModel::queryHomeworkRecordByDateAndClassUuid($classUuid, $subject, $startDate, $endDate);
        $homeworkRecordUuidList = [];
        $homeworkRecordMap      = [];
        foreach($homeworkRecordList as $homeworkRecordBean){
            $homeworkRecordUuidList[]   = $homeworkRecordBean->getUuid();
            $homeworkRecordMap[$homeworkRecordBean->getUuid()] = $homeworkRecordBean;
        }

        $homeworkItemList           = HomeworkItemModel::queryHomeworkItemByRecordUuidList($homeworkRecordUuidList);
        $homeworkItemUuidList       = [];
        $homeworkItemUuidMapToDate  = [];
        foreach($homeworkItemList as $homeworkItemBean){
            $homeworkRecordBean     = $homeworkRecordMap[$homeworkItemBean->getHomeworkUuid()];
            $homeworkItemUuidList[] = $homeworkItemBean->getUuid();
            $homeworkItemUuidMapToDate[$homeworkItemBean->getUuid()] = $homeworkRecordBean->getHomeworkDate();
        }

        $scheduleBeanList       = HomeworkScheduleModel::queryScheduleByChildAndItemUuidList($studentUuid, $homeworkItemUuidList);
        $countData = [];
        foreach($scheduleBeanList as $scheduleBean){
            $date           = $homeworkItemUuidMapToDate[$scheduleBean->getHomeworkItemUuid()];
            if(!isset($countData[$date])){
                $countData[$date] = [
                    'sumTime'       => 0,
                    'itemCount'     => 0,
                    'hasData'       => true,
                ];
            }
            $countData[$date]['sumTime'] += $scheduleBean->getCostTime();
            $countData[$date]['itemCount']++;
        }

        for($i = 0; $i < 7; $i++){
            $date = date('Y-m-d', strtotime($startDate) + 86400 * $i);
            if(!isset($countData[$date])){
                $countData[$date] = [
                    'sumTime'       => 0,
                    'itemCount'     => 0,
                    'hasData'       => false,
                ];
            }
        }

        $result = [];
        foreach($countData as $date => $data){
            $result[$date] = [
                'averageTime'   => $data['itemCount'] > 0 ? $data['sumTime'] / $data['itemCount'] : 0,
                'hasData'       => $data['hasData'],
            ];
        }

        return [
            'studentDetail' => $result,
        ];
    }
}