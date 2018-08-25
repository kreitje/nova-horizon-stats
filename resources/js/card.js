Nova.booting((Vue, router) => {
    Vue.component('nova-horizon-stats-jobs-past-hour', require('./components/JobsPastHour'));
    Vue.component('nova-horizon-stats-failed-jobs-past-hour', require('./components/FailedJobsPastHour'));
    Vue.component('nova-horizon-stats-processes', require('./components/Processes'));
    Vue.component('nova-horizon-stats-workload', require('./components/Workload'));
})
