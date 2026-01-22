<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tickets</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        axios.defaults.headers.common['X-API-Secret'] = '{{ config('app.api_secret') }}';
        axios.defaults.headers.common['Accept'] = 'application/json';
    </script>
</head>
<body>
<div x-data="{
    tickets: [],

    get openTickets() {
        return this.tickets.filter(
            (ticket) => ticket.status === 'open'
        )
    },

    get closedTickets() {
        return this.tickets.filter(
            (ticket) => ticket.status === 'closed'
        )
    },

    async init() {
        await this.index();
    },

    async index() {
       const response = await axios.get('/api/tickets');

       this.tickets = response.data;
    },

    async update(ticket, status) {
        await axios
            .patch(`/api/tickets/${ticket.id}`, { status })
            .then(() => this.index());
    },
}" class="m-6">
    <h1 class="text-3xl font-bold">Tickets</h1>
    <ul class="space-y-3 mt-6">
        <template x-for="ticket in openTickets" :key="ticket.id">
            <li>
                <label class="flex gap-1.5 items-baseline">
                    <input
                        type="checkbox"
                        :checked="ticket.status === 'closed'"
                        x-on:change="update(ticket, $event.target.checked ? 'closed' : 'open')"
                    >
                    <div>
                        <span x-text="ticket.title" class="font-bold"></span> <br>
                        <span x-text="ticket.message"></span>
                    </div>
                </label>
            </li>
        </template>
    </ul>

    <h2 class="text-2xl font-bold mt-8">Closed</h2>
    <ul class="space-y-3 mt-4">
        <template x-for="ticket in closedTickets" :key="ticket.id">
            <li class="line-through">
                <label class="flex gap-1.5 items-baseline">
                    <input
                        disabled
                        type="checkbox"
                        :checked="ticket.status === 'closed'"
                        x-on:change="update(ticket, $event.target.checked ? 'closed' : 'open')"
                    >
                    <div>
                        <span x-text="ticket.title" class="font-bold"></span> <br>
                        <span x-text="ticket.message"></span>
                    </div>
                </label>
            </li>
        </template>
    </ul>
</div>
</body>
</html>
