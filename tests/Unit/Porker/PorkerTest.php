<?php
namespace Tests\Unit\Porker;

use Tests\TestCase;
use Packages\game\usecase\AcquisitionCardAndGetName;
use Packages\game\infra\InMemoryDeckRepository;
use Packages\game\domain\DeckService;

/**
 * PorkerTest
 */
class PorkerTest extends TestCase
{

    public function test_getOneCard()
    {
        $deck = new DeckService();
        $card = $deck->getOneCard();
        $this->assertTrue(in_array($card->getSuitName(), ['heart', 'diamond', 'spade', 'club']));
        $this->assertTrue(in_array($card->getRankName(), ['1', '2', '3']));

    }

    public function test_usecase()
    {
        $this->assertTrue(is_string((new AcquisitionCardAndGetName(new InMemoryDeckRepository))->acquisitionCard()));
    }
}