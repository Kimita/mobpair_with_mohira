<?php
namespace Packages\game\domain;

class DeckService
{
    public function getOneCard(): Card
    {
        return $this->selectCard();
    }

    private function selectCard(): Card
    {
        // 本来はここでデッキ内のカード取得の整合性とかの処理が入り、取得カードを決定する
        return new Card('heart', '1');
    }
}

