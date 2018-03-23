<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/13
 * Time: 上午11:11
 */

namespace app\modules\actions\outer\commit;
use app\modules\services\outer\commit\AddClassService;
use sp_framework\actions\BaseAction;
use sp_framework\components\Assert;

class AddClassAction extends BaseAction
{
    private $schoolUuid;
    private $className;
    private $nowGrade;
    private $createTime;
    private $graduateTime;

    protected function formatParams()
    {
        $this->schoolUuid   = $this->get('schoolUuid');
        $this->className    = $this->get('className');
        $this->nowGrade     = $this->get('nowGrade');
        $this->createTime   = $this->get('createTime');
        $this->graduateTime = $this->get('graduateTime');
        Assert::isTrue(!empty($this->schoolUuid), "学校ID不能为空");
        Assert::isTrue(!empty($this->className), "班级名称不能为空");
        Assert::isTrue(!empty($this->nowGrade), "班级创建年级不能为空");
        Assert::isTrue(!empty($this->createTime), "班级创建时间不能为空");
        Assert::isTrue(!empty($this->graduateTime), "毕业时间不能为空");
    }

    public function execute()
    {
        $addResult = AddClassService::addClass($this->schoolUuid, $this->className, $this->nowGrade, $this->createTime, $this->graduateTime);
        return $addResult;
    }
}