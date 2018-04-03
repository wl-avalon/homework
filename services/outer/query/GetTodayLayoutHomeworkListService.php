<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/4/2
 * Time: 上午10:54
 */

namespace app\modules\services\outer\query;


use app\modules\constants\HomeworkRecordBeanConst;
use app\modules\models\beans\HomeworkRecordBean;
use app\modules\models\HomeworkItemModel;
use app\modules\models\HomeworkRecordModel;

class GetTodayLayoutHomeworkListService
{
    public static function getTodayLayoutHomeworkList($classUuid, $type, $teacherID){
        if($type == 1){
            $recordBeanList = HomeworkRecordModel::queryTodayHomeworkRecordByClassUuidList($classUuid);
        }else{
            $recordBeanList = HomeworkRecordModel::queryTodayHomeworkRecordByClassUuidList($classUuid, $teacherID);
        }
        $recordUuidList     = [];
        $recordSubjectMap   = [];
        foreach($recordBeanList as $recordBean){
            $recordUuidList[] = $recordBean->getUuid();
            $recordSubjectMap[$recordBean->getUuid()] = HomeworkRecordBeanConst::$subjectMap[$recordBean->getSubject()];
        }

        $homeworkItemList   = HomeworkItemModel::queryHomeworkItemByRecordUuidList($recordUuidList);

        $homeworkList = [];
        foreach($homeworkItemList as $itemBean){
            $homeworkList[] = [
                'homeworkItemUuid'  => $itemBean->getUuid(),
                'content'           => $itemBean->getHomeworkContent(),
                'subject'           => $recordSubjectMap[$itemBean->getHomeworkUuid()],
            ];
        }
        return [
            'homeworkItemList'    => $homeworkList,
        ];
    }
}