@extends('layouts.admin')
@section('content')
@can('requested_product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.requested-products.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.requestedProduct.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.requestedProduct.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-RequestedProduct">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.requestedProduct.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.requestedProduct.fields.product') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.requestedProduct.fields.quantity') }}
                        </th>
                        <th>
                            {{ trans('cruds.requestedProduct.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.requestedProduct.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requestedProducts as $key => $requestedProduct)
                        <tr data-entry-id="{{ $requestedProduct->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $requestedProduct->id ?? '' }}
                            </td>
                            <td>
                                {{ $requestedProduct->product->name ?? '' }}
                            </td>
                            <td>
                                {{ $requestedProduct->product->description ?? '' }}
                            </td>
                            <td>
                                {{ $requestedProduct->product->price ?? '' }}
                            </td>
                            <td>
                                {{ $requestedProduct->quantity ?? '' }}
                            </td>
                            <td>
                                {{ $requestedProduct->price ?? '' }}
                            </td>
                            <td>
                                {{ $requestedProduct->name ?? '' }}
                            </td>
                            <td>
                                @can('requested_product_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.requested-products.show', $requestedProduct->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('requested_product_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.requested-products.edit', $requestedProduct->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('requested_product_delete')
                                    <form action="{{ route('admin.requested-products.destroy', $requestedProduct->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('requested_product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.requested-products.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-RequestedProduct:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection