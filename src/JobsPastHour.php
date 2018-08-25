<?php

namespace Kreitje\NovaHorizonStats;

use Laravel\Nova\Card;

class JobsPastHour extends Card
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
        'cardTitle' => 'Jobs Past Hour'
    ];

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'nova-horizon-stats-jobs-past-hour';
    }

    /**
     * JobsPastHour constructor.
     *
     * @param int|null $secondsToRefresh
     * @param null|string $component
     */
    public function __construct(int $secondsToRefresh = 30, $cardTitle = null, string $component = null)
    {
        parent::__construct($component);

        $this->meta['refreshTime'] = $secondsToRefresh;

        if (!is_null($cardTitle)) {
            $this->meta['cardTitle'] = trim($cardTitle);
        }
    }
}
