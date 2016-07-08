<?php
namespace CodeDocs\PlantUml;

use CodeDocs\Finalizer\Finalizer;
use CodeDocs\Model\Config;
use CodeDocs\PlantUml;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * This finalizer creates images from all .puml files in the export dir.
 */
class CreateImagesFinalizer extends Finalizer
{

    /**
     * @param Config $config
     */
    public function run(Config $config)
    {
        $iterator = new RecursiveDirectoryIterator($config->getExportDir());
        $iterator = new RecursiveIteratorIterator($iterator);
        $iterator = new \RegexIterator($iterator, '/\.puml$/');

        $files = [];

        foreach ($iterator as $file) {
            /** @var $file \SplFileInfo */
            $files[] = $file->getPathname();
        }

        $jar = $config->getParam(PlantUml::CONFIG_JAR);

        passthru(sprintf('java -jar %s %s', $jar, implode(' ', $files)));
    }
}
