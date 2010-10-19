<h2>Tickets</h2>

<p><a href="/tickets/new"><img src="/images/create.png" /></a></p>

<table class="ticketlist">
<tr class="header">
    <th class="left">Subject</th>
    <th>Creator</th>
    <th>Created On</th>
    <th>Updated On</th>
</tr>
{foreach from=$tickets item=t}
<tr>
    <td>
        <a href="/tickets/show/{$t->number}">{$t->title}</a><br />
        <span>{$t->body|truncate:100}</span>
    </td>
    <td class="center">
        {$t->user}
    </td>
    <td class="center">
        {$t->created_at}
    </td>
    <td class="center">
        {$t->updated_at}
    </td>
</tr>
{/foreach}
</table>