@if(session('success'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{ session("success") }}
            </div>
        </div>
    </div>
@endif
@if((session("error")))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{ session("error") }}
            </div>
        </div>
    </div>
@endif
@if((session("warning")))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{ session("warning") }}
            </div>
        </div>
    </div>
@endif