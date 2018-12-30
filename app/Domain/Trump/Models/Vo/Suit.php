<?php
/**
 * Created by PhpStorm.
 * User: "Tatsuhiko Kimita <nannbo@crappo.net>"
 * Date: 2018-12-29
 * Time: 20:27
 */
declare(strict_types = 1);

namespace App\Domain\Trump\Models\Vo;

class Suit
{
    /**
     * @var string
     */
    private $val;

    public function __construct(string $val)
    {
        if (false === is_string($val)) {
            throw new \TypeError();
        }
        $this->val = $val;
    }

    /**
     * @param $name
     * @return string
     */
    public function __get($name)
    {
        if ($name !== 'label') {
            throw new \OutOfBoundsException();
        }
        return $this->val;
    }

    public function __set($name, $value) { throw new \BadMethodCallException(); }

    public function __isset($name) { throw new \BadMethodCallException(); }

    public function __toString() { return $this->val; }

}