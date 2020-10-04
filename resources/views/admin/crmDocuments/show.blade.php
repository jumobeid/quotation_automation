@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.crmDocument.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crm-documents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.crmDocument.fields.id') }}
                        </th>
                        <td>
                            {{ $crmDocument->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmDocument.fields.customer') }}
                        </th>
                        <td>
                            {{ $crmDocument->customer->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmDocument.fields.document_file') }}
                        </th>
                        <td>
                            @if($crmDocument->document_file)
                                <a href="{{ $crmDocument->document_file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmDocument.fields.name') }}
                        </th>
                        <td>
                            {{ $crmDocument->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmDocument.fields.description') }}
                        </th>
                        <td>
                            {{ $crmDocument->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmDocument.fields.requested_products') }}
                        </th>
                        <td>
                            @foreach($crmDocument->requested_products as $key => $requested_products)
                                <span class="label label-info">{{ $requested_products->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmDocument.fields.quotation_request_date') }}
                        </th>
                        <td>
                            {{ $crmDocument->quotation_request_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmDocument.fields.department_name') }}
                        </th>
                        <td>
                            {{ $crmDocument->department_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmDocument.fields.quotation_is_signed') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $crmDocument->quotation_is_signed ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crmDocument.fields.quotation_is_new') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $crmDocument->quotation_is_new ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crm-documents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection