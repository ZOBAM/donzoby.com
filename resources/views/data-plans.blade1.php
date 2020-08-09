<div class="row d-none" id="display-data-plans">
</div>

<div class="row d-none" id="notification-div">
    <div class="col-sm-8 offset-sm-2" style="border: 3px double rgb(240, 53, 40);">
        <p id="notification-text" class="text-center" style="margin: 0px;padding:0.9em 0px;"></p>
    </div>
</div>
<h3 class="text-center">Add A New Data Plan To The Database</h3>
<form method="POST" action="/member/data-plan/edit/94" id="data-plan-form">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-6 form-group">
            <label for="provider">Network Provider:</label>
            <select class="form-control form-control-sm" name="provider" id="provider" required>
                <option value="">Enter Network Provider</option>
                <option value="9mobile">9mobile</option>
                <option value="airtel">Airtel</option>
                <option value="glo">GLO</option>
                <option value="mtn">MTN</option>
            </select>
        </div>
        <div class="col-sm-6 form-group">
            <label for="plan_title">Data Plan Title:</label>
            <input type="text" class="form-control form-control-sm" name="title" placeholder="Enter Data Plan Title" id="plan_title" required>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 form-group">
            <label for="volume">Data Volume (eg. 500MB,2GB etc):</label>
            <input type="text" class="form-control form-control-sm" name="volume" list="volume" placeholder="Enter Data Plan Volume" required>
                <datalist id="volume">
                <option value="25mb">
                <option value="27mb">
                <option value="75mb">
                <option value="90mb">
                <option value="100mb">
                <option value="200mb">
                <option value="250mb">
                <option value="340mb">
                <option value="350mb">
                <option value="500mb">
                <option value="750mb">
                <option value="1gb">
                <option value="2GB">
                <option value="2.3GB">
                <option value="2.5GB">
                <option value="3.5GB">
                <option value="3.75GB">
                <option value="4.5GB">
                <option value="5gb">
                <option value="5.25GB">
                <option value="6GB">
                <option value="7GB">
                <option value="8GB">
                <option value="9GB">
                <option value="12GB">
                <option value="16.5GB">
                <option value="25GB">
                <option value="42GB">
                <option value="78GB">
                <option value="100GB">
                <option value="115GB">
            </datalist>
        </div>
        <div class="col-sm-6 form-group">
            <label for="data_price">Data Price:</label>
            <input type="text" class="form-control form-control-sm" placeholder="Enter Data Plan Price" name="price" id="data_price" required>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 form-group">
            <label for="bonus_all">Bonus For All (eg. 500MB,2GB etc):</label>
            <input type="text" class="form-control form-control-sm" name="bonus_all" placeholder="Enter Data Plan Bonus" list="bonus_all">
            <datalist id="bonus_all">
                <option value="25mb">
                <option value="27mb">
                <option value="75mb">
                <option value="90mb">
                <option value="100mb">
                <option value="200mb">
                <option value="250mb">
                <option value="340mb">
                <option value="350mb">
                <option value="500mb">
                <option value="750mb">
                <option value="1gb">
                <option value="2GB">
                <option value="2.3GB">
                <option value="2.5GB">
                <option value="3.5GB">
                <option value="3.75GB">
                <option value="4.5GB">
                <option value="5gb">
                <option value="5.25GB">
                <option value="6GB">
                <option value="7GB">
                <option value="8GB">
                <option value="9GB">
                <option value="12GB">
                <option value="16.5GB">
                <option value="25GB">
            </datalist>
        </div>
        <div class="col-sm-6 form-group">
            <label for="bonus_new_sim">Bonus For New Users (eg. 500MB,2GB etc):</label>
            <input type="text" class="form-control form-control-sm" name="bonus_new_sim" placeholder="Enter Data Plan Bonus for new users" list="bonus_new_sim">
            <datalist id="bonus_new_sim">
                <option value="25mb">
                <option value="27mb">
                <option value="75mb">
                <option value="90mb">
                <option value="100mb">
                <option value="200mb">
                <option value="250mb">
                <option value="340mb">
                <option value="350mb">
                <option value="500mb">
                <option value="750mb">
                <option value="1gb">
                <option value="2GB">
                <option value="2.3GB">
                <option value="2.5GB">
                <option value="3.5GB">
                <option value="3.75GB">
                <option value="4.5GB">
                <option value="5gb">
                <option value="5.25GB">
                <option value="6GB">
                <option value="7GB">
                <option value="8GB">
                <option value="9GB">
                <option value="12GB">
                <option value="16.5GB">
                <option value="25GB">
            </datalist>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 form-group">
            <label for="validity">Data Validity Period:</label>
            <input type="text" class="form-control form-control-sm" name="validity" list="validity" placeholder="Enter Validity Period" required>
            <datalist id="validity">
                <option value="24hrs">
                <option value="2days">
                <option value="5days">
                <option value="7days">
                <option value="14days">
                <option value="30days">
                <option value="60days">
                <option value="90days">
                <option value="365days">
            </datalist>
        </div>
        <div class="col-sm-6 form-group">
            <label for="use_period">Data Use Period:</label>
            <select class="form-control form-control-sm" name="use_period" id="use_period">
                <option value="anytime">Anytime </option>
                <option value="weekend">Weekend (Sat & Sun)</option>
                <option value="evening">Evening (9pm upwards)</option>
                <option value="night">Night (12midnight till dawn)</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 form-group">
            <label for="how_to_sub">How To Subscribe:</label>
            <textarea class="form-control form-control-sm" name="how_to_sub" id="validity" required></textarea>
        </div>
        <div class="col-sm-6 form-group">
            <label for="description">Data Plan Description (Extra Details):</label>
            <textarea class="form-control form-control-sm" name="description" id="description"></textarea>
        </div>
    </div>
    <div class="row">
        <input type="submit" value="Save Data Plan" class="btn-success col-md-4 offset-md-4" >
    </div>
</form>
@if($errors->any())
<ul>
  @foreach ($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach
</ul>
@endif

@section('bottomLinks')
<script src="{{asset('js/data-plan.js')}}"  type="text/javascript" defer></script>
<script>
</script>
@endsection
