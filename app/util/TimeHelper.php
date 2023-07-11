<?php
namespace app\util;

use Carbon\Carbon;
use zjkal\TimeHelper as Base;

class TimeHelper extends Base
{

    /**
     * 获取指定日期当月第一天, 默认当月
     * @param string|int $date
     * @return false|string
     */
    public static function getMonthFirstDay(string|int $date = ''): bool|string
    {
        $date = static::toTimestamp($date);
        return date('Y-m-01', strtotime($date));
    }

    /**
     * 获取指定日期当月最后一天, 默认当月
     * @param $date
     * @return false|string
     */
    public static function getMonthLastDay(string|int $date = ''): bool|string
    {
        $date = static::toTimestamp($date);
        return date('Y-m-d', strtotime(date('Y-m-01', strtotime($date)) . ' +1 month -1 day'));
    }

    /**
     * 获取月初的时间戳
     * @param string $month 月份，格式2020-10
     * @return false|int
     */
    public static function getMonthStartTimestamp(string $month = ''): bool|int
    {
        $month = static::getMonthFirstDay($month);
        return strtotime($month);
    }

    /**
     * 获取月末时间戳
     * @param string $month 月份，格式2020-10
     * @return false|int
     */
    public static function getMonthEndTimestamp(string $month = ''): bool|int
    {
        $month = static::getMonthLastDay($month) . ' 23:59:59';
        return strtotime($month);
    }

    /**
     * 上周开始日期
     * @return string
     */
    public static function getSubWeekStartDate(): string
    {
        return Carbon::now()->subWeek()->startOfWeek()->toDateTimeString();
    }

    /**
     * 上周开始日期
     * @return false|int
     */
    public static function getSubWeekStartDateTimestamp(): bool|int
    {
        return strtotime(self::getSubWeekStartDate());
    }

    /**
     * 上周结束日期
     * @return string
     */
    public static function getSubWeekEndDate(): string
    {
        return Carbon::now()->subWeek()->endOfWeek()->toDateTimeString();
    }

    /**
     * 上周结束日期
     * @return false|int
     */
    public static function getSubWeekEndDateTimestamp(): bool|int
    {
        return strtotime(self::getSubWeekEndDate());
    }

    /**
     * 本周结束日期
     * @return string
     */
    public static function getCurrentWeekEndDate(): string
    {
        return Carbon::now()->endOfWeek()->toDateTimeString();
    }

    /**
     * 本周结束日期
     * @return int
     */
    public static function getCurrentWeekEndDateTimestamp(): int
    {
        return strtotime(self::getCurrentWeekEndDate());
    }

    /**
     * 本周开始日期
     * @return string
     */
    public static function getCurrentWeekStartDate(): string
    {
        return Carbon::now()->startOfWeek()->toDateTimeString();
    }

    /**
     * 本周开始日期
     * @return int
     */
    public static function getCurrentWeekStartDateTimestamp(): int
    {
        return strtotime(self::getCurrentWeekStartDate());
    }

    /**
     * 昨天开始时间
     * @return string
     */
    public static function getStartOfYesterday(): string
    {
        return Carbon::yesterday()->startOfDay()->toDateTimeString();
    }

    /**
     * 昨天开始时间
     * @return int
     */
    public static function getStartOfYesterdayTimestamp(): int
    {
        return strtotime(self::getStartOfYesterday());
    }

    /**
     * 昨天结束时间
     * @return string
     */
    public static function getEndOfYesterday(): string
    {
        return Carbon::yesterday()->endOfDay()->toDateTimeString();
    }

    /**
     * 昨天结束时间
     * @return int
     */
    public static function getEndOfYesterdayTimestamp(): int
    {
        return strtotime(self::getEndOfYesterday());
    }

    /**
     * 今天开始时间
     * @return string
     */
    public static function getStartOfToday(): string
    {
        return Carbon::now()->startOfDay()->toDateTimeString();
    }

    /**
     * 今天开始时间
     * @return int
     */
    public static function getStartOfTodayTimestamp(): int
    {
        return strtotime(self::getStartOfToday());
    }

    /**
     * 今天结束时间
     * @return string
     */
    public static function getEndOfToday(): string
    {
        return Carbon::now()->endOfDay()->toDateTimeString();
    }

    /**
     * 今天结束时间
     * @return int
     */
    public static function getEndOfTodayTimestamp(): int
    {
        return strtotime(self::getEndOfToday());
    }

    /**
     * 近7天的开始时间
     * @return string
     */
    public static function getStartOfSevenDay(): string
    {
        return Carbon::now()->startOfDay()->subDay(6)->toDateTimeString();
    }

    /**
     * 近7天的开始时间
     * @return int
     */
    public static function getStartOfSevenDayTimestamp(): int
    {
        return strtotime(self::getStartOfSevenDay());
    }

    /**
     * 近30天的开始时间
     * @return string
     */
    public static function getStartOfThirtyDay(): string
    {
        return Carbon::now()->startOfDay()->subDay(29)->toDateTimeString();
    }

    /**
     * 近30天的开始时间
     * @return int
     */
    public static function getStartOfThirtyDayTimestamp(): int
    {
        return strtotime(self::getStartOfThirtyDay());
    }

    /**
     * 本月开始时间
     * @return string
     */
    public static function getStartOfCurrentMonth(): string
    {
        return Carbon::now()->startOfMonth()->toDateTimeString();
    }

    /**
     * 本月开始时间
     * @return int
     */
    public static function getStartOfCurrentMonthTimestamp(): int
    {
        return strtotime(self::getStartOfCurrentMonth());
    }

    /**
     * 上月开始时间
     * @return string
     */
    public static function getStartOfSubMonth(): string
    {
        return Carbon::now()->subMonth()->startOfMonth()->toDateTimeString();
    }

    /**
     * 上月开始时间
     * @return int
     */
    public static function getStartOfSubMonthTimestamp(): int
    {
        return strtotime(self::getStartOfSubMonth());
    }

    /**
     * 上月结束时间
     * @return string
     */
    public static function getEndOfSubMonth(): string
    {
        return Carbon::now()->subMonth()->endOfMonth()->toDateTimeString();
    }

    /**
     * 上月结束时间
     * @return int
     */
    public static function getEndOfSubMonthTimestamp(): int
    {
        return strtotime(self::getEndOfSubMonth());
    }

    /**
     * 上12个月（含当月）开始时间
     * @return string
     */
    public static function getStartOfTwelveMonth(): string
    {
        return Carbon::now()->subMonth(12)->startOfMonth()->toDateTimeString();
    }

    /**
     * 上12个月（含当月）开始时间
     * @return int
     */
    public static function getStartOfTwelveMonthTimestamp(): int
    {
        return strtotime(self::getStartOfTwelveMonth());
    }


    /**
     * 生成日期列表
     * @param $date1
     * @param $date2
     * @return array
     */
    public static function dateRange($date1, $date2): array
    {
        $timestamp1 = strtotime($date1);
        $timestamp2 = strtotime($date2);
        $days = ($timestamp2 - $timestamp1) / 86400 + 1;
        $date = [];
        for ($i = 0; $i < $days; $i++) {
            $date[] = date('Y-m-d', $timestamp1 + (86400 * $i));
        }
        return $date;
    }

}
