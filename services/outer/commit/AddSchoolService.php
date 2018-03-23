<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/12
 * Time: 下午6:04
 */

namespace app\modules\services\outer\commit;
use app\modules\apis\IDAllocApi;
use app\modules\constants\SchoolRecordBeanConst;
use app\modules\models\beans\SchoolRecordBean;
use app\modules\models\SchoolRecordModel;
use sp_framework\components\Assert;

class AddSchoolService
{
    public static function addSchool($schoolName, $schoolLevel, $schoolAttribution){
        $idResponse = IDAllocApi::nextId();
        Assert::isTrue(!empty($idResponse['data']['nextId']), "网络繁忙,请稍后再试", "获取schoolUuid失败");
        $schoolUuid = $idResponse['data']['nextId'];
        $schoolRecordBeanData = [
            'uuid'           => $schoolUuid,
            'school_name'           => $schoolName,
            'school_level'          => $schoolLevel,
            'school_attribution'    => $schoolAttribution,
            'school_status'         => SchoolRecordBeanConst::SCHOOL_STATUS_NORMAL,
            'create_time'           => date('Y-m-d H:i:s'),
            'register_time'         => date('Y-m-d H:i:s'),
        ];
        $schoolRecordBean   = new SchoolRecordBean($schoolRecordBeanData);
        SchoolRecordModel::insertOneRecord($schoolRecordBean);
        return [];
    }
}