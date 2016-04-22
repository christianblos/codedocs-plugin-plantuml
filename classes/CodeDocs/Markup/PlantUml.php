<?php
namespace CodeDocs\Markup;

use CodeDocs\Model\Config;
use CodeDocs\Model\ParseResult;
use CodeDocs\Model\Source;
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

        $content = file_get_contents($file);

        $generator = new OnlineGenerator($config->getParam('plantuml.url'));
        $url       = $generator->createUrl($content);

        return sprintf('![%s](%s)', $this->alt, $url);
    }
}
