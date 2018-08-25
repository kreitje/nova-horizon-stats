<template>
    <card class="flex flex-col items-center justify-center relative nova-horizon-stats-card" v-bind:class="borderClass">
        <div class="px-3 py-3">
            <h1 class="text-left" v-html="cardTitle"></h1>
            <div v-if="isError" class="text-sm pt-2">Error getting stats. Is horizon installed?</div>
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
                status: '',
                refreshTime: 30,
                workloads: []
            }
        },

        mounted() {
            console.log(this.card);
            if (this.card.refreshTime) {
                this.refreshTime = parseInt(this.card.refreshTime);
            }

            if (this.card.cardTitle) {
                this.cardTitle = this.card.cardTitle;
            }

            this.fetchStats();
            setInterval(this.fetchStats, this.refreshTime * 1000);
        },

        computed: {
            borderClass() {

                if (!this.isLoading && this.isError) {
                    return 'border border-danger';
                }

                return '';
            }
        },

        methods: {
            fetchStats() {
                this.isLoading = true;
                this.isError = false;
                Nova.request().get('/horizon/api/workload').then(response => {
                    this.isLoading = false;
                    this.isError = false;
                    console.log(response.data);

                    if (response.data.length > 0) {
                        if (this.card.queueNames.length === 0) {
                            this.workloads = response.data;
                        } else {
                            //need to filter
                        }
                    }


                }).catch(err => {
                    this.isLoading = false;
                    this.isError = true;
                });
            }
        }
    }
</script>
