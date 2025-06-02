<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Furniture Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" type="png" href="images/fs.png">
    <style>
        :root {
            --primary-color: #4a6b57;
            --secondary-color: #f8f1e9;
            --accent-color: #d4a762;
            --text-color: #333;
            --light-text: #777;
            --error-color: #e74c3c;
            --success-color: #2ecc71;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: var(--text-color);
            line-height: 1.6;
        }

        .auth-container {
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 1;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header h2 {
            color: var(--primary-color);
            font-size: 28px;
            margin-bottom: 10px;
        }

        .auth-header p {
            color: var(--light-text);
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-color);
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-group input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(74, 107, 87, 0.2);
            outline: none;
        }

        .password-input {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--light-text);
            cursor: pointer;
            padding: 5px;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .remember-me input {
            margin-right: 8px;
            cursor: pointer;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }

        .auth-btn {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 20px;
        }

        .auth-btn:hover {
            background-color: #3a5746;
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            color: var(--light-text);
            font-size: 14px;
        }

        .auth-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .auth-footer a:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }

        .auth-social {
            margin-top: 30px;
            text-align: center;
        }

        .auth-social p {
            color: var(--light-text);
            margin-bottom: 15px;
            font-size: 14px;
            position: relative;
        }

        .auth-social p::before,
        .auth-social p::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background-color: #ddd;
        }

        .auth-social p::before {
            left: 0;
        }

        .auth-social p::after {
            right: 0;
        }

        .social-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            max-width: 150px;
        }

        .social-btn:hover {
            background-color: #f9f9f9;
        }

        .social-btn.google {
            color: #db4437;
        }

        .social-btn.facebook {
            color: #4267B2;
        }

        .auth-image {
            display: none;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 5px;
            color: white;
            font-weight: 500;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            transform: translateY(-100px);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .notification.show {
            transform: translateY(0);
            opacity: 1;
        }

        .notification.success {
            background-color: var(--success-color);
        }

        .notification.error {
            background-color: var(--error-color);
        }

        .input-error {
            border-color: var(--error-color) !important;
        }

        .error-message {
            color: var(--error-color);
            font-size: 13px;
            margin-top: 5px;
            display: none;
        }

        @media (min-width: 992px) {
            .auth-container {
                padding: 40px;
            }

            .auth-image {
                display: block;
                width: 50%;
                max-width: 600px;
                margin-left: 50px;
            }

            .auth-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 10px;
                box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1);
            }
        }

        @media (max-width: 576px) {
            .auth-card {
                padding: 30px 20px;
            }

            .social-buttons {
                flex-direction: column;
            }

            .social-btn {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Auth Container -->
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <img src="images/fs.png" alt="Furniture Store Logo" width="60" style="margin-bottom: 15px;">
                <h2>Masuk ke Akun Anda</h2>
                <p>Silakan masuk untuk melanjutkan belanja</p>
            </div>
            
            <form id="login-form" class="auth-form" novalidate>
                <div class="form-group">
                    <label for="username">Username atau Email</label>
                    <input type="text" id="username" required>
                    <div class="error-message" id="username-error">Username/email harus diisi</div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-input">
                        <input type="password" id="password" required minlength="6">
                        <button type="button" class="toggle-password" aria-label="Toggle password visibility">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="error-message" id="password-error">Password harus diisi (minimal 6 karakter)</div>
                </div>
                
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" id="remember" checked>
                        <span>Ingat saya</span>
                    </label>
                    <a href="forgot-password.html" class="forgot-password">Lupa password?</a>
                </div>
                
                <button type="submit" class="auth-btn">
                    <span id="btn-text">Masuk</span>
                    <div id="btn-loader" class="loader" style="display: none;"></div>
                </button>
                
                <div class="auth-footer">
                    <p>Belum punya akun? <a href="register.html">Daftar sekarang</a></p>
                </div>
            </form>
            
            <div class="auth-social">
                <p>Atau masuk dengan</p>
                <div class="social-buttons">
                    <button type="button" class="social-btn google">
                        <i class="fab fa-google"></i> Google
                    </button>
                    <button type="button" class="social-btn facebook">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </button>
                </div>
            </div>
        </div>
        
        
    </div>

    <div id="notification" class="notification"></div>

    <script>
        // Toggle password visibility
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
                this.setAttribute('aria-label', 'Sembunyikan password');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
                this.setAttribute('aria-label', 'Tampilkan password');
            }
        });
        
        // Form validation
        function validateForm() {
            let isValid = true;
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            const usernameError = document.getElementById('username-error');
            const passwordError = document.getElementById('password-error');
            
            // Reset errors
            username.classList.remove('input-error');
            password.classList.remove('input-error');
            usernameError.style.display = 'none';
            passwordError.style.display = 'none';
            
            // Validate username
            if (username.value.trim() === '') {
                username.classList.add('input-error');
                usernameError.style.display = 'block';
                isValid = false;
            }
            
            // Validate password
            if (password.value.trim() === '') {
                password.classList.add('input-error');
                passwordError.textContent = 'Password harus diisi';
                passwordError.style.display = 'block';
                isValid = false;
            } else if (password.value.length < 6) {
                password.classList.add('input-error');
                passwordError.textContent = 'Password minimal 6 karakter';
                passwordError.style.display = 'block';
                isValid = false;
            }
            
            return isValid;
        }
        
        // Show notification
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = `notification ${type} show`;
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }
        

    // Handle login form submission
    document.getElementById('login-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    if (!validateForm()) return;
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const rememberMe = document.getElementById('remember').checked;
    
    // Save remember me preference
    localStorage.setItem('rememberMe', rememberMe);
    
    // Show loading state
    const btnText = document.getElementById('btn-text');
    const btnLoader = document.getElementById('btn-loader');
    btnText.style.display = 'none';
    btnLoader.style.display = 'block';
    
    // Rest of the code remains the same...

        
        // Simulate API call
        try {
            await new Promise(resolve => setTimeout(resolve, 1500));
            
            // Simulate successful login - tambahkan data yang lebih lengkap
            const loggedInUser = {
                nama: username,  // Ini yang akan ditampilkan di profil
                username: username.toLowerCase().replace(/\s+/g, '_'),
                email: `${username.toLowerCase().replace(/\s+/g, '_')}@example.com`,
                joinDate: new Date().toISOString(),
                token: 'simulated-jwt-token'
            };
            
            if (rememberMe) {
                localStorage.setItem('loggedInUser', JSON.stringify(loggedInUser));
            } else {
                sessionStorage.setItem('loggedInUser', JSON.stringify(loggedInUser));
            }
            
            showNotification('Login berhasil! Mengarahkan...');
            
            // Redirect to intended page or home
            const urlParams = new URLSearchParams(window.location.search);
            const redirectUrl = urlParams.get('redirect') || 'index.html';
            
            setTimeout(() => {
                window.location.href = redirectUrl;
            }, 1000);
            
        } catch (error) {
            showNotification('Username atau password salah', 'error');
        } finally {
            btnText.style.display = 'block';
            btnLoader.style.display = 'none';
        }
    });

        
        // Check if user is already logged in
        document.addEventListener('DOMContentLoaded', function() {
            const loggedInUser = JSON.parse(localStorage.getItem('loggedInUser')) || 
                            JSON.parse(sessionStorage.getItem('loggedInUser'));
            
            if (loggedInUser) {
                window.location.href = 'index.html';
            }
            
            // Auto focus username field
            document.getElementById('username').focus();
            
            // Set remember me checkbox based on previous choice
            if (localStorage.getItem('rememberMe') === 'true') {
                document.getElementById('remember').checked = true;
            }
        });
        // Social login handlers
        document.querySelector('.social-btn.google').addEventListener('click', function() {
            showNotification('Fitur login dengan Google akan datang', 'error');
        });
        
        document.querySelector('.social-btn.facebook').addEventListener('click', function() {
            showNotification('Fitur login dengan Facebook akan datang', 'error');
        });
    </script>
</body>
</html>
