
<div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
    <form action="/downloadDocument" method="POST" >
        @csrf
        <h2>Public Holidays South Africa</h2>

        <br/>

        @foreach($holidays as $holiday)
            <ul class="list-group" id="holiday_list">
                <li class="list-group-item">{{$holiday->date}} - {{$holiday->name}}</li>
            </ul>
        @endforeach
    </form>
</div>
