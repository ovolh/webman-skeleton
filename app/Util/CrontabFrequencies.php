<?php

namespace App\Util;

class CrontabFrequencies
{
    public string $rule = '* * * * * *';

    /**
     * 获取rule
     * @return string
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * 按小时执行
     *
     * @return $this
     */
    public function hourly()
    {
        return $this->spliceIntoPosition(2, 0);
    }

    protected function spliceIntoPosition($position, $value)
    {
        $segments = explode(' ', $this->rule);

        $segments[$position - 1] = $value;

        return $this->rule(implode(' ', $segments));
    }

    /**
     * 设置任务执行周期
     * @param $rule
     * @return $this
     */
    public function rule($rule)
    {
        $this->rule = $rule;
        return $this;
    }

    /**
     * 按小时延期执行
     *
     * @param int $offset
     * @return $this
     */
    public function hourlyAt($offset)
    {
        return $this->spliceIntoPosition(2, $offset);
    }

    /**
     * 按天执行
     *
     * @return $this
     */
    public function daily()
    {
        return $this->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, 0);
    }

    /**
     * 指定时间执行
     *
     * @param string $time
     * @return $this
     */
    public function at($time)
    {
        return $this->dailyAt($time);
    }

    /**
     * 指定时间执行
     *
     * @param string $time 01:12:13 时：分：秒
     * @return $this
     */
    public function dailyAt($time)
    {
        $segments = explode(':', $time);

        return $this->spliceIntoPosition(3, (int)$segments[0])
            ->spliceIntoPosition(2, count($segments) == 2 ? (int)$segments[1] : '0')
            ->spliceIntoPosition(1, count($segments) == 3 ? (int)$segments[2] : '0');
    }

    /**
     * 每天执行两次
     *
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function twiceDaily($first = 1, $second = 13)
    {
        $hours = $first . ',' . $second;

        return $this->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, $hours);
    }

    /**
     * 工作日执行
     *
     * @return $this
     */
    public function weekdays()
    {
        return $this->spliceIntoPosition(6, '1-5');
    }

    /**
     * 周末执行
     *
     * @return $this
     */
    public function weekends()
    {
        return $this->spliceIntoPosition(6, '0,6');
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
     * 按周设置天执行
     *
     * @param array|mixed $days
     * @return $this
     */
    public function days($days)
    {
        $days = is_array($days) ? $days : func_get_args();

        return $this->spliceIntoPosition(7, implode(',', $days));
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
        return $this->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, 0)
            ->spliceIntoPosition(6, 0);
    }

    /**
     * 指定每周的时间执行
     *
     * @param int $day
     * @param string $time
     * @return $this
     */
    public function weeklyOn($day, $time = '0:0')
    {
        $this->dailyAt($time);

        return $this->spliceIntoPosition(6, $day);
    }

    /**
     * 按月执行
     *
     * @return $this
     */
    public function monthly()
    {
        return $this->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, 0)
            ->spliceIntoPosition(4, 1);
    }

    /**
     * 指定每月的执行时间
     *
     * @param int $day
     * @param string $time
     * @return $this
     */
    public function monthlyOn($day = 1, $time = '0:0')
    {
        $this->dailyAt($time);

        return $this->spliceIntoPosition(4, $day);
    }

    /**
     * 每月执行两次
     *
     * @param int $first
     * @param int $second
     * @return $this
     */
    public function twiceMonthly($first = 1, $second = 16)
    {
        $days = $first . ',' . $second;

        return $this->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, 0)
            ->spliceIntoPosition(4, $days);
    }

    /**
     * 按季度执行
     *
     * @return $this
     */
    public function quarterly()
    {
        return $this->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, 0)
            ->spliceIntoPosition(4, 1)
            ->spliceIntoPosition(5, '*/3');
    }

    /**
     * 按年执行
     *
     * @return $this
     */
    public function yearly()
    {
        return $this->spliceIntoPosition(2, 0)
            ->spliceIntoPosition(3, 0)
            ->spliceIntoPosition(4, 1)
            ->spliceIntoPosition(5, 1);
    }

    /**
     * 每秒执行
     *
     * @return $this
     */
    public function everySecond()
    {
        return $this->spliceIntoPosition(1, '*/1');
    }

    /**
     * 每5秒执行
     *
     * @return $this
     */
    public function everyFiveSecond()
    {
        return $this->spliceIntoPosition(1, '*/5');
    }

    /**
     * 每几秒执行
     *
     * @return $this
     */
    public function everyNumSecond($second)
    {
        return $this->spliceIntoPosition(1, '*/' . $second);
    }

    /**
     * 每分钟执行
     *
     * @return $this
     */
    public function everyMinute()
    {
        return $this->spliceIntoPosition(2, '*');
    }

    /**
     * 每5分钟执行
     *
     * @return $this
     */
    public function everyFiveMinutes()
    {
        return $this->spliceIntoPosition(2, '*/5');
    }

    /**
     * 每10分钟执行
     *
     * @return $this
     */
    public function everyTenMinutes()
    {
        return $this->spliceIntoPosition(2, '*/10');
    }

    /**
     * 每30分钟执行
     *
     * @return $this
     */
    public function everyThirtyMinutes()
    {
        return $this->spliceIntoPosition(2, '0,30');
    }

    /**
     * 设置时区
     *
     * @param string $timezone
     * @return $this
     */
    public function timezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }
}
