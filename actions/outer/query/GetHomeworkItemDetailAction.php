<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/4/3
 * Time: 下午9:42
 */

namespace app\modules\actions\outer\query;
use app\modules\services\outer\query\GetHomeworkItemDetailService;
use sp_framework\actions\BaseAction;

class GetHomeworkItemDetailAction extends BaseAction
{
    private $homeworkItemUuid;
    private $classUuid;

    protected function formatParams()
    {
        $this->classUuid        = $this->get('classUuid');
        $this->homeworkItemUuid = $this->get('homeworkItemUuid');
    }

    public function execute()
    {
        return GetHomeworkItemDetailService::getHomeworkItemDetail($this->classUuid, $this->homeworkItemUuid);
    }
}