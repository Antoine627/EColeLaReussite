<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 100px;
            max-width: 900px; /* Ajuster la largeur totale */
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

        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2 class="h4 font-weight-bold">Créer un compte</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="registrationForm">
                        @csrf

                        <!-- Nom -->
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                            <div class="error" id="nameError"></div>
                        </div>

                        <!-- Adresse Email -->
                        <div class="form-group">
                            <label for="email">Adresse email</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                            <div class="error" id="emailError"></div>
                        </div>

                        <!-- Mot de passe -->
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                            <div class="error" id="passwordError"></div>
                        </div>

                        <!-- Confirmer le mot de passe -->
                        <div class="form-group">
                            <label for="password_confirmation">Confirmer le mot de passe</label>
                            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <div class="error" id="confirmPasswordError"></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a class="text-muted" href="{{ route('login') }}">
                                Déjà inscrit ?
                            </a>
                            <button type="submit" class="btn btn-primary">
                                S'inscrire
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Fonction de validation des champs
        function validateForm() {
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');

            let valid = true;

            // Validation du nom
            const nameError = document.getElementById('nameError');
            nameError.textContent = '';
            if (nameInput.value.trim() === '') {
                nameError.textContent = 'Le nom est requis.';
                valid = false;
            }

            // Validation de l'email
            const emailError = document.getElementById('emailError');
            emailError.textContent = '';
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(emailInput.value)) {
                emailError.textContent = 'Veuillez entrer une adresse e-mail valide.';
                valid = false;
            }

            // Validation du mot de passe
            const passwordError = document.getElementById('passwordError');
            passwordError.textContent = '';
            if (passwordInput.value.length < 6) {
                passwordError.textContent = 'Le mot de passe doit comporter au moins 6 caractères.';
                valid = false;
            }

            // Validation de la confirmation du mot de passe
            const confirmPasswordError = document.getElementById('confirmPasswordError');
            confirmPasswordError.textContent = '';
            if (confirmPasswordInput.value !== passwordInput.value) {
                confirmPasswordError.textContent = 'Les mots de passe ne correspondent pas.';
                valid = false;
            }

            return valid;
        }

        // Événements pour valider en temps réel
        document.getElementById('name').addEventListener('input', validateForm);
        document.getElementById('email').addEventListener('input', validateForm);
        document.getElementById('password').addEventListener('input', validateForm);
        document.getElementById('password_confirmation').addEventListener('input', validateForm);

        // Validation lors de la soumission du formulaire
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault(); // Empêche la soumission si validation échoue
            }
        });
    </script>
</body>
</html>