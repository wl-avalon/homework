<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/30
 * Time: 上午10:57
 */

namespace app\modules\services\outer\query;
use app\modules\apis\SchoolAdminApi;
use app\modules\models\beans\HomeworkItemBean;
use app\modules\models\beans\HomeworkRecordBean;
use app\modules\models\HomeworkItemModel;
use app\modules\models\HomeworkRecordModel;
use app\modules\models\HomeworkScheduleModel;

class GetChildHomeworkBriefService
{
    public static function getChildHomeworkBrief($parentUuid, $childUuid){
        $childInfo= SchoolAdminApi::getStudentByStudentUuid($childUuid)->toArray();

        $homeworkRecordList     = HomeworkRecordModel::queryTodayHomeworkRecordByClassUuidList([$childInfo['classUuid']]);
        $homeworkRecordUuidList = [];
        /** @var HomeworkRecordBean[]  $homeworkRecordMap*/
        $homeworkRecordMap      = [];
        foreach($homeworkRecordList as $homeworkRecordBean){
            $homeworkRecordUuidList[] = $homeworkRecordBean->getUuid();
            $homeworkRecordMap[$homeworkRecordBean->getUuid()]  = $homeworkRecordBean;
        }
        $homeworkItemList           = HomeworkItemModel::queryHomeworkItemByRecordUuidList($homeworkRecordUuidList);
        $homeworkItemUuidList       = [];
        $homeworkItemMap            = [];
        $homeworkItemMapToSubject   = [];
        foreach($homeworkItemList as $itemBean){
            $homeworkItemUuidList[] = $itemBean->getUuid();
            $homeworkItemMap[$itemBean->getUuid()]  = $itemBean;
            $homeworkItemMapToSubject[$itemBean->getUuid()] = $homeworkRecordMap[$itemBean->getHomeworkUuid()]->getSubject();
        }

        /** @var HomeworkItemBean[]  $doneHomeworkItemList*/
        $doneHomeworkItemList       = [];
        /** @var HomeworkItemBean[]  $waitWorkHomeworkItemMap*/
        $waitWorkHomeworkItemMap    = $homeworkItemMap;
        $homeworkScheduleList       = HomeworkScheduleModel::queryScheduleByChildAndItemUuidList($childUuid, $homeworkItemUuidList);
        foreach($homeworkScheduleList as $scheduleBean){
            unset($waitWorkHomeworkItemMap[$scheduleBean->getHomeworkItemUuid()]);
            $doneHomeworkItemList[] = $homeworkItemMap[$scheduleBean->getHomeworkItemUuid()];
        }

        $result = [
            'notDone'  => [],
            'hasDone'  => [],
        ];
        foreach($waitWorkHomeworkItemMap as $homeworkItemUuid => $itemBean){
            $result['notDone'][] = [
                'uuid'      => $itemBean->getUuid(),
                'content'   => $itemBean->getHomeworkContent(),
                'subject'   => $homeworkItemMapToSubject[$itemBean->getUuid()],
            ];
        }
        foreach($doneHomeworkItemList as $homeworkItemUuid  => $itemBean){
            $result['hasDone'][] = [
                'uuid'      => $itemBean->getUuid(),
                'content'   => $itemBean->getHomeworkContent(),
                'subject'   => $homeworkItemMapToSubject[$itemBean->getUuid()],
            ];
        }
        return $result;
    }
}