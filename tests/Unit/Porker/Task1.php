<?php
/**
 * Created by PhpStorm.
 * User: "Tatsuhiko Kimita <nannbo@crappo.net>"
 * Date: 2018-12-29
 * Time: 20:32
 */

namespace Tests\Unit\Porker;

use Tests\TestCase;
use Mockery\MockInterface;
use App\Domain\Poker\Models\Interfaces\PlayerInterface as Player;
use App\Domain\Card\Models\Interfaces\CardInterface as CardEntity;
use App\Domain\Card\Models\Entity\Vo\Suit;
use App\Domain\Card\Models\Entity\Vo\Rank;

class Task1 extends TestCase
{

    public function test_task1()
    {
        $expectSuit = '♠';
        $expectRank = '1';
        $suit = new Suit($expectSuit);
        $rank = new Rank($expectRank);
        $notation = $suit->getVal().$rank->getVal();
        
        $card = \Mockery::mock(CardEntity::class);
        $card->shouldReceive('getNotation')
             ->andReturn($notation);
        
        
        $player = \Mockery::mock(Player::class);
        $player->shouldReceive('getCard')
               ->andReturn($card);

        $playersCard = $player->getCard();
        $cardNotation = $playersCard->getNotation();
        $this->assertEquals($notation, $cardNotation);
    }
}