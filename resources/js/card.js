Nova.booting((Vue, router) => {
    Vue.component('nova-horizon-stats-jobs-past-hour', require('./components/JobsPastHour'));
    Vue.component('nova-horizon-stats-failed-jobs-past-hour', require('./components/FailedJobsPastHour'));
})
