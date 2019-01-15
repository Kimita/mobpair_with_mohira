<?php
/**
 * Created by PhpStorm.
 * User: "Tatsuhiko Kimita <nannbo@crappo.net>"
 * Date: 2018-12-29
 * Time: 20:22
 */

namespace App\Domain\Poker\Models\Interfaces;

use App\Domain\Trump\Models\Interfaces\CardInterface as CardEntity;

/**
 * 一人のプレイヤーを表現するエンティティインスタンスが備えるインターフェース
 *
 * Interface PlayerInterface
 * @package App\Domain\Poker\Models\Interfaces
 */
interface PlayerInterface
{
    /**
     * 手札のカードのうち一枚を返す
     * @return CardEntity
     */
    public function getCard() : CardEntity;
}