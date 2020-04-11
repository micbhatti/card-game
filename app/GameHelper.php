<?php
namespace App;
use Illuminate\Support\Str;

/**
 * Game Helper
 *
 * Include functions to compare the cards
 *
 */
class GameHelper
{

    const CARDSVALUE = [
        2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10,
        'J'=>11, 'Q'=>12, 'K'=>13, 'A'=>14
    ];

    public $user_cards;

    /**
     * Find score of both players
     *
     * @param Array $userCards
     *
     * @return Array
     */
    public function getScores($userCards)
    {
        $botCards = self::botCards($userCards);

        $user_score = 0;
        $bot_score = 0;

        $botCardsUnchanged = implode(" ", $botCards);

        foreach ($this->user_cards as $key => $userCard) {

            if(Str::contains($userCard, ['K', 'Q', 'A', 'J'])) {
                $this->user_cards[$key] = self::CARDSVALUE[$userCard];
            }

            if(Str::contains($botCards[$key], ['K', 'Q', 'A', 'J'])) {
                $botCards[$key] = self::CARDSVALUE[$botCards[$key]];
            }

            if($this->user_cards[$key] > $botCards[$key]) {
                $user_score++;
            }
            if($this->user_cards[$key] < $botCards[$key]) {
                $bot_score++;
            }

        }

        return [
            'bot_cards' => $botCardsUnchanged,
            'user_score'=>$user_score,
            'bot_score'=>$bot_score
        ];
    }

      /**
     * Create cards for bot
     *
     * @param $userCards
     *
     * @return Array
     */
    public function botCards($userCards)
    {
        $this->user_cards = explode(' ', $userCards);

        $botCards = [];

        foreach($this->user_cards as $count) {
            $botCards[] = array_rand(self::CARDSVALUE);
        }

        return $botCards;
    }
}
