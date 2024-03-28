<div id="customAlert" class="{{isset($type) ? $type : ''}} custom-alert fixed z-50 bottom-10 right-0 py-4 px-8">
    <span id="alertMessage" class="alert-message">{{isset($message) ? $message : ''}}</span>
</div>
@if (isset($type))
    <script>
        $(document).ready(function () {
            var alertElement = $('#customAlert');
            var alertMessage = $('#alertMessage');

            alertElement.fadeIn(function() {
                alertElement.delay(2000).fadeOut();
            });
            
        });
    </script>
@endif
