<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/13
 * Time: 下午6:02
 */

namespace app\modules\actions\outer\commit;
use sp_framework\actions\BaseAction;
use sp_framework\components\Assert;

class AddHomeworkRecordAction extends BaseAction
{
    private $creatorUuid;
    private $homeworkContent;

    protected function formatParams()
    {
        $this->creatorUuid      = $this->get('creatorUuid');
        $this->homeworkContent  = json_decode($this->get('homeworkContent'), true);
        Assert::isTrue(!empty($this->creatorUuid), "创建者不能为空");
        Assert::isTrue(!empty($this->homeworkContent), "作业内容不能为空");
    }

    public function execute()
    {

    }
}