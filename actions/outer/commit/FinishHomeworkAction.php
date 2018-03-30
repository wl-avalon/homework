<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/30
 * Time: 下午6:07
 */

namespace app\modules\actions\outer\commit;
use app\modules\services\outer\commit\FinishHomeworkService;
use sp_framework\actions\BaseAction;

class FinishHomeworkAction extends BaseAction
{
    private $parentUuid;
    private $childUuid;
    private $homeworkUuid;
    private $minutes;

    protected function formatParams()
    {
        $this->parentUuid   = $this->get('memberID');
        $this->childUuid    = $this->get('childUuid');
        $this->homeworkUuid = $this->get('homeworkUuid');
        $this->minutes      = $this->get('minutes');
    }

    public function execute()
    {
        return FinishHomeworkService::finishHomework($this->parentUuid, $this->childUuid, $this->homeworkUuid, $this->minutes);
    }
}