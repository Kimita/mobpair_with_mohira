<?php
namespace Packages\game\domain;

Interface DeckRepository
{
    public function getOneCard(): string; // 本来はカード型

    public function save(string $card): void; // 本来はカード型

    public function getAll(): array;    // 本来は配列でなくリスト的なクラス
}
