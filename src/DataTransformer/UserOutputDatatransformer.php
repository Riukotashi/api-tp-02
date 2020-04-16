<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\UserOutput;
use App\Entity\User;

final class UserOutputDatatransformer implements DataTransformerInterface
{
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $data instanceof User && $to === UserOutput::class;
    }
    public function transform($object, string $to, array $context = [])
    {

        if(!$object instanceof User){
            return;
        }
        $output = new UserOutput();

        $output->id = $object->getId();
        $output->email = $object->getEmail();
        $output->numberFavArtist = count($object->getArtists());
        $output->artists = $object->getArtists();
        return $output;

    }
}