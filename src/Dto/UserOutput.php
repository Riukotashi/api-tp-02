<?php

namespace App\Dto;

use Symfony\Component\Serializer\Annotation\Groups;

final class UserOutput
{
    /**
     * @Groups({"user_read"})
     */
    public $id;

    /**
     * @Groups({"user_read"})
     */
    public $email;

    /**
     * @Groups({"user_read"})
     */
    public $numberFavArtist;

    /**
     * @Groups({"user_read"})
     */
    public $artists;
}