<div id="MyleaSummaryTitle">
    <h2>{{__('common.Summary')}}</h2>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table width="100%"  style="font-size: 1.0rem;">
                    <tr>
                        <td width="50%">{{__('common.TotalMyleaIncubation')}}</td>
                        <td width="5%">:</td>
                        <td width="17%">{{$Data->sum('InStock')}}</td>
                        <td>{{__('common.Pieces')}}</td>
                    </tr>
                    <tr>
                        <td>{{__('common.Total')}} {{__('common.Harvest')}}</td>
                        <td>:</td>
                        <td>{{$Data->sum('TotalHarvest')}}</td>
                        <td>{{__('common.Pieces')}}</td>
                    </tr>

                    <tr>
                        <td>{{__('common.Total')}} {{__('common.RemainingHarvest')}}</td>
                        <td>:</td>
                        <td>{{$Data->sum('RemainingHarvest')}}</td>
                        <td>{{__('common.Pieces')}}</td>
                    </tr>
                    <tr>
                        <td>{{__('common.TotalTray')}}</td>
                        <td>:</td>
                        <td>{{$Data->sum('TotalTray')}}</td>
                        <td>{{__('common.Pieces')}}</td>
                    </tr>
                    <tr>
                        <td>{{__('common.TotalFinishGood')}}</td>
                        <td>:</td>
                        <td> {{ $TotalFinishGood }}</td>
                        <td>{{__('common.Pieces')}}</td>
                    </tr>
                    <tr>
                        <td>{{__('common.Contamination')}}</td>
                        <td>:</td>
                        <td>{{$Data->sum('TotalContamination')}}</td>
                        <td>{{__('common.Pieces')}}</td>
                    </tr>
                    <tr>
                        <td>{{__('common.ContaminationRate')}}</td>
                        <td>:</td>
                        <td>@if($Data->sum('TotalTray')){{round($Data->sum('TotalContamination')/$Data->sum('TotalTray')*100, 2)}}@endif</td>
                        <td>%</td>
                    </tr>
                </table>
            </div>
        </div>            
    </div>
</div>