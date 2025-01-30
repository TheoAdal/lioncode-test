<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const token = "{{ $token }}"; //taking the token to get the the companies

            fetch("{{ route('companies.show') }}", {
                method: "GET",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                let output = "<h3>Test Companies</h3><ul>";
                data.forEach(company => {
                    output += `
                        <li>
                            ${company.name} |
                            ${company.adress} |
                            ${company.phone}
                        </li>`;
                });
                output += "</ul>";
                document.getElementById("getcompanies").innerHTML = output;
            })
            .catch(error => {
                console.error("Error fetching test companies:", error);
                document.getElementById("getcompanies").innerHTML = "<p>Failed to load data.</p>";
            });
        });
    </script>
</head>
<body>

    <h2>Your API Token</h2>
    <p><strong>{{ $token ? $token : 'No token available.' }}</strong></p>
    <p>You can use this token to access the `TESTCOMPANIES` API.</p>

    <div id="getcompanies">
        <p>Loading test companies...</p>
    </div>
    <form id="logout-form" method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>
