<?php 
    use thecodeisbae\LayoutManager\LayoutManager; 
    LayoutManager::init(); 
?>

<?php LayoutManager::start_section('header') ?>
    <style>
        .bg-login-image {
            background: url(<?= assets("/img/panier.jpg") ?>);
            background-position: center;
            background-size: cover;
        }
    </style>
<?php LayoutManager::end_section('header') ?>

<?php LayoutManager::start_section('content') ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bon retour !</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="login"
                                                aria-describedby="emailHelp" placeholder="Identifiant">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                placeholder="Mot de passe">
                                        </div>
                                        <a href="#" onclick="submitLoginAjax();" id="btnLog"
                                            class="btn btn-primary btn-user btn-block">
                                            Se connecter
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Mot de passe oublié ?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="/register">Créer un compte!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php LayoutManager::end_section('content') ?>

<?php LayoutManager::end_section('footer') ?>
    <script>
        function submitLoginAjax()
        {
            var login = $('#login').val();
            var password = $('#password').val();
            if(login != '' && password != '')
            {
                $('#btnLog').html('Patienter <i class="fa fa-spinner fa-spin"></i>');
                $.ajax({
                    type: "post",
                    url: "/submitLoginAjax",
                    data: {login:login,password:password},
                    success: function (msg) {
                        console.log(msg);
                        var val = msg.split("||");
                        if (val[0] == "true") {
                            setTimeout(() => {
                                toastr.success(val[1]);
                            }, 1000);
                            setTimeout(() => {
                                location.href = '/home.' + Math.floor(Math.random() *
                                    10000000000) + 1;
                            }, 2000);
                        } else if (val[0] == "false") {
                            toastr.error(val[1]);
                            $('#btnLog').html('Se connecter');
                        }
                    }
                });
            }else{
                toastr.error('Tous les champs sont requis');
            }
        }    
    </script>
<?php LayoutManager::end_section('footer') ?>
<?php LayoutManager::set(_VIEWS_PATH.'app/connexionLayout.php') ?>