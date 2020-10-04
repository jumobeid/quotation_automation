@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.crmDocument.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.crm-documents.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="customer_id">{{ trans('cruds.crmDocument.fields.customer') }}</label>
                <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id" required>
                    @foreach($customers as $id => $customer)
                        <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $customer }}</option>
                    @endforeach
                </select>
                @if($errors->has('customer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmDocument.fields.customer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="document_file">{{ trans('cruds.crmDocument.fields.document_file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('document_file') ? 'is-invalid' : '' }}" id="document_file-dropzone">
                </div>
                @if($errors->has('document_file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('document_file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmDocument.fields.document_file_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.crmDocument.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmDocument.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.crmDocument.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmDocument.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="requested_products">{{ trans('cruds.crmDocument.fields.requested_products') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('requested_products') ? 'is-invalid' : '' }}" name="requested_products[]" id="requested_products" multiple required>
                    @foreach($requested_products as $id => $requested_products)
                        <option value="{{ $id }}" {{ in_array($id, old('requested_products', [])) ? 'selected' : '' }}>{{ $requested_products }}</option>
                    @endforeach
                </select>
                @if($errors->has('requested_products'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requested_products') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmDocument.fields.requested_products_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quotation_request_date">{{ trans('cruds.crmDocument.fields.quotation_request_date') }}</label>
                <input class="form-control date {{ $errors->has('quotation_request_date') ? 'is-invalid' : '' }}" type="text" name="quotation_request_date" id="quotation_request_date" value="{{ old('quotation_request_date') }}" required>
                @if($errors->has('quotation_request_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quotation_request_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmDocument.fields.quotation_request_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="department_name">{{ trans('cruds.crmDocument.fields.department_name') }}</label>
                <input class="form-control {{ $errors->has('department_name') ? 'is-invalid' : '' }}" type="text" name="department_name" id="department_name" value="{{ old('department_name', '') }}" required>
                @if($errors->has('department_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmDocument.fields.department_name_helper') }}</span>
            </div>
            @can('quotation_is_signed')
            <div class="form-group">
                <div class="form-check {{ $errors->has('quotation_is_signed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="quotation_is_signed" value="0">
                    <input class="form-check-input" type="checkbox" name="quotation_is_signed" id="quotation_is_signed" value="1" {{ old('quotation_is_signed', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="quotation_is_signed">{{ trans('cruds.crmDocument.fields.quotation_is_signed') }}</label>
                </div>
               
                @if($errors->has('quotation_is_signed'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quotation_is_signed') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmDocument.fields.quotation_is_signed_helper') }}</span>
            </div>
            @endcan
            @can('quotation_is_new')
            <div class="form-group">
                <div class="form-check {{ $errors->has('quotation_is_new') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="quotation_is_new" id="quotation_is_new" value="1" required {{ old('quotation_is_new', 0) == 1 || old('quotation_is_new') === null ? 'checked' : '' }}>
                    <label class="required form-check-label" for="quotation_is_new">{{ trans('cruds.crmDocument.fields.quotation_is_new') }}</label>
                </div>
                @if($errors->has('quotation_is_new'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quotation_is_new') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crmDocument.fields.quotation_is_new_helper') }}</span>
            </div>
            @endcan
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.documentFileDropzone = {
    url: '{{ route('admin.crm-documents.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="document_file"]').remove()
      $('form').append('<input type="hidden" name="document_file" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="document_file"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($crmDocument) && $crmDocument->document_file)
      var file = {!! json_encode($crmDocument->document_file) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="document_file" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection