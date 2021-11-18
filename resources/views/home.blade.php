@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col">
            <flash message=""></flash>
            <projects  :projects="{{ json_encode($projects) }}"></projects>
          
        </div>
    </div>
</div>
@endsection

    <script>
       var my_total = {!! json_encode($totaltimes) !!};
          
    </script>


