<dataplan-component></dataplan-component>
@if($errors->any())
<ul>
  @foreach ($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach
</ul>
@endif

@section('bottomLinks')
<script>
</script>
@endsection
