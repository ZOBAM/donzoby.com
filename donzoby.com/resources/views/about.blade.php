@extends('layouts/master')
@section('title')About Donzoby.com
@stop

@section('displayImage')
    @parent
@endsection

@section('mainContent')
<div class='container-fluid' id='main-content'>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="donzoby-info">
                <h1>About Donzoby.com</h1>
    <p>
        Donzoby.com is long held vision birthed by the grace of God for the furtherance of godly knowledge in the world of computers.</p>
        <p>We exist to minimize or eliminate where possible and when possible the stress and pain everyone else have to undergo in other to know what we have known in dealing with the computer system over the years.</p>
<p>Holding very close to our hearts the pains (and sometimes needless pains) we went through to learn certain computer and ICT skills that were supposed to be easy, we are ever the more determined to remove every huddles on the path of timely knowledge transfer in this sector.</p>
<p>Added to what we do online is our Computer Literacy Outreach Program tagged: Light Up Your World. Within this scheme, we visit communities, villages, and just any organized set of individuals that want to be trained on the use of computer for solving everyday problems. This training could be either greatly subsidized or completely free depending on the arrangement we have with the organizers.</p>
<p>For more information, visit our Light Up Your World page and also our Services Page.</p>



        <h4 class="text-info">Our pain in learning have taught us to be kind in teaching!</h4>
            </div>
        </div>
    </div>

</div><!--main-content-->
@endsection

@section('bottomLinks')
<script src="{{asset('public/js/lga.js')}}" type="text/javascript"></script>
@endsection
