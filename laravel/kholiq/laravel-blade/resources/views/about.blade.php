<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

```
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background: #f5f7fa;
        color: #222;
        line-height: 1.6;
    }

    .container {
        width: 90%;
        max-width: 1100px;
        margin: auto;
    }

    /* Navbar */
    header {
        background: #ffffff;
        border-bottom: 1px solid #e5e7eb;
    }

    nav {
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        font-size: 24px;
        font-weight: bold;
        color: #111827;
    }

    .nav-menu {
        display: flex;
        gap: 30px;
        list-style: none;
    }

    .nav-menu a {
        text-decoration: none;
        color: #4b5563;
        transition: 0.3s;
    }

    .nav-menu a:hover {
        color: #111827;
    }

    /* Hero */
    .hero {
        padding: 100px 0;
        text-align: center;
        background: #111827;
        color: white;
    }

    .hero h1 {
        font-size: 48px;
        margin-bottom: 15px;
    }

    .hero p {
        max-width: 650px;
        margin: auto;
        color: #d1d5db;
        font-size: 18px;
    }

    /* About */
    .about {
        padding: 80px 0;
        background: white;
    }

    .about-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    .about-image {
        height: 350px;
        background: #e5e7eb;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-size: 20px;
    }

    .about-text h2 {
        font-size: 36px;
        margin-bottom: 20px;
        color: #111827;
    }

    .about-text p {
        color: #6b7280;
        margin-bottom: 15px;
    }

    /* Values */
    .values {
        padding: 80px 0;
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title h2 {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .section-title p {
        color: #6b7280;
    }

    .cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    }

    .card {
        background: white;
        padding: 30px;
        border-radius: 15px;
        border: 1px solid #e5e7eb;
    }

    .card h3 {
        margin-bottom: 12px;
        font-size: 21px;
    }

    .card p {
        color: #6b7280;
    }

    /* Footer */
    footer {
        background: #111827;
        color: white;
        padding: 30px 0;
        text-align: center;
    }

    footer p {
        color: #9ca3af;
    }

    /* Responsive */
    @media (max-width: 768px) {

        .nav-menu {
            display: none;
        }

        .hero {
            padding: 70px 0;
        }

        .hero h1 {
            font-size: 36px;
        }

        .about-content {
            grid-template-columns: 1fr;
        }

        .cards {
            grid-template-columns: 1fr;
        }
    }
</style>
```

</head>

<body>

```
<!-- Navbar -->
<header>
    <div class="container">
        <nav>
            <div class="logo">MyCompany</div>

            <ul class="nav-menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="/profile/Elbas/33">Profile</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <h1>About Us</h1>
        <p>
            Kami membangun solusi yang sederhana, efektif,
            dan memberikan manfaat nyata bagi pelanggan kami.
        </p>
    </div>
</section>

<!-- About -->
<section class="about">
    <div class="container">
        <div class="about-content">

            <div class="about-image">
                Your Image
            </div>

            <div class="about-text">
                <h2>Who We Are</h2>

                <p>
                    Kami adalah perusahaan yang berfokus pada
                    memberikan solusi berkualitas melalui
                    pengalaman, teknologi, dan pelayanan terbaik.
                </p>

                <p>
                    Dengan mengutamakan kualitas dan kebutuhan
                    pelanggan, kami terus berkembang untuk
                    memberikan hasil yang dapat diandalkan.
                </p>

                <p>
                    Kami percaya bahwa solusi yang baik bukan
                    hanya terlihat bagus, tetapi juga harus
                    berfungsi dengan baik dan memberikan nilai
                    nyata.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- Values -->
<section class="values">
    <div class="container">

        <div class="section-title">
            <h2>Our Values</h2>
            <p>Prinsip yang menjadi dasar kami dalam bekerja.</p>
        </div>

        <div class="cards">

            <div class="card">
                <h3>Quality</h3>
                <p>
                    Kami selalu berusaha memberikan hasil
                    dengan standar kualitas yang baik.
                </p>
            </div>

            <div class="card">
                <h3>Integrity</h3>
                <p>
                    Kami menjaga kejujuran dan tanggung jawab
                    dalam setiap pekerjaan.
                </p>
            </div>

            <div class="card">
                <h3>Innovation</h3>
                <p>
                    Kami terus mencari cara yang lebih efektif
                    untuk memberikan solusi terbaik.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <p>&copy; 2026 MyCompany. All rights reserved.</p>
    </div>
</footer>
```

</body>
</html>