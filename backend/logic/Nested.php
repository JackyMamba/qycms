<?php
/**
 * @author qingyu8@staff.weibo.com
 * @date 08/10/2017
 */
namespace backend\logic;

/**
 * Class Nested
 * 要求：数据list的每一行，含id、pid、pids字段
 * @package common\models
 */
class Nested extends \common\logic\Nested {
    protected static $_with_pre = true;

    public static function dataList($data) {
        $res = [];
        $tmp = self::childrenWithTree($data);
        unset($data);
        if (!empty($tmp['tree'])) {
            self::dataPrefix($tmp['tree'], $tmp['items'], $res);
        }
        return $res;
    }

    private static function dataPrefix($tree, &$items, &$res) {
        foreach ($tree as $k => $v) {
            $level = $items[$k]['pids'] == '0' ? 1 : count(explode(',', $items[$k]['pids'])) + 1;
            if($level == 1){
                $pre = '';
            }elseif($level == 2){
                $pre = '–&nbsp;';
            }else{
                $pre = str_repeat('<span style="color: #999;">┊&nbsp;&nbsp;&nbsp;</span>', $level - 2) . '–&nbsp;';
            }

            $items[$k]['name'] = $pre . $items[$k]['name'];
            $items[$k]['nested_level'] = $level;
            $res[$items[$k]['id']] = $items[$k];
            if (!empty($v)) {
                self::dataPrefix($v, $items, $res);
            }

        }
    }
}
