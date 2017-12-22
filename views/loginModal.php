<!--Modal: Login Form-->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

            <!--Header-->
            <div class="modal-header white-text" style="background-color: #34B4E4;">
                <h4 class="title"><i class="fa fa-user"></i> Login</h4>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
            <form action="<?= base_url('auth/login') ?>" method="post">
                <div class="modal-body">
                    <div class="md-form form-sm">
                        <input type="text" id="form30" name="identity" class="form-control" placeholder="E-mail"
                               autofocus>
                        <!--                    <label for="form30">Your email</label>-->
                    </div>

                    <div class="md-form form-sm">
                        <input type="password" id="form31" name="password" class="form-control" placeholder="Senha">
                        <!--                    <label for="form31">Your password</label>-->
                    </div>

                    <div class="text-center mt-2">
                        <button class="btn btn-info"><i class="fa fa-sign-in mr-1"></i> Entrar</button>
                    </div>
                </div>
            </form>
            <!--Footer-->
            <div class="modal-footer">
                <div class="options text-center text-md-right mt-1">

                </div>
                <button type="button" class="btn btn-blue-grey ml-auto" data-dismiss="modal"><i
                        class="fa fa-times mr-1"></i> Fechar
                </button>
            </div>
        </div>
    </div>
    <!--/.Content-->
</div>
</div>
<!--Modal: Login Form-->