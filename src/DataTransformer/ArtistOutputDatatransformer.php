<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\ArtistOutput;
use App\Entity\Artist;

final class ArtistOutputDatatransformer implements DataTransformerInterface
{
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $data instanceof Artist && $to === ArtistOutput::class;
    }
    public function transform($object, string $to, array $context = [])
    {

        if(!$object instanceof Artist){
            return;
        }
        $output = new ArtistOutput();

        $output->id = $object->getId();
        $output->name = $object->getName();
        $output->startYear = $object->getStartYear();

        $output->numberAlbum = count($object->getAlbums());
        $output->numberFan = count($object->getUsers());
        $output->styles = $object->getStyles();
        return $output;

    }
}