<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            {{__('form.FilterForm')}}
        </div>
        <div class="card-body">
            <form method="GET">
                <div class="row mb-2">
                    <label for="InitialDate" class="col-sm-4 col-form-label col-form-label-sm">{{__('common.InitialDate')}}</label>
                    <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                    <div class="col-sm-6">
                        <input type="date" name="InitialDate" class="form-control form-control-sm " id="colFormLabelSm" value="@if(isset($_GET['InitialDate'])){{$_GET['InitialDate']}}@endif" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="EndDate" class="col-sm-4 col-form-label col-form-label-sm">{{__('common.EndDate')}}</label>
                    <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                    <div class="col-sm-6">
                        <input type="date" name="EndDate" class="form-control form-control-sm " id="colFormLabelSm" value="@if(isset($_GET['EndDate'])){{$_GET['EndDate']}}@endif" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="TotalTray" class="col-sm-4 col-form-label col-form-label-sm">{{__('common.TotalTray')}}</label>
                    <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                    <div class="col-sm-2">
                        <select name="TotalTrayOperator" class="form-control">
                            <option value=">">></option>
                            <option value="<"><</option>
                            <option value="=">=</option>
                            @if(isset($_GET['TotalTrayOperator']))
                            <option value="{{$_GET['TotalTrayOperator']}}" selected>{{$_GET['TotalTrayOperator']}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="TotalTrayNumber" placeholder="Number" class="form-control" value="@if(isset($_GET['TotalTrayNumber'])){{$_GET['TotalTrayNumber']}}@endif">
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="UnderIncubation" class="col-sm-4 col-form-label col-form-label-sm">{{__('common.UnderIncubation')}}</label>
                    <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                    <div class="col-sm-2">
                        <select name="UnderIncubationOperator" class="form-control">
                            <option value=">">></option>
                            <option value="<"><</option>
                            <option value="=">=</option>
                            @if(isset($_GET['UnderIncubationOperator']))
                            <option value="{{$_GET['UnderIncubationOperator']}}" selected>{{$_GET['UnderIncubationOperator']}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="UnderIncubationNumber" placeholder="Number" class="form-control" value="@if(isset($_GET['UnderIncubationNumber'])){{$_GET['UnderIncubationNumber']}}@endif">
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="Contamination" class="col-sm-4 col-form-label col-form-label-sm">{{__('common.Contamination')}}</label>
                    <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                    <div class="col-sm-2">
                        <select name="ContaminationOperator" class="form-control">
                            <option value=">">></option>
                            <option value="<"><</option>
                            <option value="=">=</option>
                            @if(isset($_GET['ContaminationOperator']))
                            <option value="{{$_GET['ContaminationOperator']}}" selected>{{$_GET['ContaminationOperator']}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="ContaminationNumber" placeholder="Number" class="form-control" value="@if(isset($_GET['ContaminationNumber'])){{$_GET['ContaminationNumber']}}@endif">
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="Harvest" class="col-sm-4 col-form-label col-form-label-sm">{{__('common.Harvest')}}</label>
                    <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                    <div class="col-sm-2">
                        <select name="HarvestOperator" class="form-control">
                            <option value=">">></option>
                            <option value="<"><</option>
                            <option value="=">=</option>
                            @if(isset($_GET['HarvestOperator']))
                            <option value="{{$_GET['HarvestOperator']}}" selected>{{$_GET['HarvestOperator']}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="HarvestNumber" placeholder="Number" class="form-control" value="@if(isset($_GET['HarvestNumber'])){{$_GET['HarvestNumber']}}@endif">
                    </div>
                </div>
                <input type="submit" name="filter" class="btn btn-primary">
            </form>
        </div>
    </div>    
</div>