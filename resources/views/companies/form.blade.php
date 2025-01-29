<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST COMPANIES</title>
</head>
<body>
    <h1>COMPANY FORM PAGE</h1>
    <form action="{{ route('companies.store') }}" method="POST">
        @csrf
        <div>
            <label for="name" class="">
                Name
            </label>
            <input type="name" name="name" id="name-input" class="" placeholder="Name">
        </div>
        <div>
            <label for="adress" class="">
                Adress
            </label>
            <input type="adress" name="adress" id="adress-input" class="" placeholder="Adress">
        </div>
        <div>
            <label for="phone" class="">
                Phone
            </label>
            <input type="phone" name="phone" id="phone-input" class="" placeholder="Phone">
        </div>
        
        <button type="submit" class="">
            Register
        </button>
    </form>
</body>
</html>