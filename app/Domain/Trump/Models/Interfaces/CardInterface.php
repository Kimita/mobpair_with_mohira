<?php
/**
 * Created by PhpStorm.
 * User: "Tatsuhiko Kimita <nannbo@crappo.net>"
 * Date: 2018-12-29
 * Time: 20:19
 */

namespace App\Domain\Trump\Models\Interfaces;

/**
 * 一枚一枚のカードを表現するCardエンティティインスタンスが備えるインターフェース
 *
 * Interface CardInterface
 * @package App\Domain\Trump\Models\Interfaces
 */
interface CardInterface
{
    public function notation() : string;
}