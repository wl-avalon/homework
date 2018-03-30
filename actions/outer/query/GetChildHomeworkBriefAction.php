<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/30
 * Time: 上午10:55
 */

namespace app\modules\actions\outer\query;
use app\modules\services\outer\query\GetChildHomeworkBriefService;
use sp_framework\actions\BaseAction;

class GetChildHomeworkBriefAction extends BaseAction
{
    private $parentUuid;
    private $childUuid;

    protected function formatParams()
    {
        $this->parentUuid   = $this->get('memberID');
        $this->childUuid    = $this->get('childUuid');
    }

    public function execute()
    {
        return GetChildHomeworkBriefService::getChildHomeworkBrief($this->parentUuid, $this->childUuid);
    }
}