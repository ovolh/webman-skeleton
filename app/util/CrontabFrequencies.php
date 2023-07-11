<?php

namespace app\util;

use Illuminate\Support\Carbon;

class CrontabFrequencies
{
    public string $expression = '* * * * * *';

    /**
     * The Cron expression representing the event's frequency.
     *
     * @param string $expression
     * @return $this
     */
    public function cron(string $expression)
    {
        $this->expression = $expression;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getExpression(): string
    {
        return $this->expression;
    }

    /**
     * 每1秒
     *
     * @return $this
     */
    public function everySecond()
    {
        return $this->spliceIntoPosition(1, '*');
    }

    /**
     * 每2秒
     *
     * @return $this
     */
    public function everyTwoSecond()
    {
        return $this->spliceIntoPosition(1, '*/2');
    }

    /**
     * 每3秒
     *
     * @return $this
     */
    public function everyThreeSecond()
    {
        return $this->spliceIntoPosition(2, '*/3');
    }

    /**
     * 每4秒
     *
     * @return $this
     */
    public function everyFourSecond()
    {
        return $this->spliceIntoPosition(1, '*/4');
    }

    /**
     * 每5秒
     *
     * @return $this
     */
    public function everyFiveSecond()
    {
        return $this->spliceIntoPosition(1, '*/5');
    }

    /**
     * 每10秒
     *
     * @return $this
     */
    public function everyTenSecond()
    {
        return $this->spliceIntoPosition(1, '*/10');
    }

    /**
     * 每15秒
     *
     * @return $this
     */
    public function everyFifteenSecond()
    {
        return $this->spliceIntoPosition(1, '*/15');
    }

    /**
     * 每30秒
     *
     * @return $this
     */
    public function everyThirtySecond()
    {
        return $this->spliceIntoPosition(1, '0,30');
    }

    /**
     * 每几秒
     *
     * @return $this
     */
    public function everyNumSecond($num = 1)
    {
        return $this->spliceIntoPosition(1, '*/' . $num);
    }

    /**
     * 每1分钟
     *
     * @return $this
     */
    public function everyMinute()
    {
        return $this->spliceIntoPosition(2, '*');
    }

    /**
     * 每2分钟
     *
     * @return $this
     */
    public function everyTwoMinutes()
    {
        return $this->spliceIntoPosition(2, '*/2');
    }

    /**
     * 每3分钟
     *
     * @return $this
     */
    public function everyThreeMinutes()
    {
        return $this->spliceIntoPosition(2, '*/3');
    }

    /**
     * 每4分钟
     *
     * @return $this
     */
    public function everyFourMinutes()
    {
        return $this->spliceIntoPosition(2, '*/4');
    }

    /**
     * 每5分钟
     *
     * @return $this
     */
    public function everyFiveMinutes()
    {
        return $this->spliceIntoPosition(2, '*/5');
    }

    /**
     * 每10分钟
     *
     * @return $this
     */
    public function everyTenMinutes()
    {
        return $this->spliceIntoPosition(2, '*/10');
    }

    /**
     * 每15分钟
     *
     * @return $this
     */
    public function everyFifteenMinutes()
    {
        return $this->spliceIntoPosition(2, '*/15');
    }

    /**
     * 每30分钟
     *
     * @return $this
     */
    public function everyThirtyMinutes()
    {
        return $this->spliceIntoPosition(2, '0,30');
    }

    /**
     * 每几分钟
     *
     * @return $this
     */
    public function everyNumMinutes($num = 1)
    {
        return $this->spliceIntoPosition(2, '*/' . $num);
    }

    /**
     * 每小时
     *
     * @return $this
     */
    public function hourly()
    {
        return $this->spliceIntoPosition(2, 0)->spliceIntoPosition(1, 0);
    }

    /**
     * 每小时，在具体时间
     *
     * @param array|int $offset
     * @return $this
     */
    public function hourlyAt($offset)
    {
        $offset = is_array($offset) ? implode(',', $offset) : $offset;

        return $this->spliceIntoPosition(2, $offset)->spliceIntoPosition(1, 0);
    }

    /**
     * 将活动安排为每隔奇数小时运行一次。
     *
     * @return $this
     */
    public function everyOddHour()
    {
        return $this->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, '1-23/2')
            ->spliceIntoPosition(1, 0);
    }

