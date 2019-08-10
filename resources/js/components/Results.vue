<template>
    <div class="card mt-5">
            
                <div class="card-header">Previous Matches</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @isset($prevMatches)
                            @if(sizeof($prevMatches) != 0)
                                @foreach($prevMatches as $prevMatch)

                                <div class="row py-2">
                                    <div class="col-3 mx-auto">
                                        <img src="{{ $prevMatch->homeEmblem }}" alt="{{ $prevMatch->homeTeam }}">
                                    </div>
                                    <div class="col-6 mx-auto my-auto text-center">
                                        <h1 style="display: inline;">{{ $prevMatch->homegoals }} - </h1>
                                        <h1 style="display: inline;">{{ $prevMatch->awayGoals }}</h1>

                                        @isset($predictions)
                                            <table>
                                            @foreach($predictions[  $prevMatch->id  - 1] as $prediction)
                                            <tr>
                                                <td style="text-align:right">
                                                    <small>{{ $users[$prediction->userID - 1]->name }}</small>
                                                </td>
                                                <td>
                                                    <small>{{ $prediction->homeGoals }} - {{ $prediction->awayGoals }}</small>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </table>
                                        @endisset

                                    </div>
                                    <div class="col-3 mx-auto">
                                        <img src="{{ $prevMatch->awayEmblem }}" alt="{{ $prevMatch->awayTeam }}">
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        @endisset
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Results Component mounted.')
        }
    }
</script>
