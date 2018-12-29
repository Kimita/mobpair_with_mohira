<?php
/**
 * Created by PhpStorm.
 * User: "Tatsuhiko Kimita <nannbo@crappo.net>"
 * Date: 2018-12-29
 * Time: 20:22
 */

use App\Domain\Trump\Models\Interfaces\CardInterface as CardEntity;

interface PlayerInterface
{
    public function getCard() : CardEntity;
}