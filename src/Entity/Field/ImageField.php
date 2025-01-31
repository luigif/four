<?php

declare(strict_types=1);

namespace Bolt\Entity\Field;

use Bolt\Entity\Field;
use Bolt\Entity\FieldInterface;
use Doctrine\ORM\Mapping as ORM;
use League\Glide\Urls\UrlBuilderFactory;

/**
 * @ORM\Entity
 */
class ImageField extends Field implements FieldInterface
{
    public function getType(): string
    {
        return 'image';
    }

    public function __toString(): string
    {
        return $this->getPath();
    }

    public function getValue(): array
    {
        $value = parent::getValue() ?: [];

        // Generate a URL
        $value['path'] = $this->getPath();

        // @todo temp fix for https://github.com/bolt/four/issues/318
        unset($value['media']);
        unset($value['title']);
        unset($value[0]);

        return $value;
    }

    public function getPath(): string
    {
        $urlBuilder = UrlBuilderFactory::create('/thumbs/');

        // @todo those dimensions shouldn't be hardcoded here
        return $urlBuilder->getUrl($this->get('filename'), [
            'w' => 240,
            'h' => 160,
            'area' => 'files',
        ]);
    }
}
