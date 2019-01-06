<?php
namespace Packages\game\usecase;

use Packages\game\domain\DeckRepository;
use Packages\game\domain\DeckService;

class AcquisitionCardAndGetName
{
    /**
     * @var $repository
     */
    private $deckRepository;


    public function __construct(DeckRepository $deckRepository) // DeckRepository って作ったけど DeckService作ったからここは UserRepositoryになるかも
    {
        $this->deckRepository = $deckRepository; // 初期配分後永続化が必要になったら使うかも？
    }

    public function acquisitionCard()
    {
        $deck = new DeckService();
        $card = $deck->getOneCard();
        return $card->getCardInfo();
    }
}

