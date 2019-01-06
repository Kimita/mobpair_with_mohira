<?php
namespace Packages\game\infra;

use Packages\game\domain\DeckRepository;

class InMemoryDeckRepository implements DeckRepository
{
    /**
     * @var array
     */
    private $cards = [];

    public function __construct()
    {
    }

    public function getOneCard(): string
    {

    }

    public function save($card): void
    {
        $cards[] = $card;
    }

    public function getAll(): array
    {
        return $this->cards;
    }


}