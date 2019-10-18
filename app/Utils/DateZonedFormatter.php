<?php


namespace App\Utils;

class DateZonedFormatter
{
    private $zone;
    private $format;

    /**
     * DateZonedFormatter constructor.
     * @param \DateTimeZone $zone
     * @param $format
     */
    public function __construct(\DateTimeZone $zone, $format)
    {
        $this->zone = $zone;
        $this->format = $format;
    }

    /**
     * @param \DateTime $dateTime
     * @return string
     */
    public function format(\DateTime $dateTime): string {
        $dateTime->setTimezone($this->zone);

        return $dateTime->format($this->format);
    }

    /**
     * @param string $value
     * @param \DateTimeZone $baseZone
     * @return string
     * @throws \Exception
     */
    public function formatValue(string $value, \DateTimeZone $baseZone): string {
        $dateTime = new \DateTime($value, $this->zone);
        $dateTime->setTimezone($baseZone);

        return $dateTime->format($this->format);
    }
}