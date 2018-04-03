<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/4/3
 * Time: 下午7:51
 */

namespace app\modules\services\outer\query;


use app\modules\models\HomeworkItemModel;

class GetHomeworkRecordDetailService
{
    public static function getHomeworkRecordDetail($homeworkRecordUuid){
        $homeworkItemList = HomeworkItemModel::queryHomeworkItemByRecordUuidList($homeworkRecordUuid);

        $result = [];
        foreach($homeworkItemList as $homeworkItemBean){
            $result[] = [
                'homeworkItemUuid'      => $homeworkItemBean->getUuid(),
                'homeworkItemContent'   => $homeworkItemBean->getHomeworkContent(),
            ];
        }
        return [
            'homeworkItemList'  => $result,
        ];
    }
}