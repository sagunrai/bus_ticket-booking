


  {{--  <script src="{{ asset('backend/') }}"></script>  --}}

  <!-- jquery 3.3.1 -->
  <script src="{{ asset('backend/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>

  <!-- bootstap bundle js -->
  <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>

  <!-- slimscroll js -->
  <script src="{{ asset('backend/assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>

  <!-- main js -->
  {{--  <script src="{{ asset('backend/assets/libs/js/main-js.j') }}"></script>  --}}

  <!-- chart chartist js -->
  {{--  <script src="{{ asset('backend/assets/vendor/charts/chartist-bundle/chartist.min.js') }}"></script>

  <!-- sparkline js -->
  <script src="{{ asset('backend/assets/vendor/charts/sparkline/jquery.sparkline.js') }}"></script>

  <!-- morris js -->
  <script src="{{ asset('backend/assets/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/charts/morris-bundle/morris.js') }}"></script>  --}}

  {{--  <!-- chart c3 js -->
  <script src="{{ asset('backend/assets/vendor/charts/c3charts/c3.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/charts/c3charts/d3-5.4.0.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/charts/c3charts/C3chartjs.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/js/dashboard-ecommerce.js') }}"></script>  --}}

  <script src="{{ asset('backend/assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/datatables/js/data-table.js') }}"></script>

  <script src="{{ asset('backend/assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/js/main-js.js') }}"></script>

  <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>
  {{-- for Post content box --}}
  <script>
    $(document).ready(function() {
        $('#summernote').summernote({
        placeholder: '',
        tabsize: 2,
        height: 450
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

{{-- for image select in post page --}}
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});
</script>

{{-- for Tag in Post page --}}

{{--  <link rel="stylesheet" href="{{ asset('tagjsfiles/tagify.css') }}">  --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
{{--  <script>
    // if IE, add IE tagify's polyfills
    !function( d ) {
        if( !d.currentScript ){
            var s = d.createElement( 'script' );
            s.src = 'tagjsfiles/tagify.polyfills.min.js';
            d.head.appendChild( s );
        }
    }(document)
</script>
<script src="{{ asset('tagjsfiles/jQuery.tagify.min.js') }}"></script>  --}}
{{--  <script data-name="dropdown-tags">
    (function(){

    var input = document.querySelector('input[name="post_tags"]'),
        // init Tagify script on the above inputs
        tagify = new Tagify(input, {
          whitelist: [
            @isset($tagsdata)
            @foreach ($tagsdata as $tagsdt)
              " {{ $tagsdt->name }}",
            @endforeach
            @endisset
            ],
          maxTags: 10,
          dropdown: {
            maxItems: 20,           // <- mixumum allowed rendered suggestions
            classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
            enabled: 0,             // <- show suggestions on focus
            closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
          }
        })
    })()
 </script>  --}}

@yield('scripts')
