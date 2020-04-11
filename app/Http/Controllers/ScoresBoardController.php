<?php

namespace App\Http\Controllers;

use App\Rules\Cards;
use App\Rules\CheckCardValues;
use App\ScoresBoard;
use Illuminate\Http\Request;
use App\GameHelper;

class ScoresBoardController extends Controller
{
    private $gameHelper;

    public function __construct(GameHelper $gameHelper)
    {
        $this->gameHelper = $gameHelper;
    }


    /**
     * Get Score board
     *
     * @return json
     */
    public function scoreBoard()
    {
        return response()->json(
            [
                'data' => ScoresBoard::with('user')->groupBy('user_id')
                ->selectRaw('user_id, count(*) as total_games, sum(user_won) as total_wins')
                ->get()
            ],
            200
        );
    }


    /**
     * Store game result
     *
     *
     * @param Request $request
     * @return json
     */
    public function storeResult(Request $request)
    {

        $request->validate([
            'user_cards' => ['required', new CheckCardValues]
        ]);

        $data = $this->gameHelper->getScores($request->user_cards);


        ScoresBoard::create([
            'user_id' => $request->user_id,
            'user_score' => $data['user_score'],
            'bot_score' => $data['bot_score'],
            'user_won' => $data['user_score'] > $data['bot_score'] ? 1 : 0,
        ]);

        return response()->json([
            'user_win' => $data['user_score'] > $data['bot_score'] ? 'You won!' : "You Lost!",
            'user_score' => $data['user_score'],
            'bot_score' => $data['bot_score'],
            'bot_cards' => $data['bot_cards']
        ], 200);

    }
}
