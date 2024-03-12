<div class="letter" style="display: flex; justify-content: center; width:100%; text-align: center;">
    <div class="">
        <h1 style="margin-bottom: 20px;">Hi {{$name}}</h1>
        <p style="margin-bottom: 20px;">You registered an account on Linh Phim, before being able to use your account you need to verify that this is your email address by clicking here:</p>
        <div style="width: 100%; display: flex; text-align: center; justify-content: center">
            <a href="{{route('callback_email_verification', ['email' => $email, 'token' => $token])}}" style="width: 100%; text-align: center; margin: 20px 0; padding: 20px 50px; background: #EA4335; color: aliceblue; border-radius: 10px 10px; text-decoration-line: none"><span>Verify my email</span></a>
        </div>
        <p>Thanks - Linh Phim</p>
    </div>
</div>
