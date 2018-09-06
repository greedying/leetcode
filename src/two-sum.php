<?php

/**

给定一个整数数组和一个目标值，找出数组中和为目标值的两个数。

你可以假设每个输入只对应一种答案，且同样的元素不能被重复利用。

示例:

给定 nums = [2, 7, 11, 15], target = 9

因为 nums[0] + nums[1] = 2 + 7 = 9
所以返回 [0, 1]`
*/

/**
  对于php来讲，我们可以用数组来解决，数组本质为哈希表。

  1、数组循环一遍,foreach效率更高
  2、对于当前数字 $v，验证 $target - $v 是否在哈希表中，如果在，则结束；不在则把当前值也存入哈希表

  这样时间复杂度为 O(n)，但空间复杂度也为 O(n)
**/
function twoSum($arr, $target) {
    $hash = [];
    foreach($arr as $k => $v) {
        $left = $target - $v;
        if ($v == $left) {
            continue; // 不能重复
        }
        if (isset($hash[$left])) {
            return [$hash[$left], $k];
        } else {
            $hash[$v] = $k;
        }
    }
}

$result = twoSum([2, 7, 11, 15], 9);
print_r($result);
$result = twoSum([1, 3, 5, 7, 9], 14);
print_r($result);
