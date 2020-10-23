<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">CI4 App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" href="/">Home</a>
                <a class="nav-link" href="/novel">Novel</a>
                <a class="nav-link" href="/user">User</a>
                <a class="nav-link" href="/pages/about">About</a>
            </div>
            <div class="navbar-nav ml-auto">
                <?php if (session()->get("logged_in")) : ?>
                    <a class="nav-link" href="/logout">Logout</a>
                <?php else : ?>
                    <a class="nav-link" href="/login">Login</a>
                    <a class="nav-link" href="/register">Register</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</nav>