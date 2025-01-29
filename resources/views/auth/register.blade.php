<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>

<body>
    <h1>Register Page</h1>
    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <div>
            <label for="name" class="">
                Name
            </label>
            <input type="name" name="name" id="name-input" class="" placeholder="Name">
            @error('name')
                <span class="text-red-500" text=sm>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="name" class="">
                Email
            </label>
            <input type="email" name="email" id="email-input" class="" placeholder="Email">
            @error('email')
                <span class="text-red-500" text=sm>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="password" class="">
                Password
            </label>
            <input type="password" name="password" id="password-input" class="" placeholder="Password">
            @error('password')
                <span class="text-red-500" text=sm>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="password" class="">
                Password Confirmation
            </label>
            <input type="password" name="password_confirmation" id="password-confirmation-input" class=""
                placeholder="Repeat password">
            @error('password_confirmation')
                <span class="text-red-500" text=sm>{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="">
            Register
        </button>
    </form>
</body>


</html>
