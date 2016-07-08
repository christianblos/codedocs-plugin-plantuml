<?php
namespace CodeDocs\Markup;

use CodeDocs\Model\Config;
use CodeDocs\Model\ParseResult;
use CodeDocs\Model\Source;
use CodeDocs\PlantUml as Plugin;
use CodeDocs\PlantUml\OnlineGenerator;
use CodeDocs\ValueObject\Parsable;

/**
 * @Annotation
 */
class PlantUml extends Markup
{
    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $alt = 'UML';

    /**
     * @param ParseResult $parseResult
     * @param Config      $config
     * @param Source      $source
     *
     * @return Parsable|string
     */
    public function buildContent(ParseResult $parseResult, Config $config, Source $source)
    {
        $file = dirname($source->getCurrentFile()) . '/' . $this->value . '.puml';

        if (!file_exists($file)) {
            return '';
        }

        $jar = $config->getParam(Plugin::CONFIG_JAR);
        if ($jar) {
            $url = $this->value . '.png';
        } else {
            $url = $this->createOnlineLink($config, $file);
        }

        return sprintf('![%s](%s)', $this->alt, $url);
    }

    /**
     * @param Config $config
     * @param string $file
     *
     * @return string
     */
    private function createOnlineLink(Config $config, $file)
    {
        $content = file_get_contents($file);

        $generator = new OnlineGenerator($config->getParam(Plugin::CONFIG_URL));

        return $generator->createUrl($content);
    }
}
