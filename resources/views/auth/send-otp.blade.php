@extends('layouts.auth')

@section('content')
    <div class="banner d-flex login-banner">
        <div class="img-part mt-5">
            <img src="{{ asset('images/car.png') }}" alt="">
        </div>
        <div class="form-part">
            <h2 class="mb-3">OTP Verifiaction</h2>
            <p>Sent a verification code to verify your mobile number</p>
            <p class="user-num">Sent to +8801737835825</p>
            <div class="">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                        <section class="">
                                <div class="row">
                                    <div class="col">
                                        <form class="text-center">
                                            <div class="form-group reset-form-group">
                                                <div class="passcode-wrapper">
                                                    <input id="codeBox1" type="number" maxlength="1"
                                                        onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)">
                                                    <input id="codeBox2" type="number" maxlength="1"
                                                        onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)">
                                                    <input id="codeBox3" type="number" maxlength="1"
                                                        onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)">
                                                    <input id="codeBox4" type="number" maxlength="1"
                                                        onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                </form>
                <div class="bottom-part">
                    <p class="text-start">Didn’t get code yet? <a href=""> Resend OTP</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
     function getCodeBoxElement(index) {
            return document.getElementById('codeBox' + index);
        }

        function onKeyUpEvent(index, event) {
            const eventCode = event.which || event.keyCode;
            if (getCodeBoxElement(index).value.length === 1) {
                if (index !== 4) {
                    getCodeBoxElement(index + 1).focus();
                } else {
                    getCodeBoxElement(index).blur();
                    // Submit code
                    console.log('submit code ');
                }
            }
            if (eventCode === 8 && index !== 1) {
                getCodeBoxElement(index - 1).focus();
            }
        }

        function onFocusEvent(index) {
            for (item = 1; item < index; item++) {
                const currentElement = getCodeBoxElement(item);
                if (!currentElement.value) {
                    currentElement.focus();
                    break;
                }
            }
        }
</script>