    /**
     * 每2小时
     *
     * @return $this
     */
    public function everyTwoHours()
    {
        return $this->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, '*/2')
            ->spliceIntoPosition(1, 0);
    }

    /**
     * 每3小时
     *
     * @return $this
     */
    public function everyThreeHours()
    {
        return $this->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, '*/3')
            ->spliceIntoPosition(1, 0);
    }

    /**
     * 每4小时
     *
     * @return $this
     */
    public function everyFourHours()
    {
        return $this->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, '*/4')
            ->spliceIntoPosition(1, 0);
    }

    /**
     * 每6小时
     *
     * @return $this
     */
    public function everySixHours()
    {
        return $this->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, '*/6')
            ->spliceIntoPosition(1, 0);
    }

    /**
     * 每天
     *
     * @return $this
     */
    public function daily()
    {
        return $this->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, 0)
            ->spliceIntoPosition(1, 0);
    }

    /**
     * 每天固定时间 (10:00:34, 19:30, etc).
     *
     * @param string $time
     * @return $this
     */
    public function at($time)
    {
        return $this->dailyAt($time);
    }

    /**
     * 每天固定时间 (10:00:34, 19:30, etc).
     *
     * @param string $time
     * @return $this
     */
    public function dailyAt($time)
    {
        $segments = explode(':', $time);

        return $this->spliceIntoPosition(3, (int)$segments[0])
            ->spliceIntoPosition(2, count($segments) === 2 ? (int)$segments[1] : '0')
            ->spliceIntoPosition(1, count($segments) === 3 ? (int)$segments[2] : '0');
    }

    /**
     * 每天两次
     *
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function twiceDaily($first = 1, $second = 13)
    {
        return $this->twiceDailyAt($first, $second, 0);
    }

    /**
     * 固定时间每天2次
     *
     * @param int $first
     * @param int $second
     * @param int $offset
     * @return $this
     */
    public function twiceDailyAt($first = 1, $second = 13, $offset = 0)
    {
        $hours = $first . ',' . $second;

        return $this->spliceIntoPosition(2, $offset)
            ->spliceIntoPosition(3, $hours)
            ->spliceIntoPosition(1, 0);
    }

    /**
     * 工作日执行
     *
     * @return $this
     */
    public function weekdays()
    {
        return $this->days('1-5');
    }

    /**
     * 周末执行
     *
     * @return $this
     */
    public function weekends()
    {
        return $this->days('0,6');
    }

    /**
     * 星期一执行
     *
     * @return $this
     */
    public function mondays()
    {
        return $this->days(1);
    }

    /**
     * 星期二执行
     *
     * @return $this
     */
    public function tuesdays()
    {
        return $this->days(2);
    }

    /**
     * 星期三执行
     *
     * @return $this
     */
    public function wednesdays()
    {
        return $this->days(3);
    }

    /**
     * 星期四执行
     *
     * @return $this
     */
    public function thursdays()
    {
        return $this->days(4);
    }

    /**
     * 星期五执行
     *
     * @return $this
     */
    public function fridays()
    {
        return $this->days(5);
    }

    /**
     * 星期六执行
     *
     * @return $this
     */
    public function saturdays()
    {
        return $this->days(6);
    }

    /**
     * 星期天执行
     *
     * @return $this
     */
    public function sundays()
    {
        return $this->days(0);
    }

    /**
     * 按周执行
     *
     * @return $this
     */
    public function weekly()
    {
        return $this->spliceIntoPosition(1, 0)
            ->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, 0)
            ->spliceIntoPosition(6, 0);
    }

    /**
     * 指定每周的时间执行
     *
     * @param array|mixed $dayOfWeek
     * @param string $time
     * @return $this
     */
    public function weeklyOn($dayOfWeek, $time = '0:0:0')
    {
        $this->dailyAt($time);

        return $this->days($dayOfWeek);
    }

    /**
     * 按月执行
     *
     * @return $this
     */
    public function monthly()
    {
        return $this->spliceIntoPosition(1, 0)
            ->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, 0)
            ->spliceIntoPosition(4, 1);
    }

    /**
     * 指定每月的执行时间
     *
     * @param int $dayOfMonth
     * @param string $time
     * @return $this
     */
    public function monthlyOn($dayOfMonth = 1, $time = '0:0:0')
    {
        $this->dailyAt($time);

        return $this->spliceIntoPosition(4, $dayOfMonth);
    }

    /**
     * 每月执行两次
     *
     * @param int $first
     * @param int $second
     * @param string $time
     * @return $this
     */
    public function twiceMonthly($first = 1, $second = 16, $time = '0:0:0')
    {
        $daysOfMonth = $first . ',' . $second;

        $this->dailyAt($time);

        return $this->spliceIntoPosition(4, $daysOfMonth);
    }

    /**
     * 每月最后一天执行
     *
     * @param string $time
     * @return $this
     */
    public function lastDayOfMonth($time = '0:0:0')
    {
        $this->dailyAt($time);

        return $this->spliceIntoPosition(4, Carbon::now()->endOfMonth()->day);
    }

    /**
     * 按季度执行
     *
     * @return $this
     */
    public function quarterly()
    {
        return $this->spliceIntoPosition(1, 0)
            ->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, 0)
            ->spliceIntoPosition(4, 1)
            ->spliceIntoPosition(5, '1-12/3');
    }

    /**
     * 指定季度的执行时间
     *
     * @param int $dayOfQuarter
     * @param int $time
     * @return $this
     */
    public function quarterlyOn($dayOfQuarter = 1, $time = '0:0:0')
    {
        $this->dailyAt($time);

        return $this->spliceIntoPosition(4, $dayOfQuarter)
            ->spliceIntoPosition(5, '1-12/3');
    }

    /**
     * 按年执行
     *
     * @return $this
     */
    public function yearly()
    {
        return $this->spliceIntoPosition(1, 0)
            ->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, 0)
            ->spliceIntoPosition(4, 1)
            ->spliceIntoPosition(5, 1);
    }

    /**
     * 指定具体年执行
     *
     * @param int $month
     * @param int|string $dayOfMonth
     * @param string $time
     * @return $this
     */
    public function yearlyOn($month = 1, $dayOfMonth = 1, $time = '0:0:0')
    {
        $this->dailyAt($time);

        return $this->spliceIntoPosition(4, $dayOfMonth)
            ->spliceIntoPosition(5, $month);
    }

    /**
     * Set the days of the week the command should run on.
     *
     * @param array|mixed $days
     * @return $this
     */
    public function days($days)
    {
        $days = is_array($days) ? $days : func_get_args();

        return $this->spliceIntoPosition(6, implode(',', $days));
    }

    /**
     * Splice the given value into the given position of the expression.
     *
     * @param int $position
     * @param string $value
     * @return $this
     */
    protected function spliceIntoPosition($position, $value)
    {
        $segments = preg_split("/\s+/", $this->expression);

        $segments[$position - 1] = $value;

        return $this->cron(implode(' ', $segments));
    }
}
