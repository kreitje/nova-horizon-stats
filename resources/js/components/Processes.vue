<template>
    <card class="flex flex-col items-center justify-center relative nova-horizon-stats-card" v-bind:class="borderClass">
        <div class="px-3 py-3">
            <h1 class="text-center text-3xl text-80"><strong v-html="stat">{{stat}}</strong></h1>
            <h2 class="text-center text-80 font-light" v-html="cardTitle"></h2>

            <div v-if="!isHorizonOnline" class="text-danger text-center">Horizon is not online.</div>
            <div v-if="isError" class="text-sm pt-2">Error getting stats. Is horizon installed?</div>
        </div>

        <div class="loading-indicator text-sm text-80" v-if="isLoading">Loading...</div>
        <div class="online-indicator">
            <span v-if="isHorizonOnline" class="text-success" title="Horizon is running">✔</span>
            <span v-if="!isHorizonOnline" class="text-danger" title="Horizon is inactive">&times;</span>
        </div>
    </card>
</template>

<script>
    export default {
        props: ['card'],

        data: function() {
            return {
                cardTitle: 'Processes',
                isLoading: true,
                isError: false,
                stat: 0,
                status: '',
                refreshTime: 30
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
            this.fetchStatsIntervalId = setInterval(this.fetchStats, this.refreshTime * 1000);
        },

        beforeDestroy() {
            clearInterval(this.fetchStatsIntervalId);
        },

        computed: {
            borderClass() {

                if (!this.isLoading && this.isError) {
                    return 'border border-danger';
                }

                return '';
            },

            isHorizonOnline() {
                return this.status === 'running';
            }
        },

        methods: {
            fetchStats() {
                this.isLoading = true;
                this.isError = false;
                Nova.request().get('/horizon/api/stats').then(response => {
                    this.isLoading = false;
                    this.isError = false;
                    this.stat = response.data.processes;
                    this.status = response.data.status;
                }).catch(err => {
                    this.isLoading = false;
                    this.isError = true;
                });
            }
        }
    }
</script>
