<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e9ecef;
        }
        .container {
            max-width: 900px; /* Ajuster la largeur totale */
            margin-top: 100px;
            border-radius: 12px;
            overflow: hidden; /* Pour éviter les débordements */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .login-form {
            padding: 30px;
            background: white;
        }
        h2 {
            font-size: 24px;
            font-weight: 700;
            color: #343a40;
            margin-bottom: 20px;
        }
        .alert {
            margin-bottom: 20px;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
        }
        .text-center a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
        .text-center a:hover {
            color: #0056b3;
        }
        .image-container {
            background: url('{{ asset('images/1.png') }}') no-repeat center center;
            background-size: cover; /* Pour couvrir tout l'espace */
            height: 100%; /* Hauteur de l'image */
        }
        .image-section {
            flex: 1; /* Prend la moitié de l'espace disponible */
        }
        .form-section {
            flex: 1; /* Prend l'autre moitié de l'espace disponible */
        }
        .error {
            color: red;
            font-size: 0.85em;
        }
    </style>
</head>
<body>
    <div class="container d-flex">
        <div class="image-section">
            <div class="image-container">
                <img src="{{ asset('images/1.png') }}" alt="">
            </div>
        </div>

        <div class="form-section login-form">
            <h2>Connexion</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf
                <div class="form-group">
                    <label for="email">Adresse e-mail :</label>
                    <input type="email" name="email" id="email" class="form-control" required autofocus placeholder="exemple@domaine.com">
                    <div class="error" id="emailError"></div>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="Votre mot de passe">
                    <div class="error" id="passwordError"></div>
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
            <div class="text-center mt-3">
                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                <br>
                <a href="{{ route('register') }}">S'inscrire</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function validateEmail() {
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex pour une validation d'email simple
            
            if (emailInput.value === '') {
                emailError.textContent = '';
            } else if (!emailPattern.test(emailInput.value)) {
                emailError.textContent = 'Veuillez entrer une adresse e-mail valide.';
            } else {
                emailError.textContent = '';
            }
        }

        function validatePassword() {
            const passwordInput = document.getElementById('password');
            const passwordError = document.getElementById('passwordError');
            
            if (passwordInput.value === '') {
                passwordError.textContent = '';
            } else if (passwordInput.value.length < 6) {
                passwordError.textContent = 'Le mot de passe doit comporter au moins 6 caractères.';
            } else {
                passwordError.textContent = '';
            }
        }

        document.getElementById('email').addEventListener('input', validateEmail);
        document.getElementById('password').addEventListener('input', validatePassword);
    </script>
</body>
</html>