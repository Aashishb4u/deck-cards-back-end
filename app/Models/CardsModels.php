<?php
/**
 * Created by PhpStorm.
 * User: lt-73
 * Date: 27/5/18
 * Time: 8:28 PM
 */

namespace App\Models;
namespace App\Models;



use App\BaseModels\BaseCardsModel;

class CardsModels extends BaseCardsModel
{
    public function getAllCards() {
        $response = null;
        $response = $this::select('id','card_number','card_type')->get();
        return $response;
    }


}