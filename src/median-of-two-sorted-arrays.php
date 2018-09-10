<?php

/**
  给定两个大小为 m 和 n 的有序数组 nums1 和 nums2 。

  请找出这两个有序数组的中位数。要求算法的时间复杂度为 O(log (m+n)) 。

  你可以假设 nums1 和 nums2 不同时为空。

  示例 1:
  nums1 = [1, 3]，nums2 = [2]
  中位数是 2.0
  
  示例 2:
  nums1 = [1, 2]， nums2 = [3, 4]
  中位数是 (2 + 3)/2 = 2.5
*/

/*o*
  解答：数组 A, B长度为 a, b。不妨假设都是升序排列，且 m < n
  合并后的数组，我们假设中位数左侧a的数组为i, b的数组为j，如下图
                           |        right_part
  a[0], a[1], ..., a[i-1]  |  a[i], a[i+1], ..., a[m-1]
  b[0], b[1], ..., b[j-1]  |  b[j], b[j+1], ..., b[n-1]

  容易理解，ij必然存在。则存在以下关系
  1、 m+n为偶数的时候，i + j = m + n - i - j
      m+n为奇数的时候：i + j = m + n - i - j + 1
      我们让左侧数量不少于右侧，这样我们可以 统一表示为
      i + j = (m+n+1) / 2，
      即 i = (m+n+1) / 2 - i
  2、a[i-1] < b[j] && b[j-1] < a[i]

  3、当 m + n 为偶数的时候，median = (max(a[i-1] + b[j-1]) + min(a[i]+b[j])) / 2
     当 m + n 为奇数的时候，median = (max(a[i-1], b[j-1])

  12两个条件中，因为1比较容易满足，我们可以通过二分法确定一个合适的i，i的初始范围则为[0, m]。
  如果i不满足条件2，则根据具体情况向左右挪动。
  找打合适的i后，根据3计算中位数；但是也需要先处理特殊情况，即一个数组的最大值小于另外一个数组对的最小值

**/
function getMedian($a, $b) {
    $m = count($a); $n = count($b);
    if ($m > $n) {
        $tmp = $a; $a = $b; $b = $tmp;
        $m = count($a); $n = count($b);
    }
    $l = 0; 
    $r = $m;
    $half = floor(($m + $n + 1) / 2);
    while($l <= $r) {
        $i = ($l + $r) / 2;
        $j = $half  - $i;
        if ($i < $r && $b[$j - 1] > $a[$i]) {
            $l = $i + 1;
        } elseif ($i > $l && $a[$i - 1] > $b[$j]) {
            $r = $i - 1;
        } else {
            /**
              找到合适的i后，进一步计算中位值。这里我们抄网上方式，获取中位数左右数，然后取平均值。
              如果m+n为奇数，则左右都为中位数，否则左右平均为中位数
              **/
            // a 全部在中位数右测
            $left = $right = 0;
            if ($i == 0) {
                $left = $b[$j - 1];
            } elseif ($j == 0) {
                $left = $a[$i-1];
            } else {
                $left = max($b[$j - 1], $a[$i - 1]);
            }
            if (($m + $n) % 2 == 1) return $left; // 因为左边不少于右边

            if ($i == $m) {
                $right = $b[$j];
            } else if ($j  == $n) {
                $right = $a[$i];
            } else {
                $right = min($b[$j], $a[$i]);
            }
            return ($left + $right) / 2.0;
        }
    }
}

function myPrint($a, $b) {
    echo "a is :";
    var_dump($a);
    echo "b is :";
    var_dump($b);
    echo "the median is :" . getMedian($a, $b);
    echo "\n\n";
}

myPrint([1, 3], [2]); // 2
myPrint([1, 2], [3, 4]); // 2.5
myPrint([1, 2, 3], [4, 5]); // 3
myPrint([1, 2, 3, 4], [5, 6]); // 3.5
myPrint([7, 8, 9], [3, 4]); // 7
myPrint([6, 8, 9, 10], [3, 7]); // 7.5
