<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/4/2
 * Time: 上午10:54
 */

namespace app\modules\services\outer\query;


use app\modules\constants\HomeworkRecordBeanConst;
use app\modules\models\HomeworkRecordModel;

class GetTodayLayoutHomeworkListService
{
    public static function getTodayLayoutHomeworkList($classUuid, $type, $teacherID){
        if($type == 1){
            $recordBeanList = HomeworkRecordModel::queryTodayHomeworkRecordByClassUuidList($classUuid);
        }else{
            $recordBeanList = HomeworkRecordModel::queryTodayHomeworkRecordByClassUuidList($classUuid, $teacherID);
        }

        $homeworkList = [];
        foreach($recordBeanList as $recordBean){
            $homeworkList[] = [
                'homeworkRecordUuid'    => $recordBean->getUuid(),
                'subject'               => HomeworkRecordBeanConst::$subjectMap[$recordBean->getSubject()],
            ];
        }
        return [
            'homeworkRecordList'    => $homeworkList,
        ];
    }
}