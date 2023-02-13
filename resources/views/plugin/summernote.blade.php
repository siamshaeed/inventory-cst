
{{--<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $("#my_summernote").summernote({
            height: 250,   //set editable area's height
        });
        $('.dropdown-toggle').dropdown();
    });
</script>
