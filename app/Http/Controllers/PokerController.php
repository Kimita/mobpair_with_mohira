<?php
/**
 * Created by PhpStorm.
 * User: "Tatsuhiko Kimita <nannbo@crappo.net>"
 * Date: 2018-12-29
 * Time: 19:52
 */

namespace App\Http\Controllers;


class PokerController
{
    public function getNotationAction()
    {
        return view('poker.get-notation-action');
    }
}