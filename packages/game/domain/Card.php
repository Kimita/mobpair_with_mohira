<?php
namespace Packages\game\domain;

class Card
{
    private $suit;
    private $rank;

    public function __construct(string $suit, string $rank)
    {
        $this->suit = $suit;
        $this->rank = $rank;
    }

    public function getSuitName(): string
    {
        return $this->suit;
    }

    public function getRankName(): string
    {
        return $this->rank;
    }

    public function getCardInfo(): string
    {
        return $this->suit . ' : ' . $this->rank;
    }
}