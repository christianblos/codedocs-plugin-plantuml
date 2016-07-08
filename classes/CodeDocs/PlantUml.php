<?php
namespace CodeDocs;

use CodeDocs\Component\Plugin;
use CodeDocs\Model\Config;
use CodeDocs\ValueObject\Directory;

class PlantUml extends Plugin
{
    const CONFIG_JAR = 'plugins.plantuml.jar';
    const CONFIG_URL = 'plugins.plantuml.url';

    /**
     * @param Config $config
     */
    public function mount(Config $config)
    {
        $jar = $this->getParam('jar');
        if ($jar) {
            $dir     = new Directory(dirname($jar), $config->getConfigDir());
            $jarPath = realpath(sprintf('%s/%s', rtrim((string)$dir, '/'), basename($jar)));

            $config->setParam(self::CONFIG_JAR, $jarPath);
        }

        $url = $this->getParam('url');
        if ($url) {
            $config->setParam(self::CONFIG_URL, $url);
        }
    }
}
