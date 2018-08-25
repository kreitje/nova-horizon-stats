<?php

namespace Kreitje\NovaHorizonStats;

use Laravel\Nova\Card;

class FailedJobsPastHour extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Set the card meta data
     *
     * @var array
     */
    public $meta = [
        'refreshTime' => 30,
        'cardTitle' => 'Failed Jobs Past Hour'
    ];

    /**
     * FailedJobsPastHour constructor.
     *
     * @param int|null $secondsToRefresh
     * @param null|string $component
     */
    public function __construct(int $secondsToRefresh = 30, string $cardTitle = null, string $component = null)
    {
        parent::__construct($component);

        $this->meta['refreshTime'] = $secondsToRefresh;

        if (!is_null($cardTitle)) {
            $this->meta['cardTitle'] = trim($cardTitle);
        }
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'nova-horizon-stats-failed-jobs-past-hour';
    }

}
