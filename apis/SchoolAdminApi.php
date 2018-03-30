<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/30
 * Time: 上午11:10
 */

namespace app\modules\apis;
use sp_framework\apis\ApiContext;

class SchoolAdminApi
{
    public static function getChildList($parentUuid){
        $params = [
            'parentUuid'    => $parentUuid,
        ];
        return ApiContext::get('school-admin', 'getChildList', $params)->throwWhenFailed();
    }

    public static function getStudentByStudentUuid($studentUuid){
        $params = [
            'studentUuid'    => $studentUuid,
        ];
        return ApiContext::get('school-admin', 'getStudentByStudentUuid', $params)->throwWhenFailed();
    }
}