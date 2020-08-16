<div>
    <p>Here you!</p>
    <p>
        Get your predictions in pronto; The first game starts today at {{ $firstKickoff }}.
    </p>

    <br /> 

    <p>
        Get yourself involved at  
        <a href="https://predictorleague.x4iiiis.com/" target="_blank">predictorleague.x4iiiis.com</a>. 
    </p>

    <br />

    <table class="table">
    @foreach ($matches as $match)
        <tr>
            <td>{{ $match->kickoff }}</td>
            <td>{{ $match->homeTeam }}</td>
            <td> vs </td>
            <td>{{ $match->awayTeam }}</td>
        </tr>
    @endforeach
    </table>
</div>