<?php

/**
  示例 1:

  输入: "abcabcbb"
  输出: 3 
  解释: 无重复字符的最长子串是 "abc"，其长度为 3。
  示例 2:

  输入: "bbbbb"
  输出: 1
  解释: 无重复字符的最长子串是 "b"，其长度为 1。
  示例 3:

  输入: "pwwkew"
  输出: 3
  解释: 无重复字符的最长子串是 "wke"，其长度为 3。
  请注意，答案必须是一个子串，"pwke" 是一个子序列 而不是子串。

*/

/**
    滑动窗口法
    1、i和 j 为窗口的左右边界
    2、j 每次向右挪动一个位置
    3、此时计算以j为结尾的不重复子串。
       即寻找前面有没有与j重复的字符串j'；如果有j'，则取 i = max(j'+1, i)；否则i不变。
    4、同时，我们会将当前值写入哈希，哈希的值为下标。每个循环都写入，确保重复的字符，保存的是最大下标
    5、然后每次都记录当前字串的长度，并与之前最大长度比较，保留最大值
    6、所有循环结束后，返回最后的最大值
**/
function lengthOfLongestSubstring($str) {
    $ans = 0;
    $hash = [];
    for ($i = $j = 0, $l = strlen($str); $j < $l; $j++) {
        if (isset($hash[$str[$j]])) {
            $i = max($i, $hash[$str[$j]] + 1);
        }
        $ans = max($ans, $j - $i + 1);
        $hash[$str[$j]] = $j;
    }
    return $ans;
}

function myPrint($str) {
    echo "the string is :" . $str;
    echo "longest string length is :" . lengthOfLongestSubstring($str);
    echo "\n\n";
}

myPrint('abcabcbb'); // abc, echo 3
myPrint('bbbbb'); // b, echo 1
myPrint('pwwkew'); // wke, echo 3
