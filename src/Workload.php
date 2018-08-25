<?php

namespace Kreitje\NovaHorizonStats;

use Laravel\Nova\Card;

class Workload extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * Set the card meta data
     *
     * @var array
     */
    public $meta = [
        'refreshTime' => 30,
        'cardTitle' => 'Queue Workload',
        'queueNames' => []
    ];

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'nova-horizon-stats-workload';
    }

    /**
     * JobsPastHour constructor.
     *
     * @param int|null $secondsToRefresh
     * @param null $cardTitle
     * @param array $queueNames
     * @param null|string $component
     */
    public function __construct(int $secondsToRefresh = 30, $cardTitle = null, array $queueNames = [], string $component = null)
    {
        parent::__construct($component);

        $this->meta['refreshTime'] = $secondsToRefresh;

        if (!is_null($cardTitle)) {
            $this->meta['cardTitle'] = trim($cardTitle);
        }

        if (is_array($queueNames)) {
            $this->meta['queueNames'] = $queueNames;
        }
    }
}
