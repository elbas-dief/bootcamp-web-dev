<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header PHP P8</title>

    <style>
        * {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            padding: 0;
            margin: 0;
        }

        nav {
            background: linear-gradient(#2626a5, #161677, rgb(38, 38, 165));
        }

        .navbar-parent {
            max-width: 1200px;
            margin: auto;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* width: 100%; */
            padding: 10px 25px 10px 25px;
            /* padding: 0px 15px; */
            margin: auto;
        }

        .navbar-brand {
            color: white;
            display: flex;
            align-items: center;
            text-decoration: none;
            gap: 12px;
        }

        .nav-bar {
            color: white;
            display: flex;
            padding: 0px 10px 0px 10px;
            gap: 10px;
        }

        .nav-bar a {
            text-decoration: none;
            color: white;
            transition: transform 0.3s;
        }

        .nav-item {
            padding: 5px 10px;
            margin: 0px;
        }

        .nav-item:hover {
            background-color: rgb(86, 86, 245);
            border-radius: 5px;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="navbar-parent">
                <a href="#" class="navbar-brand">
                    <img src="https://raw.githubusercontent.com/elbas-dief/starterkit/refs/heads/main/assets/logo-kontraktor.png"
                        class="logo" width="40px">
                    <h3>Kontraktor Jaya</h3>
                </a>

                <div class="nav-bar">
                    <a href="../p8-latihan/index.php" class="nav-item">Home</a>
                    <a href="../p8-latihan/about-us.php" class="nav-item">About Us</a>
                    <a href="../p8-latihan/katalog.php" class="nav-item">Katalog</a>
                    <a href="../p8-latihan/contact-us.php" class="nav-item">Contact Us</a>
                </div>

                <button class="custom-toggler" type="button" aria-label="Toggle navigation">
                    <span class="custom-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>
</body>
</html>