<template>
    <card class="block nova-horizon-stats-card" v-bind:class="borderClass">
        <div class="px-3 py-3">
            <h1 class="text-left text-80 font-light" v-html="cardTitle"></h1>
            <div v-if="isError" class="text-sm pt-2">Error getting stats. Is horizon installed?</div>

            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Queue</th>
                        <th>Processes</th>
                        <th>Jobs</th>
                        <th>Wait</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="workload in workloads">
                        <td class="text-center" v-html="workload.name"></td>
                        <td class="text-center" v-html="workload.processes"></td>
                        <td class="text-center" v-html="workload.length"></td>
                        <td class="text-center" v-html="humanTime(workload.wait)"></td>
                    </tr>
                    <tr v-if="workloads.length === 0">
                        <td colspan="4">No queues returned. Either you are watching only specific queues or maybe Horizon is not running.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="loading-indicator text-sm text-80" v-if="isLoading">Loading...</div>
    </card>
</template>

<script>
    export default {
        props: ['card'],

        data: function() {
            return {
                cardTitle: 'Queue Workload',
                isLoading: true,
                isError: false,
                refreshTime: 30,
                workloads: []
            }
        },

        mounted() {
            if (this.card.refreshTime) {
                this.refreshTime = parseInt(this.card.refreshTime);
            }

            if (this.card.cardTitle) {
                this.cardTitle = this.card.cardTitle;
            }

            this.fetchStats();
            setInterval(this.fetchStats, this.refreshTime * 1000);
        },

        methods: {
            fetchStats() {
                this.isLoading = true;
                this.isError = false;
                Nova.request().get('/horizon/api/workload').then(response => {
                    this.isLoading = false;
                    this.isError = false;

                    if (response.data.length > 0) {
                        if (this.card.queueNames.length === 0) {
                            this.workloads = response.data;
                        } else {

                            this.workloads = response.data.filter(workload => {
                                return _.indexOf(this.card.queueNames, workload.name) > -1;
                            });
                        }
                    } else {
                        this.workloads = [];
                    }


                }).catch(err => {
                    this.isLoading = false;
                    this.isError = true;
                });
            },

            humanTime(time) {
                return moment.duration(time, "seconds").humanize().replace(/^(.)|\s+(.)/g, function ($1) {
                    return $1.toUpperCase();
                });
            }
        }
    }
</script>
