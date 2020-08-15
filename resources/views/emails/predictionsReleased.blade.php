<div>
    <p>
        Haw!
    </p>
    <p>
        New fixtures have just been released.
    </p>

    <br />
    
    <p>The first game starts at {{ $firstKickoff }}.</p>
    <p>
        Get yourself involved at  
        <a href="https://predictorleague.x4iiiis.com/" target="_blank">predictorleague.x4iiiis.com</a>. 
    </p>

    <br />
    
    <table>
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