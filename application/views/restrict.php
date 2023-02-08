<section style="min-height: calc(100vh - 83px)" class="light-bg">
    <div class="container">
        <!--área restrita-->
        <div class="row">
            <div class="col-lg-offset-3 col-lg-6 text-center">
                <div class="section-title">
                    <h2>ÁREA RESTRITA</h2>
                </div>
            </div>
        </div>
        <!--logoff-->
        <div class="row">
            <div class="col-lg-offset-5 col-lg-2 text-center">
                <div class="form-group">
                    <a class="btn btn-link"><i class="fa fa-user"></i></a>
                    <a class="btn btn-link" href="restrict/logoff"><i class="fa fa-sign-out"></i></a>
                </div>
            </div>
        </div>

        <div class="container">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_hospitais" role="tab" data-toggle="tab">Hospitais</a></li>
                <li><a href="#tab_diretoria" role="tab" data-toggle="tab">Diretoria</a></li>
                <li><a href="#tab_contato" role="tab" data-toggle="tab">Contato</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab_hospitais" class="tab-pane active">
                    <!--hospitais-->    
                    <div class="container-fluid">
                        <h2 class="text-center"><strong>Gerenciar Hospitais</strong></h2>
                        <a id="btn_add_hospitais" class="btn btn-primary"><i class="fa fa-plus">&nbsp;Adicionar Hospitais</i></a>
                        <table id="dt_hospitais" class="table table-striped table-bordered">
                            <thead>
                                <tr class="tableheader">
                                    <th>Nome</th>
                                    <th>Imagem</th>
                                    <th>Cooperados</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--diretoria-->
                <div id="tab_diretoria" class="tab-pane">    
                    <div class="container-fluid">
                        <h2 class="text-center"><strong>Gerenciar Membros</strong></h2>
                        <a id="btn_add_membro" class="btn btn-primary"><i class="fa fa-plus">&nbsp;Adicionar Membros</i></a>
                        <table id="dt_diretoria" class="table table-striped table-bordered">
                            <thead>
                                <tr class="tableheader">
                                    <th>Nome</th>
                                    <th>Foto</th>
                                    <th>Função</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--contato-->
                <div id="tab_contato" class="tab-pane">    
                    <div class="container-fluid">
                        <h2 class="text-center"><strong>Gerenciar Contatos</strong></h2>
                        <a id="btn_add_contatos" class="btn btn-primary"><i class="fa fa-plus">&nbsp;Adicionar Contatos</i></a>
                        <table id="dt_contato" class="table table-striped table-bordered">
                            <thead>
                                <tr class="tableheader">
                                    <th>Login</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal_hospitais" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title">Hospitais</h4>
            </div>
            <div class="modal-body">
                <form id="form_hospitais">
                    <input name="hospitais_id" hidden>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">

                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
