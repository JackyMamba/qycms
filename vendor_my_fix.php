#!/usr/bin/env php
<?php
/**
 * @author qingyu8@staff.weibo.com
 * @date 23/10/2017
 */

$params = getParams();
$root = str_replace('\\', '/', __DIR__);

echo "QyCMS vendor my Fix Tool v1.0\n\n";

$map = [
    'vendor_my_fix/BootstrapAsset.php'=>'vendor/yiisoft/yii2-bootstrap/BootstrapAsset.php',
    'vendor_my_fix/BootstrapPluginAsset.php'=>'vendor/yiisoft/yii2-bootstrap/BootstrapPluginAsset.php',
    'vendor_my_fix/JqueryAsset.php'=>'vendor/yiisoft/yii2/web/JqueryAsset.php',
    'vendor_my_fix/vendor_my_fix/UEditor.php'=>'vendor/kucha/ueditor/UEditor.php',
    'vendor_my_fix/UEditorAsset.php'=>'vendor/kucha/ueditor/UEditorAsset.php',
    'vendor_my_fix/ZeroClipboard.js' =>'vendor/kucha/ueditor/assets/third-party/zeroclipboard/ZeroClipboard.js',
];
$all = false;
foreach ($map as $s=>$t){
    $diff_cmd = "diff $s $t";
    echo "Command: $diff_cmd\n";
    echo "Result: " . shell_exec($diff_cmd);

    if (!copyFile($root, $s, $t, $all, $params)) {
        break;
    }
}

function copyFile($root, $source, $target, &$all, $params)
{
    if (!is_file($root . '/' . $source)) {
        echo "       skip $target ($source not exist)\n";
        return true;
    }
    if (is_file($root . '/' . $target)) {
        if (file_get_contents($root . '/' . $source) === file_get_contents($root . '/' . $target)) {
            echo "  unchanged $target\n";
            return true;
        }
        if ($all) {
            echo "  overwrite $target\n";
        } else {
            echo "      exist $target\n";
            echo "            ...overwrite? [Yes|No|All|Quit] ";


            $answer = !empty($params['overwrite']) ? $params['overwrite'] : trim(fgets(STDIN));
            if (!strncasecmp($answer, 'q', 1)) {
                return false;
            } else {
                if (!strncasecmp($answer, 'y', 1)) {
                    echo "  overwrite $target\n";
                } else {
                    if (!strncasecmp($answer, 'a', 1)) {
                        echo "  overwrite $target\n";
                        $all = true;
                    } else {
                        echo "       skip $target\n";
                        return true;
                    }
                }
            }
        }
        file_put_contents($root . '/' . $target, file_get_contents($root . '/' . $source));
        return true;
    }
    echo "   generate $target\n";
    @mkdir(dirname($root . '/' . $target), 0777, true);
    file_put_contents($root . '/' . $target, file_get_contents($root . '/' . $source));
    return true;
}

function getParams()
{
    $rawParams = [];
    if (isset($_SERVER['argv'])) {
        $rawParams = $_SERVER['argv'];
        array_shift($rawParams);
    }

    $params = [];
    foreach ($rawParams as $param) {
        if (preg_match('/^--(\w+)(=(.*))?$/', $param, $matches)) {
            $name = $matches[1];
            $params[$name] = isset($matches[3]) ? $matches[3] : true;
        } else {
            $params[] = $param;
        }
    }
    return $params;
}