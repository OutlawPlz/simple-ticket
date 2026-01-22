<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tickets</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
<div x-data="{
    tickets: [],

    async init() {
        await this.index();
    },

    async index() {
       const response = await axios.get('/api/tickets');

       this.tickets = response.data;
    },

    async update(ticket) {
        await axios.patch(`/api/tickets/${ticket.id}`, { close: true });
    },
}">
    <h1 class="text-3xl font-bold">Tickets</h1>
    <ul class="space-y-3 mt-6">
        <template x-for="ticket in tickets" :key="ticket.id">
            <li>
                <label class="flex gap-1.5 items-baseline">
                    <input type="checkbox" name="" id="">
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
