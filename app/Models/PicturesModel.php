<?php
/**
 * Created by PhpStorm.
 * User: lt-73
 * Date: 26/5/18
 * Time: 12:30 AM
 */

namespace App\Models;
use App\BaseModels\BasePictureModel;



class PicturesModel extends BasePictureModel
{
    public function savePictures($data)
    {
        $returnData = null;
        $this->picture_name = $data['picture_name'];
        $this->id_user = $data['id_user'];
        $this->is_profile = 0;
        if ($this->save()) {
            $returnData = $this;
        }
        return $returnData;
    }
}