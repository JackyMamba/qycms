<?php
/**
 * @author qingyu8@staff.weibo.com
 * @date 08/10/2017
 */

namespace common\logic;

use yii\helpers\ArrayHelper;

/**
 * Class Nested
 * 多级
 * 要求：数据list的每一行，含id、pid、pids、display_order字段
 * @package common\models
 */
class Nested {

    protected static $_with_pre;

    /**
     * @param $data
     * @return array $ct ['items'=>[],'tree'=>[]]
     */
    public static function childrenWithTree($data) {
        $tree = [];
        $items = [];
        foreach ($data as $v) {
            $items[$v['id']] = $v;
            $now = &$tree;
            $pids = empty($v['pids']) ? [] : explode(',', $v['pids']);
            array_push($pids, $v['id']);
            foreach ($pids as $pid) {
                if (!array_key_exists($pid, $now)) {
                    $now[$pid] = [];
                }
                $now = &$now[$pid];
            }
        }

        return [
            'items' => $items,
            'tree' => $tree
        ];
    }

    public static function getFirstLevel(&$ct){
        return ArrayHelper::filter($ct['items'], array_keys($ct['tree']));
    }

    public static function getAncestors(&$ct, $id = null){
        if(empty($id)){
            return false;
        }
        $item = $ct['items'][$id];
        $ks = explode(',', $item['pids']);
        return ArrayHelper::filter($ct['items'], $ks);
    }

    public static function getSiblings(&$ct, $id){
        if(empty($id)){
            return false;
        }
        $item = $ct['items'][$id];
        $ks = $item['pids'] == 0 ? '' : '[' . str_replace(',', '][', $item['pids']) . ']';
        eval('$ids = $ct["tree"]' . $ks . ';');
        return ArrayHelper::filter($ct['items'], array_keys($ids));
    }

    public static function getChildren(&$ct, $id){
        if(empty($id)){
            return false;
        }
        $item = $ct['items'][$id];
        $ks = $item['pids'] == 0 ? '[' . $id . ']' : '[' . str_replace(',', '][', $item['pids']) . '][' . $id . ']';
        eval('$ids = $ct["tree"]' . $ks . ';');
        return ArrayHelper::filter($ct['items'], array_keys($ids));
    }

    public static function options($data = [], $filter_id = null, $with_root = true) {
        $options = [];
        $with_root && $options[] = '根/';
        $tmp = self::childrenWithTree($data);
        if (!empty($tmp['tree'])) {
            self::fe($tmp['tree'], $tmp['items'], $options, $filter_id);
        }
        return $options;
    }

    public static function getPids($model) {
        if (empty($model)) {
            return '0';
        }
        $pids = empty($model->pids) ? '' : $model->pids . ',';
        return $pids . $model->id;
    }

    private static function fe($tree, &$items, &$options, $filter_id) {
        foreach ($tree as $k => $v) {
            $pre = '';
            if (static::$_with_pre) {
                $level = $items[$k]['pids'] == '0' ? 1 : count(explode(',', $items[$k]['pids'])) + 1;
                $pre = str_repeat('-', $level);
            }
            if (empty($filter_id) || $filter_id != $items[$k]['id']) {
                $options[$items[$k]['id']] = $pre . $items[$k]['name'];
                if (!empty($v)) {
                    self::fe($v, $items, $options, $filter_id);
                }
            }
        }
    }
}
