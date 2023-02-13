<script>
            @foreach( session('toasts', collect())->toArray() as $toast)
    var options = {
            title: '{{ $toast['title'] }}',
            message: '{{ $toast['message'] }}',
            messageColor: '{{ $toast['messageColor'] }}',
            messageSize: '{{ $toast['messageSize'] }}',
            titleLineHeight: '{{ $toast['titleLineHeight'] }}',
            messageLineHeight: '{{ $toast['messageLineHeight'] }}',
            position: '{{ $toast['position'] }}',
            titleSize: '{{ $toast['titleSize'] }}',
            titleColor: '{{ $toast['titleColor'] }}',
            closeOnClick: '{{ $toast['closeOnClick'] }}',

        };

    var type = '{{  $toast["type"] }}';

    show(type, options);

    @endforeach
    function show(type, options) {
        if (type === 'info'){
            iziToast.info(options);
        }
        else if (type === 'success'){
            iziToast.success(options);
        }
        else if  (type === 'warning'){
            iziToast.warning(options);
        }
        else if (type === 'error'){
            iziToast.error(options);
        } else {
            iziToast.show(options);
        }

    }
</script>

{{--Start Display All Errors--}}
@if($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            "use strict";
            iziToast.error({
                message: "{{ $error }}",
                position: 'topRight'
            });
        </script>
    @endforeach
@endif
{{--End Display All Errors--}}


{{ session()->forget('toasts') }}
