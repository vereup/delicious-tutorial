@if ($message = Session::get('success'))
<div class="alert alert-success m-0 alert-block">
    <div class="d-flex justify-content-between">
    <strong class="testkk">{{ $message }}</strong>
    <button type="button" class="close flashbutton fw-bold fs-5"  data-coreui-dismiss="alert">×</button>
    </div>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger m-0 alert-block">
    <div class="d-flex justify-content-between">
    <strong class="testkk">{{ $message }}</strong>
    <button type="button" class="close flashbutton fw-bold fs-5"  data-coreui-dismiss="alert">×</button>
</div>
</div>
@endif
@if ($message = Session::get('warning'))
<div class="alert alert-warning m-0 alert-block">
    <div class="d-flex justify-content-between">
    <strong>{{ $message }}</strong>
    <button type="button" class="close flashbutton fw-bold fs-5"  data-coreui-dismiss="alert">×</button>
</div>
</div>
@endif
@if ($message = Session::get('info'))
<div class="alert alert-info m-0 alert-block">
    <div class="d-flex justify-content-between">
    <strong>{{ $message }}</strong>
    <button type="button" class="close flashbutton fw-bold fs-5"  data-coreui-dismiss="alert">×</button>
</div>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger m-0">
    <div class="d-flex justify-content-between">
    <strong>{{ $errors->first() }}</strong>
    <button type="button" class="close flashbutton fw-bold fs-5"  data-coreui-dismiss="alert">×</button>
</div>
</div>
@endif