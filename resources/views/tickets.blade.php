<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tickets</title>

    <script defer src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
<div x-data="{
    tickets: [],

    async index() {
       const response = await axios.get('/api/tickets');

       this.tickets = response.data;
    }

    async update(ticket) {
        await axios.patch('/api/tickets/${ticket.id}', { close: true })
    }
}">
    <h1>Tickets</h1>
    <ul>
        <li x-for="ticket in tickets" :key="ticket.id">
            <span x-text="ticket.title"></span> <br>
            <span x-text="ticket.message"></span>
        </li>
    </ul>
</div>
</body>
</html>
