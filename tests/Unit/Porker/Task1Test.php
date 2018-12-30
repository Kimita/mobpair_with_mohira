<?php
/**
 * Created by PhpStorm.
 * User: "Tatsuhiko Kimita <nannbo@crappo.net>"
 * Date: 2018-12-29
 * Time: 20:32
 */

namespace Tests\Unit\Porker;

use Tests\TestCase;
use App\Domain\Poker\Models\Interfaces\PlayerInterface as Player;
use App\Domain\Trump\Models\Interfaces\CardInterface as CardEntity;
use App\Domain\Trump\Models\Vo\Suit;
use App\Domain\Trump\Models\Vo\Rank;

/**
 * @see http://devtesting.jp/tddbc/?TDDBC仙台07%2F課題
 * 「課題1 トランプのカード」セクションに対応するテストクラス
 *
 * Class Task1
 * @package Tests\Unit\Porker
 */
class Task1TestBak extends TestCase
{

    /**
     * 「課題1-1 カードの文字列表記」に対応するテストクラス
     */
    public function test_section1()
    {
        $suit = new Suit('♠');
        $rank = new Rank('1');

        $this->assertTrue($suit instanceof Suit);
        $expectSuit = $suit->label;

        $this->assertTrue($rank instanceof Rank);
        $expectRank = $rank->label;

        $notation = $expectSuit . $expectRank;

        /* Cardエンティティのmockを生成し、interfaceに定義した通りの振る舞いをmockオブジェクトへ割り当てる */
        $card = \Mockery::mock(CardEntity::class);
        $card->shouldReceive('notation')
            ->andReturn($notation);

        /* Playerエンティティのmockを生成し、interfaceに定義した通りの振る舞いをmockオブジェクトへ割り当てる */
        $player = \Mockery::mock(Player::class);
        $player->shouldReceive('getCard')
            ->andReturn($card);

        /*
         * テストを実施する
         */
        $playersCard = $player->getCard();
        $cardNotation = $playersCard->notation();
        $this->assertEquals($notation, $cardNotation);
    }
}