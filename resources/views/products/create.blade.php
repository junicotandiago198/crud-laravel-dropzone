@extends('layout')

@section('title')
   Create product
@endsection

@section('content')
   <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
         <label class="form-label">Name</label>
         <input name="name" type="text" class="form-control">
      </div>
      <div class="mb-3">
         <label class="form-label">Description</label>
         <textarea name="description" class="form-control" rows="3"></textarea>
      </div>

      <div class="mb-3">
         <label for="document">Photo</label>
         <div class="needsclick dropzone" id="document-dropzone">

         </div>
      </div>
      <div>
         <input class="btn btn-primary" type="submit">
         <a class="btn btn-danger" href="{{ route('products.index') }}">Back</a>
      </div>
   </form>
@endsection

@push('script-internal')
   <script>
      var uploadedDocumentMap = {}
      Dropzone.options.documentDropzone = {
         url: '{{ route('products.storeMedia') }}',
         maxFilesize: 2, // MB
         addRemoveLinks: true,
         acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
         headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
         },
         success: function(file, response) {
            $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
         },
         removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
               name = file.file_name
            } else {
               name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
         }
      }
   </script>
@endpush
