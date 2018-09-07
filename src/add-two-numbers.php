<?php

/**

  给定两个非空链表来表示两个非负整数。位数按照逆序方式存储，它们的每个节点只存储单个数字。将两数相加返回一个新的链表。
  你可以假设除了数字 0 之外，这两个数字都不会以零开头。

  示例：
  输入：(2 -> 4 -> 3) + (5 -> 6 -> 4)
  输出：7 -> 0 -> 8
  原因：342 + 465 = 807

*/

/**
  下面解法直接按照整数相加，大于0则进位。
  1、为了方便，位数较少的数字，用0补齐。这样处理方便统一，效率则会差一点，尤其两个位数差很大的时候
  2、注意最后是不是有进位
**/
function addTwoNumbers($arr1, $arr2) {
    $result = [];
    $l = max(count($arr1), count($arr2));
    $carry = 0;
    for ($i = 0; $i < $l; $i++) {
        $v1 = $arr1[$i] ?? 0;
        $v2 = $arr2[$i] ?? 0;
        $v = $v1 + $v2 + $carry;
        if ($v > 9) {
            $v = $v % 10;
            $carry = 1;
        } else {
            $carry = 0;
        }
        $result[$i] = $v;
    }
    if ($carry) $result[$l] = $carry;
    return $result;
}

function myPrint($arr) {
    for($i = 0, $l = count($arr); $i < $l; $i++){
        echo $arr[$i];
        if ($i < $l - 1) {
            echo "->";
        }
    }
    echo "\n";
}

function batchPrint($arr1, $arr2) {
    echo "-----start-----\n";
    echo "first:";
    myPrint($arr1);
    echo "second:";
    myPrint($arr2);
    $result = addTwoNumbers($arr1, $arr2);
    echo "result:\n";
    myPrint($result);
    echo "-----end-----\n\n";
}

batchPrint([2, 4, 3], [5, 6, 4]);

batchPrint([0, 1], [0, 1, 2]);

batchPrint([], [0, 1]);

batchPrint([9, 9], [1]);
