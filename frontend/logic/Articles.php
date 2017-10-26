<?php
/**
 * @author qingyu8@staff.weibo.com
 * @date 22/10/2017
 */

namespace frontend\logic;


use frontend\models\Artcate;

class Articles extends Base {

    public static function nestedCates(){
        return Artcate::nestedItems();
    }

    public static function getItems($cid){

    }

    public static function getItem($id){

    }
}
