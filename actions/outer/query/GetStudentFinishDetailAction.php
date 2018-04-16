<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/4/16
 * Time: 上午11:27
 */

namespace app\modules\actions\outer\query;
use app\modules\services\outer\query\GetStudentFinishDetailService;
use sp_framework\actions\BaseAction;
use sp_framework\components\Assert;

class GetStudentFinishDetailAction extends BaseAction
{
    private $studentUuid;
    private $weekIndex;
    private $subject;

    protected function formatParams()
    {
        $this->studentUuid  = $this->get('studentUuid');
        $this->weekIndex    = $this->get('weekIndex');
        $this->subject      = $this->get('subject');
        Assert::isTrue(!empty($this->studentUuid), "网络繁忙,请稍后再试", "学生ID不能为空");
        Assert::isTrue(!empty($this->subject), "网络繁忙,请稍后再试", "科目ID不能为空");
    }

    public function execute()
    {
        return GetStudentFinishDetailService::getStudentFinishDetail($this->studentUuid, $this->weekIndex, $this->subject);
    }
}