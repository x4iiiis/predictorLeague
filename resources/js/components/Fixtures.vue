<template>
    <div class="card">
            
                <div class="card-header">Upcoming Matches</div>
                    <!--
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('prediction.store') }}" method="post">
                        @csrf

                        @isset($matches)
                            @if(sizeof($matches) != 0)
                                @foreach($matches as $match)
                                <div class="row py-2">
                                    <div class="col-3 mx-auto">
                                        <img src="{{ $match->homeEmblem }}" alt="{{ $match->homeTeam }}">
                                    </div>
                                    <div class="form-group col-6 my-auto mx-auto text-center">
                                        <input class="col-5" name="home{{ $match->id }}" required type="number"></input>
                                        <input class="col-5" name="away{{ $match->id }}" required type="number"></input>
                                    </div>
                                    <div class="col-3 mx-auto">
                                        <img src="{{ $match->awayEmblem }}" alt="{{ $match->awayTeam }}">
                                    </div>
                                </div>
                                @endforeach
                                <div class="text-center">
                                    <button class="btn btn-lg btn-primary mx-auto" type="submit">Submit</button>
                                </div>
                            @endif
                        @endisset
                        </form>
                    </div>
                    -->
                </div>
            </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Fixtures Component mounted.')
        }
    }
</script>
