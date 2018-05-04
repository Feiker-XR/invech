<?php

namespace bong\service\queue;

use Kcloze\Jobs\Config;
use Kcloze\Jobs\Logs;
use Kcloze\Jobs\Utils;

class SwooleJobAction
{
    public function init()
    {
        $this->logger  = Logs::getLogger(Config::getConfig()['logPath'] ?? '', Config::getConfig()['logSaveFileApp'] ?? '');
    }

    public function start($JobObject)
    {
        $this->init();
        try {
            $JobObject->fire();
        } catch (\Throwable $e) {
            Utils::catchError($this->logger, $e);
        } catch (\Exception $e) {
            Utils::catchError($this->logger, $e);
        }
    }
}
