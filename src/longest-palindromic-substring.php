<?php

/**
  给定一个字符串 s，找到 s 中最长的回文子串。你可以假设 s 的最大长度为1000。

  示例 1：

  输入: "babad"
  输出: "bab"
  注意: "aba"也是一个有效答案。
  示例 2：

  输入: "cbbd"
  输出: "bb"
*/

/**
  循环访问第i个字符，并以其为中心向两边扩展尽量长
**/
function longestPalindromicSubstring($str) {
    $substr = '';
    $maxLength = 0;
    for ($i = 0, $l = strlen($str); $i < $l; $i++) {
        $l1 = expandAroundCenter($str, $l, $i, $i);
        $l2 = expandAroundCenter($str, $l, $i, $i + 1);
        if ($l1 > $maxLength || $l2 > $maxLength) {
            $maxLength = max($l1, $l2);
            $substr = substr($str, $i - floor(($maxLength - 1) / 2), $maxLength);// 这里floor那段只是为了凑一下
        }
    }
    return $substr;
}

//  返回最大长度，可避免每次都在内部取子串
function expandAroundCenter($str, $length, $left, $right) {
    // 这里的等号，是为了在边界的时候能够执行
    while($left >= 0 && $right <= $length - 1) {
        if ($str[$left] == $str[$right]) {
            $left--;
            $right++;
        } else {
            break;
        }
    }
    /***
    while($left >= 0 && $right <= $length - 1 && $str[$left] == $str[$right]) {
        $left--;
        $right++;
    }

      **/
    return $right - $left - 1; // 因为最后的 left 和 right是不符合要求的
}

function myPrint($str) {
    echo "the string is :" . $str;
    echo "\nlongest Palindromic Substring is :" . longestPalindromicSubstring($str);
    echo "\n\n";
}

myPrint('babad'); // aba
myPrint('cbbd'); // bb
myPrint('abcde'); // a
myPrint('abcdd'); // dd

// Manacher's 算法，则见 https://www.felix021.com/blog/read.php?2040
