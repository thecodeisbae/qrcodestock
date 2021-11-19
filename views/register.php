<?php 
    use thecodeisbae\LayoutManager\LayoutManager; 
    LayoutManager::init(); 
?>

<?php LayoutManager::start_section('header') ?>
    <style>       
        .bg-register-image {
        background: url(<?= assets('/img/panier.jpg') ?>);
        background-position: center;
        background-size: cover;
        }
    </style>
<?php LayoutManager::end_section('header') ?>

<?php LayoutManager::start_section('content') ?>
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Creer un compte !</h1>
                            </div>
                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="prenoms"
                                            placeholder="Prénoms">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="nom"
                                            placeholder="Nom">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email"
                                        placeholder="Email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" placeholder="Mot de passe">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="cpassword" placeholder="Confirmer le mot de passe">
                                    </div>
                                </div>
                                <a href="#" onclick="submitRegisterAjax();" id="btnSub" class="btn btn-primary btn-user btn-block">
                                    Créer mon compte
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Mot de pass oublié ?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="/login">Vous avez déjà un compte ? Connectez-vous !</a>
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
        function submitRegisterAjax()
        {
            var nom = $('#nom').val();
            var prenoms = $('#prenoms').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var cpassword = $('#cpassword').val();

            if(nom != '' && prenoms != '' && email != '' && password != '' && cpassword != '')
            {
                if(password != cpassword)
                {
                    toastr.error('Les deux mots de passe ne correspondent pas');
                    return;
                }
                $('#btnSub').html('Patienter <i class="fa fa-spinner fa-spin"></i>');
                $.ajax({
                    type: "post",
                    url: "/submitRegisterAjax",
                    data: {nom:nom,prenoms:prenoms,email:email,password:password},
                    success: function (msg) {
                        console.log(msg);
                        var val = msg.split("||");
                        if (val[0] == "true") {
                            setTimeout(() => {
                                toastr.success(val[1]);
                            }, 1000);
                            setTimeout(() => {
                                location.href = '/login/0.' + Math.floor(Math.random() *
                                    10000000000) + 1;
                            }, 2000);
                        } else if (val[0] == "false") {
                            toastr.error(val[1]);
                            $('#btnSub').html('Créer mon compte');
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