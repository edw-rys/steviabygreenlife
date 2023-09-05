<div class="card-header">
    <h4>Compras realizadas</h4>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
        <div class="card-header"><h4 data-toggle="collapse" data-target="#multiCollapseExample2" aria-controls="multiCollapseExample2" class="c-pointer">Filtros</h4></div>

        <div class="card-body collapse {{ request('open_filters') == 'yes' ? 'show' : ''}}" id="multiCollapseExample2">
            <form method="GET" action="{{ route('admin.shopping') }}" class="row" style="margin-bottom: 0;">
            <input type="hidden" value="yes" name="open_filters">
            <div class="col-md-4 col-12">
                <div class="form-group">
                    <label >Desde <span class="required"></span></label>
                    <input type="date" class="form-control" name="start_date" value="{{ request('start_date')}}">
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="form-group">
                    <label >Hasta</label>
                    <input type="date" class="form-control" name="end_date" value="{{ request('end_date')}}">
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="form-group">
                    <label>Estado de entrega</label>
                    <select style="width: 100%" class="select2" name="status_delivery">
                        @foreach ($statusesDelivery as $statusItem)
                            <option value="{{ $statusItem->code }}" {{ request('status_delivery') == $statusItem->code ? 'selected':''}}>{{ $statusItem->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            

            <div class="col-12">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
                            <a href="{{ route('admin.shopping') }}" class="btn btn-warning btn-sm">Restaurar</a>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
    

