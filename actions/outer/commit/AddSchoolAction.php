<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/12
 * Time: 下午12:07
 */

namespace app\modules\actions\outer\commit;
use app\modules\services\outer\commit\AddSchoolService;
use sp_framework\actions\BaseAction;
use sp_framework\components\Assert;

class AddSchoolAction extends BaseAction
{
    private $schoolName;
    private $schoolLevel;
    private $schoolAttribution;

    protected function formatParams(){
        $this->schoolName           = $this->get('schoolName', '');
        $this->schoolLevel          = $this->get('schoolLevel', '');
        $this->schoolAttribution    = $this->get('schoolAttribution', '');
        Assert::isTrue(!empty($this->schoolName), "学校名称不能为空");
        Assert::isTrue(!empty($this->schoolLevel), "学校级别不能为空");
        Assert::isTrue(!empty($this->schoolAttribution), "学校地址不能为空");
    }

    public function execute()
    {
        $addResult = AddSchoolService::addSchool($this->schoolName, $this->schoolLevel, $this->schoolAttribution);
        return $addResult;
    }
}