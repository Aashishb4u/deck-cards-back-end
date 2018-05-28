<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $cards_array = ['Spade', 'Heart', 'Diamond', 'Club'];
        foreach ($cards_array as $card_type) {
            for ($card_num = 1; $card_num < 14; $card_num++) {
                DB::table('cards')->insert(
                    array(
                        'card_number' => $card_num,
                        'card_type' => $card_type,
                    ));
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
