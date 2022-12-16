<div x-data="{
    time: new Date(),
    init() {
        setInterval(() => {
            this.time = new Date();
        }, 1000);
    },
    getTime() {
        return moment(this.time).format('DD/MM/YYYY HH:mm:ss')
    },
}" x-init="init()" class="p-2 widget-core-now-client">
    Now: <span x-text="getTime()"></span>
</div>
