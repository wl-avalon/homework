<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/13
 * Time: 下午6:02
 */

namespace app\modules\actions\outer\commit;
use app\modules\services\outer\commit\AddHomeworkService;
use sp_framework\actions\BaseAction;
use sp_framework\components\Assert;

class CommitHomeworkAction extends BaseAction
{
    private $class;
    private $subject;
    private $homeworkName;
    private $creatorUuid;
    private $homeworkContent;

    protected function formatParams()
    {
        $this->creatorUuid      = $this->get('memberID');
        $this->class            = $this->get('class');
        $this->subject          = $this->get('subject');
        $this->homeworkName     = $this->get('homeworkName');
        $this->homeworkContent  = json_decode($this->get('homeworkList'), true);
        $this->creatorUuid      = -1;
        Assert::isTrue(!empty($this->creatorUuid), "创建者不能为空");
        Assert::isTrue(!empty($this->homeworkContent), "作业内容不能为空");
    }

    public function execute()
    {
        return AddHomeworkService::addHomework($this->creatorUuid, $this->homeworkContent, $this->class, $this->subject, $this->homeworkName);
    }
}