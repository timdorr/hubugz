<h2>Tickets</h2>

<p><a href="/tickets/create"><img src="/images/create.png" /></a></p>

<table class="ticketlist">
<tr class="header">
    <th class="left">Subject</th>
    <th>Creator</th>
    <th>Created On</th>
    <th>Updated On</th>
</tr>
{foreach from=$tickets item=t}
<tr>
    <td style="width:500px">
        <a class="title" href="/tickets/show/{$t->number}">{$t->title}</a>
        {foreach from=$t->labels item=l}<span class="label {if $l == 'Bug Report'}bug{elseif $l == 'Feature Request'}feature{/if}">{$l}</span> {/foreach}
        <br />
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
<tr class="spacer"><td colspan="4"></td></tr>
{/foreach}
</table>