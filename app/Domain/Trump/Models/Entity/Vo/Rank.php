<?php
/**
 * Created by PhpStorm.
 * User: "Tatsuhiko Kimita <nannbo@crappo.net>"
 * Date: 2018-12-29
 * Time: 20:27
 */

use App\Domain\Trump\Models\Entity\Vo;

class Rank
{
    /**
     * @var string
     */
    private $val;

    public function __construct(String $val)
    {
        $this->val = $val;
    }

    public function getVal() : string
    {
        return $this->val;
    }
}